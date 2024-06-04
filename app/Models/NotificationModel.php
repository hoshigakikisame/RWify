<?php

namespace App\Models;

use App\Enums\User\UserRoleEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\HasTimeStamp;
use App\Interfaces\SearchCompatible;

class NotificationModel extends Model implements SearchCompatible {
    
    use HasFactory, HasTimeStamp;
    protected $table = 'tb_notification';
    protected $primaryKey = 'id_notification';
    const CREATED_AT = 'dibuat_pada';
    const UPDATED_AT = 'diperbarui_pada';

    protected $fillable = [
        'id_notification',
        'target_nik',
        'role',
        'pesan',
        'slug',
        'dibaca_pada',
    ];

    public static function searchable(): array
    {
        return [
            'target_nik',
            'role',
            'pesan',
        ];
    }

    public static function filterable(): array {
        return [
            'target_nik',
            'role'
        ];
    }

    // relationships
    public function user(): object | null
    {
        return $this->belongsTo(UserModel::class, 'target_nik', 'nik');
    }

    public static function new(?string $targetNik, string $pesan, string $slug): object
    {
        return self::create([
            'target_nik' => $targetNik,
            'pesan' => $pesan,
            'slug' => $slug,
        ]);
    }

    public function markAsRead(): void
    {
        $this->dibaca_pada = now();
        $this->save();
    }

    // GETTERS
    public function getIdNotification(): int
    {
        return $this->id_notification;
    }

    public function getTargetNik(): string
    {
        return $this->target_nik;
    }

    public function getPesan(): string
    {
        return $this->pesan;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function getUrl(): string
    {
        return config('app.url') . $this->slug;
    }

    public function getDibacaPada(): string
    {
        return $this->dibaca_pada;
    }

    public function getDibuatPada(): string
    {
        return $this->dibuat_pada;
    }

    public function getDiperbaruiPada(): string
    {
        return $this->diperbarui_pada;
    }


    // SETTERS
    public function setTargetNik(string $target_nik): void
    {
        $this->target_nik = $target_nik;
    }

    public function setPesan(string $pesan): void
    {
        $this->pesan = $pesan;
    }

    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    public function setDibacaPada(string $dibaca_pada): void
    {
        $this->dibaca_pada = $dibaca_pada;
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