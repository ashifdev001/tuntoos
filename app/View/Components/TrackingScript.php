<?php

namespace App\View\Components;

use App\Models\TrackingScripts;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TrackingScript extends Component
{
    /**
     * Create a new component instance.
     */
    public $trackingScripts;
    public function __construct($page)
    {
        $this->trackingScripts = TrackingScripts::where('page', $page)->first();
        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tracking-script');
    }
}
