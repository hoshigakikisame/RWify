<?php

namespace App\View\Components\Button;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AddButton extends Component
{
    /**
     * Create a new component instance.
     */

    public $routeButton, $modalParent, $modalForm, $multipartReq, $title;
    public function __construct($routeButton, $modalParent, $modalForm, $title, $multipartReq = false)
    {
        $this->routeButton = $routeButton;
        $this->modalParent = $modalParent;
        $this->modalForm = $modalForm;
        $this->multipartReq = $multipartReq;
        $this->title = $title;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.button.add-button');
    }
}
