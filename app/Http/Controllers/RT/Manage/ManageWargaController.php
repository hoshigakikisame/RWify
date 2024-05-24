<?php

namespace App\Http\Controllers\RT\Manage;

// App
use App\Http\Controllers\Controller;
use App\Decorators\SearchableDecorator;
use App\Models\RukunTetanggaModel;
use App\Models\UserModel;

class ManageWargaController extends Controller
{
    public function manageWargaPage()
    {
        $ownedRT = RukunTetanggaModel::where('nik_ketua_rukun_tetangga', '=', request()->user()->getNik())->first();

        $query = request()->q;
        $paginate = request()->paginate;
        $filters = ['id_rukun_tetangga' => $ownedRT->getIdRukunTetangga(), ...request()->filters ?? []];

        $users = (new SearchableDecorator(UserModel::class))->search($query, $paginate, [], $filters);

        $count = UserModel::where('id_rukun_tetangga', auth()->user()->id_rukun_tetangga)->count();

        $data = [
            "users" => $users,
            "count" => $count
        ];

        return view('pages.rt.manage.warga', $data);
    }
}
