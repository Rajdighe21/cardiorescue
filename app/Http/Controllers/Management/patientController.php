<?php

namespace App\Http\Controllers\Management;

use App\Models\doctor;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\assessment;
use App\Models\patient_list;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\patient_registration;
use Illuminate\Support\Facades\Validator;

class patientController extends Controller
{
    public function patientsList()
    {
        $patient_lists = patient_registration::orderBy('id', 'DESC')->paginate(10);
        $dailyPatients = DB::table('daily_recipts')->get();
        return view('Management.patientsList', compact('patient_lists','dailyPatients'));
    }

    public function registerSrch(Request $request)
    {
        $registerSrch = $request->registerSrch;
        $patient_lists = patient_registration::where('patient_name', 'like', "%$registerSrch%")->paginate(30);
        $dailyPatients = DB::table('daily_recipts')->get();
        return view('Management.patientsList', compact('patient_lists','dailyPatients'));

    }



    public function create()
    {
        $doctors = doctor::orderBy('id', 'DESC')->get();
        return view('Management.createPatient', compact('doctors'));
    }

    public function store(request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'age' => 'required',
            'address' => 'required',
            'app_date' => 'required',
            'session_no' => 'required',
            'doctor_name' => 'required',
            'contact' => 'required',
            'status' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        } else {
            $image = $request->file('image');
            $imageName = $request->name . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('management/patientsImg'), $imageName);

            $patient = new patient_list();
            $patient->name = $request->name;
            $patient->email = $request->email;
            $patient->age = $request->age;
            $patient->address = $request->address;
            $patient->app_date = json_encode($request->app_date); // Ensure this is an array
            $patient->session_no = json_encode($request->session_no); // Ensure this is an array
            $patient->doctor_name = json_encode($request->doctor_name); // Ensure this is an array  percentage
            $patient->percentage = json_encode($request->percentage);
            $patient->contact = $request->contact;
            $patient->image = 'management/patientsImg/' . $imageName; // Save the path to the image
            $patient->status = $request->status;
            $patient->save();


            session()->flash("success", 'Patient Info Added Successfully');
            return redirect()->route('manage.patientsList')->withInput()->withErrors($validator);
        }
    }

    public function EditPatient(Request $request, $id)
    {
        $doctors = doctor::orderBy('id', 'DESC')->get();
        $patientInfo = patient_list::find($id);
        $patientArray = $patientInfo->toArray();
        return view('Management.updatePatient', compact('patientInfo', 'doctors'));
    }


    public function PatientAppointment(Request $request, $id)
    {
        $doctors = doctor::orderBy('id', 'DESC')->get();
        $patientInfo = patient_list::find($id);
        return view('Management.patientAppointment', compact('patientInfo', 'doctors'));
    }

    public function UpdatePatient(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'app_date' => 'required',
            'session_no' => 'required',
            'doctor_name' => 'required',
            'percentage' => 'required',
            'description' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Find the patient by id
        $patient = patient_list::find($id);

        // Set the status attribute from the request input
        $patient->status = $request->input('status');

        // Decode current JSON fields or initialize as empty arrays
        $currentPercentages = json_decode($patient->percentage, true) ?? [];
        $currentAppointments = json_decode($patient->app_date, true) ?? [];
        $currentSessions = json_decode($patient->session_no, true) ?? [];
        $currentDoctors = json_decode($patient->doctor_name, true) ?? [];

        // Add new values to arrays
        $newPercentage = $request->percentage;
        $newAppointment = $request->app_date;
        $newSession = $request->session_no;
        $newDoctors = $request->doctor_name;

        $newPercentagesArray = array_map('trim', explode(',', $newPercentage));
        $newAppointmentsArray = array_map('trim', explode(',', $newAppointment));
        $newSessionsArray = array_map('trim', explode(',', $newSession));
        $newDoctorsArray = array_map('trim', explode(',', $newDoctors));

        $currentPercentages = array_merge($currentPercentages, $newPercentagesArray);
        $currentAppointments = array_merge($currentAppointments, $newAppointmentsArray);
        $currentSessions = array_merge($currentSessions, $newSessionsArray);
        $currentDoctors = array_merge($currentDoctors, $newDoctorsArray);

        // Encode updated arrays back to JSON
        $updatedPercentages = json_encode($currentPercentages);
        $updatedAppointments = json_encode($currentAppointments);
        $updatedSessions = json_encode($currentSessions);
        $updatedDoctors = json_encode($currentDoctors);

        // Prepare the update data array
        $updateData = [
            'app_date' => $updatedAppointments,
            'session_no' => $updatedSessions,
            'doctor_name' => $updatedDoctors,
            'percentage' => $updatedPercentages,
            'description' => $request->description,
        ];

        // Update the patient record with new data
        $patient->update($updateData);

        // Flash success message and redirect
        session()->flash("success", 'Patient Info Updated Successfully');
        return redirect()->back()->withInput();
    }


    public function ClickPatients()
    {
        $patient_lists = assessment::orderBy('id', 'DESC')->paginate(30);
        return view('Management.clickPatients', compact('patient_lists'));
    }

    public function SearchPatients(Request $request)
    {
        $search = $request->searchKey;
        $patient_lists = assessment::where('name', 'like', "%$search%")->paginate(30);
        return view('Management.clickPatients', compact('patient_lists', 'search'));
    }

    public function viewPdf($id)
    {
        $lastRecord = assessment::findOrFail($id);
        $pdf = PDF::loadView('pdf.assessment', ['lastRecord' => $lastRecord]);
        return $pdf->stream($lastRecord->patient_name . '-invoice.pdf');
    }

    public function bookApp()
    {
        $patient_lists = patient_registration::orderBy('id', 'DESC')->paginate(30);
        return view('Management.patientAppointment', compact('patient_lists'));
    }
}
