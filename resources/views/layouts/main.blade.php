@use('Illuminate\Support\Facades\Vite')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <title>@yield('title', 'Shorten Your Long URLs')  | Push: A Personal URL Shortener</title>
    <meta name="description" content="@yield('description')">
    <meta name="author" content="Andrew Woods">


    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<div id="page-wrapper">
    <div id="page-content">
    <nav>
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/url/clean">Clean</a></li>
        </ul>
    </nav>
        @yield('content')
    </div>
</div>
</body>

</html>
