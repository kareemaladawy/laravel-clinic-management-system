<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone_number',
        'gender',
        'birthday',
        'location',
        'medical_info'
    ];

    protected $allowedFilters = [
        'id',
        'name',
        'email',
        'gender',
        'location',
        'medical_info',
        'permissions'
    ];

    protected $allowedSorts = [
        'updated_at',
        'created_at'
    ];
}
