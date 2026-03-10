<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PatientService;

class PatientController extends Controller
{
    protected $patientService;

    public function __construct(PatientService $patientService)
    {
        $this->patientService = $patientService;
    }

    // 1️⃣ Patient Dashboard: List of doctors + patient appointments
    public function dashboard()
    {
         $categories   = $this->patientService->getAllCategories();
        $doctors = $this->patientService->getAllDoctors();
        $appointments = $this->patientService->getPatientAppointments();

        return view('patient.dashboard', compact('categories', 'doctors', 'appointments'));
    }

    // 2️⃣ Doctor Booking Page: Show doctor profile + booking form + patient's appointments
    public function doctorBookingForm($id)
    {
        $doctor = $this->patientService->getDoctor($id);
        $appointments = $this->patientService->getPatientAppointments();

        return view('patient.doctor_booking', compact('doctor', 'appointments'));
    }

    // 3️⃣ Store Appointment
    public function store(Request $request)
    {
        $request->validate([
            'doctor_id' => 'required|exists:doctors,id',
            'appointment_date' => 'required|date|after_or_equal:today',
            'appointment_time' => 'required',
            'reason' => 'required|string|max:255',
        ]);

        $appointment = $this->patientService->bookAppointment($request->only([
            'doctor_id', 'appointment_date', 'appointment_time', 'reason'
        ]));

        if (!$appointment) {
            return redirect()->back()->with('error', 'This slot is either in the past or already booked.');
        }

        return redirect()->route('patient.doctor.book', $request->doctor_id)
                         ->with('success', 'Appointment booked successfully!');
    }

    // 4️⃣ AJAX: Get booked slots for a doctor on a given date
    public function getBookedSlots($doctorId, $date)
    {
        $slots = $this->patientService->getBookedTimeSlots($doctorId, $date);
        return response()->json($slots);
    }
}