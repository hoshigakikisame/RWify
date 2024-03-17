<?php

namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;

class SharedController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function index()
    {
        return view('shared/index');
    }
}
