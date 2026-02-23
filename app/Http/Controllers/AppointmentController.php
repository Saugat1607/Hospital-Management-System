<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    // Show a single appointment to the doctor
    public function show($id)
    {
        $appointment = Appointment::with('patient', 'doctor')->findOrFail($id);
        return view('doctor.appointment-view', compact('appointment'));
    }

    // Mark appointment as complete
    public function complete($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->status = 'completed';
        $appointment->save();

        return redirect()->back()->with('success', 'Appointment marked as completed!');
    }
}
