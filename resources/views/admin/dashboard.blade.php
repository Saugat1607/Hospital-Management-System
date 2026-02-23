@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100">

    <!-- Top Navigation -->
    <div class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold text-gray-800 tracking-wide">
                🏥 Hospital Admin Dashboard
            </h1>

            <div class="flex items-center gap-6">
                <span class="text-gray-600 font-medium">
                    Welcome, {{ auth()->user()->name }}
                </span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="px-3 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-6 py-8">

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

            <!-- Doctors -->
            <a href="{{ route('admin.doctors') }}" 
               class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition duration-300 border-l-4 border-blue-500 block cursor-pointer">
                <p class="text-gray-500 text-sm">Total Doctors</p>
                <h2 class="text-4xl font-bold text-gray-800 mt-2">{{ $totalDoctors }}</h2>
                <p class="text-blue-500 text-sm mt-1">View Doctors</p>
            </a>

            <!-- Patients -->
            <a href="{{ route('admin.patients') }}" 
               class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition duration-300 border-l-4 border-green-500 block cursor-pointer">
                <p class="text-gray-500 text-sm">Total Patients</p>
                <h2 class="text-4xl font-bold text-gray-800 mt-2">{{ $totalPatients }}</h2>
                <p class="text-green-500 text-sm mt-1">View Patients</p>
            </a>

            <!-- Appointments -->
            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition duration-300 border-l-4 border-purple-500">
                <p class="text-gray-500 text-sm">Total Appointments</p>
                <h2 class="text-4xl font-bold text-gray-800 mt-2">{{ $totalAppointments }}</h2>
            </div>

            <!-- Pending -->
            <div class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition duration-300 border-l-4 border-yellow-500">
                <p class="text-gray-500 text-sm">Pending Appointments</p>
                <h2 class="text-4xl font-bold text-gray-800 mt-2">{{ $pendingAppointments }}</h2>
            </div>

        </div>

        <!-- Recent Appointments -->
        <div class="mt-10 bg-white rounded-xl shadow-md p-6">
            <h2 class="text-lg font-semibold text-gray-700 mb-6 border-b pb-3">Recent Appointments</h2>

            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 text-gray-600 text-sm uppercase tracking-wider">
                            <th class="p-4">Patient</th>
                            <th class="p-4">Doctor</th>
                            <th class="p-4">Reason</th>
                            <th class="p-4">Date</th>
                            <th class="p-4">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($latestAppointments as $appointment)
                        <tr class="border-b hover:bg-gray-50 transition">
                            <td class="p-4 font-medium text-gray-800">{{ $appointment->patient->name }}</td>
                            <td class="p-4 text-gray-600">{{ $appointment->doctor->name }}</td>
                            <td class="p-4 text-gray-600">{{ $appointment->reason ?? 'General Checkup' }}</td>
                            <td class="p-4 text-gray-600">
                                <div class="flex flex-col">
                                    <span class="font-medium">{{ \Carbon\Carbon::parse($appointment->date)->format('d M Y') }}</span>
                                    <span class="text-xs text-gray-400">{{ \Carbon\Carbon::parse($appointment->date)->format('h:i A') }}</span>
                                </div>
                            </td>
                            <td class="p-4">
                                <span class="px-3 py-1 rounded-full text-xs font-semibold
                                    {{ $appointment->status == 'pending'
                                        ? 'bg-yellow-100 text-yellow-700'
                                        : 'bg-green-100 text-green-700' }}">
                                    {{ ucfirst($appointment->status) }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="p-6 text-center text-gray-500">No appointments found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
@endsection