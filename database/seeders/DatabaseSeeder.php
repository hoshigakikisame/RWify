<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void {
        $this->call([
            UserSeeder::class,
            PengumumanSeeder::class,
            UmkmSeeder::class,
            PengaduanSeeder::class,
            ReservasiJadwalTemuModelSeeder::class,
            TipePropertiSeeder::class,
            PropertiSeeder::class,
            PembayaranIuranSeeder::class,
            IuranSeeder::class,
        ]);
    }
}
