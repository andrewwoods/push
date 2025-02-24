<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">

    <title>@yield('title')  | A Personal URL Shortener</title>
    <meta name="description" content="@yield('description')">
    <meta name="author" content="Andrew Woods">

    <!-- Styles -->
    <style>
    :root {
        /* Whitespace Settings */
        --padding-small: 0.5em;
        --padding-medium: 1em;
        --padding-large: 1.5em;

        --margin-small: 0.5em;
        --margin-medium: 1em;
        --margin-large: 1.5em;

        /* Color Legend */
        --navy: #003049;
        --red: #d62828;
        --orange: #f77f00;
        --yellow: #fcbf49;
        --cream: #eae2b7;

        --white: #ffffff;
        --black: #2a2a2a;

        /* Font Legend */
        --sans-font: "Inter Display";
        --serif-font: "Produkt";
        --fixed-font: "Noto Sans Mono";

    }

    body {
        background-color: var(--cream);
        color: var(--black);
        font-family: var(--sans-font), sans-serif;
    }

    h1, h2, h3 {
        margin-top: 0;
        margin-bottom: var(--margin-medium);
        font-family: var(--serif-font), serif;
    }

    form {
        border: 1px solid var(--navy);
        padding: var(--padding-medium);

    }

    label {
        display: block;
        margin-top: var(--margin-medium);
    }

    input, textarea {
        width: 10em;
        padding: var(--padding-small);
        font-size: 1em;
        font-family: var(--fixed-font), serif;
    }

    .wide {
        width: 30em;
    }

    </style>
    <!-- Scripts -->
    <!-- <script src="/js/script.js"></script> -->

</head>
<body>
<div id="page-wrapper">
    <div id="page-content">
    <nav>
        <ul>
            <li><a href="/">Home</a></li>
        </ul>
    </nav>
        @yield('content')
    </div>
</div>
<!-- <script src="/js/script.js"></script> -->
</body>

</html>
