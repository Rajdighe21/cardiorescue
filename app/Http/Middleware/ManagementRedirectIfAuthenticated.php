<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class ManagementRedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string ...$guards): Response
    {

        // Check authentication using the 'web' guard
        if (Auth::guard('web')->check()) {
            $user = Auth::guard('web')->user();

            // Redirect only if the authenticated user has role = 1
            if ($user->role == 1) {
                return redirect()->route('manage.dashboard');
            }
        }

        // Allow the request to proceed for unauthenticated users or those without role = 1
        return $next($request);
    }
}
