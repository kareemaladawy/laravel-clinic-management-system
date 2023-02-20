<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detection extends Model
{
    use HasFactory;

    protected $fillable = [
        'patient_id',
        'doctor_id',
        'disease',
        'state',
        'notes',
        'prescription'
    ];

    protected $allowedFilters = [
        'patient_id',
        'doctor_id',
        'disease',
        'state',
        'notes',
        'prescription'
    ];

    protected $allowedSorts = [
        'created_at',
        'updated_at'
    ];
}
