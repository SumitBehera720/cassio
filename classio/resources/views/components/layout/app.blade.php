<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="theme-color" content="#0B1A2C">
    <meta name="description" content="Classio - Your ultimate destination for clothes, accessories, shoes, and luxury fashion. Inspired by you.">

    <!-- Preconnect for performance -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <title>Classio - Inspired By You</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#FAF9F6] text-[#1F2937] font-sans antialiased overflow-x-hidden min-w-0 w-full min-h-screen flex flex-col justify-between">
    <x-header :categories="$categories ?? []" />
    
    <main class="flex-grow w-full">
        {{ $slot }}
    </main>

    <x-footer />
    <x-whatsapp-cta />
    <x-notify-modal />
    <x-popup-banner />

    @stack('scripts')
</body>
</html>
