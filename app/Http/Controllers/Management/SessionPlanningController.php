<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\patient_registration;
use App\Models\SessionPlanning;
use App\Models\User;

class SessionPlanningController extends Controller
{
    public function index()
    {
        $doctorLists = User::where('role', 1)->get();
        $patientLists = patient_registration::latest()->paginate(10);
        return view('Management.planingIndex', compact('patientLists', 'doctorLists'));
    }

    public function assign(Request $request)
    {
        $events = SessionPlanning::all();
        return response()->json($events);
    }
}
