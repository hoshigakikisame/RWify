<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\UserModel;
use App\Models\RukunWargaModel;
use App\Models\RukunTetanggaModel;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
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

        // preserved instances
        // rw test account instance
        $ketuaRukunWargaInstance = UserModel::factory()->state(
            [
                'email' => 'niaoktav119@gmail.com',
                'role' => 'Ketua Rukun Warga',
                'id_rukun_tetangga' => $rukunTetanggaInstances[0]->getIdRukunTetangga()
            ]
        )->create()->first();

        // warga test account instance
        UserModel::factory()->state(
            [
                'email' => 'niaoktav119+warga@gmail.com',
                'role' => 'Warga',
                'id_rukun_tetangga' => $rukunTetanggaInstances[0]->getIdRukunTetangga()
            ]
        )->create();

        // attach ketua rukun warga to rukun warga
        $rukunWargaInstance->setNikKetuaRukunWarga($ketuaRukunWargaInstance->getNik());
        $rukunWargaInstance->save();   

        // attach ketua rukun tetangga to rukun tetangga
        for ($i = 0; $i < count($rukunTetanggaInstances); $i++) {
            $ketuaRukunTetanggaInstance = UserModel::factory()->state(
                ['role' => 'Ketua Rukun Tetangga']
            )->create()->first();
            $rukunTetanggaInstances[$i]->setNikKetuaRukunTetangga($ketuaRukunTetanggaInstance->getNik());
            $rukunTetanggaInstances[$i]->save();
        }

        // warga
        $wargaInstances = UserModel::factory()->count(30)->create();
        // attach warga to rukun tetangga
        for ($i = 0; $i < count($wargaInstances); $i++) {
            $wargaInstances[$i]->setIdRukunTetangga($rukunTetanggaInstances[$i % 3]->getIdRukunTetangga());
            $wargaInstances[$i]->save();
        }
    }
}
