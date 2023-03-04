<?php

declare(strict_types=1);

use App\Orchid\Screens\Detector\DetectorScreen;
use App\Orchid\Screens\Examples\ExampleCardsScreen;
use App\Orchid\Screens\Examples\ExampleChartsScreen;
use App\Orchid\Screens\Examples\ExampleFieldsAdvancedScreen;
use App\Orchid\Screens\Examples\ExampleFieldsScreen;
use App\Orchid\Screens\Examples\ExampleLayoutsScreen;
use App\Orchid\Screens\Examples\ExampleScreen;
use App\Orchid\Screens\Examples\ExampleTextEditorsScreen;
use App\Orchid\Screens\Patient\PatientCreateScreen;
use App\Orchid\Screens\Patient\PatientEditScreen;
use App\Orchid\Screens\Patient\PatientListScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

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

// Platform > System > Patients > Create
Route::screen('patients/create', PatientCreateScreen::class)
->name('platform.system.patients.create')
->breadcrumbs(function (Trail $trail) {
    return $trail
        ->parent('platform.system.patients')
        ->push(__('Create Patient'), route('platform.system.patients.create'));
});

// Platform > System > Patients > Patient > Edit
Route::screen('patients/{patient}/edit', PatientEditScreen::class)
    ->name('platform.system.patient.edit')
    ->breadcrumbs(function (Trail $trail, $patinet) {
        return $trail
            ->parent('platform.system.patients')
            ->push(__('Edit Patient'), route('platform.system.patient.edit', $patinet));
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
