<?php

namespace App\Http\Controllers\RW;

use App\Http\Controllers\Controller;

class RWController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function dashboard()
    {
        return view('rw.dashboard');
    }
}
