<?php

namespace App\Models;

use App\Classes\ImageuploadHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'title',
        'subtitle',
        'image',
        'btn_txt',
        'link',
        'status'
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
