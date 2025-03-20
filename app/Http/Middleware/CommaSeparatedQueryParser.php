<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Replaces comma separated query parameters to a query array
 */
class CommaSeparatedQueryParser
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next, ...$parameterNames): Response
    {
        foreach ($parameterNames as $name) {
            $this->parseParameter($request, $name);
        }

        return $next($request);
    }

    private function parseParameter(Request $request, string $name): void
    {
        $valueString = $request->get($name);

        if ($valueString) {
            $values = explode(',', $valueString);
            $request->merge([
                $name => $values
            ]);
        }
    }
}
