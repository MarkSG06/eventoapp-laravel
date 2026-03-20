<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" href="">

  <title>Admin</title>

  @vite(['resources/css/index.css', 'resources/js/admin.js'])
  <script src="https://unpkg.com/monaco-editor@0.47.0/min/vs/loader.js"></script>
</head>

<body>
  <header>
    <x-navigation />
  </header>

  <main>
    {{ $slot }}
  </main>
  <x-notification />
  <x-modal-destroy />
  <section class="modal-image active">
    <x-modal-image />
  </section>
</body>

</html>