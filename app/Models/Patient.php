<?php

namespace App\Models;

use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Orchid\Screen\AsSource;
use App\Models\History;

class Patient extends Model
{
    use HasFactory, UUID, AsSource;

    protected $guarded = [];

    protected $allowedFilters = [
        'name',
        'updated_at',
        'created_at'
    ];

    protected $allowedSorts = [
        'name',
        'updated_at',
        'created_at'
    ];

    public function getHistoryAttribute(): string
    {
        return $this->history->properties;
    }

    public function history()
    {
        return $this->hasOne(History::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function treatments()
    {
        return $this->hasMany(Treatment::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function doctor()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function detections()
    {
        return $this->hasMany(Detection::class);
    }
}
