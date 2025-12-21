<?php

namespace App\Models;

use App\Classes\ImageuploadHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achievement extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'image',
        'countTxt',
    ];

    protected $appends = ['image_url'];

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return null;
        }
        return ImageuploadHelper::getUploadedFileUrl($this->image);
    }
}
