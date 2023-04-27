<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <!-- Styles 
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
-->
        <!-- Styles -->
        <link rel="stylesheet" href="{{asset('fontawesome-free-5.15.4-web/css/all.min.css')}}">
        @livewireStyles
        @yield('css')
    </head>
    <body class="font-sans antialiased">
        <x-jet-banner />

        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
                        
            <script>
                function dropdownFunction(element) {
                 var dropdowns = document.getElementsByClassName("dropdown-content");
                 var i;
                 let list = element.parentElement.parentElement.getElementsByClassName("dropdown-content")[0];
                 list.classList.add("target");
                 for (i = 0; i < dropdowns.length; i++) {
                     if (!dropdowns[i].classList.contains("target")) {
                         dropdowns[i].classList.add("hidden");
                     }
                 }
                 list.classList.toggle("hidden");
             }</script>
 
        </div>

        @stack('modals')

        @livewireScripts

        @isset($js)

            {{$js}}

        @endisset
        
    </body>
</html>
