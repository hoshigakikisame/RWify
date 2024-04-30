<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SidebarWrap extends Component
{
    /**
     * Create a new component instance.
     */
    public $email, $role, $footerMenu, $imageProfile;
    public function __construct($email, $role, $footerMenu, $imageProfile)
    {
        $this->email = $email;
        $this->role = $role;
        $this->footerMenu = $footerMenu;
        $this->imageProfile = $imageProfile;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.sidebar-wrap');
    }
}
