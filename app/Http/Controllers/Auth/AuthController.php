<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\UserModel;

class AuthController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login()
    {
        return 'Login';
    }
}
