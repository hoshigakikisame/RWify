<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputImage extends Component
{
    /**
     * Create a new component instance.
     */
    public $title, $key, $type, $placeholder, $value;

    public function __construct(string $key, $title = null, $placeholder = null, $value = null)
    {
        $this->title = $title;
        $this->key = $key;
        $this->placeholder = $placeholder;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-image');
    }
}
