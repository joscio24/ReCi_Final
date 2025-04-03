<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LinkItemComponent extends Component
{
    public $title;
    public $description;
    public $index;
    public $icon;
    /**
     * Create a new component instance.
     *
     *  @return void
     */
    public function __construct($title, $description, $index, $icon)
    {
        //
        $this->title = $title;
        $this->description = $description;
        $this->index = $index;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.link-item-component');
    }
}
