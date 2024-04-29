<?php

namespace Database\Seeders;

use App\Models\PengaduanModel;
use Illuminate\Database\Seeder;

use App\Models\UserModel;

class PengaduanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PengaduanModel::truncate();
        $pengaduanInstances = PengaduanModel::factory()->count(30)->create()->all();
    }
}
