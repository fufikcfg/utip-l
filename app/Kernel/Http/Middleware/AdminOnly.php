<?php

namespace App\Kernel\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminOnly
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        if ($request->isMethod('get')) {
            return $next($request);
        }
        $user = $request->user();
        if (!$user || !$user->is_admin) {
            return response()->json(['message' => 'Forbidden. Admins only.'], 403);
        }
        return $next($request);
    }
}
