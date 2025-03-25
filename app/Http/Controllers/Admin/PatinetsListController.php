<?php

namespace App\Http\Controllers\Admin;

use App\Models\condition;
use Illuminate\Http\Request;
use App\Models\basic_information;
use App\Http\Controllers\Controller;

class PatinetsListController extends Controller
{
    public function index()
    {
        $patientsLists = basic_information::latest()->paginate(10);
        $conditions = condition::all();
        return view('admin.dashboard.patientsList', compact('patientsLists','conditions'));
    }
}
