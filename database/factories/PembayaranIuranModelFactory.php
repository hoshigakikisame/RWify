<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\PembayaranIuranModel;
use App\Models\UserModel;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PengaduanModel>
 */
class PembayaranIuranModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = PembayaranIuranModel::class;
    public function definition(): array
    {
        $this->faker = fake('id_ID');
        $nikCollections = UserModel::pluck('nik')->all();

        return [
            'tanggal_bayar' => $this->faker->date(),
            'image_url' => $this->faker->imageUrl(),
            'keterangan' => 'Pembayaran iuran bulan ' . $this->faker->monthName() . ' 2024',
            'nik_pembayar' => $this->faker->randomElement($nikCollections),
            'diperbarui_pada' => now()->addHours(rand(1, 100))->toDateTime(),
        ];
    }
}
