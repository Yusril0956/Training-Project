<?php

namespace App\Exports;

use App\Models\AttendanceRecord;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class AttendanceExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithEvents
{
    protected $trainingId;
    protected ?Request $request;

    public function __construct($trainingId, ?Request $request = null)
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
            $query->where('attendance_session_id', $this->request->input('session_id'));
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
        $sessionDate = data_get($record, 'session.date');

        return [
            data_get($record, 'member.id', '-'),
            data_get($record, 'member.user.name', '-'),
            data_get($record, 'member.user.email', '-'),
            data_get($record, 'session.id', '-'),
            data_get($record, 'session.title', '-'),
            $sessionDate ? Carbon::parse($sessionDate)->format('Y-m-d') : '-',
            $record->status ?? '-',
            $record->notes ?? '-',
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                $highestRow = $sheet->getHighestRow();
                $highestColumn = $sheet->getHighestColumn();

                $headerRange = "A1:{$highestColumn}1";
                $tableRange = "A1:{$highestColumn}{$highestRow}";

                // Style header
                $sheet->getStyle($headerRange)->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'color' => [
                            'rgb' => 'FFFFFF',
                        ],
                    ],
                    'fill' => [
                        'fillType' => Fill::FILL_SOLID,
                        'startColor' => [
                            'rgb' => '198754',
                        ],
                    ],
                    'alignment' => [
                        'horizontal' => Alignment::HORIZONTAL_CENTER,
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                ]);

                // Border dan alignment semua tabel
                $sheet->getStyle($tableRange)->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => Border::BORDER_THIN,
                            'color' => [
                                'rgb' => 'D9D9D9',
                            ],
                        ],
                    ],
                    'alignment' => [
                        'vertical' => Alignment::VERTICAL_CENTER,
                    ],
                ]);

                // Rata tengah untuk kolom tertentu
                $sheet->getStyle('A:A')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('D:D')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('F:F')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                $sheet->getStyle('G:G')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // Notes dibuat wrap text
                $sheet->getStyle('H:H')->getAlignment()->setWrapText(true);

                // Tinggi header
                $sheet->getRowDimension(1)->setRowHeight(25);

                // Filter header
                $sheet->setAutoFilter($headerRange);
            },
        ];
    }
}