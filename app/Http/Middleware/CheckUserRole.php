<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = $request->user();

        // if (!in_array($user->role, $roles)) {
        //     abort(403, 'Unauthorized action.');
        // }

        return $next($request);
    }
}
