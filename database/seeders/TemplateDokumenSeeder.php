<?php

namespace Database\Seeders;

use App\Models\TemplateDokumenModel;
use Illuminate\Database\Seeder;

use App\Models\UserModel;

class TemplateDokumenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TemplateDokumenModel::truncate();
        $templateDokumenInstances = TemplateDokumenModel::factory()->count(30)->create()->all();
    }
}
