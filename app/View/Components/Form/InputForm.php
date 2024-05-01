<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputForm extends Component
{
    /**
     * Create a new component instance.
     */
    public $title, $key, $type, $placeholder, $value;

    public function __construct(string $title, string $key, string $type, string $placeholder, $value = "")
    {
        $this->title = $title;
        $this->key = $key;
        $this->type = $type;
        $this->placeholder = $placeholder;
        $this->value = $value;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.input-form');
    }
}
