<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use App\Models\UserModel;

class WargaController extends Controller
{
    public function dashboard()
    {
        return view('pages.warga.dashboard');
    }
}
