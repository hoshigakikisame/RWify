<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\KartuKeluargaModel;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PengaduanModel>
 */
class KartuKeluargaModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = KartuKeluargaModel::class;
    public function definition(): array
    {
        $this->faker = fake('id_ID');

        return [
            'nkk' => $this->faker->nik(),
            'alamat' => $this->faker->address(),
            'tagihan_listrik_per_bulan' => $this->faker->numberBetween(100000, 1000000),
            'jumlah_pekerja' => $this->faker->numberBetween(1, 10),
            'total_penghasilan_per_bulan' => $this->faker->numberBetween(1000000, 10000000),
            'total_pajak_per_tahun' => $this->faker->numberBetween(1000000, 10000000),
            'tagihan_air_per_bulan' => $this->faker->numberBetween(100000, 1000000),
            'total_kendaraan_dimiliki' => $this->faker->numberBetween(1, 10),
            'diperbarui_pada' => now()->addHours(rand(1, 100))->toDateTime(),
        ];
    }
}
