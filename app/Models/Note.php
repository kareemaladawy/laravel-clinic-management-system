<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $gurded = [];

    protected $allowedFilters = [
        'patient_id',
        'body'
    ];

    protected $allowedSorts = [
        'created_at',
        'updated_at'
    ];
}
