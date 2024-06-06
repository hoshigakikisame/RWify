<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TipePropertiModel;
use App\Models\UserModel;

use App\Enums\Pengaduan\PengaduanStatusEnum;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PengaduanModel>
 */
class TipePropertiModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = TipePropertiModel::class;
    public function definition(): array
    {
        $this->faker = fake('id_ID');

        return [
            'nama_tipe' => $this->faker->sentence(),
            'iuran_per_bulan' => $this->faker->randomNumber(6),
        ];
    }
}
