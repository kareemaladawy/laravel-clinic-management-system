<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;

    protected $gurded = [];

    protected $allowedFilters = [
        'properties',
    ];

    protected $allowedSorts = [
        'created_at',
        'updated_at'
    ];
}
