<?php

namespace App\Models;

use App\Enums\PapelUsuario;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'papel',
        'ativo',
        'cidade_comarca_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password'          => 'hashed',
            'papel'             => PapelUsuario::class,
            'ativo'             => 'boolean',
        ];
    }

    public function cidadeComarca(): BelongsTo
    {
        return $this->belongsTo(CidadeComarca::class);
    }

    public function verTodasCidades(): bool
    {
        return $this->cidade_comarca_id === null;
    }

    public function canEdit(): bool
    {
        return $this->papel !== PapelUsuario::Usuario;
    }

    public function canManageUsers(): bool
    {
        return $this->papel === PapelUsuario::Master;
    }

    public function isMaster(): bool
    {
        return $this->papel === PapelUsuario::Master;
    }
}
