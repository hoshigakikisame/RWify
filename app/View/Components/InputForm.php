<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputForm extends Component
{
    /**
     * Create a new component instance.
     */
    public $title, $key, $type, $validation;

    public function __construct(string $title, string $key, string $type, string $validation)
    {
        $this->title = $title;
        $this->key = $key;
        $this->type = $type;
        $this->validation = $validation;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.input-form');
    }
}
