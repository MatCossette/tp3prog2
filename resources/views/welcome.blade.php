<x-app-layout>
    @if ($message)
    <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded relative text-center" role="alert">
        <span class="block sm:inline">{{ $message }}</span>
    </div>
    @endif
    <div class="min-h-screen bg-gray-100">
        <!-- Page Content -->
        <main>
            <div class="relative flex items-top justify-center sm:items-center py-4 sm:pt-0 ">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-3">        
                    @foreach ($meals as $meal)
                    <div class="bg-white w-128 h-60 rounded shadow-md flex card text-grey-darkest">

                        @if ($meal->image)
                        <img class="w-1/2 h-full rounded-l-sm" src="/storage/images/{{ $meal-> image }}" alt="photo de repas">
                        @else
                        <img class="w-1/2 h-full rounded-l-sm" src="/storage/images/placeholdermeal.svg" alt="image repas par default">
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
                                            <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white py-2 px-4 rounded">Réserver</button>
                                        </form>
                                        @else
                                        <a href="{{ url('/login') }}" class="bg-gray-500 hover:bg-gray-700 text-white py-2 px-4 rounded">Réserver</a>
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
</x-app-layout>
