<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'thumbnail',
        'video_type',
        'video_url',
        'video_file',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    // 🔥 Append custom attribute automatically
    protected $appends = ['video_full_url','thumbnail_full_url'];

    /**
     * Get full video URL (local upload or external URL)
     */
    public function getVideoFullUrlAttribute()
    {
        // External URL
        if ($this->video_type === 'url' && !empty($this->video_url)) {
            return $this->video_url;
        }

        // Local uploaded video
        if ($this->video_type === 'upload' && !empty($this->video_file)) {
            return \App\Classes\ImageuploadHelper::getUploadedFileUrl($this->video_file);
        }

        return null;
    }

    /**
     * Optional: Full thumbnail URL
     */
    public function getThumbnailFullUrlAttribute()
    {
        return $this->thumbnail ? \App\Classes\ImageuploadHelper::getUploadedFileUrl($this->thumbnail) : null;
    }
}
