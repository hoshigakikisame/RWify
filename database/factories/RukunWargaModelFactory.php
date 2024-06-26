<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RukunWargaModel>
 */
class RukunWargaModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

     protected $model = \App\Models\RukunWargaModel::class;
    public function definition(): array
    {
        $this->faker = fake('id_ID');

        return [
            'nomor_rukun_warga' => 1,
            'alamat' => $this->faker->address(),
            'diperbarui_pada' => now()->addHours(rand(1, 100))->toDateTime(),
        ];
    }
}
