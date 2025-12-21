<?php

namespace App\View\Components;

use App\Models\GeneralSetting;
use App\Models\ServiceCategory;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Header extends Component
{
    /**
     * Create a new component instance.
     */
    public $headerContent;
    public function __construct()
    {
        $settings = GeneralSetting::whereIn('key', [
            'site_facebook',
            'site_twitter',
            'site_linkedin',
            'site_instagram',
        ])->pluck('value', 'key');

        $this->headerContent = [
            "site_linkedin" => $settings['site_linkedin'] ?? null,
            "site_facebook" => $settings['site_facebook'] ?? null,
            "site_twitter" => $settings['site_twitter'] ?? null,
            "site_instagram" => $settings['site_instagram'] ?? null,
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.header');
    }
}
