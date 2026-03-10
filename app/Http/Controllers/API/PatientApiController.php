<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Services\PatientService;
use Illuminate\Http\Request;

class PatientApIcontroller extends Controller{
    protected $patientService;
    public function __construct(PatientService $patientService)
    {
        $this->patientService = $patientService;
    }

    // Get api/doctors
    public function getDoctors()
    {
        $doctors = $this->patientService->getAllDoctors();
        return response()->json([
            'status' => 'success',
            'doctors' => $doctors
        ]);
    }


    // GET /api/appointments
    public function myAppointments()
    {
        $appointments = $this->patientService->getPatientAppointments();
        return response()->json(['status' => 'success', 'data' => $appointments]);
    }

    //Post api/appointments
    public function bookAppointment(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:users,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required',   
            'reason' => 'required|string|max:255',
        ]);
        $appointment = $this->patientService->bookAppointment($request->only([
            'doctor_id', 'appointment_date', 'appointment_time', 'reason'
        ]));
        if (!$appointment){
            return response()->json([
                'status' => 'error',
                'message' => 'This slot is either in the past or already booked.'
            ], 409);    
            
        }
        return response()->json([
            'status' => 'success',
            'message' => 'Appointment booked successfully!',
            'appointment' => $appointment
        ], 201);
    }
    // GET /api/booked-slots/{doctor}/{date}
    public function bookedSlots($doctor, $date)
    {
        $slots = $this->patientService->getBookedTimeSlots($doctor, $date);
        return response()->json(['status' => 'success', 'data' => $slots]);
    }
}