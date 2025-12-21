<?php

namespace App\View\Components;

use App\Models\WhyChooseUs as ModelsWhyChooseUs;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class WhyChooseUs extends Component
{
    /**
     * Create a new component instance.
     */
    public $whyChooseUs;
    public function __construct()
    {
        $general = \App\Models\GeneralSetting::whereIn('key', ['testimonials_heading', 'testimonials_video_link', 'testimonials_description', 'whychooseus_heading', 'whychooseus_description'])->get();
        $this->whyChooseUs = [];
        if ($general->isNotEmpty()) {
            foreach ($general as &$item) {
                $this->whyChooseUs[$item->key] = $item->value;
            }
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.why-choose-us');
    }
}
