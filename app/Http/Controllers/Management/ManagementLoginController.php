<?php

namespace App\Http\Controllers\Management;

use App\Models\doctor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\patient_list;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\notification;
use App\Models\User;


class ManagementLoginController extends Controller
{
    public function login()
    {
        return view('Management.login');
    }

    public function authenticate(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Check if the validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Attempt to authenticate the user
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $admin = Auth::guard('web')->user();

            if ($admin && $admin->role == 1) {
                return redirect()->route('manage.dashboard');
            }elseif($admin && $admin->role == 4){
                return redirect()->route('fms.dashboard');
            } else {
                Auth::guard('admin')->logout();
                return redirect()->route('manage.login')->withErrors(['error' => 'Unauthorized access.']);
            }
        } else {

            return redirect()->route('manage.login')->withErrors(['error' => 'Invalid credentials.']);
        }
    }

    public function dashboard()
    {
        $doctorList = count(doctor::all());
        $PatientList = count(patient_list::all());
        $notifications = notification::select('data','notifiable_id')->get();
        $latestNotifications = notification::orderBy('created_at', 'desc')->take(5)->get();
        $user = User::all();
        return view('Management.dashboard', compact('doctorList', 'PatientList','notifications','user','latestNotifications'));
    }

    public function logout()
    {
        Auth::guard('web')->logout();
        return redirect()->route('manage.login');
    }

}
