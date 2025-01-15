<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Check if the logged-in user has the required role
        if (!Auth::check() || Auth::user()->role !== $role) {
            return redirect('/');
        }

        return $next($request);
    }
}
