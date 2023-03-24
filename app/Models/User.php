<?php

namespace App\Models;

use Orchid\Attachment\Attachable;
use Orchid\Platform\Models\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use hasApiTokens, HasFactory, Notifiable, Attachable;

    protected $guarded = [];

    protected $allowedFilters = [
        'name',
        'email',
        'phone_number',
        'specialty',
        'gender'
    ];

    protected $allowedSorts = [
        'created_at',
        'updated_at'
    ];


    protected $hidden = [
        'password',
        'permissions',
    ];


    protected $casts = [
        'permissions' => 'array',
    ];

    public function getFirstNameAttribute()
    {
        return explode(' ', $this->name)[0];
    }

    public function patients()
    {
        return $this->hasMany(Patient::class, 'created_by', 'id');
    }

    public function histories()
    {
        return $this->hasManyThrough(History::class, Patient::class, 'created_by', 'patient_id', 'id', 'id');
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function treatments()
    {
        return $this->hasMany(Treatment::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }

    public function detections()
    {
        return $this->hasMany(Detection::class);
    }

}
