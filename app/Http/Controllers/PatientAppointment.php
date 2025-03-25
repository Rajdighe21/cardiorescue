<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patients_Appointment;
use App\Mail\CardioRescueMail;
use Illuminate\Support\Facades\Mail;

class PatientAppointment extends Controller
{
    public function store(Request $request)
    {
        $storeData = new Patients_Appointment();
        $storeData->name = $request->name;
        $storeData->email = $request->email;
        $storeData->phone = $request->phone;
        $storeData->pincode = $request->pincode;
        $storeData->issue = $request->issue;
        $storeData->save();


        $mailData = [
            'title' => 'Patient Query',
            'patient' => $storeData
        ];

        Mail::to('krinamota92@gmail.com')->send(new CardioRescueMail($mailData));
        session()->flash('success', 'Your request has been sent!');
        return redirect()->back();
    }
}
