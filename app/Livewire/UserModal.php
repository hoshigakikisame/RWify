<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Contracts\View\View;
use LivewireUI\Modal\ModalComponent;


class UserModal extends ModalComponent
{
    public Forms\UserForm $form;

    public $title = "Add Data Warga";

    public function save(): void
    {
        $this->form->save();
        $this->closeModal();
        $this->dispatch('refresh-list');
    }


    public function render(): View
    {
        return view('livewire.user-modal');
    }

    public static function modalMaxWidth(): string
    {
        return '7xl';
    }
}
