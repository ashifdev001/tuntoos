<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrackingScripts extends Model
{
    use HasFactory;

    protected $fillable = ['page', 'script'];

    // Accessor: Get the script value (e.g., decode entities if needed)
    public function getScriptAttribute($value)
    {
        return htmlspecialchars_decode($value);
    }

    // Mutator: Set the script value (e.g., encode entities before saving)
    public function setScriptAttribute($value)
    {
        $this->attributes['script'] = htmlspecialchars($value);
    }
}
