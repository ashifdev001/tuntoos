<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ServiceGallery extends Component
{
    /**
     * Create a new component instance.
     */
    public $services;
    public $category;
    public function __construct($slug)
    {
        $service = \App\Models\Service::with('category')->where('slug', $slug)->first();

        $this->category = $service?->category;
        $this->services = collect();

        if ($service && $service->category_id) {
            $this->services = \App\Models\Service::where('category_id', $service->category_id)
                ->where('id', '!=', $service->id)
                ->latest()
                ->take(3)
                ->get();
        }
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.service-gallery');
    }
}
