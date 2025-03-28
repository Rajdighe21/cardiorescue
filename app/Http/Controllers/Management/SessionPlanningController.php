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
        $patientLists = patient_registration::latest()->paginate(10);

        $WeekSessions = SessionPlanning::orderBy('date', 'asc')
            ->with('patient')
            ->select('patient_id', 'date', 'day')
            ->get();

        // dd($WeekSessions);

        $years = $WeekSessions->map(function ($session) {
            return \Carbon\Carbon::parse($session->date)->year;
        })->unique()->sort()->values();

        return view('Management.planningIndex', compact('patientLists', 'WeekSessions', 'years'));
    }

    public function filterPlanning(Request $request)
    {

        $query = SessionPlanning::with('patient')->orderBy('date', 'asc');
        if ($request->year) {
            $query->whereYear('date', $request->year);
        }
        if ($request->month) {
            $monthNumber = \Carbon\Carbon::parse($request->month)->month;
            $query->whereMonth('date', $monthNumber);
        }

        $WeekSessions = $query->get();
        return view('Management.planningPartialsTable', compact('WeekSessions'))->render();
    }

    public function assign($id)
    {
        $patientDetails = patient_registration::find($id);
        $sessions = SessionPlanning::where('patient_id', $id)->select('id', 'description', 'date', 'time')->get();
        return view('Management.planningCalender', compact('patientDetails', 'sessions'));
    }
    public function storePlanning(Request $request)
    {
        // dd($request->all());

        $request->validate([
            'patient_id' => 'required|exists:patient_registrations,id',
            'date' => 'required|date',
            'day' => 'required|string',
            'month' => 'required|string',
            'status' => 'required|string',
            'description' => 'nullable|string',
            'frequency' => 'required|in:once,twice',
            'appointmentTime' => 'required'
        ]);

        SessionPlanning::create([
            'patient_id' => $request->patient_id,
            'date' => $request->date,
            'day' => $request->day,
            'month' => $request->month,
            'status' => $request->status,
            'description' => $request->description,
            'frequency' => $request->frequency,
            'time' => $request->appointmentTime,
        ]);

        return redirect()->back()->with('success', 'Appointment set successfully!');
    }

    public function deletePlanning($id)
    {
        // dd($id);
        $appointment = SessionPlanning::findOrFail($id);
        $appointment->delete(); // This performs a soft delete
        return response()->json(['success' => true]);
    }
}
