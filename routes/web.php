<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::view('/', 'index');
Route::view('/register', 'register');

Route::post('/register', [AuthController::class, 'register'])->name('register');
