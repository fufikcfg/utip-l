<?php

namespace App\Kernel\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogChangeRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if (
            app()->environment('development')
            && in_array($request->method(), ['POST', 'PUT', 'PATCH', 'DELETE'])
        ) {
            Log::info('Incoming request data', [
                'method' => $request->method(),
                'uri'    => $request->getRequestUri(),
                'user_id' => optional($request->user())->id,
                'params' => $request->except(['password', 'password_confirmation']),
            ]);
        }
        return $next($request);
    }
}
