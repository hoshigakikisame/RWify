<?php

namespace Database\Seeders;

use App\Enums\Pengaduan\PengaduanStatusEnum;
use App\Models\PengaduanModel;
use Illuminate\Database\Seeder;

use App\Models\UserModel;

class PengaduanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PengaduanModel::truncate();
        $file = fopen('database/datasources/pengaduan.csv', 'r');

        $usersNik = UserModel::all()->pluck('nik')->toArray();
        $statuses = PengaduanStatusEnum::getValues();
        $data = [];

        // skip header
        fgetcsv($file);

        while ($row = fgetcsv($file)) {
            array_push($data, [
                'nik_pengadu' => $usersNik[array_rand($usersNik)],
                'judul' => $row[0],
                'isi' => $row[1],
                'image_url' => "https://via.placeholder.com/640x480.png/00ddcc?text=pengaduan",
                'status' => $statuses[array_rand($statuses)],
                'dibuat_pada' => now()->toDateTime(),
                'diperbarui_pada' => now()->addHours(rand(1, 100))->toDateTime(),
            ]);
        }

        PengaduanModel::insert($data);
    }
}
