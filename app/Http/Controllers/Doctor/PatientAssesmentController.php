<?php

namespace App\Http\Controllers\Doctor;

use App\Models\doctor;
use App\Models\assessment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\patient_registration;
use Illuminate\Support\Facades\Validator;

class PatientAssesmentController extends Controller
{
    public  function assesment($id)
    {
        $patient_detail = patient_registration::where('id', $id)->get();
        $doctors = Doctor::all();
        return view('doctor.assesment', compact('patient_detail', 'doctors'));
    }

    public function search(Request $request)
    {

        $search = $request->search;
        $patient_detail = patient_registration::where('id', 'like', "%$search%")->get();
        $doctors = doctor::all();
        return view('doctor.assesment', compact('patient_detail', 'search', 'doctors'));
    }
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [

            'dr_name' => 'required|array',

            'session_num' => 'required|array',

            'percentage' => 'required|array',

            'diagnosis' => 'required|array',

            'app_date' => 'required|array',

            'current_status' => 'required',
            'surgical_history' => 'required',
            'medical_history' => 'required',
            'cervical_flexion' => 'required',
            'cervical_extension' => 'required',
            'cervical_sideFlexion' => 'required',
            'cervical_rotation' => 'required',
            'shoulder_side' => 'required|array|min:1',
            'shoulder_flexion' => 'required',
            'shoulder_extension' => 'required',
            'shoulder_adduction' => 'required',
            'shoulder_abduction' => 'required',
            'elbow_side' => 'required||array|min:1',
            'elbow_flexion' => 'required|',
            'elbow_extension' => 'required',
            'wrist_side' => 'required|array|min:1',
            'wrist_flexion' => 'required',
            'wrist_extension' => 'required',
            'ulnar_deviation' => 'required',
            'radial_deviation' => 'required',
            'hip_side' => 'required|array|min:1',
            'hip_flexion' => 'required',
            'hip_extension' => 'required',
            'hip_adduction' => 'required',
            'hip_abduction' => 'required',
            'knee_side' => 'required|array|min:1',
            'knee_flexion' => 'required',
            'knee_extension' => 'required',
            'ankle_side' => 'required|array|min:1',
            'dorsiflexion' => 'required',
            'plantarflexion' => 'required',
            'mmt' => 'required',
            'met' => 'required',
            'rt_upper_limb' => 'required',
            'lt_upper_limb' => 'required',
            'rt_lower_limb' => 'required',
            'lt_lower_limb' => 'required',
            'bisceps_reflexes' => 'required ',
            'triceps_reflex' => 'required ',
            'brachioradialis_reflexes' => 'required ',
            'knee_reflexes' => 'required ',
            'ankle_reflexes' => 'required ',
            'plantar_reflexes' => 'required ',
            'balence_reflexes' => 'required',
            'special_test' => 'required',
            'pain_muscle_tone' => 'required',
            'touch_muscle_tone' => 'required',
            'temp_muscle_tone' => 'required',
            'two_point_discrimination' => 'required',
            'baragnosis_muscle_tone' => 'required',
            'stregnosis_muscle_tone' => 'required',
            'gait' => 'required',
            'limb' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withInput()->withErrors($validator);
        } else {

            $dr_name = $request->input('dr_name');
            $session_num = $request->input('session_num');
            $percentage = $request->input('percentage');
            $diagnosis = $request->input('diagnosis');
            $app_date = $request->input('app_date');

            $assessment = new assessment();

            $assessment->dr_name = json_encode($dr_name);
            $assessment->session_num = json_encode($session_num);
            $assessment->percentage = json_encode($percentage);
            $assessment->diagnosis = json_encode($diagnosis);
            $assessment->app_date = json_encode($app_date);

            $assessment->patients_id = $request->patients_id;
            $assessment->name = $request->name;
            $assessment->age = $request->age;
            $assessment->gender = $request->gender;
            $assessment->current_status = $request->current_status;
            $assessment->surgical_history = $request->surgical_history;
            $assessment->medical_history = $request->medical_history;
            // $assessment->posture = implode(',', $posture);
            // $assessment->range_of_motion = implode(',', $range_of_motion);
            $assessment->cervical_flexion = $request->cervical_flexion;
            $assessment->cervical_extension = $request->cervical_extension;
            $assessment->cervical_sideFlexion = $request->cervical_sideFlexion;
            $assessment->cervical_rotation = $request->cervical_rotation;
            $assessment->shoulder_side = implode(',', $request->shoulder_side);
            $assessment->shoulder_flexion = $request->shoulder_flexion;
            $assessment->shoulder_extension = $request->shoulder_extension;
            $assessment->shoulder_adduction = $request->shoulder_adduction;
            $assessment->shoulder_abduction = $request->shoulder_abduction;
            $assessment->elbow_side = implode(',', $request->elbow_side);
            $assessment->elbow_flexion = $request->elbow_flexion;
            $assessment->elbow_extension = $request->elbow_extension;
            $assessment->wrist_side = implode(',', $request->wrist_side);
            $assessment->wrist_flexion = $request->wrist_flexion;
            $assessment->wrist_extension = $request->wrist_extension;
            $assessment->ulnar_deviation = $request->ulnar_deviation;
            $assessment->radial_deviation = $request->radial_deviation;
            $assessment->hip_side = implode(',', $request->hip_side);
            $assessment->hip_flexion = $request->hip_flexion;
            $assessment->hip_extension = $request->hip_extension;
            $assessment->hip_adduction = $request->hip_adduction;
            $assessment->hip_abduction = $request->hip_abduction;
            $assessment->knee_side = implode(',', $request->knee_side);
            $assessment->knee_flexion = $request->knee_flexion;
            $assessment->knee_extension = $request->knee_extension;
            $assessment->ankle_side = implode(',', $request->ankle_side);
            $assessment->dorsiflexion = $request->dorsiflexion;
            $assessment->plantarflexion = $request->plantarflexion;
            $assessment->mmt = $request->mmt;
            $assessment->met = $request->met;
            $assessment->rt_upper_limb = $request->rt_upper_limb;
            $assessment->lt_upper_limb = $request->lt_upper_limb;
            $assessment->rt_lower_limb = $request->rt_lower_limb;
            $assessment->lt_lower_limb = $request->lt_lower_limb;
            $assessment->bisceps_reflexes = $request->bisceps_reflexes;
            $assessment->triceps_reflex = $request->triceps_reflex;
            $assessment->brachioradialis_reflexes = $request->brachioradialis_reflexes;
            $assessment->knee_reflexes = $request->knee_reflexes;
            $assessment->ankle_reflexes = $request->ankle_reflexes;
            $assessment->plantar_reflexes = $request->plantar_reflexes;
            $assessment->balence_reflexes = $request->balence_reflexes;
            $assessment->special_test = $request->special_test;
            $assessment->pain_muscle_tone = $request->pain_muscle_tone;
            $assessment->touch_muscle_tone = $request->touch_muscle_tone;
            $assessment->temp_muscle_tone = $request->temp_muscle_tone;
            $assessment->two_point_discrimination = $request->two_point_discrimination;
            $assessment->baragnosis_muscle_tone = $request->baragnosis_muscle_tone;
            $assessment->stregnosis_muscle_tone = $request->stregnosis_muscle_tone;
            $assessment->gait = $request->gait;
            $assessment->limb = $request->limb;

            // $assessment->investigation = implode(',', $investigation);
            // $assessment->mri = implode(',', $mri);
            // $assessment->x_ray = implode(',', $x_ray);

            $assessment->save();

            return redirect()->route('doctor.dashboard')->with('success', 'Assessment Details Added Successfully');
        }
    }
}
