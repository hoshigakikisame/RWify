<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;

class UserModal extends ModalComponent
{
    public Forms\UserForm $form;


    public function render(): View
    {
        return view('livewire.user-modal');
    }
}
