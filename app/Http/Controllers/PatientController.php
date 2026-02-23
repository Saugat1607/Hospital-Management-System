<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    // Patient dashboard
    public function dashboard()
    {
        // Get all appointments of the patient
        $appointments = Appointment::where('patient_id', Auth::id())
            ->with('doctor') // eager load doctor
            ->latest()
            ->get();

        // Get all doctors for the dashboard
        $doctors = User::where('role', 'doctor')->get();

        // Pass both variables to the view
        return view('patient.dashboard', compact('appointments', 'doctors'));
    }

    // Show booking form
    public function create()
    {
        $doctors = User::where('role', 'doctor')->get();
        return view('patient.book', compact('doctors'));
    }

    // Store appointment
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'appointment_date' => 'required|date|after:today',
            'reason' => 'required|string|max:255',
        ]);

        Appointment::create([
            'patient_id' => Auth::id(),
            'doctor_id' => $request->doctor_id,
            'appointment_date' => $request->appointment_date,
            'reason' => $request->reason,
        ]); 

        return redirect()
            ->route('patient.dashboard')
            ->with('success', 'Appointment booked successfully!');
    }
}
