<?php

namespace Database\Seeders;

use App\Models\ReservasiJadwalTemuModel;
use Illuminate\Database\Seeder;

use App\Models\UserModel;

class ReservasiJadwalTemuModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ReservasiJadwalTemuModel::truncate();
        $reservasiJadwalTemuInstances = ReservasiJadwalTemuModel::factory()->count(30)->create()->all();
    }
}
