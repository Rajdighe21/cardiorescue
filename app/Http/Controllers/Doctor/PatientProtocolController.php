<?php

namespace App\Http\Controllers\Doctor;

use App\Models\doctor;
use App\Models\assessment;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\patient_registration;
use Illuminate\Support\Facades\Validator;

class PatientProtocolController extends Controller
{
    public function index()
    {
        $doctors = doctor::all();


        foreach ($doctors as $doctor) {
            $doctor->app_date = json_decode($doctor->app_date, true);
            $doctor->session_no = json_decode($doctor->session_no, true);
            $doctor->doctor_name = json_decode($doctor->doctor_name, true);
            $doctor->percentage = json_decode($doctor->percentage, true);
        }
        return view('doctor.protocol', compact('doctors'));
    }

    public function search(Request $request)
    {
        $doctors = doctor::all();
        if ($request->get('keyword') != '') {
            $keyword = $request->input('keyword');
            $result = assessment::where('patients_id', 'like', "%{$keyword}%")->latest()->first();

            // $patientArray = $result->toArray();

            $register = patient_registration::where('id', 'like', "%{$keyword}%")->latest()->first();
            return view('doctor.protocol', compact('result', 'doctors', 'register',));
        } else {
            return view('doctor.protocol');
        }
    }

    public function store(Request $request)
    {


        $validator = Validator::make($request->all(), [
            'doctor_name' => 'required',
            'diagnosis' => 'required',
            'percentage' => 'required',
            'session_no' => 'required',
            'app_date' => 'required',
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }


        $patients_id = $request->patients_id;
        $patient = assessment::find($patients_id);

        $newDrName = $request->input('doctor_name');
        $newSessionNum = $request->input('session_no');
        $newPercentage = $request->input('percentage');
        $newDiagnosis = $request->input('diagnosis');
        $newAppdate = $request->input('app_date');

        // Decode the existing JSON arrays
        $drNames = json_decode($patient->dr_name) ?: [];
        $sessionNums = json_decode($patient->session_num) ?: [];
        $percentages = json_decode($patient->percentage) ?: [];
        $diagnoses = json_decode($patient->diagnosis) ?: [];
        $app_date = json_decode($patient->app_date) ?: [];


        // Append the new values to the arrays
        $drNames[] = $newDrName;
        $sessionNums[] = $newSessionNum;
        $percentages[] = $newPercentage;
        $diagnoses[] = $newDiagnosis;
        $app_date[] = $newAppdate;


        // Encode the arrays back to JSON
        $patient->dr_name = json_encode($drNames);
        $patient->session_num = json_encode($sessionNums);
        $patient->percentage = json_encode($percentages);
        $patient->diagnosis = json_encode($diagnoses);
        $patient->app_date = json_encode($app_date);

        // Save the updated patient record
        $patient->save();

        return redirect()->route('doctor.dashboard')->with('success', 'Patient Protocol updated successfully');
    }
}
