<?php

namespace Database\Seeders;

use App\Models\PropertiModel;
use App\Models\TipePropertiModel;
use Illuminate\Database\Seeder;

use App\Models\UserModel;

class PropertiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PropertiModel::truncate();
        $userInstances = UserModel::get()->all();
        $tipePropertiInstances = TipePropertiModel::get()->all();

        // Create 1 Rumah Tangga (Tanpa Usaha Kos) for each user
        foreach ($userInstances as $userInstance) {
            PropertiModel::factory()->create(
                [
                    'nik_pemilik' => $userInstance->getNik(),
                    'id_tipe_properti' => $tipePropertiInstances[0]->getIdTipeProperti()
                ]
            );
        }

        // Create Random Properti for half of the users
        PropertiModel::factory()->count(count($userInstances) / 2)->create(
            [
                'id_tipe_properti' => $tipePropertiInstances[1]->getIdTipeProperti(),
            ]
        );
    }
}
