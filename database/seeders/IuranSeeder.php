<?php

namespace Database\Seeders;

use App\Models\IuranModel;
use Illuminate\Database\Seeder;

class IuranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        IuranModel::truncate();
        $iuranInstances = IuranModel::factory()->count(30)->create()->all();
    }
}
