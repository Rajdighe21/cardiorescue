<?php

namespace App\Http\Controllers\Management;

use App\Models\consent;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\patient_registration;
use Illuminate\Support\Facades\Validator;


class consentController extends Controller
{
    public function index()
    {
         $patient_lists = patient_registration::whereNotNull('paid_amt')
        ->orderBy('id', 'DESC')
        ->paginate(10);        $dailyPatients = DB::table('daily_recipts')->get();
        $consents = DB::table('consents')->get();
        return view('Management.consent.consent', compact('patient_lists', 'dailyPatients', 'consents'));
    }



    public function consentSrch(Request $request)
    {
        $consentSrch = $request->consentSrch;
        $patient_lists = patient_registration::where('patient_name', 'like', "%$consentSrch%")->paginate(30);
        $dailyPatients = DB::table('daily_recipts')->get();
        $consents = DB::table('consents')->get();
        return view('Management.consent.consent', compact('patient_lists', 'dailyPatients', 'consents'));
    }

    public function addConsent($id)
    {
        $patients = patient_registration::findOrFail($id);
        return view('Management.consent.addConsent', compact('patients'));
    }


    public function storeConsent(Request $request)
    {
        // dd($request->all());

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'age' => 'required',
            'contact' => 'required',
            'address' => 'required',
            'start_date' => 'required',
            'body_part' => 'required',
            'session_in_day' => 'required',
            'gender' => 'required',
            'describe_problem' => 'required',
            'aware_that' => 'required',
            'number_of_session' => 'required',
        ]);


        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        } else {


            $consent = new consent();
            $consent->name = $request->name;
            $consent->patient_id = $request->patient_id;
            $consent->age = $request->age;
            $consent->contact = $request->contact;
            $consent->address = $request->address;
            $consent->start_date = $request->start_date;
            $consent->body_part = $request->body_part;
            $consent->session_in_day = $request->session_in_day;
            $consent->gender = $request->gender;
            $consent->describe_problem = $request->describe_problem;
            $consent->aware_that = $request->aware_that;
            $consent->number_of_session = $request->number_of_session;
            $consent->patient_signature = $request->signature;
            $consent->save();

            return redirect()->route('manage.consent')->with('success', "Consent Added Successfully !");
        }
    }

    public function consentPdf($id) {

        $data = DB::table('consents')->where('patient_id',$id)->latest()->first();
        $pdf = PDF::loadView('pdf.consent', ['data' => $data]);
        return $pdf->stream('document.pdf');

    }
}
