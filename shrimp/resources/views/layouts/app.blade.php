<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'Laravel') }}</title>

  <!-- Fonts -->
  <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
  <link rel="stylesheet" href="{{asset('css/forum.css')}}">
</head>
<body class="font-sans antialiased">
  <div class="min-h-screen bg-indigo-400 md:bg-slate-600">
    @include('layouts.navigation')
    {{--
    <x-message :message="session('message')" /> --}}

    <!-- Page Heading -->
    <header class="bg-slate-800 border-b-2
                border-y-amber-100 shadow shadow-neutral-500">

        <div class="md:max-w-7xl mx-auto
        py-6 px-4
        md:px-6 lg:px-12
        font-semibold  text-white  text-xs md:text-2xl
          flex whitespace-nowrap justify-between md:justify-start
          leading-tight h-4 md:h-auto items-center">
        {{ $header }}
        </div>
        <x-validation-errors class="" :errors="$errors" />
        <x-message :message="session('message')" />
    </header>

    <!-- Page Content -->
    <main>
      <div class="md:max-w-7xl mx-auto
        md:px-6 lg:px-12">
        <div class="fixed right-0 md:right-3 bottom-5 md:bottom-7">
          <img
          class="h-5 md:h-32"
          src="{{asset('logo/starshrimp.png')}}"
          >
        </div>
        {{ $slot }}
        <div class="h-24"></div>
      </div>
    </main>
  </div>
  <div id="mostBottom" class="h-0"></div>
</body>
</html>
