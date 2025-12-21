<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\GeneralSetting;

class MobileNav extends Component
{
    /**
     * Create a new component instance.
     */
     public $mobileNav;
    public function __construct()
    {
         $settings = GeneralSetting::whereIn('key', [
            'site_phone',
            'site_email',
            
        ])->pluck('value', 'key');

        

        $this->mobileNav = [
            "site_phone" => $settings['site_phone'] ?? null,
            "site_email" => $settings['site_email'] ?? null,
        ];
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.mobile-nav');
    }
}
