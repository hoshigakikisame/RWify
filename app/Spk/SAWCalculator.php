<?php

namespace App\Spk;

use App\Models\KartuKeluargaModel;

class SAWCalculator {
    private $alternatives;
    private $criterias;

    private array $criteriaWeights = [];
    private array $raw = [];
    private array $divisors = [];
    private array $normalized = [];
    private array $results = [];
    
    public function __construct($alternatives = null, $criterias = null)
    {
        $this->alternatives = $alternatives ?? KartuKeluargaModel::all();
        $this->criterias = $criterias ?? KartuKeluargaModel::getSpkCriteria();
    }

    public function criteriaWeights()
    {
        foreach ($this->criterias as $key => $value) {
            $newKey = str_replace('_', ' ', $key);
            $newKey = ucwords($newKey);
            $this->criteriaWeights[$newKey] = [
                'weight' => $value['weight'],
                'type' => $value['type']
            ];
        }

        return $this->criteriaWeights;
    }

    public function raw()
    {
        $this->raw = [];

        // get raw data
        foreach ($this->alternatives as $alternative) {
            $this->raw[$alternative->nkk] = [];
            foreach ($this->criterias as $key => $value) {
                $this->raw[$alternative->nkk][$key] = $alternative->$key;
            }
        }

        return $this->raw;
    }

    public function divisors()
    {
        // get divisors
        foreach ($this->criterias as $key => $value) {
            $this->divisors[$key] = $value['type'] == 'benefit' ? max(array_column($this->raw, $key)) : min(array_column($this->raw, $key));
        }

        return $this->divisors;
    }

    public function normalize() {
        $this->divisors();

        $this->normalized = [];

        // normalize data
        foreach ($this->alternatives as $alternative) {
            $this->normalized[$alternative->nkk] = [];
            foreach ($this->criterias as $key => $value) {
                $this->normalized[$alternative->nkk][$key] = $value['type'] == 'benefit' ? $alternative->$key / $this->divisors[$key] : $this->divisors[$key] / $alternative->$key;
            }
        }

        return $this->normalized;
    }

    public function results()
    {
        $this->normalize();

        $this->results = [];

        // sum all normalized criteria
        foreach ($this->alternatives as $alternative) {
            $this->results[] = [
                'instance' => $alternative,
                'preference' => array_sum($this->normalized[$alternative->nkk])
            ];
        }

        // DESC sort
        usort($this->results, function ($a, $b) {
            return $a['preference'] <= $b['preference'];
        });

        return $this->results;
    }
}