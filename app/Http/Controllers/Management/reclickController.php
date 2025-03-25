<?php

namespace App\Http\Controllers\Management;

use App\Models\doctor;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\reclick_patient;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\patient_registration;
use Illuminate\Support\Facades\Validator;

class reclickController extends Controller
{
    public function index()
    {
        $reclick_patients = reclick_patient::latest()->paginate(10);
        return view('Management.listReclick', compact('reclick_patients'));
    }

    public function create()
    {
        $doctors = doctor::orderBy('id', 'DESC')->get();
        return view('Management.addReclick', compact('doctors'));
    }

    public function patientSrch(Request $request)
    {
        $patientSrch = $request->patientSrch;

        if (!empty($patientSrch)) {
            $doctors = doctor::orderBy('id', 'DESC')->get();
            $patientInfo = patient_registration::where('id', 'like', "%$patientSrch%")->latest()->first();
            return view('Management.addReclick', compact('patientInfo', 'doctors'));
        } else {
            $doctors = doctor::orderBy('id', 'DESC')->get();
            $patientInfo = patient_registration::find(0);
            return view('Management.addReclick', compact('doctors'));
        }
    }



    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'first_payment' => 'required',
            'registration_date' => 'required',
            'manual_session' => 'required',
            'cost_manual_session' => 'required',
            'robotics' => 'required',
            'cost_robotics' => 'required',

            // Radio Buttons
            'assessment' => 'required',
            'muscle_test' => 'required',
            'ms' => 'required',
            'us' => 'required',
            'ayurvedic' => 'required',
            'harness' => 'required',

            'cost_assessment' => 'required',
            'cost_muscle_test' => 'required',
            'cost_ms' => 'required',
            'cost_us' => 'required',
            'cost_ayurvedic' => 'required',
            'cost_harness' => 'required',
            'total_cost' => 'required',
            'package_price' => 'required',
            'given_discount' => 'required',

        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $reclick = new reclick_patient();
            $reclick->patients_name = $request->patients_name;
            $reclick->patient_id = $request->patient_id;
            $reclick->email = $request->email;
            $reclick->age = $request->age;
            $reclick->contact = $request->contact;
            $reclick->first_payment = $request->first_payment;
            $reclick->registration_date = $request->registration_date;
            $reclick->gender = $request->gender;
            $reclick->medicine_list = $request->medicine_list;
            $reclick->describe_problem = $request->describe_problem;
            $reclick->address = $request->address;
            $reclick->status = $request->status;
            $reclick->manual_session = $request->manual_session;
            $reclick->cost_manual_session = $request->cost_manual_session;
            $reclick->robotics = $request->robotics;
            $reclick->cost_robotics = $request->cost_robotics;
            $reclick->assessment = $request->assessment;
            $reclick->cost_assessment = $request->cost_assessment;
            $reclick->muscle_test = $request->muscle_test;
            $reclick->cost_muscle_test = $request->cost_muscle_test;
            $reclick->ms = $request->ms;
            $reclick->cost_ms = $request->cost_ms;
            $reclick->us = $request->us;
            $reclick->cost_us = $request->cost_us;
            $reclick->ayurvedic = $request->ayurvedic;
            $reclick->cost_ayurvedic = $request->cost_ayurvedic;
            $reclick->harness = $request->harness;
            $reclick->cost_harness = $request->cost_harness;
            $reclick->total_cost = $request->total_cost;
            $reclick->package_price = $request->package_price;
            $reclick->given_discount = $request->given_discount;
            $reclick->save();

            return redirect()->route('reclick.index')->with('success', 'Data Added Successfully');
        }
    }


    public function reReceipt($id)
    {
        $lastRecord = DB::table('reclick_patients')->where('patient_id', $id)->latest()->first();
        $pdf = PDF::loadView('pdf.reclick_receipt', ['lastRecord' => $lastRecord]);
        return $pdf->stream($lastRecord->patients_name . 'Receipt.pdf');
    }

    public function reInvoice($id)
    {
        $lastRecord = DB::table('reclick_patients')->where('patient_id', $id)->latest()->first();
        $pdf = PDF::loadView('pdf.reclick_invoice', ['lastRecord' => $lastRecord]);
        return $pdf->stream($lastRecord->patients_name . 'Receipt.pdf');
    }

    public function patientListSrch(Request $request)
    {
        $registerListSrch = $request->registerListSrch;
        $reclick_patients  = reclick_patient::where('patients_name', 'like', "%$registerListSrch%")->paginate(30);
        return view('Management.listReclick', compact('reclick_patients'));
    }
}
