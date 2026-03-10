<?php 


namespace App\Http\Controllers;
use App\Services\AdminService;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    protected $adminService;

    public function __construct(AdminService $adminService)
    {
        $this->adminService = $adminService;
    }

    // Admin Dashboard
    public function dashboard()
    {
        try {
            $data = $this->adminService->getDashboardData();
            return view('admin.dashboard', $data);

        } catch (\Exception $e) {
            Log::critical('Failed to load admin dashboard', [
                'error' => $e->getMessage()
            ]);

            abort(500, 'Unable to load dashboard.');
        }
    }

    // Doctors Grid Dashboard
   public function doctorsList()
{
    try {
        $doctors = \App\Models\Doctor::with('category')->get();
        return view('admin.doctors', compact('doctors')); // ← was admin.doctors.dashboard
    } catch (\Exception $e) {
        Log::critical('Failed to load doctors list', [
            'error' => $e->getMessage()
        ]);
        abort(500, 'Unable to load doctors list.');
    }
}

    // Doctor's Appointments
    public function doctorAppointments($id)
    {
        try {
            $data = $this->adminService->getDoctorAppointments($id);
            return view('admin.doctor_appointments', $data);

        } catch (\Exception $e) {
            Log::critical('Failed to load doctor appointments', [
                'doctor_id' => $id,
                'error' => $e->getMessage()
            ]);
            abort(500, 'Unable to load doctor appointments.');
        }
    }

    // Patients list
    public function patientsList()
    {
        try {
            $patients = $this->adminService->getPatients();
            return view('admin.patients_dashboard', compact('patients'));

        } catch (\Exception $e) {
            Log::critical('Failed to load patients list', [
                'error' => $e->getMessage()
            ]);
            abort(500, 'Unable to load patients list.');
        }
    }
}