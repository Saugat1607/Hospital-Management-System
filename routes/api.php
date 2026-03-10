<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\PatientApiController;

Route::prefix('patient')->group(function () {
    Route::get('/doctors', [PatientApiController::class, 'getDoctors']); // List all doctors
    Route::get('/appointments', [PatientApiController::class, 'myAppointments']); // List my appointments
    Route::post('/appointments', [PatientApiController::class, 'bookAppointment']); // Book a new appointment
    Route::get('/booked-slots/{doctor}/{date}', [PatientApiController::class, 'bookedSlots']); // Check booked slots
});