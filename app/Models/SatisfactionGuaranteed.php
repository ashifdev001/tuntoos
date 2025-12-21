<?php

namespace App\Models;

use App\Classes\ImageuploadHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SatisfactionGuaranteed extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'icon',
        'link',
    ];
     protected $appends = ['icon_url'];

    public function getIconUrlAttribute()
    {
        if (!$this->icon) {
            return null;
        }
        return ImageuploadHelper::getUploadedFileUrl($this->icon);
    }
}
