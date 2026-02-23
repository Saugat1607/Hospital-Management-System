@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gray-100 p-8">

    <h1 class="text-2xl font-bold mb-6">
        Appointments for Dr. {{ $doctor->name }}
    </h1>

    <div class="bg-white shadow rounded-xl p-6">

        <table class="w-full text-left">
            <thead>
                <tr class="bg-gray-50 text-gray-600 text-sm">
                    <th class="p-3">Patient</th>
                    <th class="p-3">Reason</th>
                    <th class="p-3">Date</th>
                    <th class="p-3">Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse($appointments as $appointment)
                <tr class="border-b hover:bg-gray-50">
                    <td class="p-3">
                        {{ $appointment->patient->name }}
                    </td>
                    <td class="p-3">
                        {{ $appointment->reason }}
                    </td>
                    <td class="p-3">
                        {{ \Carbon\Carbon::parse($appointment->date)->format('d M Y h:i A') }}
                    </td>
                    <td class="p-3">
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
                    <td colspan="4" class="p-4 text-center text-gray-500">
                        No appointments found.
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>

    </div>

</div>

@endsection