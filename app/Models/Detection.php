<?php

namespace App\Models;

use Orchid\Screen\AsSource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Detection extends Model
{
    use HasFactory, AsSource;

    protected $guarded = [];

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
