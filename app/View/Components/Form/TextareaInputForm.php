<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TextareaInputForm extends Component
{
    /**
     * Create a new component instance.
     */
    public $title, $key, $placeholder, $value, $rows, $resize;
    public function __construct($title, $key, $placeholder, $value = "", $rows = 3, $resize = "")
    {
        $this->title =  $title;
        $this->key = $key;
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->rows = $rows;
        $this->resize = $resize;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.textarea-input-form');
    }
}
