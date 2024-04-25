<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TextareaInputForm extends Component
{
    /**
     * Create a new component instance.
     */
    public $title, $key, $placeholder;
    public function __construct($title, $key, $placeholder)
    {
        $this->title =  $title;
        $this->key = $key;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.textarea-input-form');
    }
}
