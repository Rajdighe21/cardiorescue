<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class ManagementAuthenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('manage.login');

    }

    protected function authenticate($request, array $guards)
    {
        // Use the 'web' guard to check authentication
        if ($this->auth->guard('web')->check()) {
            $user = $this->auth->guard('web')->user();

            // Verify if the user has role = 1
            if ($user && $user->role == 1) {
                return $this->auth->shouldUse('web');
            }
        }

        // Logout and redirect to login if unauthorized
        $this->auth->guard('web')->logout();
        $this->unauthenticated($request, ['web']);
    }
}
