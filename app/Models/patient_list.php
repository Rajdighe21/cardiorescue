<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class patient_list extends Model
{
    use HasFactory;

    protected $table = "patient_lists";


    protected $fillable = [
        'name',
        'email',
        'age',
        'address',
        'app_date',
        'session_no',
        'doctor_name',
        'contact',
        'image',
        'status',
        'percentage'
    ];
}
