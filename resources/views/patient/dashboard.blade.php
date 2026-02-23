@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100">
    <!-- Header -->
    <div class="bg-blue-600 py-6 shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <h1 class="text-3xl font-bold text-black">Patient Dashboard</h1>
            <div class="flex items-center space-x-4">
                <span class="text-black font-medium">Hello, {{ auth()->user()->name }}</span>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
    class="px-6 py-3 bg-red-600 hover:bg-red-700 text-white text-lg font-bold rounded-lg shadow-md transition duration-200 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-red-100">
    Logout
</button>
                </form>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mt-6">
        <!-- Booking Form -->
        <div class="bg-white shadow rounded-lg p-6 mb-8">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Book an Appointment</h2>
            <form action="{{ route('patient.book.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-gray-700 font-medium">Select Doctor</label>
                    <select name="doctor_id" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                        <option value="">-- Choose Doctor --</option>
                        @foreach($doctors as $doctor)
                            <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-gray-700 font-medium">Appointment Date</label>
                    <input type="datetime-local" name="appointment_date" required
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <div>
                    <label class="block text-gray-700 font-medium">Reason</label>
                    <input type="text" name="reason" required placeholder="Reason for appointment"
                        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500">
                </div>

                <button type="submit"
    class="px-8 py-3 bg-blue-600 hover:bg-blue-700 text-black text-lg font-bold rounded-lg shadow-md transition duration-200 transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-blue-300">
    Book Appointment
</button>
            </form>
        </div>

        <!-- Appointments Table -->
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">My Appointments</h2>
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-blue-100">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Doctor</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Date</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Reason</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Status</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($appointments as $appointment)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $appointment->doctor->name }}</td>
                                <td class="px-6 py-4">{{ \Carbon\Carbon::parse($appointment->appointment_date)->format('d M Y, H:i') }}</td>
                                <td class="px-6 py-4">{{ $appointment->reason }}</td>
                                <td class="px-6 py-4">
                                    @php
                                        $statusColor = match($appointment->status) {
                                            'completed' => 'text-green-600',
                                            'cancelled' => 'text-red-600',
                                            default => 'text-yellow-600',
                                        };
                                    @endphp
                                    <span class="{{ $statusColor }} font-medium">{{ ucfirst($appointment->status) }}</span>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">No appointments yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
