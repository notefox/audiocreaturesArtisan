<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>AudioCreatures - Berlin Audio</title>

    @vite('resources/css/app.css')
</head>
<body class="content-container">
<nav class="w-full flex justify-center absolute top-0 mt-5">
    <ul class="flex justify-between bg-gray w-fit gap-x-24 py-6 px-16 rounded-full">
        <li class="nav-heading-text"><a href="#">Home</a></li>
        <li class="nav-heading-text"><a href="#">About</a></li>
        <li class="nav-heading-text"><a href="#">news</a></li>
        <li class="nav-heading-text"><a href="#">Portfolio</a></li>
        <li class="nav-heading-text"><a href="#">Discover</a></li>
        <li class="nav-heading-text"><a href="#">Credits</a></li>
    </ul>
</nav>
<div class="">
    @yield('content')
</div>
</body>
<footer>
    @vite('resources/js/app.js')
</footer>

</html>
