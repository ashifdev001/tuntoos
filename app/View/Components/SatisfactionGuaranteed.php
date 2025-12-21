<?php

namespace App\View\Components;

use App\Models\SatisfactionGuaranteed as ModelsSatisfactionGuaranteed;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SatisfactionGuaranteed extends Component
{
    /**
     * Create a new component instance.
     */
    public $satisfactionGuaranteed;
    public function __construct()
    {
        $this->satisfactionGuaranteed = ModelsSatisfactionGuaranteed::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.satisfaction-guaranteed');
    }
}
