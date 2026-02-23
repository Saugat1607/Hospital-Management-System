<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hospital Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <nav class="bg-blue-600 text-white p-4 flex justify-between">
        <div class="font-bold text-lg">Hospital System</div>
        <div class="space-x-4">
            <a href="{{ route('dashboard') }}" class="hover:underline">Dashboard</a>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="hover:underline">Logout</button>
            </form>
        </div>
    </nav>
    <main class="p-4">
        @yield('content')
    </main>
</body>
</html>
