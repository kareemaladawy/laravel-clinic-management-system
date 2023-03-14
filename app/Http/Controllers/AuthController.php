<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Orchid\Support\Facades\Dashboard;

class AuthController extends Controller
{
    private const allowedPermissions = [
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

    public function register(Request $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'permissions' => collect(Dashboard::getAllowAllPermission())->map(function ($item, $key) {
                return in_array($key, self::allowedPermissions, true) ? 1 : 0;
            }),
        ]);

      return redirect('/admin/login');
    }
}
