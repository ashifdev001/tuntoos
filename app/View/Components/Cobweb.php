<?php

namespace App\View\Components;

use App\Models\Service;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Cobweb extends Component
{
    /**
     * Create a new component instance.
     */
    public $cobweblist;
    public function __construct($perPage)
    {
        $this->cobweblist = Service::with(['items', 'category'])->where('type', 'cobweb')
            ->latest()
            ->paginate($perPage);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cobweb');
    }
}
