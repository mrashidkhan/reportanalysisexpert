<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string  $role
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, $role = null)
    {
        // Check if user is authenticated
        // if (!Auth::check()) {
        //     return redirect()->route('login');
        // }

        $user = Auth::user();

        // If no role is specified, just check if user is authenticated
        if ($role === null) {
            return $next($request);
        }

        // Check if user has the required role
        if ($user->role !== $role) {
            // Redirect based on user's actual role
            switch ($user->role) {
                case 'admin':
                    return redirect()->route('admin.dashboard');
                case 'doctor':
                    return redirect()->route('doctor.dashboard');
                case 'patient':
                    return redirect()->route('patient.dashboard');
                default:
                    return redirect()->route('login')->with('error', 'Unauthorized access');
            }
        }

        return $next($request);
    }
}
