<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form action="{{ route('createMeal', [Auth::user()->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div class="flex flex-col border-2 border-dashed border-gray-400 items-center">
                            <x-label for="image" :value="__('Image')" />
                            <svg width="104" height="108" viewBox="0 0 104 108" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <rect width="104" height="108" fill="white" />
                                <path d="M54 11H4V100H90V62.5" stroke="#A9A9A9" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M87.5 46C87.5 47.1046 88.3954 48 89.5 48C90.6046 48 91.5 47.1046 91.5 46H87.5ZM91.5 46V9H87.5V46H91.5Z" fill="#A9A9A9" />
                                <path d="M78 20.5L89.5 9L101 20.5" stroke="#A9A9A9" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M5 67L28.5 43.5L61 76" stroke="#A9A9A9" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M90 79L67 56L54 69" stroke="#A9A9A9" stroke-width="4" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>

                            <p class="text-xl">Glisser un fichier</p>
                            <p>ou</p>

                            <x-input id="image" class="block mt-1 w-full" type="file" name="image" accept="image/*" placeholder="Choisir une image" />
                        </div>

                        <div class="mt-4">
                            <x-label for="description" :value="__('Description')" />

                            <x-input id="description" class="block mt-1 w-full" type="text" name="description" value="" required />
                        </div>

                        <div class="mt-4">
                            <x-label for="time" :value="__('Date du dépôt')" />

                            <x-input id="time" class="block mt-1 w-full" type="datetime-local" name="time" value="" />
                        </div>


                        <div class="flex items-center justify-end mt-4">
                            <x-button class="ml-4">
                                {{ __('Enregistrer') }}
                            </x-button>
                        </div>
                        <input type="text" hidden value="{{ Auth::user()->id }}" id="user_id" name="user_id">
                        <input type="text" hidden value="{{ Auth::user()->city }}" id="city" name="city">
                    </form>

                </div>
            </div>
        </div>
    </div>

</x-app-layout>