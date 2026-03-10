<?php

namespace App\Services;

use App\Models\User;
use App\Models\Appointment;

class AdminService {
    //Dashboard data
    public function getDashboardData() {
        return [
            'totalDoctors' => User::where('role', 'doctor')->count(),
            'totalPatients' => User::where('role', 'patient')->count(),
            'totalAppointments' => Appointment::count(),
            'pendingAppointments' => Appointment::where('status', 'pending')->count(),
            'latestAppointments' => Appointment::with(['doctor', 'patient'])
                ->latest()
                ->take(5)
                ->get(),
        ];
    }

    //get all doctors witj appointment count
    public function getDoctors() {
        return User::where('role', 'doctor')
            ->withCount('appointments')
            ->get();
    }

    //get appointmets of a specific doctor
    public function getDoctorAppointments($doctorId) {


        $doctor = User::where('role', 'doctor')->findOrFail($doctorId);

        return Appointment::where('doctor_id', $doctorId)
            ->with('patient')
            ->latest()
            ->get();

        return [
            'doctor' => $doctor,
            'appointments' => $appointments
        ];
    }

    // get all patients with appointment count
    public function getPatients() {
        return User::where('role', 'patient')
            ->withCount('appointments')
            ->get();
    }
}