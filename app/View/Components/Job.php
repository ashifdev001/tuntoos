<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Job extends Component
{
    /**
     * Create a new component instance.
     */
    public $jobs;
    public function __construct()
    {
        // Fetch all branches from the database
        $this->jobs = \App\Models\Job::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.job');
    }
}
