<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use App\Models\UserModel;

class WargaController extends Controller
{
    public function dashboard()
    {
        dd(request()->user()->getUnreadNotifications());

        return view('pages.warga.dashboard');
    }
}
