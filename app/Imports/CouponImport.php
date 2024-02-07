<?php

namespace App\Imports;

use App\Models\Coupon;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CouponImport implements ToModel, WithHeadingRow, WithChunkReading, WithBatchInserts
{

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {

        $code  = trim($row['code']);
        $value = trim($row['value']);

        if(!empty($code) && !empty($value)) {
            Coupon::create([
                'code' => $code,
                'type' => 'fixed',
                'value' => $value,
                'usage_limit' => 1,
                'start_date' => Carbon::now('Asia/Riyadh')->toDate(),
                'end_date' => '2022-06-01 00:00:00',
                'active' => 1,
                'limit_user' => 1,
                'specific_users' => 0,
                'course_id' => 2,
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
