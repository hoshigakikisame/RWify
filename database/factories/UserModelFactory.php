<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserModel>
 */
class UserModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = \App\Models\UserModel::class;
    public function definition(): array
    {
        return [
            'nik' => $this->faker->unique()->regexify('[1-9]{16}'),
            'nkk' => $this->faker->regexify('[1-9]{16}'),
            'image_url' => $this->faker->imageUrl(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt(env('SEED_DEFAULT_USER_PASSWORD')),
            'nama_depan' => $this->faker->firstName(),
            'nama_belakang' => $this->faker->lastName(),
            'tempat_lahir' => $this->faker->city(),
            'tanggal_lahir' => $this->faker->date(),
            'agama' => $this->faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu']),
            'status_perkawinan' => $this->faker->randomElement(['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati']),
            'pekerjaan' => $this->faker->randomElement(['PNS', 'TNI', 'Polri', 'Pegawai Swasta', 'Wiraswasta', 'Petani', 'Nelayan', 'Buruh', 'Pedagang', 'Pensiunan', 'Tidak Bekerja']),
            'tipe_warga' => $this->faker->randomElement(['Domisili Lokal', 'Non Domisili Lokal', 'Bukan Warga']),
            'role' => 'Warga',
            'jenis_kelamin' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'golongan_darah' => $this->faker->randomElement(['A', 'B', 'AB', 'O']),
            'alamat' => $this->faker->address(),
        ];
    }
}
