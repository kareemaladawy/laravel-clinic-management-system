<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\User\AuthController;
use App\Http\Controllers\API\User\NoteController;
use App\Http\Controllers\API\User\PatientController;
use App\Http\Controllers\API\User\DetectionController;
use App\Http\Controllers\API\User\TreatmentController;
use App\Http\Controllers\API\User\AppointmentController;


// Doctor actions
Route::name('doctor.')->group(function() {
    // register
    Route::post('register', [AuthController::class, 'register'])->name('register');
    // login
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::middleware(['auth:sanctum'])->group(function(){
        // logout
        Route::post('logout', [AuthController::class,'logout'])->name('logout');
        // patients
        Route::get('patients/search/{search}', [PatientController::class, 'search'])
            ->name('search-patients');
        Route::apiResource('patients', PatientController::class)->only(['index', 'show']);
        // treatments
        Route::apiResource('treatments', TreatmentController::class)->only(['index', 'show']);
        // appointments
        Route::apiResource('appointments', AppointmentController::class)->except('show');
        Route::get('appointments/upcoming', [AppointmentController::class, 'upcoming']);
        // notes
        Route::apiResource('notes', NoteController::class);
    });
});


// //-------------------------Detection-----------------------

// Route::get('detections', [DetectionController::class, 'index'])
// ->name('detections.read');

// // Route ::post('detection/{detection}/update', [DetectionController::class, 'update'])
// // ->name('detection.update');
