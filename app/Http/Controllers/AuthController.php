<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Orchid\Support\Facades\Dashboard;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    private const ALLOWEDPERMESSIONS = [
        'platform.index',
        'platform.system.roles',
        'platform.system.patients',
        'platform.system.detections',
        'platform.system.histories',
        'platform.system.treatments',
        'platform.system.notes',
        'platform.system.detector',
        'platform.system.appointments'
    ];

    public function register(StoreUserRequest $request)
    {
         $permessions = collect(Dashboard::getAllowAllPermission())->map(function ($item, $key) {
             return in_array($key, self::ALLOWEDPERMESSIONS, true) ? 1 : 0;
         });

         $user = User::create([
             'name' => $request->name,
             'email' => $request->email,
             'password' => Hash::make($request->password),
             'permissions' => $permessions
         ]);

         Auth::login($user);
         return redirect('/admin');
    }
}
