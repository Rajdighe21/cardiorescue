<?php

namespace App\Http\Controllers\Admin;

use App\Models\basic_information;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        $data = [];
        $PatietsCounts = basic_information::all()->count();
        $data['PatietsCounts'] = $PatietsCounts;
        return view('admin.dashboard.index',$data);
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
