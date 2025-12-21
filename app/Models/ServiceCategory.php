<?php

namespace App\Models;

use App\Classes\Helpers;
use App\Classes\ImageuploadHelper;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        "title",
        "description",
        "image",
        "cover_image",
        "slug"
    ];

    protected $appends = ['image_url', 'cover_image_url'];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($serviceCategory) {
            $serviceCategory->slug = str_replace([' ', '-'], '', Helpers::generateSlug(new self(), $serviceCategory->title));
        });
    }

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return null;
        }
        return ImageuploadHelper::getUploadedFileUrl($this->image);
    }

    public function getCoverImageUrlAttribute()
    {
        if (!$this->cover_image) {
            return null;
        }
        return ImageuploadHelper::getUploadedFileUrl($this->cover_image);
    }

    public function services()
    {
        return $this->hasMany(Service::class, 'category_id');
    }
}
