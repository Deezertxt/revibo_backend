<?php

namespace App\Enums;

use App\Enums\Concerns\Enumutils;

enum GravedadReporteEnum: string
{
    use Enumutils;

    case BAJO = 'Bajo';
    case MEDIO = 'Medio';
    case ALTO = 'Alto';

    case CRITICO = 'Critico';

    public function label(): string
    {
        return match ($this) {
            self::BAJO => 'Bajo',
            self::MEDIO => 'Medio',
            self::ALTO => 'Alto',
            self::CRITICO => 'Critico',
        };
    }
}
