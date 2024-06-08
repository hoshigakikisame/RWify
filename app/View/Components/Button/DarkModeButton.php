<?php

namespace App\View\Components\Button;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DarkModeButton extends Component
{
    /**
     * Create a new component instance.
     */

    public $isSimple;
    public function __construct($isSimple = false)
    {
        $this->isSimple = $isSimple;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.Button.dark-mode-button');
    }
}
