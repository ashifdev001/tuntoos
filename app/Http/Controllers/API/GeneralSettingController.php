<?php

namespace App\Http\Controllers\API;

use App\Classes\ImageuploadHelper;
use App\Models\Currency;
use Illuminate\Http\Request;
use App\Models\GeneralSetting;
use App\Models\Orders\PaymentMethod;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class GeneralSettingController extends BaseController
{
    private $fileList = [
        'about_image',
        'about_home_image',
        'expert_image',
        'franchise_image',
        'funtoos_image',
        'funtoos_image_1',
        'funtoos_image_2',
        'distributor_image',
        'vd_image',
        'rf_image_1',
        'rf_image_2',
        'rf_image_3',
        'rf_site_image',
        'dp_image',
        'vd_video_file'
    ];
    private $mimeTypeList = [
        'application/pdf',
        'video/mp4',
        'video/webm',
        'video/ogg',
        'video/quicktime',   // .mov
        'video/x-msvideo',   // .avi
        'video/x-matroska',  // .mkv
    ];

    private $mimeTypeListImage = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/svg+xml'];

    public function generalSettingsList()
    {
        $generalSettings = GeneralSetting::all()->toArray();
        foreach ($generalSettings as $gs) {
            if (in_array($gs['key'], $this->fileList)) {
                $generalSettings[] = [
                    'key' => $gs['key'] . '_url',
                    'value' => ImageuploadHelper::getUploadedFileUrl($gs['value'])
                ];
            }
        }

        return $this->sendResponse($generalSettings, 'General Settings');
    }

    function saveSettings(Request $request)
    {

        try {
            foreach ($request->all() as $key => $value) {
                $generalSettingsModel = GeneralSetting::where('key', $key)->first();
                if (empty($generalSettingsModel)) {
                    $generalSettingsModel = new GeneralSetting();
                }
                if (!empty($key)) {
                    if (in_array($key, $this->fileList) && $request->hasFile($key)) {
                        $mimeType = $request->file($key)->getMimeType();
                        if (in_array($mimeType, $this->mimeTypeList)) {
                            $uploadStatus = ImageuploadHelper::uploadImage($request->file($key), 'setting_images', false, null, false);
                            $value = $uploadStatus['path'];
                        } else if (in_array($mimeType, $this->mimeTypeListImage)) {
                            $uploadStatus = ImageuploadHelper::uploadImage($request->file($key), 'setting_images');
                            $value = $uploadStatus['path'];
                        } else {
                            $value = '';
                            continue;
                        }
                    }
                    $generalSettingsModel->key = $key;
                    $generalSettingsModel->value = is_array($value) ? json_encode($value) : $value;
                    $generalSettingsModel->save();
                }
            }
            return $this->sendResponse([], 'General setting saved!');
        } catch (\Exception $e) {
            Log::error('Exception: ' . $e->getMessage(), [
                'file' => $e->getFile(),
                'line' => $e->getLine(),
                'trace' => $e->getTraceAsString(),
            ]);
            return $this->sendError('Something went wrong!', $e->getMessage());
        }
    }
}
