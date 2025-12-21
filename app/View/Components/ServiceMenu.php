<?php

namespace App\View\Components;

use App\Models\ServiceCategory;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ServiceMenu extends Component
{
    /**
     * Create a new component instance.
     */
    public $menuItems;
    public function __construct()
    {
        $this->menuItems = ServiceCategory::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.service-menu');
    }
}
