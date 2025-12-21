<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Brand extends Component
{
    /**
     * Create a new component instance.
     */
    public $brands;
    public function __construct()
    {
        $this->brands = \App\Models\Brand::orderBy('id', 'asc')
            ->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.brand');
    }
}
