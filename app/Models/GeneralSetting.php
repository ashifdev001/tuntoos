<?php

namespace App\Models;

use App\Classes\Helpers;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GeneralSetting extends Model
{
    use HasFactory;
    protected $fillable = [
        'key',
        'value'
    ];

}
