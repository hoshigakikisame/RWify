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
    public $title, $key, $type, $placeholder, $value, $readonly;

    public function __construct(string $title, string $key, string $type, string $placeholder, $value = "", $readonly = false)
    {
        $this->title = $title;
        $this->key = $key;
        $this->type = $type;
        $this->placeholder = $placeholder;
        $this->value = $value;
        $this->readonly = $readonly;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.input-form');
    }
}
