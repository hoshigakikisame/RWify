<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SelectInputForm extends Component
{
    /**
     * Create a new component instance.
     */

    public $title, $options, $key, $placeholder, $selected;
    public function __construct(string $title, $options, string $key, string $placeholder, $selected = "")
    {
        $this->title = $title;
        $this->options = $options;
        $this->key = $key;
        $this->placeholder = $placeholder;
        $this->selected = $selected;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.select-input-form');
    }
}
