<?php

namespace Database\Seeders;

use App\Models\PengumumanModel;
use Illuminate\Database\Seeder;

use App\Models\UserModel;

class PengumumanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PengumumanModel::truncate();
        $pengumumanInstances = PengumumanModel::factory()->count(30)->create()->all();
    }
}
