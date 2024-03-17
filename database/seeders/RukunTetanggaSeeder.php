<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\RukunTetanggaModel;
use App\Models\RukunWargaModel;
use App\Models\UserModel;

class RukunTetanggaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // RukunTetanggaModel::factory()->count(1)->for(UserModel::factory()->state(
        //     ['role' => 'Ketua Rukun Tetangga']
        // ))->for(RukunWargaModel::factory()->count(1)->for(UserModel::factory()->state(
        //     ['role' => 'Ketua Rukun Warga']
        // )))->create();
    }
}
