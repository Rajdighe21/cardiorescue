<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SessionPlanning extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['patient_id', 'date', 'day', 'month', 'status', 'description', 'frequency','time'];

    public function patient()
    {
        return $this->belongsTo(patient_registration::class, 'patient_id');
    }

    protected $dates = ['deleted_at'];

}
