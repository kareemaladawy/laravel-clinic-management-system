<?php

declare(strict_types=1);

use App\Models\Detection;
use App\Models\History;
use App\Models\Note;
use App\Models\Patient;
use App\Models\Treatment;
use Tabuna\Breadcrumbs\Trail;
use Illuminate\Support\Facades\Route;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use App\Orchid\Screens\Detector\DetectorScreen;
use App\Orchid\Screens\History\HistoryEditScreen;
use App\Orchid\Screens\History\HistoryListScreen;
use App\Orchid\Screens\Patient\PatientEditScreen;
use App\Orchid\Screens\Patient\PatientListScreen;
use App\Orchid\Screens\Detection\DetectionListScreen;
use App\Orchid\Screens\Appointment\AppointmentEditScreen;
use App\Orchid\Screens\Appointment\AppointmentListScreen;
use App\Orchid\Screens\History\HistoryShowScreen;
use App\Orchid\Screens\Note\NoteEditScreen;
use App\Orchid\Screens\Note\NoteListScreen;
use App\Orchid\Screens\Note\NoteShowScreen;
use App\Orchid\Screens\Patient\PatientShowScreen;
use App\Orchid\Screens\Treatment\TreatmentEditScreen;
use App\Orchid\Screens\Treatment\TreatmentListScreen;
use App\Orchid\Screens\Treatment\TreatmentShowScreen;

// Main
Route::screen('/main', PlatformScreen::class)
    ->name('platform.main');

// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Profile'), route('platform.profile'));
    });



// Users

// Platform > System > Users
Route::screen('users', UserListScreen::class)
    ->name('platform.system.users')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Users'), route('platform.system.users'));
    });

// Platform > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
    ->name('platform.system.users.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.users')
            ->push(__('Create'), route('platform.system.users.create'));
    });

// Platform > System > Users > User > Edit
Route::screen('users/{user}/edit', UserEditScreen::class)
    ->name('platform.system.user.edit')
    ->breadcrumbs(function (Trail $trail, $user) {
        return $trail
            ->parent('platform.system.users')
            ->push(__('User'), route('platform.system.user.edit', $user));
    });



// Patients

// Platform > System > Patients
Route::screen('patients', PatientListScreen::class)
    ->name('platform.system.patients')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Patients'), route('platform.system.patients'));
    });

// Platform > System > Patients > Patient
Route::screen('patients/create/{patient?}', PatientEditScreen::class)
    ->name('platform.system.patient')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.system.patients')
            ->push(__('Create'), route('platform.system.patient'));
    });

// Platform > System > Patients > Show
Route::screen('patients/{patient}/show', PatientShowScreen::class)
    ->name('platform.system.patient.show')
    ->breadcrumbs(function (Trail $trail, Patient $patient) {
        return $trail
            ->parent('platform.system.patients')
            ->push(__('Show'), route('platform.system.patient.show', $patient));
    });



// Detections

// Platform > System > Detections
Route::screen('detections', DetectionListScreen::class)
->name('platform.system.detections')
->breadcrumbs(function (Trail $trail) {
    return $trail
        ->parent('platform.index')
        ->push(__('Detections'), route('platform.system.detections'));
});

// Platform > System > Detections > Detection
Route::screen('detections/edit/{detection}', DetectionListScreen::class)
->name('platform.system.detection')
->breadcrumbs(function (Trail $trail, Detection $detection) {
    return $trail
        ->parent('platform.system.detections')
        ->push(__('Edit'), route('platform.system.detection'));
});



// Appointments

// Platform > System > Appointments
Route::screen('appointments', AppointmentListScreen::class)
    ->name('platform.system.appointments')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Appointments'), route('platform.system.appointments'));
    });

// Platform > System > Appointments > Appointment
Route::screen('appointments/create/{appointment?}', AppointmentEditScreen::class)
    ->name('platform.system.appointment')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.system.appointments')
            ->push(__('Create'), route('platform.system.appointment'));
    });



// histories

// Platform > System > Histories
Route::screen('histories',HistoryListScreen::class)
->name('platform.system.histories')
->breadcrumbs(function (Trail $trail) {
    return $trail
        ->parent('platform.index')
        ->push(__('Histories'), route('platform.system.histories'));
});

// Platform > System > Histories > History
Route::screen('histories/create/{history?}',HistoryEditScreen::class)
->name('platform.system.history')
->breadcrumbs(function (Trail $trail) {
    return $trail
        ->parent('platform.system.histories')
        ->push(__('Create'), route('platform.system.history'));
});

// Platform > System > Histories > Show
Route::screen('histories/{history}/show', HistoryShowScreen::class)
    ->name('platform.system.history.show')
    ->breadcrumbs(function (Trail $trail, History $history) {
        return $trail
            ->parent('platform.system.histories')
            ->push(__('Show'), route('platform.system.history.show', $history));
    });



// Treatments

// Platform > System > Treatments
Route::screen('treatments', TreatmentListScreen::class)
->name('platform.system.treatments')
->breadcrumbs(function (Trail $trail) {
    return $trail
        ->parent('platform.index')
        ->push(__('Treatments'), route('platform.system.treatments'));
});

// Platform > System > Treatments > Treatment
Route::screen('treatments/create/{treatment?}', TreatmentEditScreen::class)
->name('platform.system.treatment')
->breadcrumbs(function (Trail $trail) {
    return $trail
        ->parent('platform.system.treatments')
        ->push(__('Create'), route('platform.system.treatment'));
});

// Platform > System > Treatments > Show
Route::screen('treatments/{treatment}/show', TreatmentShowScreen::class)
    ->name('platform.system.treatment.show')
    ->breadcrumbs(function (Trail $trail, Treatment $treatment) {
        return $trail
            ->parent('platform.system.treatments')
            ->push(__('Show'), route('platform.system.treatment.show', $treatment));
    });



// Notes

// Platform > System > Notes
Route::screen('notes', NoteListScreen::class)
->name('platform.system.notes')
->breadcrumbs(function (Trail $trail) {
    return $trail
        ->parent('platform.index')
        ->push(__('Notes'), route('platform.system.notes'));
});

// Platform > System > Notes > Note
Route::screen('notes/create/{note?}', NoteEditScreen::class)
->name('platform.system.note')
->breadcrumbs(function (Trail $trail) {
    return $trail
        ->parent('platform.system.notes')
        ->push(__('Create'), route('platform.system.note'));
});

// Platform > System > Notes > Show
Route::screen('notes/{note}/show', NoteShowScreen::class)
    ->name('platform.system.note.show')
    ->breadcrumbs(function (Trail $trail, Note $note) {
        return $trail
            ->parent('platform.system.notes')
            ->push(__('Show'), route('platform.system.note.show', $note));
    });



// Roles

// Platform > System > Roles > Role
Route::screen('roles/{role}/edit', RoleEditScreen::class)
    ->name('platform.system.roles.edit')
    ->breadcrumbs(function (Trail $trail, $role) {
        return $trail
            ->parent('platform.system.roles')
            ->push(__('Role'), route('platform.system.roles.edit', $role));
    });

// Platform > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.system.roles.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.system.roles')
            ->push(__('Create'), route('platform.system.roles.create'));
    });

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.system.roles')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Roles'), route('platform.system.roles'));
    });


// Detector
Route::screen('detector', DetectorScreen::class)
    ->name('platform.system.detector')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Detector'), route('platform.system.detector'));
    });
