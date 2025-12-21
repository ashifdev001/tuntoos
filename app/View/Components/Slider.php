<?php

namespace App\View\Components;

use App\Classes\ImageuploadHelper;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Slider extends Component
{
    /**
     * Create a new component instance.
     */
    public $sliderImages;
    public $newsLatter;
    public function __construct()
    {
        $this->sliderImages = \App\Models\Banner::where('type', 'home')->where('status', 'active')->orderBy('id', 'DESC')
            ->get();
        $this->newsLatter = \App\Models\GeneralSetting::whereIn('key', [
            'banner_bellow_heading',
            'banner_bellow_description',
            'banner_bellow_btn_txt',
            'about_home_image',
            'about_sort_description'
        ])->pluck('value', 'key');
        $this->newsLatter = [
            "heading" => $this->newsLatter['banner_bellow_heading'] ?? null,
            "description" => $this->newsLatter['banner_bellow_description'] ?? null,
            "button_text" => $this->newsLatter['banner_bellow_btn_txt'] ?? null,
            "about_image" =>  ImageuploadHelper::getUploadedFileUrl($this->newsLatter['about_home_image'] ?? null),
            "about_description" => $this->newsLatter['about_sort_description'] ?? null
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.slider');
    }
}
