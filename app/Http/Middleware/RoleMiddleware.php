<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = Auth::user();

        if (!$user || !in_array($user->role, $roles)) {
            // Option 1: abort with 403 forbidden
            abort(403, 'Unauthorized');

            // Option 2: redirect to homepage with message
            // ToastMagic::error('You do not have permission to access this page.', 'Access Denied');
            // return redirect('/');
        }

        return $next($request);
    }
}
