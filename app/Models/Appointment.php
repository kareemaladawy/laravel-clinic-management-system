<?php

namespace App\Models;

use Orchid\Screen\AsSource;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    use HasFactory, AsSource;

    protected $guarded = [];

    protected $allowedFilters = [
        'date',
        'time',
        'completed',
        'created_at',
        'updated_at'
    ];

    protected $allowedSorts = [
        'date',
        'time',
        'completed',
        'created_at',
        'updated_at'
    ];

    public function scopePending($query)
    {
        return $query->where('completed', 0);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }

}
