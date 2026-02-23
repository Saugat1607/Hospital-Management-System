@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-100 p-8">

    <h1 class="text-2xl font-bold mb-6">Patients Dashboard</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @foreach($patients as $patient)
        <div class="bg-white shadow-md rounded-xl p-6 hover:shadow-lg transition cursor-pointer">
            <div class="flex flex-col gap-2">
                <h2 class="text-lg font-semibold text-gray-800">{{ $patient->name }}</h2>
                <p class="text-gray-500 text-sm">{{ $patient->email }}</p>
                <p class="text-sm text-gray-600">Registered Patient</p>
            </div>
        </div>
        @endforeach
    </div>

</div>
@endsection  