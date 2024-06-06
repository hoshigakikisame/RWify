<?php

namespace App\Http\Controllers\PetugasKeamanan;

use App\Http\Controllers\Controller;
use App\Models\UserModel;
use App\Decorators\SearchableDecorator;

class PetugasKeamananController extends Controller
{
    public function wargaVerificationPage()
    {
        $query = request()->q;
        $paginate = request()->paginate ?? 10;
        $filters = request()->filters ?? [];

        $users = (new SearchableDecorator(UserModel::class))->search($query, $paginate, [], $filters);

        $count = UserModel::count();

        $data = [
            "users" => $users,
            "count" => $count
        ];

        return view('pages.petugasKeamanan.wargaVerification', $data);
    }
}
