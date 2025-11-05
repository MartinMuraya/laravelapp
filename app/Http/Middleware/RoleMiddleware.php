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
    public function handle(Request $request, Closure $next, string $role)
    {
        // if not logged in → send to login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // get current user's role
        $userRole = Auth::user()->role;

        // if role doesn’t match → redirect them properly
        if ($userRole !== $role) {
            if ($userRole === 'admin') {
                return redirect()->route('admin.dashboard')
                    ->with('error', 'You are not allowed to access that page.');
            }

            if ($userRole === 'user') {
                return redirect()->route('user.dashboard')
                    ->with('error', 'You are not allowed to access that page.');
            }

            // fallback (in case new roles are added later)
            return redirect()->route('home')
                ->with('error', 'Unauthorized access.');
        }

        // otherwise allow access
        return $next($request);
    }
}
