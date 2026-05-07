<?php

namespace App\Enums;

enum PapelUsuario: string
{
    case Master  = 'master';
    case Admin   = 'admin';
    case Usuario = 'usuario';

    public function label(): string
    {
        return match($this) {
            self::Master  => 'Administrador Master',
            self::Admin   => 'Administrador',
            self::Usuario => 'Usuário',
        };
    }

    public function badgeClass(): string
    {
        return match($this) {
            self::Master  => 'bg-amber-100 text-amber-800 border-amber-200',
            self::Admin   => 'bg-violet-100 text-violet-800 border-violet-200',
            self::Usuario => 'bg-slate-100 text-slate-700 border-slate-200',
        };
    }
}
