<x-app-layout>
    <x-slot name="header">
       
    </x-slot>

    <div class="flex flex-col sm:justify-center items-center sm:pt-14" >
      
      @if (session('info'))
          <div x-data="{open: true}">
            <div x-show="open"  class="bg-white border border-gray-400 text-gray-700 px-4 py-3 rounded relative flex" role="alert">
                <strong class="font-bold content-center items-center my-auto">Felicidades!</strong>
                <span class="block sm:inline content-center items-center my-auto ml-2">{{session('info')}}</span>
                <span x-on:click="open=false" class="top-0 bottom-0 right-0 px-4 py-3 ">
                <svg class="fill-current h-6 w-6 text-gray-500 ml-4" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </span>
            </div>
        </div>
      @endif
      @if (session('fail'))
          <div x-data="{open: true}">
              <div x-show="open"  class="bg-white border border-gray-400 text-gray-700 px-4 py-3 rounded relative flex" role="alert">
                  <strong class="font-bold content-center items-center my-auto">Error!</strong>
                  <span class="block sm:inline content-center items-center my-auto ml-2">{{session('fail')}}</span>
                  <span x-on:click="open=false" class="top-0 bottom-0 right-0 px-4 py-3 ">
                  <svg class="fill-current h-6 w-6 text-gray-500 ml-4" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                  </span>
              </div>
          </div>
      @endif
        <div class="sm:max-w-md mt-6 px-6 py-4 shadow-md overflow-hidden sm:rounded-lg" style="background-color: rgb(0,0,0,0.5); width: 95%;">
          <form method="POST" action="{{ route('user.store') }}">
            @csrf
      
            <div>
                <x-jet-label for="name" value="{{ __('Nombre') }}" class="text-white" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>
      
            <div class="mt-4">
                <x-jet-label for="email" value="{{ __('Email') }}" class="text-white" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>
      
            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Contraseña') }}" class="text-white" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
            </div>
      
            <div class="mt-4">
                <x-jet-label for="password_confirmation" value="{{ __('Confirmar Contraseña') }}" class="text-white" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>
      
            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms" required />
      
                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif
      
            <div class="flex items-center justify-end mt-4">
               
      
                <x-jet-button class="ml-4">
                    {{ __('Crear Usuario') }}
                </x-jet-button>
            </div>
          </form>
        </div>
    </div>


  

 
             
            
</x-app-layout>
