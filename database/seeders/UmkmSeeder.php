<?php

namespace Database\Seeders;

use App\Models\UmkmModel;
use Illuminate\Database\Seeder;

class UmkmSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UmkmModel::truncate();
        $umkmInstances = UmkmModel::factory()->count(30)->create()->all();
    }
}
