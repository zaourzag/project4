<!DOCTYPE html>
<html lang="en">
<head>

    @include('partials.head')
</head>
<body class="min-h-screen bg-white dark:bg-zinc-800">
      <script>
        window.userID = {{ auth()->id() }};
    </script>
    @include('partials.navbar')

    <main class="container mx-auto py-8">
        {{ $slot }}
    </main>



     <script src="https://cdn.jsdelivr.net/npm/izitoast@1.4.0/dist/js/iziToast.min.js">
    </script>

           <x-livewire-notification::toast />
<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
{{-- @assets
    <script src="{{ asset('js/app.js') }}"></script>
    @endassets --}}

    @stack('scripts')

    @include('partials.footer')
 @livewireScripts
     @fluxScripts

</body>
</html>
