<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class DoctorAuthenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        return $request->expectsJson() ? null : route('doctor.login');

    }

    protected function authenticate($request, array $guards)
    {

        if ($this->auth->guard('doctor')->check()) {
            return $this->auth->shouldUse('doctor');
        }


        $this->unauthenticated($request, ['doctor']);
    }
}
