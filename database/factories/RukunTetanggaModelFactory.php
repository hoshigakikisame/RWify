<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\RukunTetanggaModel>
 */
class RukunTetanggaModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = \App\Models\RukunTetanggaModel::class;
    public function definition(): array
    {
        return [
            'nomor_rukun_tetangga' => $this->faker->unique()->randomDigit(),
            'alamat' => $this->faker->address()
        ];
    }
}
