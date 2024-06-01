<?php
namespace App\Spk;

use App\Models\KartuKeluargaModel;

class MFEPCalculator
{
    public $alternatives;
    public $criterias;
    private array $factored = [];
    private array $weighted = [];
    private array $results = [];
    
    public function __construct($alternatives = null, $criterias = null)
    {
        $this->alternatives = $alternatives ?? KartuKeluargaModel::all();
        $this->criterias = $criterias ?? KartuKeluargaModel::getSpkCriteria();
        $this->calculate();
    }

    public function factor()
    {
        $this->factored = [];

        // factor each criteria
        foreach ($this->alternatives as $alternative) {
            $this->factored[$alternative->nkk] = [];
            foreach ($this->criterias as $key => $value) {
                $this->factored[$alternative->nkk][$key] = $value['rule']($alternative->$key);
            }
        }

        return $this->factored;
    }

    public function weightEvaluation()
    {
        $this->factor();

        $this->weighted = [];

        // weight each criteria
        foreach ($this->alternatives as $alternative) {
            $this->weighted[$alternative->nkk] = [];
            foreach ($this->criterias as $key => $value) {
                $this->weighted[$alternative->nkk][$key] = $this->factored[$alternative->nkk][$key] * $value['weight'];
            }
        }

        return $this->weighted;
    }

    public function calculate()
    {
        $this->weightEvaluation();

        $this->results = [];

        // sum all weighted criteria
        foreach ($this->alternatives as $alternative) {
            $this->results[] = [
                'instance' => $alternative,
                'preference' => array_sum($this->weighted[$alternative->nkk])
            ];
        }

        // DESC sort
        usort($this->results, function ($a, $b) {
            return $a['preference'] <= $b['preference'];
        });

        return $this->results;
    }
}