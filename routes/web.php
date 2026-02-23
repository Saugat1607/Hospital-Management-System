<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;

/*
|--------------------------------------------------------------------------
| Landing Page
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Redirect After Login
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->get('/dashboard', function () {

    return match (Auth::user()->role) {
        'admin'   => redirect()->route('admin.dashboard'),
        'doctor'  => redirect()->route('doctor.dashboard'),
        'patient' => redirect()->route('patient.dashboard'),
        default   => redirect('/'),
    };

})->name('dashboard');


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminController::class,'dashboard'])
            ->name('dashboard');

        Route::get('/doctors', [AdminController::class,'doctorsList'])
            ->name('doctors');

        Route::get('/doctors/{id}/appointments', [AdminController::class,'doctorAppointments'])
            ->name('doctor.appointments');

        Route::get('/patients', [AdminController::class,'patientsList'])
            ->name('patients');
    });


/*
|--------------------------------------------------------------------------
| DOCTOR ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])
    ->prefix('doctor')
    ->name('doctor.')
    ->group(function () {

        Route::get('/dashboard', [DoctorController::class,'dashboard'])
            ->name('dashboard');

        Route::get('/appointments/{id}', [DoctorController::class,'showAppointment'])
            ->name('appointment.view');

        Route::patch('/appointments/{id}/complete', [DoctorController::class,'completeAppointment'])
            ->name('appointment.complete');
    });


/*
|--------------------------------------------------------------------------
| PATIENT ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])
    ->prefix('patient')
    ->name('patient.')
    ->group(function () {

        Route::get('/dashboard', [PatientController::class,'dashboard'])
            ->name('dashboard');

        Route::get('/book', [PatientController::class,'create'])
            ->name('book');

        Route::post('/book', [PatientController::class,'store'])
            ->name('book.store');
    });
/*
|--------------------------------------------------------------------------
| PROFILE ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [App\Http\Controllers\ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [App\Http\Controllers\ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [App\Http\Controllers\ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

require __DIR__.'/auth.php';