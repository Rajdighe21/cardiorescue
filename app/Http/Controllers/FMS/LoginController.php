<?php

namespace App\Http\Controllers\FMS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\patient_registration;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\select;

class LoginController extends Controller
{

    public function login()
    {
        return view('FMS.login');
    }

    /**
     * Handle login authentication.
     */
    public function loginCheck(Request $request)
    {
        // Validate the request data
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials) && Auth::user()->role === '4') {
            // Regenerate the session to prevent fixation attacks
            $request->session()->regenerate();

            return redirect()->route('fms.dashboard')->with('success', 'Logged in successfully!');
        }

        // If authentication fails, redirect back with an error message
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Show the dashboard if the user is authenticated.
     */
    public function dashboard()
    {
        if (Auth::check()) {
            $patients  = DB::select('Select * from patient_registrations order by id desc');
            return view('FMS.dashboard',compact('patients'));
        }

        return redirect()->route('manage.login')->with('error', 'Please log in first.');
    }

    /**
     * Log out the authenticated user.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        // Invalidate the session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('manage.login')->with('success', 'Logged out successfully!');
    }
}
