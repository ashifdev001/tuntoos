<?php

namespace App\View\Components;

use App\Classes\ImageuploadHelper;
use App\Models\GeneralSetting;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HomeSection extends Component
{
    /**
     * Create a new component instance.
     */
    public $homeSection;
    public function __construct()
    {
        $this->homeSection = GeneralSetting::whereIn('key', [
            'rf_heading',
            'rf_description',
            'rf_image_1',
            'rf_image_2',
            'rf_image_3',
            'rf_site_image',
            'dp_offer',
            'dp_title',
            'dp_description',
            'dp_get_in_text',
            'dp_image',
            'vd_video_url',
            'vd_image'
        ])->pluck('value', 'key');
        $this->homeSection = [
            ...$this->homeSection,
            'rf_image_1_url'=>ImageuploadHelper::getUploadedFileUrl($this->homeSection['rf_image_1']),
            'rf_image_2_url'=>ImageuploadHelper::getUploadedFileUrl($this->homeSection['rf_image_2']),
            'rf_image_3_url'=>ImageuploadHelper::getUploadedFileUrl($this->homeSection['rf_image_3']),
            'rf_site_image_url'=>ImageuploadHelper::getUploadedFileUrl($this->homeSection['rf_site_image']),
            'dp_image_url'=>ImageuploadHelper::getUploadedFileUrl($this->homeSection['dp_image']),
            'vd_image_url'=>ImageuploadHelper::getUploadedFileUrl($this->homeSection['vd_image']),
            'vd_video_url' => (strpos($this->homeSection['vd_video_url'], 'https://') === 0)
                ? $this->homeSection['vd_video_url']
                : ImageuploadHelper::getUploadedFileUrl($this->homeSection['vd_video_url']),
        ];
        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.home-section');
    }
}
