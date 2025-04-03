<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Debat extends Component
{
    public $id;
    public $category;
    public $date;
    public $title;
    public $description;
    public $image;

    public function __construct($id, $category, $date, $title, $description, $image)
    {
        $this->id = $id;
        $this->category = $category;
        $this->date = $date;
        $this->title = $title;
        $this->description = $description;
        $this->image = $image;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.debatView');
    }
}
