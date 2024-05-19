<?php

namespace App\Traits;

use Carbon\Carbon;

trait HasTimeStamp {
    public function getDibuatPada(): Carbon
    {
        return Carbon::parse($this->dibuat_pada);
    }

    public function getDiperbaruiPada(): Carbon
    {
        return Carbon::parse($this->diperbarui_pada);
    }

    public function getReadableDibuatPada()
    {
        $date = $this->getDibuatPada();
        return "{$date->isoFormat('dddd, D MMMM Y')} pukul {$date->format('H:i')}";
    }

    public function getReadableDiperbaruiPada()
    {
        $date = $this->getDiperbaruiPada();
        return "{$date->isoFormat('dddd, D MMMM Y')} pukul {$date->format('H:i')}";
    }

    public function setDibuatPada(string $dibuat_pada): void
    {
        $this->dibuat_pada = $dibuat_pada;
    }

    public function setDiperbaruiPada(string $diperbarui_pada): void
    {
        $this->diperbarui_pada = $diperbarui_pada;
    }
}