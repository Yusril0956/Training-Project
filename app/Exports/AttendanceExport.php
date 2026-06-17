<?php

namespace App\Exports;

use App\Models\AttendanceRecord;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Http\Request;

class AttendanceExport implements FromCollection, WithHeadings, WithMapping
{
    protected $trainingId;
    protected $request;

    public function __construct($trainingId, Request $request = null)
    {
        $this->trainingId = $trainingId;
        $this->request = $request;
    }

    public function collection()
    {
        $query = AttendanceRecord::with(['member.user', 'session'])
            ->whereHas('member', function ($q) {
                $q->where('training_id', $this->trainingId);
            });

        if ($this->request && $this->request->filled('session_id')) {
            $query->where('attendance_session_id', $this->request->session_id);
        }

        return $query->get();
    }

    public function headings(): array
    {
        return [
            'Member ID',
            'Member Name',
            'Member Email',
            'Session ID',
            'Session Title',
            'Session Date',
            'Status',
            'Notes',
        ];
    }

    public function map($record): array
    {
        return [
            $record->member->id ?? '',
            $record->member->user->name ?? '',
            $record->member->user->email ?? '',
            $record->session->id ?? '',
            $record->session->title ?? '',
            optional($record->session->date)->format('Y-m-d'),
            $record->status,
            $record->notes ?? '',
        ];
    }
}
