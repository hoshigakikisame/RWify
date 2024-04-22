<?php

namespace App\View\Modals;

use App\Models\UserModel;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UserModal extends Component
{
    /**
     * Create a new component instance.
     */
    public ?UserModel $user;
    public string $actionUrl;
    public function __construct($user = false, $actionUrl)
    {
        $this->actionUrl = $actionUrl;
        $this->user = $user;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('modals.user-modal');
    }
}
