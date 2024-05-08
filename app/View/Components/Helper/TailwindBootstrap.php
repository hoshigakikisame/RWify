<?php

namespace App\View\Components\Helper;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TailwindBootstrap extends Component
{
    /**
     * Create a new component instance.
     */
    public $classes = [];

    public function __construct(){
        $this->classes = join(" ", [
            'animate-spin',
            'bg-blue-500',
            'bg-blue-600',
            'bg-black',
            'bg-indigo',
            'text-blue'
        ]);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.helper.tailwind-bootstrap');
    }
}