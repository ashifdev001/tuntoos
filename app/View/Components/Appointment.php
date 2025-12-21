<?php

namespace App\View\Components;

use App\Models\ServiceCategory;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Appointment extends Component
{
    /**
     * Create a new component instance.
     */
    public $service_categories;
    public function __construct()
    {
        $this->service_categories = ServiceCategory::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.appointment');
    }
}
