<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class FavoriteTime extends Model
{
    use HasTranslations, HasFactory;

    public $translatable = ['title'];

    protected $guarded = [];


}
