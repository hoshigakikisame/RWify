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
    use WithPagination;
    #[On('refresh-list')]
    public function refresh()
    {
    }
    public function render(): View
    {

        return view('livewire.users-table', [
            'users' => UserModel::paginate(4),
        ]);
    }
}
