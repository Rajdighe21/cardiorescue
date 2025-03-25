<?php

namespace App\Http\Controllers\Doctor;

use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\patient_registration;
use Illuminate\Support\Facades\Validator;

class PatientRegistrationController extends Controller
{

    public function register()
    {
        $lastRecord = DB::table('patient_registrations')->latest()->first();
        $lastValue = $lastRecord->id;
        return view('doctor.newRegister', compact('lastValue'));
    }


    public function updateRegister(Request $request, $id)
    {
        $lastValue = patient_registration::findOrFail($id);
        return view('doctor.UpdateRegister', compact('lastValue'));
    }

    public function registerUpdate(Request $request, $id)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'session_numbers' => 'required',
            'cost_of_session' => 'required',
            'number_of_robotics' => 'required',
            'cost_of_robotic' => 'required',
            'assessment' => 'required',
            'cost_of_assessment' => 'required',
            'machine_test' => 'required',
            'cost_machine_test' => 'required',
            'ms' => 'required',
            'cost_of_ms' => 'required',
            'us' => 'required',
            'cost_of_us' => 'required',
            'cost_ayurvedic' => 'required',
            'harness' => 'required',
            'harness_cost' => 'required',
            'total_amt' => 'required',
            'package_price' => 'required',
            'discount_amt' => 'required',
            'ayurvedic' => 'required',
            'payment_amt'=>'required',

        ]);


        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $registration = patient_registration::findOrFail($id);
            $registration->patient_name = $request->name;
            $registration->contact = $request->contact;
            $registration->email = $request->email;
            $registration->date_of_birth = $request->age;
            $registration->payment_amt = $request->payment_amt;
            $registration->regi_date = $request->regi_date;
            $registration->gender = $request->gender;
            $registration->get_medicine = $request->get_medicine;
            $registration->describe_problem = $request->describe_problem;
            $registration->address = $request->address;
            $registration->status = $request->status;
            $registration->authname = implode(',', $request->authname);
            $registration->session_numbers = $request->session_numbers;
            $registration->cost_of_session = $request->cost_of_session;
            $registration->number_of_robotics = $request->number_of_robotics;
            $registration->cost_of_robotic = $request->cost_of_robotic;
            $registration->assessment = $request->assessment;
            $registration->cost_of_assessment = $request->cost_of_assessment;
            $registration->machine_test = $request->machine_test;
            $registration->cost_machine_test = $request->cost_machine_test;
            $registration->ms = $request->ms;
            $registration->cost_of_ms = $request->cost_of_ms;
            $registration->us = $request->us;
            $registration->cost_of_us = $request->cost_of_us;
            $registration->cost_ayurvedic = $request->cost_ayurvedic;
            $registration->harness = $request->harness;
            $registration->harness_cost = $request->harness_cost;
            $registration->total_amt = $request->total_amt;
            $registration->package_price = $request->package_price;
            $registration->discount_amt = $request->discount_amt;
            $registration->ayurvedic = $request->ayurvedic;
            $registration->save();

            return redirect()->route('manage.patientsList')->with('success', 'Patient Registered Updated Successfully');
        }
    }

    public function recieptForInvice($id)
    {
        $lastRecord = DB::table('patient_registrations')->where('id', $id)->first();
        $pdf = PDF::loadView('pdf.invoice', ['lastRecord' => $lastRecord]);
        return $pdf->stream($lastRecord->patient_name . 'invoice.pdf');
    }

    public function registerStore(Request $request)
    {
        // dd($request->all());
        $rules = [
            'name' => 'required',
            'contact' => 'required',
            'email' => 'required',
            'age' => 'required',
            'payment_amt' => 'required',
            'regi_date' => 'required',
            'gender' => 'required',
            'get_medicine' => 'in:on',
            'describe_problem' => 'required',
            'address' => 'required',
            'status' => 'required',
            'location'=>'required'
        ];

        if (!empty($request->get_medicine) && $request->get_medicine == 'on') {
            $rules['medicine_list'] = 'required';
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $registration = new patient_registration();
            $registration->patient_name = $request->name;
            $registration->contact = $request->contact;
            $registration->email = $request->email;
            $registration->date_of_birth = $request->age;
            $registration->payment_amt = $request->payment_amt;
            $registration->pending_amount = $request->pending_amount;
            $registration->regi_date = $request->regi_date;
            $registration->gender = $request->gender;
            $registration->get_medicine = $request->get_medicine;
            $registration->medicine_list = $request->medicine_list;
            $registration->describe_problem = $request->describe_problem;
            $registration->address = $request->address;
            $registration->status = $request->status;
            $registration->location = implode(',',$request->location);
            $registration->authname = implode(',', $request->authname);
            $registration->save();

            return redirect()->route('manage.patientsList')->with('success', 'Patient Register Successfully');
        }
    }




    public function index()
    {
        $lastRecord = DB::table('patient_registrations')->latest()->first();
        $lastValue = $lastRecord->id;
        return view('doctor.registration', compact('lastValue'));
    }

    // public function store(Request $request)
    // {


    //     $validator = Validator::make($request->all(), [
    //         'patient_name' => 'required',
    //         'gender' => 'required',
    //         'date_of_birth' => 'required',
    //         'contact' => 'required',
    //         'email' => 'required',
    //         'get_medicine' => 'required',
    //         'address' => 'required',
    //         'emg_contact_name' => 'required',
    //         'emg_contact_number' => 'required',
    //         'payment_amt' => 'required',
    //     ]);


    //     if ($validator->passes()) {

    //         if ($request->hasFile('patient_image')) {


    //             $Imagename = time() . "-cardio." . $request->file('patient_image')->getClientOriginalName();
    //             $request->file('patient_image')->storeAs('uploads', $Imagename);
    //             $registration = new patient_registration();
    //             $registration->patient_image = $Imagename;
    //             $registration->patient_name = $request->patient_name;
    //             $registration->regi_date = $request->regi_date;
    //             $registration->gender = $request->gender;
    //             $registration->date_of_birth = $request->date_of_birth;
    //             $registration->height = $request->height;
    //             $registration->weight = $request->weight;
    //             $registration->contact = $request->contact;
    //             $registration->email = $request->email;
    //             $registration->get_medicine = $request->get_medicine;
    //             $registration->medicine_list = $request->medicine_list;
    //             $registration->describe_problem = $request->describe_problem;
    //             $registration->address = $request->address;
    //             $registration->emg_contact_name = $request->emg_contact_name;
    //             $registration->relationship = $request->relationship;
    //             $registration->emg_contact_number = $request->emg_contact_number;
    //             $registration->payment_amt = $request->payment_amt;
    //             $registration->session_numbers = $request->session_numbers;
    //             $registration->cost_of_session = $request->cost_of_session;
    //             $registration->number_of_robotics = $request->number_of_robotics;
    //             $registration->cost_of_robotic = $request->cost_of_robotic;
    //             $registration->assessment = $request->assessment;
    //             $registration->cost_of_assessment = $request->cost_of_assessment;
    //             $registration->machine_test = $request->machine_test;
    //             $registration->cost_machine_test = $request->cost_machine_test;
    //             $registration->ms = $request->ms;
    //             $registration->cost_of_ms = $request->cost_of_ms;
    //             $registration->us = $request->us;
    //             $registration->cost_of_us = $request->cost_of_us;
    //             $registration->ayurvedic = $request->ayurvedic;
    //             $registration->cost_ayurvedic = $request->cost_ayurvedic;
    //             $registration->harness = $request->harness;
    //             $registration->harness_cost = $request->harness_cost;
    //             $registration->total_amt = $request->total_amt;
    //             $registration->discount_amt = $request->discount_amt;
    //             $registration->grand_total = $request->grand_total;
    //             $registration->paid_amt = $request->paid_amt;
    //             $registration->balance = $request->balance;
    //             $registration->save();

    //             return redirect()->route('patients.registration')->with('success', 'Patient Register Successfully');
    //         } else {

    //             $registration = new patient_registration();
    //             $registration->patient_image = $request->patient_image;
    //             $registration->patient_name = $request->patient_name;
    //             $registration->regi_date = $request->regi_date;
    //             $registration->gender = $request->gender;
    //             $registration->date_of_birth = $request->date_of_birth;
    //             $registration->height = $request->height;
    //             $registration->weight = $request->weight;
    //             $registration->contact = $request->contact;
    //             $registration->email = $request->email;
    //             $registration->get_medicine = $request->get_medicine;
    //             $registration->medicine_list = $request->medicine_list;
    //             $registration->describe_problem = $request->describe_problem;
    //             $registration->address = $request->address;
    //             $registration->emg_contact_name = $request->emg_contact_name;
    //             $registration->relationship = $request->relationship;
    //             $registration->emg_contact_number = $request->emg_contact_number;
    //             $registration->payment_amt = $request->payment_amt;
    //             $registration->session_numbers = $request->session_numbers;
    //             $registration->cost_of_session = $request->cost_of_session;
    //             $registration->number_of_robotics = $request->number_of_robotics;
    //             $registration->cost_of_robotic = $request->cost_of_robotic;
    //             $registration->assessment = $request->assessment;
    //             $registration->cost_of_assessment = $request->cost_of_assessment;
    //             $registration->machine_test = $request->machine_test;
    //             $registration->cost_machine_test = $request->cost_machine_test;
    //             $registration->ms = $request->ms;
    //             $registration->cost_of_ms = $request->cost_of_ms;
    //             $registration->us = $request->us;
    //             $registration->cost_of_us = $request->cost_of_us;
    //             $registration->ayurvedic = $request->ayurvedic;
    //             $registration->cost_ayurvedic = $request->cost_ayurvedic;
    //             $registration->harness = $request->harness;
    //             $registration->harness_cost = $request->harness_cost;
    //             $registration->total_amt = $request->total_amt;
    //             $registration->discount_amt = $request->discount_amt;
    //             $registration->grand_total = $request->grand_total;
    //             $registration->paid_amt = $request->paid_amt;
    //             $registration->balance = $request->balance;
    //             $registration->save();

    //             return redirect()->route('patients.registration')->with('success', 'Patient Register Successfully');
    //         }
    //     } else {

    //         return response()->json([
    //             'status' => false,
    //             'error' => $validator->errors(),
    //         ]);
    //     }
    // }


    public function downloadPdf($id)
    {
        $lastRecord = DB::table('patient_registrations')->where('id', $id)->first();
        $pdf = PDF::loadView('pdf.receipt', ['lastRecord' => $lastRecord]);
        return $pdf->stream($lastRecord->patient_name . 'Receipt.pdf');
    }


    public function edit(Request $request, $id)
    {
        $lastValue = patient_registration::findOrFail($id);
        return view('doctor.EditRegistration', compact('lastValue'));
    }



    // Search Function
    public function appointmentSrch(Request $request)
    {
        // dd($request->all());
        $appointmentSrch = $request->appointmentSrch;
        $patient_lists = patient_registration::where('patient_name', 'like', "%$appointmentSrch%")->paginate(30);
        return view('Management.patientAppointment', compact('patient_lists'));
    }
}
