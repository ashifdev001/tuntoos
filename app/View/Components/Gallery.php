<?php

namespace App\View\Components;

use App\Models\Gallery as ModelsGallery;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Gallery extends Component
{
    /**
     * Create a new component instance.
     */
    public $galleries;
    public function __construct()
    {
        $this->galleries = ModelsGallery::latest();
        $this->galleries = $this->galleries->paginate(8);
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.gallery');
    }
}
