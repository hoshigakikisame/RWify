<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PengumumanModel>
 */
class PengumumanModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = \App\Models\PengumumanModel::class;
    public function definition(): array
    {
        return [
            'judul' => $this->faker->sentence(),
            'path_gambar' => 'build/assets/images/Semeru.png',
            'konten' => $this->faker->paragraph()
        ];
    }
}
