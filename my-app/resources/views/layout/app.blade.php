<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name', 'KickCraze'))</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="icon" href="{{ asset('Images/logo.png') }}" type="image/png">
</head>
<body class="bg-white text-zinc-950 antialiased">
    <style>[x-cloak]{display:none!important}</style>

    {{-- Navigation --}}
    @include('components.navbar')
    @include('components.subnav')
    @include('components.banner')


    {{-- Page Content --}}
    <main>
        @yield('content')
    </main>

    {{-- Footer --}}
    @include('components.footer')

</body>
</html>
