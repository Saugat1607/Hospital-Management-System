<?php

namespace App\Http\Controllers;

use App\Services\DoctorService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class DoctorController extends Controller
{
    protected $doctorService;

    public function __construct(DoctorService $doctorService)
    {
        $this->doctorService = $doctorService;
    }

    // Doctor Dashboard
    public function dashboard()
    {
        try {
            $doctor = Auth::guard('doctor')->user(); // ← use doctor guard
            $data = $this->doctorService->getDashboardData($doctor->id);
            return view('doctor.dashboard', $data);
        } catch (\Exception $e) {
            Log::critical('Failed to load doctor dashboard', [
                'error' => $e->getMessage()
            ]);
            abort(500, 'Unable to load dashboard.');
        }
    }

    // View Single Appointment
    public function showAppointment($id)
    {
        try {
            $doctor = Auth::guard('doctor')->user(); // ← use doctor guard
            $appointment = $this->doctorService->getAppointment($doctor->id, $id);
            return response()->json([
                'status' => 'success',
                'appointment' => $appointment
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to load appointment', [
                'error' => $e->getMessage()
            ]);
            return response()->json([
                'status'  => 'error',
                'message' => 'Unable to load appointment.'
            ], 500);
        }
    }

    // Complete Appointment
    public function completeAppointment($id)
    {
        try {
            $doctor = Auth::guard('doctor')->user(); // ← use doctor guard
            $this->doctorService->completeAppointment($doctor->id, $id);
            return response()->json([
                'status'  => 'success',
                'message' => 'Appointment marked as completed.'
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to complete appointment', [
                'error' => $e->getMessage()
            ]);
            return response()->json([
                'status'  => 'error',
                'message' => 'Failed to complete appointment.'
            ], 500);
        }
    }
}