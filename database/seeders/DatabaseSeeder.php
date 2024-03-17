<?php

namespace Database\Seeders;

use App\Models\RukunWargaModel;
use App\Models\RukunTetanggaModel;
use App\Models\UserModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // CAUTION: This will delete all data in the database. This script meant to be used one time only.
        
        DB::statement('DELETE FROM tb_user');
        DB::statement('DELETE FROM tb_rukun_warga');
        DB::statement('DELETE FROM tb_rukun_tetangga');

        $rukunWargaInstance = RukunWargaModel::factory()->count(1)->create()->first();
        $rukunTetanggaInstances = RukunTetanggaModel::factory()->state(
            ['id_rukun_warga' => $rukunWargaInstance->getIdRukunWarga()]
        )->count(3)->create()->all();
        $ketuaRukunWargaInstance = UserModel::factory()->state(
            ['role' => 'Ketua Rukun Warga']
        )->create()->first();

        // attach ketua rukun warga to rukun warga
        $rukunWargaInstance->setNikKetuaRukunWarga($ketuaRukunWargaInstance->getNik());
        $rukunWargaInstance->save();

        // attach ketua rukun tetangga to rukun tetangga
        for ($i = 0; $i < 3; $i++) {
            $ketuaRukunTetanggaInstance = UserModel::factory()->state(
                ['role' => 'Ketua Rukun Tetangga']
            )->create()->first();
            $rukunTetanggaInstances[$i]->setNikKetuaRukunTetangga($ketuaRukunTetanggaInstance->getNik());
            $rukunTetanggaInstances[$i]->save();
        }
    }
}
