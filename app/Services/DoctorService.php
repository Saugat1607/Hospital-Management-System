<?php

namespace App\Services;

use App\Models\Appointment;

class DoctorService
{
    public function getDashboardData($doctorId)
    {
        $appointments = Appointment::where('doctor_id', $doctorId)
            ->with('patient')
            ->latest()
            ->paginate(10);

        // return all needed stats
        return [
            'appointments' => $appointments,
            'totalAppointments' => Appointment::where('doctor_id', $doctorId)->count(),
            'upcomingAppointments' => Appointment::where('doctor_id', $doctorId)
                ->whereDate('appointment_date', '>=', now())
                ->count(),
            'completedAppointments' => Appointment::where('doctor_id', $doctorId)
                ->where('status', 'completed')
                ->count(),
            'pendingAppointments' => Appointment::where('doctor_id', $doctorId)
                ->where('status', 'pending')
                ->count(),
        ];
    }

    public function completeAppointment($doctorId, $appointmentId)
    {
        $appointment = Appointment::where('doctor_id', $doctorId)
            ->where('id', $appointmentId)
            ->firstOrFail();

        $appointment->update([
            'status' => 'completed'
        ]);
    }
}