<?php

namespace App\Http\Controllers;

use App\Models\basic_information;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class Users_information extends Controller
{

    public function index(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'patientname' => 'required',
            'patientphone' => 'required',
            'patientemail' => 'required',

        ]);

        if ($validate->passes()) {

            $basic_info = new basic_information();
            $basic_info->patientname = $request->patientname;
            $basic_info->patientphone = $request->patientphone;
            $basic_info->patientemail = $request->patientemail;
            $basic_info->save();

            return redirect()->route('view')->with('basic_info', $basic_info);


        }
    }


    public function store(Request $request)
    {

        // dd($request->all());
        $rules = [
            // 'patientname' => 'required',
            // 'patientphone' => 'required',
            // 'patientemail' => 'required',
            'patientage' => 'required',
            'patientweight' => 'required',
            'patientgender' => 'required',
            'PatientSuffering' => 'required',
            'whichsidesuffering' => 'required',
            'SufferingDuration' => 'required'
        ];

        $validate = $request->validate($rules);

        $data = [
            'patientname' => $request->patientname,
            'patientphone' => $request->patientphone,
            'patientemail' => $request->patientemail,
            'patientage' => $request->patientage,
            'patientweight' => $request->patientweight,
            'sufferingFrom' => $request->sufferingFrom,
            'whichsidesuffering' => $request->whichsidesuffering,
            'SufferingDuration' => $request->SufferingDuration,
            'areaaffected' => json_encode($request->areaaffected),
            'hand_finger' => $request->hand_finger,
            'walking_condition' => $request->walking_condition,
            'condition' => $request->condition,
            'elebow_condition' => $request->elebow_condition,
            'shoulder_condition' => $request->shoulder_condition,
            'PatientGoalMobility' => $request->PatientGoalMobility,
            'HealthQuality' => $request->HealthQuality,
            'below_suffering' => $request->below_suffering,
            'currentDate' => now(),
        ];

        // $user['to'] = 'krinamota92@gmail.com';

        // Mail::send('mailTheme', $data, function ($messages) use ($user) {
        //     $messages->to($user['to']);
        //     $messages->subject('Quick Health Test');
        // });


        $user_info = new \App\Models\Users_information();
        $user_info->patientname = $request->patientname;
        $user_info->patientphone = $request->patientphone;
        $user_info->patientemail = $request->patientemail;
        $user_info->patientage = $request->patientage;
        $user_info->patientweight = $request->patientweight;
        $user_info->patientgender = $request->patientgender;
        $user_info->PatientSuffering = $request->sufferingFrom;
        $user_info->whichsidesuffering = $request->whichsidesuffering;
        $user_info->areaaffected = json_encode($request->areaaffected);
        $user_info->hand_finger = $request->hand_finger;
        $user_info->walking_condition = $request->walking_condition;
        $user_info->condition = $request->condition;
        $user_info->elebow_condition = $request->elebow_condition;
        $user_info->shoulder_condition = $request->shoulder_condition;
        $user_info->SufferingDuration = $request->SufferingDuration;
        $user_info->PatientGoalMobility = $request->PatientGoalMobility;
        $user_info->HealthQuality = $request->HealthQuality;
        $user_info->patient_stressed = $request->patient_stressed;
        $user_info->VitaminDeficiency = $request->VitaminDeficiency;
        $user_info->below_suffering = $request->below_suffering;
        $user_info->sleep_time = $request->sleep_time;
        $user_info->save();





        return redirect()->route('booking')->with('user_info', $user_info);


    }






}
