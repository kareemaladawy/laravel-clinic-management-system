<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');


Route::group(['middleware'=>['auth:sanctum']], static function(){
    Route::post('/logout', [AuthController::class,'logout']);//protected
});
