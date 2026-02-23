<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Appointment;

class DoctorDashboardController extends Controller
{
    /**
     * Show the doctor dashboard with appointments.
     */
    public function index()
    {
        $doctorId = Auth::id();

        // Get appointments for this doctor, most recent first
        $appointments = Appointment::with('patient')
            ->where('doctor_id', $doctorId)
            ->orderBy('appointment_date', 'desc')
            ->get();

        return view('doctor.dashboard', compact('appointments'));
    }
}
