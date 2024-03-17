<?php

namespace App\Http\Controllers;

use App\Models\UserModel;

class TestController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function test()
    {
        $user = UserModel::all()->first();
        return $user->getNik();
    }
}
