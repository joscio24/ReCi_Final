<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ListItemComponent extends Component
{
    public $id;
    public $title;
    public $description;
    public $index;
    /**
     * Create a new component instance.
     *
     *  @return void
     */
    public function __construct($id, $title, $description, $index)
    {
        //
        $this->id = $id;
        $this->title = $title;
        $this->description = $description;
        $this->index = $index;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.list-item-component');
    }
}
