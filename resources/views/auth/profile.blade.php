<x-app-layout>
  <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
          {{ __('Profil') }}
      </h2>
  </x-slot>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 bg-white border-b border-gray-200">
                <p>Pseudonyme: {{ Auth::user()->name }}</p>
                <p>Email: {{ Auth::user()->email }}</p>
                <p>Addresse: {{ Auth::user()->address }}</p>
                <p>Ville: {{ Auth::user()->city }}</p>
                <form action="{{ route('edit', [Auth::user()->id]) }}" method="GET">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mt-3 rounded">
                        Modifier mes informations
                    </button>
                </form>
                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 mt-3 rounded" id="deleteProfileButton">
                    Supprimer mon compte
                </button>
                <form action="{{ route('delete', [Auth::user()->id]) }}" method="POST" class="hidden" id="confirmModal">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <div class="fixed z-10 inset-0 overflow-y-auto " aria-labelledby="modal-title" role="dialog" aria-modal="true">
                        <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
                          <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                          <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
                          <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                              <div class="sm:flex sm:items-start">
                                <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
                                  <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                  </svg>
                                </div>
                                <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
                                  <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                    Supprimer mon compte
                                  </h3>
                                  <div class="mt-2">
                                    <p class="text-sm text-gray-500">
                                      Attention! Cette action supprimera de façon permanente votre compte et tous les repas que vous avez ajouté.
                                    </p>
                                  </div>
                                </div>
                              </div>
                            </div>
                            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                              <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
                                Supprimer
                              </button>
                              <button type="button" id="closeButton" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                Annuler
                              </button>
                            </div>
                          </div>
                        </div>
                    </div>                
                </form>

                  <h2 class="font-bold mb-5 text-grey-darkest mt-6">
                    Vous offrez présentement:
                  </h2>
              <div class="relative flex items-top justify-center sm:items-center py-4 sm:pt-0 ">
                  <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                      @foreach ($offeredMeals as $meal)
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
                                  <div class="text-xs flex items-center mb-4 text-gray-400">
                                      Depuis le <br> {{ $meal-> created_at }}
                                  </div>
                              </div>
                              <div class="bg-grey-lighter p-3 flex items-center justify-between transition hover:bg-grey-light">
                                <form action="{{ route('deleteMeal', $meal->id) }}" method="POST">
                                  {{ csrf_field() }}
                                  {{ method_field('DELETE') }}              
                                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 mt-3 rounded">
                                        X
                                    </button>
                                </form>
                              </div>
                          </div>
                      </div>
                      @endforeach
                  </div>
              </div>
              <h2 class="font-bold mb-5 text-grey-darkest mt-6">
                Vous avez réservé:
              </h2>
              <div class="relative flex items-top justify-center sm:items-center py-4 sm:pt-0 ">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-3">
                    @foreach ($reservedMeal as $meal)
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
                                <div class="text-xs flex items-center mb-4 text-gray-400">
                                    Depuis le <br> {{ $meal-> created_at }}
                                </div>
                            </div>
                            <div class="bg-grey-lighter p-3 flex items-center justify-between transition hover:bg-grey-light">
                              <form action="{{ route('eraseMeal', $meal->id) }}" method="POST">
                                @csrf
                                  <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 mt-3 rounded">
                                      Ramassé!
                                  </button>
                              </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>

          </div>
      </div>
  </div>
</x-app-layout>

<script>
    const deleteProfileButton = document.getElementById('deleteProfileButton')
    const closeButton = document.getElementById('closeButton')
    const confirmModal = document.getElementById('confirmModal')

    deleteProfileButton.addEventListener('click',()=>confirmModal.classList.remove('hidden'))
    closeButton.addEventListener('click',()=>confirmModal.classList.add('hidden'))
</script>