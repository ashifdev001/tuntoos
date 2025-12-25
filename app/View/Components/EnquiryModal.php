<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class EnquiryModal extends Component
{
    /**
     * Create a new component instance.
     */
    public $dropdownItems;
    public function __construct()
    {
        $this->dropdownItems = \App\Models\DropdownItem::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.enquiry-modal');
    }
}
