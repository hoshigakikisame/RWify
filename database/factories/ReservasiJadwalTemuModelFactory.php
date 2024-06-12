<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\ReservasiJadwalTemuModel;
use App\Models\UserModel;
use App\Enums\ReservasiJadwalTemu\ReservasiJadwalTemuStatusEnum;


class ReservasiJadwalTemuModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = ReservasiJadwalTemuModel::class;
    public function definition(): array
    {
        $this->faker = fake('id_ID');

        $wargaInstances = UserModel::where('role', 'Warga')->get();
        $ketuaRukunWargaInstance = UserModel::where('role', 'Ketua Rukun Warga')->get()->first();

        return [
            'nik_pemohon' => $this->faker->randomElement($wargaInstances)->getNik(),
            'nik_penerima' => $ketuaRukunWargaInstance->getNik(),
            'subjek' => $this->faker->sentence(),
            'pesan' => $this->faker->paragraph(),
            'jadwal_temu' => $this->faker->dateTime(),
            'status' => $this->faker->randomElement(ReservasiJadwalTemuStatusEnum::getValues()),
            'diperbarui_pada' => now()->addHours(rand(1, 100))->toDateTime(),
        ];
    }
}