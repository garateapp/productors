<x-app-layout>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Agregar Daño') }}
        </h2>
    </x-slot>
    <div class="overflow-hidden bg-white rounded shadow-lg">

        @if (session('info'))
            <div class="flex justify-center">
                <div class="justify-center">
                    <div class="flex justify-center w-full px-4 py-3 text-green-700 bg-green-100 border border-green-400 rounded"
                        role="alert">
                        <strong class="mx-2 font-bold">Exito!</strong>
                        <span class="flex">{{ session('info') }}</span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg class="w-6 h-6 text-red-500 fill-current" role="button"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <title>Cerrar</title>
                                <path
                                    d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        @endif
        @if (session('fail'))
            <div x-data="{ open: true }">
                <div x-show="open"
                    class="relative flex px-4 py-3 text-red-700 bg-red-100 border border-red-400 rounded"
                    role="alert">
                    <strong class="items-center content-center my-auto font-bold">Error!</strong>
                    <span class="items-center content-center block my-auto ml-2 sm:inline">{{ session('fail') }}</span>
                    <span x-on:click="open=false" class="top-0 bottom-0 right-0 px-4 py-3 ">
                        <svg class="w-6 h-6 ml-4 text-gray-500 fill-current" role="button"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <title>Cerrar</title>
                            <path
                                d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                        </svg>
                    </span>
                </div>
            </div>
        @endif
        <div>
            <div class="max-w-4xl py-12 mx-auto sm:px-6 lg:px-44">
                <div class="px-6 py-4 mt-6 overflow-hidden shadow-md sm:max-w-md sm:rounded-lg"
                    style="background-color: rgb(0,0,0,0.5); width: 95%;">

                    <form method="POST" action="{{ route('valor.update', $dagnos->id) }}" class="mt-6') }}">

                        @csrf
                        @method('PUT')

                        <div>
                            <x-jet-label for="Especie" value="Especie" class="text-white" />
                            <select id="especie" name="especie" class="block w-full mt-1 select2 form-control" type="text" required>
                                @foreach ($especies as  $id=> $entry))
                                <option value="{{ $entry }}" {{ $dagnos->especie == $entry ? 'selected' : '' }}>{{ $entry }}</option>

                                @endforeach
                            </select>
                        </div>
                        <div class="mt-4">
                            <x-jet-label for="parametro" value="parametro" class="text-white" />
                            <select id="parametro" name="parametro" class="block w-full mt-1 select2 form-control" type="text" required>
                                @foreach ($parametros as $id=> $parametro)
                                <option value="{{ $id }}" {{ $dagnos->parametro_id == $id ? 'selected' : '' }}>{{ $parametro }}</option>

                                @endforeach
                            </select>
                        </div>

                        <div class="mt-4">
                            <x-jet-label for="valor" value="Valor" class="text-white" />
                            <x-jet-input id="valor" class="block w-full mt-1 form-control" type="text" name="valor"
                                value="{{ $dagnos->name }}" required />
                        </div>





                        <br />
                        <x-jet-button class="ml-4">
                            {{ __('Editar Daño') }}
                        </x-jet-button>
                        <x-jet-button type="button" class="ml-4"
                            onclick="window.location.href='{{ route('valor.index') }}'">
                            {{ __('Volver') }}
                        </x-jet-button>
                </div>
                </form>
            </div>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
$(document).ready(function() {
    $('.select2').select2();
});
    </script>

</x-app-layout>
