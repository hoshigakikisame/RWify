<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PengaduanModel;
use App\Models\UserModel;

use App\Enums\Pengaduan\PengaduanStatusEnum;

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
        $this->faker = fake('id_ID');

        return [
            'judul' => $this->faker->sentence(),
            'nik_pengadu' => UserModel::get()->random()->getNik(),
            'isi' => $this->faker->paragraph(),
            'image_url' => $this->faker->imageUrl(),
            'status' => $this->faker->randomElement(PengaduanStatusEnum::getValues())
        ];
    }
}
