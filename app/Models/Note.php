<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Note extends Model
{
    use HasFactory, AsSource;

    protected $guarded = [];

    protected $allowedFilters = [
        'patient_id',
        'body'
    ];

    protected $allowedSorts = [
        'created_at',
        'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
