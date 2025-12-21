<?php

namespace App\View\Components;

use App\Models\Blog;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SideBlog extends Component
{
    /**
     * Create a new component instance.
     */
    public $blogs;
    public function __construct($currentBlog)
    {
        $this->blogs = Blog::where('id','!=',$currentBlog)->latest()
            ->paginate(6);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.side-blog');
    }
}
