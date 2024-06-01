<?php
namespace App\Http\Controllers\RW\Manage;

use App\Http\Controllers\Controller;
use App\Models\KartuKeluargaModel;
use App\Spk\MFEPCalculator;
use App\Spk\SAWCalculator;

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
        $saw = new SAWCalculator(KartuKeluargaModel::all(), KartuKeluargaModel::getSpkCriteria());

        // dd($saw->criteriaWeights(), $saw->raw(), $saw->divisors(), $saw->normalize(), $saw->results());

        return view('pages.rw.manage.bansos.saw', [
            'criteriaWeights' => $saw->criteriaWeights(),
            'raw' => $saw->raw(),
            'divisors' => $saw->divisors(),
            'normalized' => $saw->normalize(),
            'results' => $saw->results()
        ]);
    }
}