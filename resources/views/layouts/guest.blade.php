<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" type="image/png" href="{{asset('/assets/images/logo-pfn.png')}}">

        <title>Produksi Film Negara</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
        @php
    $manifest = json_decode(file_get_contents(public_path('build/manifest.json')), true);
@endphp
<script type="module" src="{{asset('build/'.$manifest['resources/js/app.js']['file'])}}"></script>
<link rel="stylesheet" href="{{asset('build/'.$manifest['resources/css/app.css']['file'])}}">
    </head>
    <body>
        <div class="font-sans text-gray-900 antialiased">
            {{ $slot }}
        </div>
    </body>
</html>
