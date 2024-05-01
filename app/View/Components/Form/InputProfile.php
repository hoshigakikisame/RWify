<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputProfile extends Component
{
    /**
     * Create a new component instance.
     */

    public $key, $value, $type, $disabled, $title;
    public function __construct($key, $value, $type, $disabled = "", $title)
    {
        $this->key = $key;
        $this->value = $value;
        $this->type = $type;
        $this->disabled = $disabled;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.input-profile');
    }
}
