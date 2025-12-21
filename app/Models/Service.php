<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'type',
        'description',
        'meta_title',
        'meta_description',
        'cover_image',
        'image',
        'card_image',
        'category_id'
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

        return str_replace(['-',' '], '', $slug);
    }

    public function category()
    {
        return $this->belongsTo(ServiceCategory::class , 'category_id', 'id');
    }
    
    public function items()
    {
        return $this->hasMany(ServiceItem::class, 'service_id', 'id');
    }

    protected $appends = ['image_url','cover_image_url','card_image_url'];
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
    
    public function getCardImageUrlAttribute()
    {
        if (!$this->card_image) {
            return null;
        }
        return \App\Classes\ImageuploadHelper::getUploadedFileUrl($this->card_image);
    }
}
