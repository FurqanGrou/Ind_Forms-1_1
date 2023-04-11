<?php

namespace App\Exports;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class UnsubscribedStudentsExport implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize, ShouldQueue
{
    protected $date_from;
    protected $date_to;

    function __construct($date_from, $date_to)
    {
        $this->date_from = $date_from;
        $this->date_to = $date_to;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $students = DB::table('students')
            ->select('students.name',
                'students.serial_number',
                DB::raw('(CASE
                        WHEN students.section = "1" THEN "بنين"
                        ELSE "بنات"
                        END) AS user_section'),
                'students.path',
                'students.client_zoho_id',
            )
            ->leftJoin('subscribes', function($join) {
                $join->on('students.id', '=', 'subscribes.student_id')
                    ->whereNotBetween('subscribes.created_at', [$this->date_from, $this->date_to]);
            })
            ->whereNull('subscribes.id')
            ->where('students.status', '=', '1');

        return $students->get();
    }

    public function headings(): array
    {
        return [
            'اسم الطالب',
            'رقم الطالب',
            'القسم',
            'المسار',
            'رقم زوهو',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            // Style the first row as bold text.
            1 => ['font' => ['bold' => true, 'size' => 12], 'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER]],
        ];
    }
}
