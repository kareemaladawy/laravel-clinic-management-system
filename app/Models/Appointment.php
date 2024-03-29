<?php

namespace App\Models;

use Orchid\Screen\AsSource;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    use HasFactory, AsSource;

    protected $guarded = [];

    protected $touches = ['patient'];

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

    public function scopeUpcoming($query)
    {
        return $query->whereDate('date', '>=', Carbon::now()->toDateString());
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
