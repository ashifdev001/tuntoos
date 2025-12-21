<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Flavors extends Component
{
    /**
     * Create a new component instance.
     */
    public $flavors, $showPagination;
    public function __construct($limit = null, $perPage = null, $showPagination = false)
    {
        $perPage = $perPage ?? $limit ?? 8;
        $this->flavors = \App\Models\Flavor::orderBy('created_at', 'desc')->paginate($perPage);
        $this->showPagination = $showPagination;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.flavors');
    }
}
