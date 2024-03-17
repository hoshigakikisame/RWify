<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'nik' => '1234567890123456',
                'nkk' => '1234567890123456',
                'email' => 'niaoktav119@gmail.com',
                'password' => bcrypt(env('SEED_DEFAULT_USER_PASSWORD')),
                'nama_depan' => 'Nia',
                'nama_belakang' => 'Oktaviani',
                'tempat_lahir' => 'Bandung',
                'tanggal_lahir' => '1999-11-19',
                'agama' => 'Islam',
                'status_perkawinan' => 'Belum Kawin',
                'pekerjaan' => 'Mahasiswa',
                'role' => 'Ketua Rukun Warga',
                'jenis_kelamin' => 'Perempuan'
            ]
        ];

        DB::table('tb_user')->insert($data);
    }
}
