<?php

namespace App\Http\Controllers;

use App\Models\condition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ViewController extends Controller
{
     public function identify(){

      $conditions =  condition::all();

        return view("identify",compact('conditions'));
     }


}
