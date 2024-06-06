<?php

namespace Database\Seeders;

use App\Models\PembayaranIuranModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PembayaranIuranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tb_pembayaran_iuran')->delete();
        $pembayaranIuranInstances = PembayaranIuranModel::factory()->count(30)->create()->all();
    }
}
