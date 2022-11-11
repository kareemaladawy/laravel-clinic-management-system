<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\HttpResponses;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\LoginUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    use HttpResponses;

    public function login(LoginUserRequest $request)
    {
        $request->validated();
        if (!Auth::attempt($request->only(['email', 'password']))) {

            return response()->json([
                'message' => 'Credentials do not match'
            ], 401);
        }
        $user=User::where('email',$request->email,)->first();

        $user->tokens()->delete();
    
        return response()->json([
            'user' => $user,
            'token' => $user->createToken('Api Token of ' . $user->name)->plainTextToken
        ], 200);
    }

    public function register(StoreUserRequest $request)
    {
        $request->validated();
        $user=User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
        ]);
        
        return response()->json([
            'user' => $user,
            'token' => $user->createToken('Token of ' . $user->name)->plainTextToken
        ], 200);
       
    }

    public function logout()
    {
        Auth::user()->currentAccessToken()->delete();
        return response()->json([
            'message' => 'Logged out.'
        ], 200);
    }
}

