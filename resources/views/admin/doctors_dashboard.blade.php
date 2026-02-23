@extends('layouts.app')

@section('content')

<div class="min-h-screen bg-gray-100 p-8">

    <h1 class="text-2xl font-bold mb-6">Doctors List</h1>

    <div class="bg-white shadow rounded-xl p-6">
        <ul class="divide-y">
            @foreach($doctors as $doctor)
                <li class="py-4 flex justify-between items-center hover:bg-gray-50 px-3 rounded transition">
                    <span class="font-medium text-gray-700">
                        {{ $doctor->name }}
                    </span>

                    <a href="{{ route('admin.doctor.appointments', $doctor->id) }}"
                       class="text-blue-600 text-sm hover:underline">
                        View Appointments →
                    </a>
                </li>
            @endforeach
        </ul>
    </div>

</div>

@endsection