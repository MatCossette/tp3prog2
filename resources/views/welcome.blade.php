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
    <div class="min-h-screen bg-white">
        @include('layouts.navigation')

        <!-- Page Content -->
        <main class="mt-5 p-5">
            <h1 class="font-bold text-3xl mb-5">Repas disponibles</h1>
            <div class="relative flex items-top justify-center sm:items-center py-4 sm:pt-0 ">

                <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                    @foreach ($meals as $meal)
                    <div class="bg-white w-128 h-60 rounded shadow-md flex card text-grey-darkest">

                        @if ($meal->image)
                        <img class="w-1/2 h-full rounded-l-sm" src="/storage/{{ $meal-> image }}" alt="photo de repas">
                        @else
                        <img class="w-1/2 h-full rounded-l-sm" src="/storage/placeholdermeal.svg" alt="image repas par default">
                        @endif
                        <div class="w-full flex flex-col">
                            <div class="p-4 pb-0 flex-1">
                                <h2 class="font-bold mb-1 text-grey-darkest">
                                    {{ $meal-> description }}
                                </h2>
                                <div>
                                    @foreach($usersOffering as $userOffering)
                                    @if ($userOffering->id == $meal->user_id)
                                    <p class="text-gray-300"> Ajouté par {{ $userOffering->name }}</p>
                                    <div class="text-xs flex items-center mb-2 text-gray-400">
                                        le {{ $meal-> created_at }}
                                    </div>
                                    @if (Route::has('login'))
                                    <div class="sm:block">
                                        @auth
                                        <p class="text-xs">{{ $userOffering->address }}, {{ $userOffering->city }}</p>
                                        @else
                                        @endauth
                                    </div>
                                    @endif
                                    @endif
                                    @endforeach
                                </div>
                                <div class="flex items-center mt-2">
                                    <div class="text-xs">
                                        {{ $meal-> meteo }}°C
                                    </div>
                                </div>
                                <div class="bg-grey-lighter p-3 flex items-center justify-between transition hover:bg-grey-light">
                                    @if (Route::has('login'))
                                    <div class="py-4 sm:block">
                                        @auth
                                        <form action="{{ route('reserveMeal', ['foodCard' => $meal-> id, 'id' => Auth::user()->id]) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="bg-yellow-400 hover:bg-yellow-300 text-white py-2 px-4 rounded">Réserver</button>
                                        </form>
                                        @else
                                        <a href="{{ url('/login') }}" class="bg-gray-300 hover:bg-gray-400 text-white py-2 px-4 rounded">Réserver</a>
                                        @endauth
                                    </div>
                                    @endif
                                </div>

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