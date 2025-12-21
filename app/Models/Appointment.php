<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone',
        'email',
        'type',
        'service_category_id',
        'message',
        'location',
        'status',
    ];

    protected $with = [
        'serviceCat'
    ];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('D M-Y h:i A');
    }

    function serviceCat()
    {
        return $this->belongsTo(ServiceCategory::class, 'service_category_id', 'id');
    }
}
