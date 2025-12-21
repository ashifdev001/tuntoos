<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CobWeb extends Model
{
      use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'description',
        'cover_image',
        'image'
    ];

    public static function generateSlug($title)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        while (self::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return $slug;
    }

     public function items()
    {
        return $this->hasMany(CobWebItem::class, 'cobweb_id', 'id');
    }

    protected $appends = ['image_url','cover_image_url'];
    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            return null;
        }
        return \App\Classes\ImageuploadHelper::getUploadedFileUrl($this->image);
    }

     public function getCoverImageUrlAttribute()
    {
        if (!$this->cover_image) {
            return null;
        }
        return \App\Classes\ImageuploadHelper::getUploadedFileUrl($this->cover_image);
    }

}
