<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;


class PostCard extends Component
{
    public $id;
    public $category;
    public $date;
    public $title;
    public $description;
    public $image;
    public $status;
    public $comments;
    public $likes;

    public function __construct($id, $category, $date, $title, $description, $image, $status, $comments, $likes, $views)
    {
        $this->id = $id;
        $this->category = $category;
        $this->date = $date;
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
        $this->status = $status;
        $this->comments = $comments;
        $this->likes = $likes;
        $this->views = $views;
    }

    public function render()
    {
        return view('components.post-card');
    }
}
