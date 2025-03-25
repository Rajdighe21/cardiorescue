<?php

namespace App\Http\Controllers\Admin;

use App\Models\notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\consultations;

class ConsultationController extends Controller
{
    public function index($id)
    {

        $data = notification::where('id', $id)->first();
        $decodeted = json_decode($data->data);
        $sessionStart = Consultations::where('patient_id', $decodeted->patient_id)->first();
        return view('doctor.consultation', compact('data', 'sessionStart'));
    }


    public function startSession(Request $request)
    {
        $validation =  $request->validate([
            'session_start' => 'required',
            'patient_id' => 'required'

        ]);

        $data = new consultations();
        $data->session_start = $request->session_start;
        $data->patient_id = $request->patient_id;
        $data->save();
        return redirect()->back()->with('success', 'Session Time is started');
    }

    public function endSession(Request $request)
    {

        $validation = $request->validate([
            'session_end' => 'required',
        ]);
        $data = consultations::where('patient_id', $request->patient_id)->first();
        if (!$data) {
            return redirect()->back()->with('error', 'Start Session / No consultation record found for this patient.');
        }
        $data->session_end = $request->session_end;
        $data->save();
        return redirect()->back()->with('success', 'Session Ended successfully.');
    }

    public function storeConsultation(Request $request)
    {
        $validator = $request->validate([
            'diagnosis' => 'required',
            'percentage' => 'required',
            'treatment_protocol' => 'required',
            'after_treatment_protocol' => 'required',
        ]);

        $data = consultations::where('patient_id', $request->patient_id)->first();
        if (!$data) {
            return redirect()->back()->with('error', 'No Record Found');
        }
        $data->name = $request->name;
        $data->diagnosis = $request->diagnosis;
        $data->percentage = $request->percentage;
        $data->treatment_protocol = $request->treatment_protocol;
        $data->after_treatment_protocol = $request->after_treatment_protocol;
        $data->prevideo = $request->prevideo;
        $data->postvideo = $request->postvideo;
        $data->save();
        return redirect()->route('doctor.dashboard')->with('success', 'Consultations Completed !');
    }
}
