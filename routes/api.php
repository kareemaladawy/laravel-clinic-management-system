<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\note\NoteController;
use App\Http\Controllers\Patient\PatientController;
use App\Http\Controllers\detection\DetectionController;
use App\Http\Controllers\treatment\TreatmentController;
use App\Http\Controllers\appointment\AppointmentController;


//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/login', [AuthController::class, 'login'])->name('login');


Route::group(['middleware'=>['auth:sanctum']], static function(){

Route::post('/logout', [AuthController::class,'logout']);

Route::get('patients', [PatientController::class, 'index'])
->name('patients.read');

Route ::get('patients/{patient}', [patientController::class, 'show'])
->name('patient.show');

// Route ::post('patients', [patientController::class, 'store'])
// ->name('patient.store');

// Route ::patch('patients/{patient}', [patientController::class, 'update'])
// ->name('patient.update');

// Route ::delete('patients/{patient}', [patientController::class, 'distroy'])
// ->name('patient.delete');

//-------------------------Detection-----------------------

Route::get('detections', [DetectionController::class, 'index'])
->name('detections.read');

// Route ::post('detection/{detection}/update', [DetectionController::class, 'update'])
// ->name('detection.update');

//------------------------Treatment---------------------

Route::get('treatments', [TreatmentController::class, 'index'])
->name('treatments.read');

Route ::post('treatments', [TreatmentController::class, 'store'])
->name('treatment.store');

Route ::post('treatments/{treatment}', [TreatmentController::class, 'update'])
->name('treatment.update');

Route ::delete('treatments/{treatment}', [TreatmentController::class, 'distroy'])
->name('treatment.delete');

//-------------------------Appointment-------------------------

Route::get('appointments', [AppointmentController::class, 'index'])
->name('appointments.read');

Route ::post('appointments', [AppointmentController::class, 'store'])
->name('appointment.store');

Route ::post('appointments/{appointment}', [AppointmentController::class, 'update'])
->name('appointment.update');

Route ::delete('appointments/{appointment}', [AppointmentController::class, 'distroy'])
->name('appointment.delete');

//-------------------------Notes-------------------------

Route::get('notes', [NoteController::class, 'index'])
->name('notes.read');

Route ::post('notes', [NoteController::class, 'store'])
->name('note.store');

Route ::post('notes/{note}', [NoteController::class, 'update'])
->name('note.update');

Route ::delete('notes/{note}', [NoteController::class, 'distroy'])
->name('note.delete');

});




