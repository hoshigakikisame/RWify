<?php

namespace App\Livewire;

use Livewire\Component;
use App\Decorators\SearchableDecorator;
use App\Models\UserModel;
use Livewire\WithPagination;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\On;

class UsersTable extends Component
{
    public Forms\UserForm $form;
    public $perPage = 5;
    public $search = "";

    use WithPagination;
    #[On('refresh-list')]
    public function refresh()
    {
    }

    public function delete($nik): void
    {
        $this->form->delete($nik);
        $this->dispatch('refresh-list');
    }
    public function render(): View
    {

        return view('livewire.users-table', [
            'users' => UserModel::search($this->search)->paginate($this->perPage),
        ]);
    }
}
