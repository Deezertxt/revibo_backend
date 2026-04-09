<?php

namespace App\Enums;

use App\Enums\Concerns\Enumutils;

enum RolUsuario: string
{
    use Enumutils;

    case ADMIN = 'admin';
    case USUARIO = 'usuario';
    case AUTORIDAD = 'autoridad';

    public function label(): string
    {
        return match ($this) {
            self::ADMIN => 'Administrador',
            self::USUARIO => 'Usuario',
            self::AUTORIDAD => 'Autoridad',
        };
    }
}