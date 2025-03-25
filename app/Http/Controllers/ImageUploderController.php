<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ImageUploderController extends Controller
{
    public function index(Request $request)
    {
        if (!empty($patient_image)) {
            $ext = $patient_image->getClientOriginalExtension();
            $newName = time() . '.' . $ext;
        }
    }
}
