<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;
use Illuminate\Support\Facades\Auth;

class DoctorController extends Controller
{
    // Dashboard view
    public function dashboard()
    {
        $doctorId = Auth::id();

        $appointments = Appointment::where('doctor_id', $doctorId)
            ->with('patient')
            ->orderBy('appointment_date', 'desc')
            ->get();

        $totalAppointments = $appointments->count();
        $upcomingAppointments = $appointments->where('status', 'pending')->count();
        $completedAppointments = $appointments->where('status', 'completed')->count();
        $cancelledAppointments = $appointments->where('status', 'cancelled')->count();

        return view('doctor.dashboard', compact(
            'appointments',
            'totalAppointments',
            'upcomingAppointments',
            'completedAppointments',
            'cancelledAppointments'
        ));
    }

    // View a single appointment
    public function showAppointment($id)
    {
        $appointment = Appointment::with('patient')->findOrFail($id);

        // Ensure this appointment belongs to the logged-in doctor
        if ($appointment->doctor_id != Auth::id()) {
            abort(403, 'Unauthorized');
        }

        return view('doctor.appointment-view', compact('appointment'));
    }

    // Mark appointment as completed
    public function completeAppointment($id)
    {
        $appointment = Appointment::findOrFail($id);

        if ($appointment->doctor_id != Auth::id()) {
            abort(403, 'Unauthorized');
        }

        $appointment->status = 'completed';
        $appointment->save();

        return redirect()->back()->with('success', 'Appointment marked as completed.');
    }
}