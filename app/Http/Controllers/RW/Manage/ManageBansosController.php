<?php
namespace App\Http\Controllers\RW\Manage;

use App\Http\Controllers\Controller;
use App\Models\KartuKeluargaModel;
use App\Spk\MFEPCalculator;

class ManageBansosController extends Controller
{
    public function bansosMfepPage()
    {
        
        $mfep = new MFEPCalculator(KartuKeluargaModel::all(), KartuKeluargaModel::getSpkCriteria());

        $criteriaWeights = [];
        foreach ($mfep->criterias as $key => $value) {
            $newKey = str_replace('_', ' ', $key);
            $newKey = ucwords($newKey);
            $criteriaWeights[$newKey] = $value['weight'];
        }

        // dd($criteriaWeights, $mfep->factor(), $mfep->weightEvaluation(), $mfep->calculate());

        return view('pages.rw.manage.bansos.mfep', [
            'criteriaWeights' => $criteriaWeights,
            'factored' => $mfep->factor(),
            'weighted' => $mfep->weightEvaluation(),
            'results' => $mfep->calculate()
        ]);
    }
}