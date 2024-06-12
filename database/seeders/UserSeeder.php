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

        // disable foreign key
        DB::statement('SET FOREIGN_KEY_CHECKS=0');
        DB::table('tb_kartu_keluarga')->delete();
        DB::table('tb_user')->delete();
        DB::table('tb_rukun_warga')->delete();
        DB::table('tb_rukun_tetangga')->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1');

        $rukunWargaInstance = RukunWargaModel::factory()->count(1)->create()->first();
        $rukunTetanggaInstances = [
            RukunTetanggaModel::factory()->state(
                [
                    'id_rukun_warga' => $rukunWargaInstance->getIdRukunWarga()
                    ,
                    'nomor_rukun_tetangga' => 1
                ]
            )->create()->first(),
            RukunTetanggaModel::factory()->state(
                [
                    'id_rukun_warga' => $rukunWargaInstance->getIdRukunWarga()
                    ,
                    'nomor_rukun_tetangga' => 2
                ]
            )->create()->first()
        ];



        // spliting the process to avoid '0' nkk bug
        KartuKeluargaModel::factory()->count(2)->create()->all();

        $kartuKeluargaInstances = KartuKeluargaModel::all();

        for ($i = 0; $i < count($kartuKeluargaInstances); $i++) {
            $kartuKeluargaInstances[$i]->setIdRukunTetangga($rukunTetanggaInstances[$i % count($rukunTetanggaInstances)]->id_rukun_tetangga);
            $kartuKeluargaInstances[$i]->save();
        }

        // preserved instances
        // permanent rw test account instance
        $ketuaRukunWargaInstance = UserModel::factory()->state(
            [
                'email' => 'niaoktav119@gmail.com',
                'role' => 'Ketua Rukun Warga',
                'nama_depan' => 'Husni',
                'nama_belakang' => 'Mubarok',
                'image_url' => 'https://static01.nyt.com/images/2022/04/10/obituaries/00traub-image1/00traub-image1-mediumSquareAt3X.jpg',
                'nkk' => $kartuKeluargaInstances[0]->getNkk()
            ]
        )->create()->first();

        // temporary ketua rw test account instances
        // UserModel::factory()->state(
        //     [
        //         'email' => 'daffayudisa09@gmail.com',
        //         'role' => 'Ketua Rukun Warga',
        //         // 'id_rukun_tetangga' => $rukunTetanggaInstances[0]->getIdRukunTetangga(),
        //         'nkk' => $kartuKeluargaInstances[0]->getNkk()
        //     ]
        // )->create()->first();

        // UserModel::factory()->state(
        //     [
        //         'email' => 'thoriqfathurrozi@gmail.com',
        //         'role' => 'Ketua Rukun Warga',
        //         // 'id_rukun_tetangga' => $rukunTetanggaInstances[0]->getIdRukunTetangga(),
        //         'nkk' => $kartuKeluargaInstances[1]->getNkk()
        //     ]
        // )->create()->first();

        // temporary ketua rt test account instances
        $tempKetuaRT = UserModel::factory()->state(
            [
                'email' => 'niaoktav119+rt@gmail.com',
                'role' => 'Ketua Rukun Tetangga',
                'nkk' => $kartuKeluargaInstances[1]->getNkk()
            ]
        )->create()->first();

        // warga test account instance
        UserModel::factory()->state(
            [
                'email' => 'niaoktav119+warga@gmail.com',
                'role' => 'Warga',
                'nkk' => $kartuKeluargaInstances[1]->getNkk()
            ]
        )->create();

        // attach ketua rukun warga to rukun warga
        $rukunWargaInstance->setNikKetuaRukunWarga($ketuaRukunWargaInstance->getNik());
        $rukunWargaInstance->save();

        // ketua rukun tetangga instances
        UserModel::factory()->count(1)->state(
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

        // warga
        // UserModel::factory()->count(30)->create();
        // $wargaInstances = UserModel::where('role', 'Warga')->get();
        // attach warga to rukun tetangga
        // for ($i = 0; $i < count($wargaInstances); $i++) {
        //     $wargaInstances[$i]->setNkk($kartuKeluargaInstances[$i % 3]->getNkk());
        //     $wargaInstances[$i]->save();
        // }

        // petugas keamanan
        // UserModel::factory()->count(3)->state(
        //     [
        //         'role' => UserRoleEnum::PETUGAS_KEAMANAN->value,
        //         'nkk' => $kartuKeluargaInstances[rand(0, count($kartuKeluargaInstances) - 1)]->getNkk(),
        //         'pekerjaan' => 'Petugas Keamanan'
        //     ]
        // )->create()->all();

        // preserved petugas keamanan instance
        UserModel::factory()->state(
            [
                'email' => 'niaoktav119+satpam@gmail.com',
                'role' => UserRoleEnum::PETUGAS_KEAMANAN->value,
                'nkk' => $kartuKeluargaInstances[0]->getNkk(),
                'pekerjaan' => 'Petugas Keamanan'
            ]
        )->create();
    }
}
