<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Push | A Personal URL Shortener</title>
    <meta name="description" content="A Personal, Self-hosted URL Shortener for
    people who want more control over the tools they use">
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
    }

    body {
        background-color: var(--cream);
        color: var(--black);
        font-face: "Inter Display", sans-serif;
    }
    </style>
    <!-- Scripts -->
    <script src="/js/script.js"></script>

</head>
<body>
<div id="page-wrapper">
    <div id="page-content">
        <h1>Push URL Shortener</h1>

        <p>
           This is a paragraph of text. There are many like it but this one is mine.
        </p>
    </div>
</div>
<script src="/js/script.js"></script>
</body>

</html>
