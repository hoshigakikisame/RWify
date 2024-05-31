<?php

namespace App\Http\Controllers\RT\Manage;

// App
use App\Http\Controllers\Controller;
use App\Decorators\SearchableDecorator;
use App\Models\KartuKeluargaModel;
use App\Models\RukunTetanggaModel;
use App\Models\UserModel;
use Illuminate\Database\Eloquent\Builder;

class ManageWargaController extends Controller
{
    public function manageWargaPage()
    {
        $ownedRT = RukunTetanggaModel::where('nik_ketua_rukun_tetangga', '=', request()->user()->getNik())->first();

        $query = request()->q;
        $paginate = request()->paginate;
        $filters = [...request()->filters ?? []];

        $users = (new SearchableDecorator(UserModel::class))->search($query, $paginate, ['kartuKeluarga' => KartuKeluargaModel::class], $filters, function (Builder $queryBuilder) {
            $queryBuilder->whereRelation('kartuKeluarga', 'id_rukun_tetangga', '=', request()->user()->getKartuKeluarga()->getIdRukunTetangga());
        });

        $count = UserModel::withWhereHas('kartuKeluarga', function (Builder $query) {
            $query->where('tb_kartu_keluarga.id_rukun_tetangga', '=', request()->user()->getKartuKeluarga()->getIdRukunTetangga());
        })->count();

        $data = [
            "users" => $users,
            "count" => $count
        ];

        return view('pages.rt.manage.warga', $data);
    }
}
