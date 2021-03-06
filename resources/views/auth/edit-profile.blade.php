<x-app-layout>

  <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
          <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
              <div class="p-6 bg-white border-b border-gray-200">
                <x-auth-validation-errors class="mb-4" :errors="$errors" />

                <form action="{{ route('edit', [Auth::user()->id]) }}" method="POST">
                    @csrf
        
                    <!-- Name -->
                    <div>
                        <x-label for="name" :value="__('Name')" />
        
                        <x-input id="name" class="block mt-1 w-full" type="text" name="name" value="{{ Auth::user()->name }}" required autofocus />
                    </div>
        
                    <!-- Email Address -->
                    <div class="mt-4">
                        <x-label for="email" :value="__('Email')" />
        
                        <x-input id="email" class="block mt-1 w-full" type="email" name="email" value="{{ Auth::user()->email }}" required />
                    </div>
        
                    <!-- Address -->
                    <div class="mt-4">
                        <x-label for="address" :value="__('Address')" />
        
                        <x-input id="address" class="block mt-1 w-full" type="text" name="address" value="{{ Auth::user()->address }}" required />
                    </div>
        
                    <!-- City -->
                    <div class="mt-4">
                        <x-label for="city" :value="__('City')" />
        
                        <select class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" id="city" name="city">
                            <option class="py-1" value="Beauport">Beauport</option>
                            <option class="py-1" value="Drummondville">Drummondville</option>
                            <option class="py-1" value="Gatineau">Gatineau</option>
                            <option class="py-1" value="Levis">L??vis</option>
                            <option class="py-1" value="Montreal">Montr??al</option>
                            <option class="py-1" value="Quebec">Qu??bec</option>
                            <option class="py-1" value="Trois-Rivieres">Trois-Rivi??res</option>
                        </select>            
                    </div>
                        
                    <!-- Password -->
                    <div class="mt-4">
                        <x-label for="password" :value="__('New Password')" />
        
                        <x-input id="password" class="block mt-1 w-full"
                                        type="password"
                                        name="password"
                                        autocomplete="new-password" />
                    </div>
        
                    <!-- Confirm Password -->
                    <div class="mt-4">
                        <x-label for="password_confirmation" :value="__('Confirm Password')" />
        
                        <x-input id="password_confirmation" class="block mt-1 w-full"
                                        type="password"
                                        name="password_confirmation"/>

                    </div>
    
                    <div class="flex items-center justify-end mt-4">        
                        <x-button class="ml-4">
                            {{ __('Enregistrer') }}
                        </x-button>
                    </div>
                </form>
        
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