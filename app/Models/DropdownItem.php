<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DropdownItem extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
    ];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('D M-Y h:i A');
    }
}
