<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <x-auth-validation-errors class="mb-4" :errors="$errors" />

                    <form action="{{ route('createMeal', [Auth::user()->id]) }}" method="post" enctype="multipart/form-data">
                        @csrf

                        <div>
                            <x-label for="image" :value="__('Image')" />

                            <x-input id="image" class="block mt-1 w-full" type="file" name="image" accept="image/*" placeholder="Choisir une image" />
                        </div>

                        <div class="mt-4">
                            <x-label for="description" :value="__('Description')" />

                            <x-input id="description" class="block mt-1 w-full" type="text" name="description" value="" required />
                        </div>

                        <div class="mt-4">
                            <x-label for="time" :value="__('Date du dépôt')" />

                            <x-input id="time" class="block mt-1 w-full" type="datetime-local" name="time" value=""/>
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