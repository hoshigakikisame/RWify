<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SearchInput extends Component
{
    /**
     * Create a new component instance.
     */

    public $placeholder;
    public function __construct($placeholder = 'Search...')
    {
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.search-input');
    }
}
