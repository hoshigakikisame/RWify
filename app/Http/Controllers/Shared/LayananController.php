<?php

namespace App\Http\Controllers\Shared;

use App\Http\Controllers\Controller;

class LayananController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */

    public function permintaanDokumen() {
        return view('shared/layanan/permintaanDokumen');
    }

    public function pengaduan() {
        return view('shared/layanan/pengaduan');
    }

    public function pembayaranIuran() {
        return view('shared/layanan/pembayaranIuran');
    }
}
