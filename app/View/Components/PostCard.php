<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Post;

class PostCard extends Component
{
    /**
     * Create a new component instance.
     */
    public Post $post;
    public bool $showExcerpt = true;
    public string $size = 'md'; // sm, md, lg

    public function __construct(Post $post, bool $showExcerpt = true, string $size = 'md')
    {
        $this->post = $post;
        $this->showExcerpt = $showExcerpt;
        $this->size = $size;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.post-card');
    }
}
