<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;

class WargaController extends Controller
{
    public function dashboard()
    {
        return view('pages.warga.dashboard');
    }
}
