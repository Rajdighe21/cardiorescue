<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class patient_registration extends Model
{
    use HasFactory;


    protected $table = 'patient_registrations';
    protected $fillable = ['patient_name', 'patient_image'];
}
