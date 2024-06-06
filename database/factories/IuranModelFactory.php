<?php

namespace Database\Factories;

use App\Enums\Iuran\IuranBulanEnum;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\IuranModel;
use App\Models\PembayaranIuranModel;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PengaduanModel>
 */
class IuranModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = IuranModel::class;
    public function definition(): array
    {
        $this->faker = fake('id_ID');
        $pembayaranIuranInstances = PembayaranIuranModel::select('id_pembayaran_iuran', 'nik_pembayar')->get();

        return [
            'id_pembayaran_iuran' => $this->faker->randomElement($pembayaranIuranInstances)->getIdPembayaranIuran(),
            'jumlah_bayar' => $this->faker->numberBetween(100000, 1000000),
            'tahun' => 2024,
            'bulan' => $this->faker->randomElement(IuranBulanEnum::getValues()),
            'nik_pembayar' => $this->faker->randomElement($pembayaranIuranInstances)->getNikPembayar()
        ];
    }
}
