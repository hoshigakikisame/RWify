<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class TemplateDokumenModel extends Model
{
    use HasFactory;
    protected $table = 'tb_template_dokumen';
    protected $primaryKey = 'id_template_dokumen';
    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';

    protected $fillable = [
        'id_template_dokumen',
        'nama_template',
        'path_template',
        'dibuat_pada',
        'diperbarui_pada'
    ];

    public static $searchable = [
        'nama_template'
    ];

    // relationships

    // GETTERS
    public function getIdTemplateDokumen(): int {
        return $this->id_template_dokumen;
    }

    public function getNamaTemplate(): string {
        return $this->nama_template;
    }

    public function getPathTemplate(): string {
        return $this->path_template;
    }

    public function getDibuatPada(): string {
        return $this->dibuat_pada;
    }

    public function getDiperbaruiPada(): string {
        return $this->diperbarui_pada;
    }


    // SETTERS
    public function setIdTemplateDokumen(int $id_template_dokumen): void {
        $this->id_template_dokumen = $id_template_dokumen;
    }

    public function setNamaTemplate(string $nama_template): void {
        $this->nama_template = $nama_template;
    }

    public function setPathTemplate(string $path_template): void {
        $this->path_template = $path_template;
    }

    public function setDibuatPada(string $dibuat_pada): void {
        $this->dibuat_pada = $dibuat_pada;
    }

    public function setDiperbaruiPada(string $diperbarui_pada): void {
        $this->diperbarui_pada = $diperbarui_pada;
    }
}
