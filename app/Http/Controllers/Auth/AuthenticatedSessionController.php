<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

    public function store(LoginRequest $request): RedirectResponse
    {
        // 1️⃣ Try Doctor login first (separate doctors table)
        $doctor = \App\Models\Doctor::where('email', $request->email)->first();
        if ($doctor && Hash::check($request->password, $doctor->password)) {
            Auth::guard('doctor')->login($doctor);
            $request->session()->regenerate();
            return redirect()->route('doctor.dashboard');
        }

        // 2️⃣ Try Patient / Admin login (users table)
        if (Auth::guard('web')->attempt(
            $request->only('email', 'password'),
            $request->boolean('remember')
        )) {
            $request->session()->regenerate();

            return match(Auth::user()->role) {
                'admin'  => redirect()->route('admin.dashboard'),
                default  => redirect()->route('patient.dashboard'),
            };
        }

        // 3️⃣ Failed
        return back()->withErrors([
            'email' => 'These credentials do not match our records.',
        ])->onlyInput('email');
    }

    public function destroy(Request $request): RedirectResponse
    {
        // Logout whichever guard is active
        if (Auth::guard('doctor')->check()) {
            Auth::guard('doctor')->logout();
        } else {
            Auth::guard('web')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}