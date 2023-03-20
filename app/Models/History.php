<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use App\Models\patient;

class History extends Model
{
    use HasFactory, AsSource;

    protected $guarded = [];

    protected $touches = ['patient'];

    protected $allowedFilters = [
        'properties',
        'patient'
    ];

    protected $allowedSorts = [
        'created_at',
        'updated_at'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
