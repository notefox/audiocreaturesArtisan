<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ current_page_path_name() }}</title>

    <!-- Styles -->
    @vite(['resources/css/app.css'])
</head>
<body class="w-full bg-repeat-y relative bg-space">
<div id="content-container" class="content-container mx-auto">
    <!-- Page Content -->
    {{ $slot }}
</div>
</body>
<footer>
    <!-- Scripts -->
    @vite('resources/js/app.js')
    @livewireScripts
</footer>
</html>
