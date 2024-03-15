<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>৪ সিগন্যাল ব্যাটালিয়ন</title>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

        
        {{-- {{-- {{-- <!-- Fonts --> --}}
        <link rel="preconnect" href="https://fonts.bunny.net">
        <!-- In your Blade file -->
        <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
                {{-- <link href="https://cdn.datatables.net/searchpanes/2.3.0/css/searchPanes.bootstrap5.css" rel="stylesheet" /> --}}
        <link href="https://cdn.datatables.net/select/2.0.0/css/select.bootstrap5.css" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /> -



        <link rel="stylesheet"  href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css"/>
        <link href="https://cdn.datatables.net/2.0.0/css/dataTables.bootstrap5.css" rel="stylesheet" />
        <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css"  rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css"  rel="stylesheet" />
        
        <style>
            .dataTables_wrapper .dataTables_length select {
                background-image: none;
            }
        </style>



        <!-- Scripts -->
        <script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/datepicker.min.js"></script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>


    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

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



        </div>


        {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script> --}}

    </body>
    
</html>
