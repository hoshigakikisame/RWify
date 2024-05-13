<?php

namespace Database\Seeders;

use App\Models\TipePropertiModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class TipePropertiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tb_tipe_properti')->delete();
        TipePropertiModel::factory()->create(
            [
                'nama_tipe' => 'Rumah Tangga (Tanpa Usaha Kos)',
                'iuran_per_bulan' => 90000
            ]
        );

        TipePropertiModel::factory()->create(
            [
                'nama_tipe' => 'Rumah Kos Tipe A1 (1-5 Kamar)',
                'iuran_per_bulan' => 90000
            ]
        );

        TipePropertiModel::factory()->create(
            [
                'nama_tipe' => 'Rumah Kos Tipe A2 (6-20 Kamar)',
                'iuran_per_bulan' => 100000
            ]
        );

        TipePropertiModel::factory()->create(
            [
                'nama_tipe' => 'Rumah Kos Tipe A3 (21 Kamar Keatas)',
                'iuran_per_bulan' => 110000
            ]
        );

        TipePropertiModel::factory()->create(
            [
                'nama_tipe' => 'Rumah Kos Tipe B1 (1-5 Kamar)',
                'iuran_per_bulan' => 100000
            ]
        );

        TipePropertiModel::factory()->create(
            [
                'nama_tipe' => 'Rumah Kos Tipe B2 (6-20 Kamar)',
                'iuran_per_bulan' => 110000
            ]
        );

        TipePropertiModel::factory()->create(
            [
                'nama_tipe' => 'Rumah Kos Tipe B3 (21 Kamar Keatas)',
                'iuran_per_bulan' => 120000
            ]
        );
    }
}
