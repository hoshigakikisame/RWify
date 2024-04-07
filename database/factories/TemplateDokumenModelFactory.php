<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

use App\Models\TemplateDokumenModel;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserModel>
 */
class TemplateDokumenModelFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = TemplateDokumenModel::class;
    public function definition(): array
    {
        return [
            'nama_template' => $this->faker->sentence(),
            'path_template' => 'build/assets/images/Semeru.png'
        ];
    }
}
