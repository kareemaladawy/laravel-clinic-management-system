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

    protected $gurded = [];

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

    public function patients()
    {
        return $this->hasMany(Patient::class, 'created_by', 'user_id');
    }

}
