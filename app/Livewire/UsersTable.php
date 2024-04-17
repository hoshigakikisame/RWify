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

    public $select = "";
    public $orderBy = "dibuat_pada";
    public $orderDir = "DESC";

    use WithPagination;
    #[On('refresh-list')]
    public function refresh()
    {
    }

    public function setOrderBy($orderBy)
    {
        if ($this->orderBy === $orderBy) {
            $this->orderDir = ($this->orderDir == 'ASC') ? 'DESC' : 'ASC';
            return;
        }
        $this->orderBy = $orderBy;
        $this->orderDir = "DESC";
    }

    public function selection($select)
    {
        $this->select = $select;
    }

    public function delete($nik): void
    {
        $this->form->delete($nik);
        $this->dispatch('refresh-list');
    }
    public function render(): View
    {

        return view('livewire.users-table', [
            'users' => UserModel::search($this->search)
                ->when($this->select !== '', function ($query) {
                    $query->where('role', $this->select);
                })->orderBy($this->orderBy, $this->orderDir)
                ->paginate($this->perPage),
        ]);
    }
}
