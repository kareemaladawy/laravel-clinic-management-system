<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detection extends Model
{
    use HasFactory;

    protected $gurded = [];

    protected $allowedFilters = [
        'patient_id',
        'doctor_id',
        'disease',
        'state',
        'type',
        'comment'
    ];

    protected $allowedSorts = [
        'created_at',
        'updated_at'
    ];
}
