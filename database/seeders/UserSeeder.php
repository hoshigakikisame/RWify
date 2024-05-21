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
        // permanent rw test account instance
        $ketuaRukunWargaInstance = UserModel::factory()->state(
            [
                'email' => 'niaoktav119@gmail.com',
                'role' => 'Ketua Rukun Warga',
                'nama_depan' => 'Egar',
                'nama_belakang' => 'Sayogo 🤙',
                'image_url' => 'https://res.cloudinary.com/deg2r9cnr/image/upload/v1716194703/ky4wz6pvpjfvxetqhne1.jpg',
                'id_rukun_tetangga' => $rukunTetanggaInstances[0]->getIdRukunTetangga()
            ]
        )->create()->first();

        // temporary rw test account instances
        UserModel::factory()->state(
            [
                'email' => 'daffayudisa09@gmail.com',
                'role' => 'Ketua Rukun Warga',
                'id_rukun_tetangga' => $rukunTetanggaInstances[0]->getIdRukunTetangga()
            ]
        )->create()->first();

        UserModel::factory()->state(
            [
                'email' => 'thoriqfathurrozi@gmail.com',
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
        UserModel::factory()->count(30)->create();
        $wargaInstances = UserModel::where('role', 'Warga')->get();
        // attach warga to rukun tetangga
        for ($i = 0; $i < count($wargaInstances); $i++) {
            $wargaInstances[$i]->setIdRukunTetangga($rukunTetanggaInstances[$i % 3]->id_rukun_tetangga);
            $wargaInstances[$i]->save();
        }
    }
}
