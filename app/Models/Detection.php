<?php

namespace App\Models;

use Orchid\Screen\AsSource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Detection extends Model
{
    use HasFactory, AsSource;

    protected $guarded = [];

    protected $touches = ['patient'];

    protected $allowedFilters = [
        'patient_id',
        'doctor_id',
        'disease',
        'state',
        'type',
        'comments'
    ];

    protected $allowedSorts = [
        'created_at',
        'updated_at'
    ];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
