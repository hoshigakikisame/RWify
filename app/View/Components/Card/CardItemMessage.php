<?php

namespace App\View\Components\Card;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardItemMessage extends Component
{
    /**
     * Create a new component instance.
     */
    public $name, $description, $date, $image, $position;
    public function __construct($name, $desc, $date, $position, $image = 'image element')
    {
        $this->name = $name;
        $this->description = $desc;
        $this->position = $position;
        $this->date = $date;
        $this->image = $image;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card.card-item-message');
    }
}
