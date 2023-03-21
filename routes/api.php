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
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    // login
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::middleware(['auth:sanctum'])->group(function(){
        // logout
        Route::post('/logout', [AuthController::class,'logout'])->name('logout');
        // patients
        Route::apiResource('patients', PatientController::class)->only(['index', 'show']);
        // appointments
        Route::apiResource('appointments', AppointmentController::class)->only(['index', 'show']);
        // treatments
        Route::apiResource('treatments', TreatmentController::class);

    });
});


// //-------------------------Detection-----------------------

// Route::get('detections', [DetectionController::class, 'index'])
// ->name('detections.read');

// // Route ::post('detection/{detection}/update', [DetectionController::class, 'update'])
// // ->name('detection.update');

//------------------------Treatment---------------------

// Route::get('treatments', [TreatmentController::class, 'index'])
// ->name('treatments.read');

// Route ::post('treatments', [TreatmentController::class, 'store'])
// ->name('treatment.store');

// Route ::post('treatments/{treatment}', [TreatmentController::class, 'update'])
// ->name('treatment.update');

// Route ::delete('treatments/{treatment}', [TreatmentController::class, 'distroy'])
// ->name('treatment.delete');


//-------------------------Notes-------------------------

// Route::get('notes', [NoteController::class, 'index'])
// ->name('notes.read');

// Route ::post('notes', [NoteController::class, 'store'])
// ->name('note.store');

// Route ::post('notes/{note}', [NoteController::class, 'update'])
// ->name('note.update');

// Route ::delete('notes/{note}', [NoteController::class, 'distroy'])
// ->name('note.delete');
