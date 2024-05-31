<?php

namespace Database\Seeders;

use App\Enums\User\UserRoleEnum;
use App\Models\KartuKeluargaModel;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use App\Models\UserModel;
use App\Models\RukunWargaModel;
use App\Models\RukunTetanggaModel;
use Illuminate\Foundation\Auth\User;

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
        // spliting the process to avoid '0' nkk bug
        KartuKeluargaModel::factory()->count(20)->create()->all();
        
        $kartuKeluargaInstances = KartuKeluargaModel::all();

        for ($i=0; $i < count($kartuKeluargaInstances); $i++) { 
            $kartuKeluargaInstances[$i]->setIdRukunTetangga($rukunTetanggaInstances[$i % count($rukunTetanggaInstances)]->id_rukun_tetangga);
            $kartuKeluargaInstances[$i]->save();
        }
            // ['id_rukun_tetangga' => $rukunTetanggaInstances[rand(0, count($rukunTetanggaInstances) - 1)]->getIdRukunTetangga()] 

        // preserved instances
        // permanent rw test account instance
        $ketuaRukunWargaInstance = UserModel::factory()->state(
            [
                'email' => 'niaoktav119@gmail.com',
                'role' => 'Ketua Rukun Warga',
                'nama_depan' => 'Egar',
                'nama_belakang' => 'Sayogo 🤙',
                'image_url' => 'https://res.cloudinary.com/deg2r9cnr/image/upload/v1716194703/ky4wz6pvpjfvxetqhne1.jpg',
                'nkk' => $kartuKeluargaInstances[0]->getNkk()
            ]
        )->create()->first();

        // temporary ketua rw test account instances
        UserModel::factory()->state(
            [
                'email' => 'daffayudisa09@gmail.com',
                'role' => 'Ketua Rukun Warga',
                // 'id_rukun_tetangga' => $rukunTetanggaInstances[0]->getIdRukunTetangga(),
                'nkk' => $kartuKeluargaInstances[0]->getNkk()
            ]
        )->create()->first();

        UserModel::factory()->state(
            [
                'email' => 'thoriqfathurrozi@gmail.com',
                'role' => 'Ketua Rukun Warga',
                // 'id_rukun_tetangga' => $rukunTetanggaInstances[0]->getIdRukunTetangga(),
                'nkk' => $kartuKeluargaInstances[1]->getNkk()
            ]
        )->create()->first();

        // temporary ketua rt test account instances
        $tempKetuaRT = UserModel::factory()->state(
            [
                'email' => 'niaoktav119+rt@gmail.com',
                'role' => 'Ketua Rukun Tetangga',
                // 'id_rukun_tetangga' => $rukunTetanggaInstances[0]->getIdRukunTetangga(),
                'nkk' => $kartuKeluargaInstances[2]->getNkk()
            ]
        )->create()->first();

        // warga test account instance
        UserModel::factory()->state(
            [
                'email' => 'niaoktav119+warga@gmail.com',
                'role' => 'Warga',
                // 'id_rukun_tetangga' => $rukunTetanggaInstances[0]->getIdRukunTetangga(),
                'nkk' => $kartuKeluargaInstances[2]->getNkk()
            ]
        )->create();

        // attach ketua rukun warga to rukun warga
        $rukunWargaInstance->setNikKetuaRukunWarga($ketuaRukunWargaInstance->getNik());
        $rukunWargaInstance->save();   

        // ketua rukun tetangga instances
        UserModel::factory()->count(3)->state(
            [
                'role' => UserRoleEnum::KETUA_RUKUN_TETANGGA->value,
                'nkk' => $kartuKeluargaInstances[rand(0, count($kartuKeluargaInstances) - 1)]->getNkk()
            ]
        )->create();

        // attach ketua rukun tetangga to rukun tetangga
        for ($i = 0; $i < count($rukunTetanggaInstances); $i++) {
            $ketuaRukunTetanggaInstance = UserModel::where('role', UserRoleEnum::KETUA_RUKUN_TETANGGA->value)->get()[$i];
            $rukunTetanggaInstances[$i]->nik_ketua_rukun_tetangga = $ketuaRukunTetanggaInstance->getNik();
            $rukunTetanggaInstances[$i]->save();
        }

        // // attach temporary ketua rt to one of the rt
        $rukunTetanggaInstances[1]->nik_ketua_rukun_tetangga = $tempKetuaRT->getNik();
        $rukunTetanggaInstances[1]->save();
        
        // warga
        UserModel::factory()->count(30)->state([
            // 'nkk' => $kartuKeluargaInstances[rand(0, count($kartuKeluargaInstances) - 1)]->getNkk()
        ])->create();
        $wargaInstances = UserModel::where('role', 'Warga')->get();
        // attach warga to rukun tetangga
        for ($i = 0; $i < count($wargaInstances); $i++) {
            $wargaInstances[$i]->setNkk($kartuKeluargaInstances[$i % 3]->getNkk());
            $wargaInstances[$i]->save();
        }
    }
}
