<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Enums\User\UserAgamaEnum;
use App\Enums\User\UserStatusPerkawinanEnum;
use App\Enums\User\UserJenisKelaminEnum;
use App\Enums\User\UserGolonganDarahEnum;

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
        $this->faker = fake('id_ID');

        return [
            'nik' => $this->faker->nik(),
            'image_url' => $this->faker->imageUrl(),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt(env('SEED_DEFAULT_USER_PASSWORD')),
            'nama_depan' => $this->faker->firstName(),
            'nama_belakang' => $this->faker->lastName(),
            'tempat_lahir' => $this->faker->city(),
            'tanggal_lahir' => $this->faker->date(),
            'agama' => $this->faker->randomElement(UserAgamaEnum::getValues()),
            'status_perkawinan' => $this->faker->randomElement(UserStatusPerkawinanEnum::getValues()),
            'pekerjaan' => $this->faker->randomElement(['PNS', 'TNI', 'Polri', 'Pegawai Swasta', 'Wiraswasta', 'Petani', 'Nelayan', 'Buruh', 'Pedagang', 'Pensiunan', 'Tidak Bekerja']),
            'role' => 'Warga',
            'jenis_kelamin' => $this->faker->randomElement(UserJenisKelaminEnum::getValues()),
            'golongan_darah' => $this->faker->randomElement(UserGolonganDarahEnum::getValues()),
            'alamat' => $this->faker->address(),
        ];
    }
}
