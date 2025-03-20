<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class CommaSeparatedQueryParser
{
    public abstract function getParameterName(): string;

    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $valueString = $request->get($this->getParameterName());

        if ($valueString) {
            $values = explode(',', $valueString);
            $request->merge([
                $this->getParameterName() => $values
            ]);
        }

        return $next($request);
    }
}
