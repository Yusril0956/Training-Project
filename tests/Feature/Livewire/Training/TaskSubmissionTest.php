<?php

namespace Tests\Feature\Livewire\Training;

use App\Livewire\Training\Tasks\Show;
use App\Models\JenisTraining;
use App\Models\TaskSubmission;
use App\Models\Tasks;
use App\Models\Training;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

class TaskSubmissionTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_submit_task_with_file(): void
    {
        Storage::fake('public');

        $user = User::factory()->create();

        $jenisTraining = JenisTraining::create([
            'code' => 'GK',
            'name' => 'General Knowledge',
        ]);

        $training = Training::create([
            'name' => 'Training Test',
            'description' => 'Training untuk pengujian submit tugas.',
            'status' => 'open',
            'jenis_training_id' => $jenisTraining->id,
        ]);

        $task = Tasks::create([
            'title' => 'Tugas Peserta',
            'description' => 'Upload hasil tugas.',
            'training_id' => $training->id,
            'deadline' => now()->addDay(),
        ]);

        $file = UploadedFile::fake()->create('jawaban.pdf', 256, 'application/pdf');

        Livewire::actingAs($user)
            ->test(Show::class, [
                'trainingId' => $training->id,
                'taskId' => $task->id,
            ])
            ->set('submission_file', $file)
            ->set('message', 'Hasil tugas peserta.')
            ->call('submitTask')
            ->assertHasNoErrors();

        $submission = TaskSubmission::first();

        $this->assertNotNull($submission);
        $this->assertSame($user->id, $submission->user_id);
        $this->assertSame($task->id, $submission->task_id);
        $this->assertSame('Hasil tugas peserta.', $submission->answer);
        $this->assertNotNull($submission->file_path);
        Storage::disk('public')->assertExists($submission->file_path);
    }
}
