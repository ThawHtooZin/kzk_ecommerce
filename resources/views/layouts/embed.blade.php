<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>{{ isset($title) ? $title.' · ' : '' }}{{ config('app.name', 'Ecommerce') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
  </head>
  <body class="min-h-screen bg-white text-zinc-950 antialiased">
    <main class="px-4 py-5">
      {{ $slot ?? '' }}
      @yield('content')
    </main>
  </body>
</html>

