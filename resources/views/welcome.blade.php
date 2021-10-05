<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Content -->
            <main>
                <div class="relative flex items-top justify-center sm:items-center py-4 sm:pt-0 ">       
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                        @foreach ($meals as $meal)
                            <div class="bg-white w-128 h-60 rounded shadow-md flex card text-grey-darkest">
                                <img class="w-1/2 h-full rounded-l-sm" src="{{ $meal-> image }}" alt="image">
                                <div class="w-full flex flex-col">
                                    <div class="p-4 pb-0 flex-1">
                                        <h3 class="font-light mb-1 text-grey-darkest">
                                            Offert par {{ $meal-> user_id }} 
                                        </h3>
                                        <div class="text-xs flex items-center mb-4">
                                            Disponible depuis le <br> {{ $meal-> created_at }}
                                        </div>
                                        <div>
                                            <p>
                                                {{ $meal-> description }}
                                            </p>
                                        </div>
                                        <div class="flex items-center mt-4">
                                            <div class="text-xs">
                                                Température: {{ $meal-> meteo }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bg-grey-lighter p-3 flex items-center justify-between transition hover:bg-grey-light">
                                        @if (Route::has('login'))
                                        <div class="py-4 sm:block">
                                            @auth
                                                <a href="{{ url('/profile') }}" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">Réserver</a>
                                            @else
                                                <a href="{{ url('/login') }}" class="bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 rounded">Réserver</a>
                                            @endauth
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
        
                </div>
                <div class="relative flex justify-center bg-gray-100">
                    {{ $meals->links() }}
                </div>
            </main>
        </div>
    </body>
</html> 