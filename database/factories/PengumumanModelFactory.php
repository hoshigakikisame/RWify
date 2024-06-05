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
        $this->faker = fake('id_ID');

        return [
            'judul' => $this->faker->sentence(),
            'image_url' => $this->faker->imageUrl(),
            'konten' => $this->faker->paragraph()
        ];
    }
}
