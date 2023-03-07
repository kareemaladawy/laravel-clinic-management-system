<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;

class Treatment extends Model
{
    use HasFactory, AsSource;

    protected $guarded = [];

    protected $touches = ['patient'];

    public function patient()
    {
        return $this->belongsTo(Patient::class);
    }
}
