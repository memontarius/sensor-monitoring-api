<?php

namespace App\Http\Middleware;

use App\Models\Enums\SensorValueKey;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SensorTypesQueryParser extends CommaSeparatedQueryParser
{
    public function getParameterName(): string
    {
        return 'types';
    }
}
