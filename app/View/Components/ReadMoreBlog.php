<?php

namespace App\View\Components;

use Closure;
use App\Helpers\Helper;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ReadMoreBlog extends Component
{
    public $blogId = null;
    /**
     * Create a new component instance.
     */
    public function __construct($blogId = "")
    {
        $this->blogId = $blogId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $blogs = Helper::getBlogs(['paginate' => 3, 'blog_id' => $this->blogId]);
        return view('components.read-more-blog', compact('blogs'));
    }
}
