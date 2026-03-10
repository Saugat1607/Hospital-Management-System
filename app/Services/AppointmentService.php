<?php

namespace App\Services;

use App\Models\Appointment;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class AppointmentService
{
    // =========================
    // Get Doctor Dashboard Data
    // =========================
    public function getDoctorDashboard($doctorId)
    {
        try {

            return Cache::remember("doctor_dashboard_{$doctorId}", 300, function () use ($doctorId) {

                $appointments = Appointment::with('patient')
                    ->where('doctor_id', $doctorId)
                    ->orderBy('appointment_date', 'desc')
                    ->paginate(10);

                $stats = Appointment::selectRaw("
                    COUNT(*) as total,
                    SUM(status = 'pending') as pending,
                    SUM(status = 'completed') as completed,
                    SUM(status = 'cancelled') as cancelled
                ")
                ->where('doctor_id', $doctorId)
                ->first();

                return [
                    'appointments' => $appointments,
                    'totalAppointments' => $stats->total ?? 0,
                    'upcomingAppointments' => $stats->pending ?? 0,
                    'completedAppointments' => $stats->completed ?? 0,
                    'cancelledAppointments' => $stats->cancelled ?? 0,
                ];
            });

        } catch (\Exception $e) {

            Log::critical('Doctor dashboard service failed', [
                'doctor_id' => $doctorId,
                'error' => $e->getMessage()
            ]);

            throw $e;
        }
    }


    // =========================
    // Get Single Appointment
    // =========================
    public function getDoctorAppointment($doctorId, $appointmentId)
    {
        return Appointment::with('patient')
            ->where('doctor_id', $doctorId)
            ->findOrFail($appointmentId);
    }


    // =========================
    // Complete Appointment
    // =========================
    public function completeAppointment($appointment)
    {
        if ($appointment->status !== 'pending') {
            throw new \Exception('Only pending appointments can be completed.');
        }

        $appointment->update([
            'status' => 'completed'
        ]);

        // Clear dashboard cache
        Cache::forget("doctor_dashboard_" . $appointment->doctor_id);

        return true;
    }
}