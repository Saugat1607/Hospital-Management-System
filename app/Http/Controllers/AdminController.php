<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Appointment;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Admin Dashboard
     */
    public function dashboard()
    {
        $totalDoctors = User::where('role', 'doctor')->count();
        $totalPatients = User::where('role', 'patient')->count();
        $totalAppointments = Appointment::count();
        $pendingAppointments = Appointment::where('status', 'pending')->count();

        $latestAppointments = Appointment::with(['doctor', 'patient'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalDoctors',
            'totalPatients',
            'totalAppointments',
            'pendingAppointments',
            'latestAppointments'
        ));
    }

    /**
     * Doctors Grid Dashboard
     */
    public function doctorsList()
    {
        $doctors = User::where('role', 'doctor')
            ->withCount('appointments')
            ->get();

        return view('admin.doctors_dashboard', compact('doctors'));
    }

    /**
     * Appointments of a specific doctor
     */
    public function doctorAppointments($id)
    {
        $doctor = User::where('role', 'doctor')->findOrFail($id);

        $appointments = Appointment::where('doctor_id', $id)
            ->with('patient')
            ->latest()
            ->get();

        return view('admin.doctor_appointments', compact('doctor', 'appointments'));
    }

    /**
     * Patients List
     */
    public function patientsList()
    {
        $patients = User::where('role', 'patient')
            ->withCount('appointments')
            ->get();    
            return view('admin.patients_dashboard', compact('patients'));   
    }
    
}