<x-app-layout>
    <x-slot name="header">
       
    </x-slot>

    <div class="bg-white shadow-lg rounded overflow-hidden">
        <div class="px-6 py-4">
            {!! Form::open(['route'=>'admin.roles.store']) !!}

                @include('admin.roles.partials.form')

                
            <div class="flex justify-center mt-6">
                <button  class="items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-6 py-3 bg-gray-500 hover:bg-gray-500 focus:outline-none rounded">
                    <p class="text-sm font-medium leading-none text-white">Crear Rol</p>
                </button>
            </div>

            {!! Form::close() !!}
        </div>

    </div>

            
</x-app-layout>
