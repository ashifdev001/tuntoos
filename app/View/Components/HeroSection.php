<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class HeroSection extends Component
{
    /**
     * Create a new component instance.
     */
    public $banner;
    public function __construct($page)
    {
        $this->banner =  \App\Models\Banner::where('type', $page)->first();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.hero-section');
    }
}
