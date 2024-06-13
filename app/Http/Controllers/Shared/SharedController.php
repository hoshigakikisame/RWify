<?php

namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;
use App\Models\PengumumanModel;

class SharedController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function index()
    {

        $latest_pengumuman = PengumumanModel::where('status', 'publish')->latest('diperbarui_pada')->take(5)->get();

        return view('pages.shared.index', ['latest_pengumuman' => $latest_pengumuman]);
    }

    public function hubungiKami()
    {
        return view('pages.shared.HubungiKami');
    }
}
