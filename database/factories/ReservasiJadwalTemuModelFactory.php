<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserModel>
 */
class ReservasiJadwalTemuModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = \App\Models\ReservasiJadwalTemuModel::class;
    public function definition(): array
    {
        return [
            'nik_pemohon' => $this->faker->randomNumber(16),
            'nik_penerima' => $this->faker->randomNumber(16),
            'subjek' => $this->faker->sentence(),
            'pesan' => $this->faker->paragraph(),
            'jadwal_temu' => $this->faker->dateTime(),
            'status' => $this->faker->randomElement(['pending', 'diterima', 'ditolak'])
        ];
    }
}