<?php

namespace App\Imports;

use App\Models\Student;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class StudentImport implements ToModel, WithHeadingRow, WithChunkReading, WithBatchInserts
{

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {

        $serial_number = trim($row['rkm_altalb'] ?? null);
        $name    = trim($row['asm_altalb'] ?? null);
        $section = trim($row['alksm'] ?? null);
        $status  = trim($row['hal_altalb'] ?? null);
        $form_type         = trim($row['noaa_alastmar'] ?? null);
        $payment_amount    = trim($row['almtbky'] ?? null);
//        $path    = trim($row['almsar']);
//        $client_zoho_id    = trim($row['client_zoho_id']);

        if(!empty($serial_number) && !empty($name) && !empty($status) && !empty($section) && !empty($payment_amount)){

            Student::query()->updateOrCreate([
                'serial_number' => $serial_number,
                'section' => $section == 'بنين' ? '1' : '2',
                ],
                [
                'name'    => $name,
                'status'  => $status == 'منتظم' ? '1' : '0',
                'form_type'        => $form_type,
                'payment_amount'   => $payment_amount * 100,
//                'path'    => $path,
//                'client_zoho_id' => $client_zoho_id,
                ]);

        }
    }

    public function batchSize(): int
    {
        return 300;
    }

    public function chunkSize(): int
    {
        return 300;
    }

}
