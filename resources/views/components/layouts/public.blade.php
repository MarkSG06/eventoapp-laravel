<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="">

  <title>ReadTickets</title>

  @vite(['resources/css/public.css', 'resources/js/public.js'])
</head>

<body>
  <header>
    <x-language :languages="$languages" />
  </header>

  <main>
    {{ $slot }}
  </main>

  <x-footer />
</body>

</html>