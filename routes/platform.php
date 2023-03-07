<?php

declare(strict_types=1);

use App\Models\Detection;
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



// Detections

// Platform > System > Detections
Route::screen('detections', DetectionListScreen::class)
->name('platform.system.detections')
->breadcrumbs(function (Trail $trail) {
    return $trail
        ->parent('platform.index')
        ->push(__('Detections'), route('platform.system.detections'));
});

// Platform > System > Patients > Patient
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

// Platform > System > Histories >History
Route::screen('histories/create/{history?}',HistoryEditScreen::class)
->name('platform.system.history')
->breadcrumbs(function (Trail $trail) {
    return $trail
        ->parent('platform.system.histories')
        ->push(__('Create'), route('platform.system.history'));
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
