<?php

namespace App\Services;

use App\Models\Appointment;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;
use Carbon\Carbon;
use App\Models\Doctor;

class PatientService
{
    // Get all appointments of logged-in patient
    public function getPatientAppointments()
    {
        return Appointment::where('patient_id', Auth::id())
            ->with('doctor.category')
            ->orderBy('appointment_date', 'desc')
            ->orderBy('appointment_time', 'desc')
            ->get();
    }

    // Get all doctors
   public function getAllDoctors()
{
    return \App\Models\Doctor::with('category')->get();
}

    //get all categories with doctors
   public function getAllCategories()
{
    return \App\Models\Category::with('doctors')->get();
}
    // Get single doctor
    public function getDoctor($id)
    {
        return Doctor::with('category')->findOrFail($id);
    }



    // Book appointment (SAFE VERSION)
    public function bookAppointment(array $data)
    {
        $appointmentDate = $data['appointment_date'];
        $appointmentTime = $data['appointment_time'];

        $appointmentDateTime = Carbon::parse("$appointmentDate $appointmentTime");

        if ($appointmentDateTime->isPast()) {
            return false;
        }

        try {
            return Appointment::create([
                'patient_id' => Auth::id(),
                'doctor_id' => $data['doctor_id'],
                'appointment_date' => $data['appointment_date'],
                'appointment_time' => $data['appointment_time'],
                'reason' => $data['reason'],
                'status' => 'pending',
            ]);

        } catch (QueryException $e) {
            // Duplicate slot
            if ($e->errorInfo[1] == 1062) return false;
            throw $e;
        }
    }

    // Get booked time slots
    public function getBookedTimeSlots($doctorId, $date)
    {
        return Appointment::where('doctor_id', $doctorId)
            ->where('appointment_date', $date)
            ->pluck('appointment_time')
            ->map(fn ($time) => Carbon::parse($time)->format('H:i'))
            ->toArray();
    }
}