@extends('layouts.app')

@section('content')
<div class="max-w-xl mx-auto bg-white p-6 rounded shadow mt-10">

    <h2 class="text-xl font-bold mb-4">Profile Settings</h2>

    <form method="POST" action="{{ route('profile.update') }}">
        @csrf
        @method('PATCH')

        <input name="name"
               value="{{ auth()->user()->name }}"
               class="w-full border p-2 mb-3">

        <input name="email"
               value="{{ auth()->user()->email }}"
               class="w-full border p-2 mb-3">

        <button class="bg-blue-600 text-white px-4 py-2 rounded">
            Update
        </button>
    </form>

</div>
@endsection
