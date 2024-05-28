<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SearchDropdown extends Component
{
    /**
     * Create a new component instance.
     */

    public $placeholder, $key, $title, $items, $value, $parent;
    public function __construct($key, $placeholder, $title, $items, $parent, $value = '')
    {
        $this->key = $key;
        $this->placeholder = $placeholder;
        $this->title = $title;
        $this->items = $items;
        $this->value = $value;
        $this->parent = $parent;
    }



    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.search-dropdown');
    }
}
