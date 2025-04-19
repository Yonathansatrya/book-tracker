<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Cek login dan role admin
        if (!Auth::check() || Auth::user()->role !== 'admin') {
            return redirect()->route('404'); // Route dengan nama 404
        }

        return $next($request);
    }
}
