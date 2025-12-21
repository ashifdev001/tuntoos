<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Flavor extends Model
{
    use HasFactory;
    protected $fillable = [
        'image',
        'title',
        'description',
        'slug',
    ];

    protected $appends = ['image_url'];
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return null;
        }
        return \App\Classes\ImageuploadHelper::getUploadedFileUrl($this->image);
    }
}
