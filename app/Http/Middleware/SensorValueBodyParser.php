<?php

namespace App\Http\Middleware;

use App\Models\Enums\SensorValueKey;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SensorValueBodyParser
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $rawContent = e($request->getContent());
        parse_str($rawContent, $parsedData);

        $intersectKeys = array_intersect(array_keys($parsedData), SensorValueKey::values());

        if (empty($intersectKeys)) {
            return response()->json([
                'message' => 'Missing value of sensor'
            ], status: Response::HTTP_BAD_REQUEST);
        }

        $key = $intersectKeys[0];
        $request->merge([
            'type' => $key,
            'value' => $parsedData[$key]
        ]);

        return $next($request);
    }
}
