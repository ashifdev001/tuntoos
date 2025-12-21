<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Classes\ImageuploadHelper;
use Illuminate\Support\Str;

class Blog extends Model
{
    use HasFactory;

    protected $appends = [
        "coverImageUrl",
        "imageUrl"
    ];

    public function getCreatedAtAttribute($value)
    {
        return Carbon::parse($value)->format('D M-Y h:i');
    }
    // Accessor for coverImageUrl
    public function getCoverImageUrlAttribute()
    {
        return ImageuploadHelper::getUploadedFileUrl($this->cover_image);
    }

    public function getImageUrlAttribute()
    {
        return ImageuploadHelper::getUploadedFileUrl($this->image);
    }

    public static function generateSlug($title)
    {
        $slug = Str::slug($title);
        $originalSlug = $slug;
        $counter = 1;

        while (self::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        return str_replace(['-', ' '], '', $slug);
    }
}
