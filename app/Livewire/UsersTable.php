<?php

namespace App\Livewire;

use Livewire\Component;
use App\Decorators\SearchableDecorator;
use App\Models\UserModel;
use Livewire\WithPagination;
use Illuminate\Contracts\View\View;

class UsersTable extends Component
{
    use WithPagination;

    public function render(): View
    {

        $reqQuery = request()->q;

        $users = (new SearchableDecorator(UserModel::class))->search($reqQuery);

        $data = [
            "users" => $users
        ];
        return view('livewire.users-table', [
            'users' => UserModel::paginate(2),
        ]);
    }
}
