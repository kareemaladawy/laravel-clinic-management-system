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

    protected $fillable = [
        'name',
        'email',
        'password',
        'permissions',
    ];


    protected $hidden = [
        'password',
        'permissions',
    ];


    protected $casts = [
        'permissions' => 'array',
    ];


    protected $allowedFilters = [
        'id',
        'name',
        'email',
        'permissions',
    ];

    protected $allowedSorts = [
        'id',
        'name',
        'email',
        'updated_at',
        'created_at',
    ];
}
