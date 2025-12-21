<?php

namespace App\View\Components;

use App\Models\Branch;
use App\Models\GeneralSetting;
use App\Models\ServiceCategory;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Footer extends Component
{
    /**
     * Create a new component instance.
     */
    public $footerContent;
    public function __construct()
    {
        $settings = GeneralSetting::whereIn('key', [
            'contact_address',
            'site_phone',
            'site_email',
            'site_facebook',
            'site_twitter',
            'site_linkedin',
            'site_instagram',
        ])->pluck('value', 'key');

        $this->footerContent = [
            "contact_address" => $settings['contact_address'] ?? null,
            "site_phone" => $settings['site_phone'] ?? null,
            "site_email" => $settings['site_email'] ?? null,
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
        return view('components.footer');
    }
}
