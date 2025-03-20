<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Heavenly socks' }}</title>
    @assets
    <link href="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/css/iziToast.min.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @endassets
    @include('partials.head')
</head>
<body class="min-h-screen bg-white dark:bg-zinc-800">
       
    @include('partials.navbar')

    <main class="container mx-auto py-8">
        {{ $slot }}
    </main>
 
    @livewireScripts
     @fluxScripts
     
     <script src="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/js/iziToast.min.js">
    </script>
           <x-livewire-notification::toast />
<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
@assets
    <script src="{{ asset('js/app.js') }}"></script>
    @endassets
    @stack('scripts')
    @include('partials.footer')

</body>
</html>