<?php

namespace App\Enums;
use App\Enums\Concerns\Enumutils;

enum TipoNotificacionEnum: string
{
    use Enumutils;

    case GENERAL = 'General';
    case PERSONALIZADO = 'Personalizado';

    public function label(): string
    {
        return match ($this) {
            self::GENERAL => 'General',
            self::PERSONALIZADO => 'Personalizado',
        };
    }
}
