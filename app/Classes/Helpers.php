<?php

namespace App\Classes;

use App\Models\GeneralSetting;
use App\Models\User;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class Helpers
{

    public static function getSettingsValue($setting)
    {
        $settingRec = GeneralSetting::where('key', $setting)->first();
        return ($settingRec) ? $settingRec->value : '';
    }
    public static function generateSlug($model, $key)
    {
        if ($model && $key) {
            $slug = Str::slug($key);
            $originalSlug = $slug;
            $counter = 1;

            $usesSoftDeletes = in_array('Illuminate\Database\Eloquent\SoftDeletes', class_uses($model));

            $query = $model->newQuery();

            if ($usesSoftDeletes) {
                $query = $query->withTrashed();
            }

            while ($query->where('slug', $slug)->exists()) {
                $slug = "{$originalSlug}-{$counter}";
                $counter++;
            }

            return $slug;
        }
        return null;
    }
}
