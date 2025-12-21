<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;
    protected $fillable = [
        'firstName',
        'lastName',
        'email',
        'phone',
        'job_id',
        'resume',
        'gender',
        'message',
    ];

     protected $appends = ['resume_url'];
     protected $with = ['job'];
    
    public function getResumeUrlAttribute()
    {
        if (!$this->resume) {
            return null;
        }
        return \App\Classes\ImageuploadHelper::getUploadedFileUrl($this->resume);
    }

    function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }

}
