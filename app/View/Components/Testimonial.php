<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Testimonial extends Component
{
    /**
     * Create a new component instance.
     */
    public $testimonials;
    public function __construct()
    {
        // Fetch all testimonials from the database
        $this->testimonials = \App\Models\CustomerSay::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.testimonial');
    }
}
