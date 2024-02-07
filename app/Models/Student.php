<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function subscribes()
    {
        return $this->hasMany(Subscribe::class, 'student_id');
    }

    public function coupons()
    {
        return $this->belongsToMany(Coupon::class, 'coupon_student');
    }

}
