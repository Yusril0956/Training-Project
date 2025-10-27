<?php

namespace App\Services;

use App\Models\Training;
use App\Models\TrainingMember;
use App\Models\JenisTraining;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Collection;
use Exception;

class TrainingService
{
    /**
     * Create a new training
     *
     * @param array $data
     * @return Training
     * @throws Exception
     */
    public function createTraining(array $data): Training
    {
        try {
            return Training::create($data);
        } catch (Exception $e) {
            throw new Exception('Gagal membuat pelatihan: ' . $e->getMessage());
        }
    }

    /**
     * Update an existing training
     *
     * @param int $id
     * @param array $data
     * @return Training
     * @throws Exception
     */
    public function updateTraining(int $id, array $data): Training
    {
        try {
            $training = Training::findOrFail($id);
            $training->update($data);
            return $training;
        } catch (Exception $e) {
            throw new Exception('Gagal memperbarui pelatihan: ' . $e->getMessage());
        }
    }

    /**
     * Delete a training with cascade
     *
     * @param int $id
     * @return bool
     * @throws Exception
     */
    public function deleteTraining(int $id): bool
    {
        try {
            $training = Training::findOrFail($id);

            DB::transaction(function () use ($training) {
                // Delete members
                $training->members()->delete();

                // Delete tasks and their submissions
                foreach ($training->tasks as $task) {
                    $task->submissions()->delete();
                    $task->delete();
                }

                // Delete certificates
                $training->certificates()->delete();

                // Delete the training
                $training->delete();
            });

            return true;
        } catch (Exception $e) {
            throw new Exception('Gagal menghapus pelatihan: ' . $e->getMessage());
        }
    }

    /**
     * Approve a training request
     *
     * @param int $id
     * @return bool
     * @throws Exception
     */
    public function approveTraining(int $id): bool
    {
        try {
            $training = Training::findOrFail($id);
            $training->update(['status' => 'open']);
            return true;
        } catch (Exception $e) {
            throw new Exception('Gagal menyetujui pelatihan: ' . $e->getMessage());
        }
    }

    /**
     * Reject a training request
     *
     * @param int $id
     * @return bool
     * @throws Exception
     */
    public function rejectTraining(int $id): bool
    {
        try {
            $training = Training::findOrFail($id);
            $training->update(['status' => 'close']);
            return true;
        } catch (Exception $e) {
            throw new Exception('Gagal menolak pelatihan: ' . $e->getMessage());
        }
    }

    /**
     * Register a user for a training
     *
     * @param int $trainingId
     * @param int $userId
     * @return TrainingMember
     * @throws Exception
     */
    public function registerUserForTraining(int $trainingId, int $userId): TrainingMember
    {
        try {
            $training = Training::findOrFail($trainingId);

            if ($training->status === 'close') {
                throw new Exception('Pendaftaran untuk training ini sudah ditutup.');
            }

            // Set start and end dates if not set
            if (!$training->start_date) {
                $training->update([
                    'start_date' => now()->toDateString(),
                    'end_date' => now()->addMonth()->toDateString(),
                ]);
            }

            // Check if user is already registered
            $existingMember = TrainingMember::where('training_id', $training->id)
                ->where('user_id', $userId)
                ->first();

            if ($existingMember) {
                throw new Exception('Anda sudah terdaftar sebagai peserta training ini.');
            }

            // Create new member
            return TrainingMember::create([
                'training_id' => $training->id,
                'user_id' => $userId,
                'status' => 'pending',
                'series' => 'TRN-' . strtoupper(uniqid()),
            ]);
        } catch (Exception $e) {
            throw new Exception('Gagal mendaftar training: ' . $e->getMessage());
        }
    }

    /**
     * Update training settings
     *
     * @param int $trainingId
     * @param array $data
     * @return Training
     * @throws Exception
     */
    public function updateTrainingSettings(int $trainingId, array $data): Training
    {
        try {
            $training = Training::findOrFail($trainingId);
            $training->update($data);
            return $training;
        } catch (Exception $e) {
            throw new Exception('Gagal memperbarui pengaturan pelatihan: ' . $e->getMessage());
        }
    }

    /**
     * Get training dashboard data
     *
     * @param int $trainingId
     * @return array
     * @throws Exception
     */
    public function getTrainingDashboardData(int $trainingId): array
    {
        try {
            $training = Training::withCount(['members', 'tasks', 'materis'])
                ->with(['attendanceSessions' => function ($query) {
                    $query->where('date', '>=', now()->toDateString())
                        ->orderBy('date', 'asc')
                        ->limit(3);
                }])
                ->findOrFail($trainingId);

            return [
                'training' => $training,
                'memberCount' => $training->members_count,
                'taskCount' => $training->tasks_count,
                'materiCount' => $training->materis_count,
                'upcomingSessions' => $training->attendanceSessions,
            ];
        } catch (Exception $e) {
            throw new Exception('Gagal memuat data dashboard: ' . $e->getMessage());
        }
    }

    /**
     * Get trainings with filters
     *
     * @param array $filters
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function getTrainingsWithFilters(array $filters = []): \Illuminate\Database\Eloquent\Builder
    {
        $query = Training::query()
            ->with(['jenisTraining', 'members']);

        if (!empty($filters['search'])) {
            $query->where(function ($q) use ($filters) {
                $q->where('name', 'like', '%' . $filters['search'] . '%')
                    ->orWhere('description', 'like', '%' . $filters['search'] . '%');
            });
        }

        if (!empty($filters['jenis'])) {
            $query->whereHas('jenisTraining', function ($q) use ($filters) {
                $q->where('name', $filters['jenis']);
            });
        }

        return $query->orderBy('status', 'desc');
    }

    /**
     * Get user training statuses for a collection of trainings
     *
     * @param \Illuminate\Contracts\Pagination\LengthAwarePaginator $trainings
     * @param int $userId
     * @return array
     */
    public function getUserTrainingStatuses(\Illuminate\Contracts\Pagination\LengthAwarePaginator $trainings, int $userId): array
    {
        $statuses = [];
        foreach ($trainings as $training) {
            $member = $training->members->where('user_id', $userId)->first();
            $statuses[$training->id] = $member ? $member->status : 'none';
        }
        return $statuses;
    }

    /**
     * Get instructors (users with Admin role)
     *
     * @return Collection
     */
    public function getInstructors(): Collection
    {
        return \App\Models\User::whereHas('roles', function ($q) {
            $q->where('name', 'Admin');
        })->get();
    }
}
