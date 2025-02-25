<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ $title ?? 'Rankings' }} | {{ config('app.name') }}</title>
        @vite(['resources/css/site.css', 'resources/js/site.js'])
        @livewireStyles
    </head>
    <body class="bg-gray-100">
        <div class="container mx-auto px-4 py-8">
            @yield('content')
        </div>

        <!-- Scripts -->
        <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
        @livewireScripts
    </body>
</html>