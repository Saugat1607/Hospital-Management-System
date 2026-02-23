@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50">

    <!-- Header -->
    <div class="bg-blue-700 py-6 shadow-lg">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
            <h1 class="text-3xl font-bold text-black">Doctor Dashboard</h1>

            <div class="flex items-center space-x-6">
                <span class="text-black font-semibold text-lg">
                    Welcome, Dr. {{ auth()->user()->name }}
                </span>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white font-medium rounded-lg hover:bg-red-700 transition duration-200">
                        Logout
                    </button>
                </form>
            </div>
        </div>
    </div>


    <!-- Summary Cards -->
    <div class="max-w-7xl mx-auto px-6 mt-8 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-6">

        <!-- Card -->
        <div class="bg-white border border-gray-200 rounded-xl shadow-md p-6">
            <p class="text-gray-700 font-semibold text-lg">Total Appointments</p>
            <h2 class="text-4xl font-bold text-blue-700 mt-3">
                {{ $totalAppointments }}
            </h2>
        </div>

        <div class="bg-white border border-gray-200 rounded-xl shadow-md p-6">
            <p class="text-gray-700 font-semibold text-lg">Upcoming Appointments</p>
            <h2 class="text-4xl font-bold text-yellow-600 mt-3">
                {{ $upcomingAppointments }}
            </h2>
        </div>

        <div class="bg-white border border-gray-200 rounded-xl shadow-md p-6">
            <p class="text-gray-700 font-semibold text-lg">Completed Appointments</p>
            <h2 class="text-4xl font-bold text-green-600 mt-3">
                {{ $completedAppointments }}
            </h2>
        </div>

        <div class="bg-white border border-gray-200 rounded-xl shadow-md p-6">
            <p class="text-gray-700 font-semibold text-lg">Cancelled Appointments</p>
            <h2 class="text-4xl font-bold text-red-600 mt-3">
                {{ $cancelledAppointments }}
            </h2>
        </div>

    </div>


    <!-- Appointments Table -->
    <div class="max-w-7xl mx-auto px-6 mt-10">
        <div class="bg-white border border-gray-200 shadow-md rounded-xl overflow-hidden">

            <div class="px-6 py-4 border-b bg-gray-100">
                <h2 class="text-xl font-bold text-gray-800">Appointments</h2>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full text-left">
                    <thead class="bg-gray-200">
                        <tr>
                            <th class="px-6 py-3 font-bold text-gray-800">Patient</th>
                            <th class="px-6 py-3 font-bold text-gray-800">Date & Time</th>
                            <th class="px-6 py-3 font-bold text-gray-800">Status</th>
                            <th class="px-6 py-3 font-bold text-gray-800">Actions</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        @forelse($appointments as $appointment)
                        <tr class="hover:bg-gray-50 transition">

                            <td class="px-6 py-4 font-semibold text-gray-900">
                                {{ $appointment->patient->name }}
                            </td>

                            <td class="px-6 py-4 text-gray-800">
                                {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}
                                <br>
                                <span class="text-sm font-medium">
                                    {{ \Carbon\Carbon::parse($appointment->appointment_date)->format('h:i A') }}
                                </span>
                            </td>

                            <td class="px-6 py-4">
                                @php
                                    $statusColor = match($appointment->status) {
                                        'completed' => 'bg-green-200 text-green-800',
                                        'cancelled' => 'bg-red-200 text-red-800',
                                        default => 'bg-yellow-200 text-yellow-800',
                                    };
                                @endphp

                                <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $statusColor }}">
                                    {{ ucfirst($appointment->status) }}
                                </span>
                            </td>

                            <td class="px-6 py-4 space-x-4">

                                <a href="{{ route('doctor.appointment.view', $appointment->id) }}"
                                   class="text-blue-700 font-semibold hover:underline">
                                    View
                                </a>

                                @if($appointment->status === 'pending')
                                <form action="{{ route('doctor.appointment.complete', $appointment->id) }}"
                                      method="POST" class="inline">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                            class="text-green-700 font-semibold hover:underline">
                                        Complete
                                    </button>
                                </form>
                                @endif

                            </td>

                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-6 text-center text-gray-700 font-medium">
                                No appointments found.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>

                </table>
            </div>

        </div>
    </div>

</div>
@endsection