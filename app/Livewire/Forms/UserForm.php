<?php

namespace App\Livewire\Forms;

use Illuminate\Foundation\Auth\User;
use Livewire\Attributes\Validate;
use Livewire\Form;

class UserForm extends Form
{
    public string $nik = '';
    public string $nkk = '';

}
