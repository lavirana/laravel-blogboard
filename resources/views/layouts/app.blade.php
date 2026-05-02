<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'BlogBoard') | TheTechInfo</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <x-navbar />
    @if(session('success'))
        <x-alert type="success" :message="session('success')" />
    @endif
    <main>
        @yield('content')
    </main>
</body>
<footer>
    &copy; {{ date('Y') }} BlogBoard
</footer>
</html>
