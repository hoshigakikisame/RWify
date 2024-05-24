<?php

namespace App\Http\Controllers\RT\Manage;

// App
use App\Http\Controllers\Controller;
use App\Decorators\SearchableDecorator;
use App\Models\PengaduanModel;
use App\Models\UserModel;

class ManagePengaduanController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function managePengaduanPage()
    {

        $query = request()->q;
        $filters = request()->filters ?? [];
        $paginate = request()->paginate;

        $pengaduanInstances = (new SearchableDecorator(PengaduanModel::class))->search(
            $query, 
            $paginate, 
            ['user' => UserModel::class], 
            $filters
        );

        $count = PengaduanModel::count();

        $data = [
            "pengaduanInstances" => $pengaduanInstances,
            "count" => $count
        ];

        return view('pages.rt.manage.pengaduan', $data);
    }
}