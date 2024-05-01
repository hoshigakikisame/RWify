<?php

namespace App\View\Components\Dropdown;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DropdownElementNavbar extends Component
{
    /**
     * Create a new component instance.
     */

    public $title, $description, $href, $icon;
    public function __construct($title, $desc, $href, $icon = 'icon element')
    {
        $this->title = $title;
        $this->description = $desc;
        $this->href = $href;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.dropwdown.dropdown-element-navbar');
    }
}
