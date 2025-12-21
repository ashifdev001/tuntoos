<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ServiceCategory extends Component
{
    /**
     * Create a new component instance.
     */
    public $categories;
    public function __construct()
    {
        $this->categories = \App\Models\ServiceCategory::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.service-category');
    }
}
