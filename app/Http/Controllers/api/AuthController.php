<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Orchid\Support\Facades\Dashboard;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;


class AuthController extends Controller
{
    use HttpResponses;

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

   public function login(LoginUserRequest $request): JsonResponse
   {
       $request->validated();

       if (!Auth::attempt($request->only(['email', 'password']))) {
           return response()->json([
               'message' => 'Credentials do not match'
           ], 401);
       }
       $user=User::where('email',$request->email)
           ->first();

       $user->tokens()->delete();

       return response()->json([
           'user' => $user,
           'token' => $user->createToken('Api Token of ' . $user->name)->plainTextToken
       ], 200);
   }

   public function register(StoreUserRequest $request): \Illuminate\Http\JsonResponse
   {
       $request->validated();

       $user = User::create([
           'name' => $request->name,
           'email' => $request->email,
           'password' => Hash::make($request->password),
           'permissions' => collect(Dashboard::getAllowAllPermission())->map(function ($item, $key) {
               return in_array($key, self::allowedPermissions, true) ? 1 : 0;
           }),
       ]);

       return response()->json([
           'user' => $user,
           'token' => $user->createToken('Token of ' . $user->name)->plainTextToken
       ], 200);
   }

   public function logout(Request $request): \Illuminate\Http\JsonResponse
   {
       $request->user()->currentAccessToken()->delete();
       return response()->json([
           'message' => 'Logged out.'
       ], 200);
   }
}
