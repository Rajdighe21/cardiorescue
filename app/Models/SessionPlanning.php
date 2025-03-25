<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SessionPlanning extends Model
{
    use HasFactory;

    protected $fillable = ['patient_id','date', 'day', 'month', 'description', 'frequency'];

}
