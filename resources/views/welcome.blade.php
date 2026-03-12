<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>ReadTickets</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    @vite(['resources/css/welcome.css', 'resources/js/welcome.js'])
</head>
<style>
    * {
        padding: 0;
        margin: 0;
        font-family: system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    }

    .hero {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        height: 100vh;
        width: 100%;
        background-color: hsl(0, 0%, 85%);
    }

    .hero h1 {
        font-size: 3rem;
        font-weight: bold;
    }

    .hero p {
        font-size: 1.5rem;
        margin-bottom: 1rem;
    }

    .hero button {
        padding: 1rem 2rem;
        border: none;
        border-radius: 5px;
        background-color: hsl(271, 76%, 53%);
        color: hsl(0, 0%, 100%);
        font-size: 1.2rem;
        cursor: pointer;
    }
</style>

<body>
    <section class="hero">
        <h1>ReadTickets</h1>
        <p>ReadTickets is a ticket management system for events.</p>
        <button>Get Started</button>
    </section>
</body>

</html>