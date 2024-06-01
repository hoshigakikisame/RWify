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

        // dd($mfep->criteriaWeights(), $mfep->raw(), $mfep->factor(), $mfep->weightEvaluation(), $mfep->calculate());

        return view('pages.rw.manage.bansos.mfep', [
            'criteriaWeights' => $mfep->criteriaWeights(),
            'raw' => $mfep->raw(),
            'factored' => $mfep->factor(),
            'weighted' => $mfep->weightEvaluation(),
            'results' => $mfep->calculate()
        ]);
    }

    public function bansosSawPage()
    {
        return view('pages.rw.manage.bansos.saw');
    }
}