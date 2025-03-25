<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendances';

    protected $fillable = [
        'employee_code',
        'log_date',
        'device_name',
        'serial_number',
        'direction',
        'device_direction',
        'work_code',
        'verification_type',
        'gps'
    ];
}
