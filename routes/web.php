<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Services\PatientService;
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

Route::middleware(['auth.doctor'])          // ← was ['auth'], now ['auth.doctor']
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

        // 1️⃣ Dashboard showing all doctors
        Route::get('/dashboard', [PatientController::class, 'dashboard'])
            ->name('dashboard');

        // 2️⃣ Doctor booking form page (click "Book Now")
        Route::get('/book/{doctor}', [PatientController::class, 'doctorBookingForm'])
            ->name('doctor.book');

        // 3️⃣ Store appointment
        Route::post('/book', [PatientController::class, 'store'])
            ->name('book.store');

        // 4️⃣ AJAX route to get booked slots for a doctor on a specific date
        Route::get('/booked-slots/{doctor}/{date}', function($doctor, $date, PatientService $service) {
            return response()->json($service->getBookedTimeSlots($doctor, $date));
        })->name('booked.slots');
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