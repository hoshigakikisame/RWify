<?php
namespace App\Spk;

use App\Models\KartuKeluargaModel;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class MFEPCalculator
{
    private $alternatives;
    private $criterias;

    private array $criteriaWeights = [];
    private array $raw = [];
    private array $factored = [];
    private array $weighted = [];
    private array $results = [];

    public function __construct($alternatives = null, $criterias = null)
    {
        $this->alternatives = $alternatives ?? KartuKeluargaModel::all();
        $this->criterias = $criterias ?? KartuKeluargaModel::getSpkCriteria();
        $this->calculate();
    }

    public function criteriaWeights()
    {
        foreach ($this->criterias as $key => $value) {
            $newKey = str_replace('_', ' ', $key);
            $newKey = ucwords($newKey);
            $this->criteriaWeights[$newKey] = $value['weight'];
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

    public function exportAsXlsx(): Xlsx
    {
        $spreadsheet = new Spreadsheet();
        $this->criteriaWeights();
        $this->raw();

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

        // Faktor
        $faktorSheet = $spreadsheet->createSheet();
        $faktorSheet->setTitle('Faktor');
        // setup columns
        $faktorSheet->setCellValue('A1', 'Alt/Kriteria');
        for ($i = 0; $i < count($this->criteriaWeights); $i++) {
            $cellCoordinate = chr(66 + $i) . '1';
            $faktorSheet->setCellValue($cellCoordinate, array_keys($this->criteriaWeights())[$i]);
        }

        // setup rows
        for ($i = 0; $i < count($this->factored); $i++){
            $cell = chr(65) . ($i + 2);

            $faktorSheet->setCellValue($cell, array_keys($this->factored)[$i]);

            for ($j = 0; $j < count($this->factored[array_keys($this->factored)[$i]]); $j++) {
                $cell = chr(66 + $j) . ($i + 2);

                $faktorSheet->setCellValue($cell, array_values($this->factored[array_keys($this->factored)[$i]])[$j]);
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
        for ($i = 0; $i < count($this->weighted); $i++){
            $cell = chr(65) . ($i + 2);

            $normalisasiSheet->setCellValue($cell, array_keys($this->weighted)[$i]);

            for ($j = 0; $j < count($this->weighted[array_keys($this->weighted)[$i]]); $j++) {
                $cell = chr(66 + $j) . ($i + 2);

                $normalisasiSheet->setCellValue($cell, array_values($this->weighted[array_keys($this->weighted)[$i]])[$j]);
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