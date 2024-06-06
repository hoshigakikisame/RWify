<?php

namespace App\Spk;

use App\Models\KartuKeluargaModel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

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
        $this->results();
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
        $this->criteriaWeights();

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
        $this->raw();
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

    public function exportAsXlsx(): Xlsx {
        $spreadsheet = new Spreadsheet();

        // Data Awal
        $dataAwalSheet = $spreadsheet->getActiveSheet();
        $dataAwalSheet->setTitle('Data Awal');
        // setup columns
        $dataAwalSheet->setCellValue('A1', 'Alt/Kriteria');
        for ($i = 0; $i < count($this->criteriaWeights); $i++) {
            $cellCoordinate = chr(66 + $i) . '1';
            $dataAwalSheet->setCellValue($cellCoordinate, array_keys($this->criteriaWeights())[$i]);
        }
        // setup rows
        for ($i = 0; $i < count($this->raw); $i++){
            $cell = chr(65) . ($i + 2);
            $dataAwalSheet->setCellValue($cell, array_keys($this->raw)[$i]);

            for ($j = 0; $j < count($this->raw[array_keys($this->raw)[$i]]); $j++) {
                $cell = chr(66 + $j) . ($i + 2);
                $dataAwalSheet->setCellValue($cell, array_values($this->raw[array_keys($this->raw)[$i]])[$j]);
            }
        }

        // Normalisasi
        $normalisasiSheet = $spreadsheet->createSheet();
        $normalisasiSheet->setTitle('Normalisasi');
        // setup columns
        $normalisasiSheet->setCellValue('A1', 'Alt/Kriteria');
        for ($i = 0; $i < count($this->criteriaWeights); $i++) {
            $cellCoordinate = chr(66 + $i) . '1';
            $normalisasiSheet->setCellValue($cellCoordinate, array_keys($this->criteriaWeights())[$i]);
        }

        // setup rows
        for ($i = 0; $i < count($this->normalized); $i++){
            $cell = chr(65) . ($i + 2);

            $normalisasiSheet->setCellValue($cell, array_keys($this->normalized)[$i]);

            for ($j = 0; $j < count($this->normalized[array_keys($this->normalized)[$i]]); $j++) {
                $cell = chr(66 + $j) . ($i + 2);

                $normalisasiSheet->setCellValue($cell, array_values($this->normalized[array_keys($this->normalized)[$i]])[$j]);
            }
        }

        // Ranking
        $rankingSheet = $spreadsheet->createSheet();
        $rankingSheet->setTitle('Ranking');
        // setup columns
        $rankingSheet->setCellValue('A1', 'Rangking');
        $rankingSheet->setCellValue('B1', 'Alternatif');
        $rankingSheet->setCellValue('C1', 'Nilai');

        // setup rows
        for ($i = 0; $i < count($this->results); $i++){
            $cell = 'A' . ($i + 2);
            $rankingSheet->setCellValue($cell, $i + 1);

            $cell = 'B' . ($i + 2);
            $rankingSheet->setCellValue($cell, $this->results[$i]['instance']->nkk);

            $cell = 'C' . ($i + 2);
            $rankingSheet->setCellValue($cell, $this->results[$i]['preference']);
        }

        $writer = new Xlsx($spreadsheet);
        return $writer;
    }
}