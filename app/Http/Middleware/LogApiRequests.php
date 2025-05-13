<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Log;

class LogApiRequests
{
    public function handle($request, Closure $next)
    {
        Log::channel('api')->info('API Request', [
            'method' => $request->method(),
            'url' => $request->fullUrl(),
            'ip' => $request->ip(),
            'input' => $request->except(['password', 'password_confirmation']),
            'timestamp' => now()->toDateTimeString(),
        ]);

        return $next($request);
    }
}
