<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ __('Dashboard') }}</title>

    <!-- Styles -->
    @vite(['resources/css/app.css'])
</head>
<body class="h-screen bg-repeat-y relative bg-space">
    <div class="h-full font-serif">
        <!-- Page Content -->
        {{ $slot }}
    </div>
</body>
<footer>
    <!-- Scripts -->
    @vite(['resources/js/dashboard.js'])
    @livewireScripts
    @livewire('wire-elements-modal')
</footer>
</html>
