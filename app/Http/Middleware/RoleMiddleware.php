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
     * @param  \Closure  $next
     * @param  string[]  ...$roles
     */

    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = Auth::user();

        if (!$user || !in_array($user->role, $roles)) {
            // Option 1: abort with 403 forbidden
            // abort(403, 'Unauthorized');

            // Option 2: redirect to homepage with message
            return redirect('/')->withErrors(['access' => 'You do not have permission to access this page.']);
        }

        return $next($request);
    }
}
