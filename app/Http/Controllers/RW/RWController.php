<?php

namespace App\Http\Controllers\RW;

use App\Http\Controllers\Controller;
use App\Decorators\SearchableDecorator;
use App\Models\UserModel;

class RWController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function dashboard()
    {
        $reqQuery = request()->q;

        $users = (new SearchableDecorator(UserModel::class))->search($reqQuery);

        $data = [
            "users" => $users,
        ];
        return view('rw.dashboard', $data);
    }
}
