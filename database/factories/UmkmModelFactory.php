<?php

namespace Database\Factories;

// Illuminate
use Illuminate\Database\Eloquent\Factories\Factory;

// App
use App\Models\UmkmModel;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserModel>
 */
class UmkmModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = UmkmModel::class;
    public function definition(): array
    {
        return [
            'nama' => $this->faker->sentence(),
            'image_url' => $this->faker->imageUrl(),
            'nama_pemilik' => $this->faker->name(),
            'alamat' => $this->faker->address(),
            'map_url' => $this->faker->url(),
            'telepon' => $this->faker->phoneNumber(),
            'instagram_url' => $this->faker->url(),
            'deskripsi' => $this->faker->paragraph()
        ];
    }
}
