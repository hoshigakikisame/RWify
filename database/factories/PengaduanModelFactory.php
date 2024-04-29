<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PengaduanModel;
use App\Models\UserModel;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PengaduanModel>
 */
class PengaduanModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = PengaduanModel::class;
    public function definition(): array
    {
        return [
            'judul' => $this->faker->sentence(),
            'nik_pengadu' => UserModel::get()->random()->getNik(),
            'isi' => $this->faker->paragraph(),
            'path_gambar' => $this->faker->imageUrl(),
            'status' => $this->faker->randomElement(PengaduanModel::getStatusOptions()),
        ];
    }
}
