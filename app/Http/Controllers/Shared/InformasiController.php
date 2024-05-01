<?php

namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;
use App\Models\UmkmModel;

class InformasiController extends Controller
{
    public function umkmPage()
    {
        $umkmInstances = UmkmModel::all()->sortByDesc('created_at');

        return view('pages.shared.informasi.umkm.index', compact('umkmInstances'));
    }
}
