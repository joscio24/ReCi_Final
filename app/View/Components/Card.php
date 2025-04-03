<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Card extends Component
{
    /**
     * The title of the card.
     *
     * @var string
     */
    public string $title;

    /**
     * The text/description of the card.
     *
     * @var string
     */
    public string $text;

    /**
     * The action URL for the button.
     *
     * @var string
     */
    public string $actionUrl;

    /**
     * The text for the action button.
     *
     * @var string|null
     */
    public ?string $actionText;

    /**
     * The background color for the card.
     *
     * @var string|null
     */
    public ?string $bgColor;

    /**
     * Create a new component instance.
     */
    public function __construct(
        string $title,
        string $text,
        string $actionUrl,
        ?string $actionText = 'Voir plus',
        ?string $bgColor = '#3498db' // Default color
    ) {
        $this->title = $title;
        $this->text = $text;
        $this->actionUrl = $actionUrl;
        $this->actionText = $actionText;
        $this->bgColor = $bgColor;
    }


    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card');
    }
}
