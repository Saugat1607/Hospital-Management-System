@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100">

    <!-- Header -->
    <div class="bg-blue-600 py-6 shadow-md">
        <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
            <h1 class="text-3xl font-bold text-black tracking-wide">🩺 Appointment Details</h1>
            <div class="flex items-center space-x-4">
                <a href="{{ route('doctor.dashboard') }}" 
                   class="px-3 py-2 bg-white text-blue-600 font-medium rounded-md hover:bg-gray-100 transition">
                   Back to Dashboard
                </a>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-6 mt-8">
        <div class="bg-white shadow-md rounded-xl p-6">
            <h2 class="text-2xl font-semibold text-gray-800 mb-4">Appointment Information</h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 text-gray-700">
                <div>
                    <p class="text-sm font-medium text-gray-500">Patient Name</p>
                    <p class="mt-1 text-gray-800">{{ $appointment->patient->name }}</p>
                </div>

                <div>
                    <p class="text-sm font-medium text-gray-500">Patient Email</p>
                    <p class="mt-1 text-gray-800">{{ $appointment->patient->email }}</p>
                </div>

                <div>
                    <p class="text-sm font-medium text-gray-500">Appointment Date</p>
                    <p class="mt-1 text-gray-800">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y') }}</p>
                </div>

                <div>
                    <p class="text-sm font-medium text-gray-500">Appointment Time</p>
                    <p class="mt-1 text-gray-800">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('h:i A') }}</p>
                </div>

                <div class="sm:col-span-2">
                    <p class="text-sm font-medium text-gray-500">Reason / Notes</p>
                    <p class="mt-1 text-gray-800">{{ $appointment->reason ?? 'General Checkup' }}</p>
                </div>

                <div>
                    <p class="text-sm font-medium text-gray-500">Status</p>
                    @php
                        $statusColor = match($appointment->status) {
                            'completed' => 'bg-green-100 text-green-700',
                            'cancelled' => 'bg-red-100 text-red-700',
                            default => 'bg-yellow-100 text-yellow-700',
                        };
                    @endphp
                    <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $statusColor }}">
                        {{ ucfirst($appointment->status) }}
                    </span>
                </div>

                <div class="flex items-center space-x-2 mt-4">
                    @if($appointment->status === 'pending')
                    <form action="{{ route('doctor.appointment.complete', $appointment->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition">
                            Mark as Completed
                        </button>
                    </form>
                    @endif
                </div>
            </div>
        </div>
    </div>

</div>
@endsection