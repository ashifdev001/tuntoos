<?php

namespace App\View\Components;

use App\Models\Gallery;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SmallGallery extends Component
{
    /**
     * Create a new component instance.
     */
    public $small_galleries;
    public function __construct()
    {
        $this->small_galleries = Gallery::orderBy('id','desc')->take(9)->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.small-gallery');
    }
}
