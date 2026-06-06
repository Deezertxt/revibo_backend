<?php

declare(strict_types=1);

namespace App\Enums;

use App\Enums\Concerns\Enumutils;

enum DevicePlatform: string
{
    use Enumutils;

    case ANDROID = 'android';
    case IOS = 'ios';

    public function label(): string
    {
        return match ($this) {
            self::ANDROID => 'Android',
            self::IOS => 'iOS',
        };
    }
}