<?php

namespace App\Enums;

use App\Enums\Concerns\Enumutils;

enum TipoReporteEnum: string
{
    use Enumutils;

    case BLOQUEO = 'bloqueo';
    case MARCHA = 'marcha';
    case MANTENIMIENTO = 'mantenimiento';
    case CIERRE_PROGRAMADO = 'cierre_programado';
    case DESFILE = 'desfile';
    case FESTIVIDAD = 'festividad';
    case FERIA = 'feria';
    case ACCIDENTE_VEHICULAR = 'accidente_vehicular';
    case INCENDIO = 'incendio';
    case DERRUMBE = 'derrumbe';
    case DESLIZAMIENTO = 'deslizamiento';
    case INUNDACION = 'inundacion';

    public function label(): string
    {
        return match ($this) {
            self::BLOQUEO => 'Bloqueo',
            self::MARCHA => 'Marcha',
            self::MANTENIMIENTO => 'Mantenimiento',
            self::CIERRE_PROGRAMADO => 'Cierre Programado',
            self::DESFILE => 'Desfile',
            self::FESTIVIDAD => 'Festividad',
            self::FERIA => 'Feria',
            self::ACCIDENTE_VEHICULAR => 'Accidente Vehicular',
            self::INCENDIO => 'Incendio',
            self::DERRUMBE => 'Derrumbe',
            self::DESLIZAMIENTO => 'Deslizamiento',
            self::INUNDACION => 'Inundación',
        };
    }
}
