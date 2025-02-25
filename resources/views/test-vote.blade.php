<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Vote Button</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="bg-white p-8 rounded-lg shadow-md w-96">
        <h1 class="text-2xl font-bold mb-6">Test Vote Button</h1>

        @auth
            <livewire:vote-button :nomination="$nomination" />
            <div class="mt-4 text-sm text-gray-600">
                <p>User: {{ Auth::user()->name }}</p>
            </div>
        @else
            <div class="text-center">
                <p class="text-gray-600 mb-4">Please log in to test voting</p>
                <a href="{{ route('login') }}" class="text-blue-500 hover:underline">Login</a>
            </div>
        @endauth
    </div>

    @livewireScripts
</body>
</html>