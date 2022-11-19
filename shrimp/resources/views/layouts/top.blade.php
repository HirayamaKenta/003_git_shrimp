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
</head>
<body class="bg-gray-200">
  <div class="font-sans text-gray-900 antialiased ">
    <div class="w-full">
      <div class="w-full flex items-center justify-between">
        {{--↓ロゴ追加--}}
        <a href="{{route('top')}}">
          <img src="{{asset('logo/shrimp.png')}}" style="max-height:50px;">
        </a>
        {{--↑ロゴ追加--}}
        {{-- ↓ログイン・登録部分 --}}
        <div class="px-6 py-4 sm:block">
        @if (Route::has('login'))
          @auth
          <a href="{{ url('/chat/create') }}" class="text-sm text-gray-700
          dark:text-gray-500 underline">
            HOME
          </a>
          @else
          <a href="{{ route('login') }}" class="text-sm text-gray-700
            dark:text-gray-500 underline
            font-bold md:text-base">
            ログイン
          </a>

          @if (Route::has('register'))
          <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700
            dark:text-gray-500 underline
            font-bold md:text-base">
            新規登録
          </a>
          @endif
          @endauth
          @endif
        </div>
        {{-- ↑ログイン・登録部分 --}}
      </div>
    </div>
    <x-message :message="session('message')" />
    {{ $slot }}
  </div>
<div id="mostBottom" class="h-0"></div>
<script>
  let target = document.getElementById('mostBottom');
  target.scrollIntoView(false);
</script>
</body>
</html>
