<?php

namespace App\Http\Controllers\Management;

use App\Models\doctor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\patient_registration;
use App\Models\User;
use App\Notifications\DoctorNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Workbench\App\Models\User as ModelsUser;

class DoctorsController extends Controller
{
    public function doctorList()
    {
        $doctors = User::orderBy('id', 'DESC')->where('role', '3')->paginate(10);
        return view('Management.doctorList', compact('doctors'));
    }
    public function create()
    {
        return view('Management.createDoctors');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required | required_with:confirm_password ',
            'confirm_password' => 'required | same:password',
            'contact' => 'required',
            'status' => 'required',
            'image' => 'image | required',

        ]);

        // dd($request->all());
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }

        $image = $request->file('image');
        $imageName = $request->name . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('management/doctorimg'), $imageName);
        $doctor = new User();
        $doctor->name = $request->name;
        $doctor->email = $request->email;
        $doctor->role = $request->role;
        $doctor->password = bcrypt($request->password);
        $doctor->contact = $request->contact;
        $doctor->image = 'management/doctorimg/' . $imageName;
        $doctor->status = $request->status;
        $doctor->save();

        session()->flash("success", 'Doctor Added Successfully');
        return redirect()->route('manage.doctorList')->with('success', 'Doctor Added Successfully');
    }

    public function edit(Request $request,$id)
    {
        $doctor  = User::find($id);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required | required_with:confirm_password ',
            'confirm_password' => 'required | same:password',
            'contact' => 'required',
            'status' => 'required',

        ]);

         //dd($request->all());
        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        }


        $doctor->name = $request->name;
        $doctor->email = $request->email;
        $doctor->role = $request->role;
        $doctor->password = bcrypt($request->password);
        $doctor->contact = $request->contact;
        $doctor->image = $request->image;
        $doctor->status = $request->status;
        $doctor->save();

        session()->flash("success", 'Doctor Updated Successfully');
        return redirect()->route('manage.doctorList')->with('success', 'Doctor Updated Successfully');
    }

    public function doctorEdit($id)
    {
        $doctor = User::find($id);
        if (!empty($doctor)) {

            return view('Management.editDoctors', compact('doctor'));
        }
    }

    public function login()
    {
        return view('Management.doctorLogin');
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

        // Attempt to authenticate the user using the 'doctor' guard
        if (Auth::guard('doctor')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $doctor = Auth::guard('doctor')->user();

            if ($doctor && $doctor->role == 3) {
                return redirect()->route('doctor.dashboard');
            } else {
                Auth::guard('doctor')->logout();
                return redirect()->route('doctor.login')->withErrors(['error' => 'Unauthorized access.']);
            }
        } else {
            return redirect()->route('doctor.login')->withErrors(['error' => 'Invalid credentials.']);
        }
    }

    public function dashboard()
    {
        $user = Auth::user();
        $notifications = $user->notifications()
            ->where('notifiable_id', Auth::id())
            ->latest()
            ->take(5)
            ->get();
        return view('Management.Doctordashboard', compact('notifications'));
    }


    public function logout()
    {
        Auth::guard('doctor')->logout();
        return redirect()->route('doctor.login');
    }

    //BOOK APPOINTMENT
    public function doctorApp(Request $request, $id)
    {
        $patientInfo = patient_registration::find($id);
        $doctors = User::where('role', 3)->get();
        return view('Management.DoctorApp', compact('patientInfo', 'doctors'));
    }

    public function doctorAppBook(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'app_date' => 'required|date',
            'session_no' => 'required|string',
            'name' => 'required|string',
            'patient_id' => 'required|integer',
        ]);

        $data = $validator->validated();

        $authUser = Auth::user();
        if ($authUser) {
            $doctor = user::find($request->doctor_id);

            if ($doctor) {
                // Send the notification to the doctor (notifiable_id is set to doctor_id)
                $doctor->notify(new DoctorNotification(
                    $data['app_date'],
                    $data['session_no'],
                    $data['name'],
                    $data['patient_id']
                ));
                session()->flash("success", 'Booked Appointment Successfully');
                return redirect()->back()->with('success', 'Booked Appointment Successfully');
            }

            return response()->json(['message' => 'Doctor not found.'], 404);
        }

        return response()->json(['message' => 'User not authenticated.'], 401);
    }


    public function markAsRead(Request $request, $id)
    {
        // dd($id);
        if ($id) {
            auth()->user()->notifications->where('id', $id)->markasread();
        }
        return back();
    }

    public function doctorDelete($id)
    {
        $doctor =  User::find($id);
        $doctor->delete();
        return redirect()->back()->with('success', "Deleted SuccessFully");
    }

    public function trashList()
    {
        $doctors = User::onlyTrashed()->get();
        return view('Management.trash', compact('doctors'));
    }

    public function restoreTrash($id)
    {
        $doctor =  User::withTrashed()->find($id);
        $doctor->restore();
        return redirect()->back()->with('success', 'Restored !');
    }

    public function trashed($id)
    {
        $users =  User::onlyTrashed()->find($id);
        $users->forceDelete();
        return  redirect()->back()->with('success', 'Deleted Permanently  !');
    }
}
