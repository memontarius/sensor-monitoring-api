<?php

namespace App\Models\Enums;

enum SensorValueKey: string
{
    case TEMPERATURE = 'T';
    case PRESSURE = 'P';
    case TORQUE_VELOCITY = 'v';

    public static function values(): array
    {
        return array_map(fn ($case) => $case->value, self::cases());
    }
}
