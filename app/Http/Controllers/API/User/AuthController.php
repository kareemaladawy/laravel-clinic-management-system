<?php

namespace App\Http\Controllers\API\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Orchid\Support\Facades\Dashboard;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;


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

        $token = $user->createToken('Token of ' . $user->name)->plainTextToken;
        return response()->success(['user' => $user, 'token' => $token], 'user created.', 201);
   }

   public function login(LoginUserRequest $request)
   {
        if (Auth::attempt($request->only(['email', 'password']))) {
            auth()->user()->tokens()->delete();
            $token = auth()->user()->createToken('Token of ' . auth()->user()->name)->plainTextToken;
            return response()->success(['user' => auth()->user(), 'token' => $token], 'logged in.', 200);
        }
        return response()->error('invalid credentials.', 401);
   }

   public function logout(Request $request)
   {
       $request->user()->currentAccessToken()->delete();
       return response()->loggedOut();
   }
}
