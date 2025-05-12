<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class LogEndpointMiddleware
{
    public function handle($request, Closure $next)
    {
        $route = $request->route();
        $method = $request->method();
        $uri = $request->getRequestUri();

        Log::info("Endpoint hit: [{$method}] {$uri}", [
            'route' => optional($route)->getName(),
            'controller' => optional($route)->getActionName()
        ]);

        return $next($request);
    }
}
