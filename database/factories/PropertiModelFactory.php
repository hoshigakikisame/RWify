<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PropertiModel;
use App\Models\TipePropertiModel;
use App\Models\UserModel;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PengaduanModel>
 */
class PropertiModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = PropertiModel::class;
    public function definition(): array
    {
        return [
            'nama_properti' => $this->faker->sentence(),
            'id_tipe_properti' => TipePropertiModel::get()->random()->getIdTipeProperti(),
            'nik_pemilik' => UserModel::get()->random()->getNik(),
            'alamat' => $this->faker->address(),
            'luas_tanah' => $this->faker->randomNumber(2),
            'luas_bangunan' => $this->faker->randomNumber(2),
            'jumlah_kamar' => $this->faker->randomNumber(1),
        ];
    }
}
