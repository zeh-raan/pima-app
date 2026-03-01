<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans min-h-screen">
<header class="p-4 bg-blue-500 text-white">
    <h1>PiMA Task Manager</h1>
</header>

<main class="p-4">
    @yield('content')
</main>

<footer class="p-4 text-center text-gray-500">
    &copy; 2026 PiMA App
</footer>
</body>
</html>
