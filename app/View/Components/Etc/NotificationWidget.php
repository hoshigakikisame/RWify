<?php

namespace App\View\Components\Etc;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NotificationWidget extends Component
{
    /**
     * Create a new component instance.
     */
    public $notifications;

    public function __construct($notifications)
    {
        $this->notifications = $notifications;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.etc.notification-widget');
    }
}
