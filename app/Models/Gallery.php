<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'type',
        'description',
        'url',
    ];

    protected $appends = ['image_url'];
   
    public function getImageUrlAttribute()
    {
        if (!$this->url) {
            return null;
        }
        return \App\Classes\ImageuploadHelper::getUploadedFileUrl($this->url);
    }
}
