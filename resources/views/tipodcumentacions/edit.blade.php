<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Edición de Tipos de Documento') }}
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
                            <title>Close</title>
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

                    <form method="POST" action="{{ route('tipodocumentacions.store') }}">

                        @csrf
                        <div class="mt-4">
                            <x-jet-label for="esglobal" value="Es Global" class="text-white" /> <span
                                class="text-white fa-solid fas fa-question-circle"><i></i></span>
                            <select id="global" class="block w-full mt-1" type="text" name="global" required>
                                <option value="1">Si</option>
                                <option value="0">No</option>
                            </select>
                        </div>
                        <div class="mt-4">
                            <x-jet-label for="estado" value="País" class="text-white" />
                            <select id="pais" class="block w-full mt-1" type="text" name="pais_id" required
                                value="{{ $tipodocumentacion->pais_id }}" required>
                                <option value="">Seleccione un País</option>
                                @foreach ($paises as $id => $nombre)
                                    <option value="{{ $id }}"
                                        {{ $tipodocumentacion->pais_id == $id ? 'selected' : '' }}>{{ $nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mt-4">
                            <x-jet-label for="especie" value="Especie" class="text-white" />
                            <select id="especie" class="block w-full mt-1" type="text" name="especie_id" required
                                value="{{ $tipodocumentacion->especie_id }}" required>
                                <option value="">Seleccione un Especie</option>
                                @foreach ($especies as $id => $nombre)
                                    <option value="{{ $id }}"
                                        {{ $tipodocumentacion->especie_id == $id ? 'selected' : '' }}>
                                        {{ $nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <x-jet-label for="nombre" value="Nombre" class="text-white" />
                            <x-jet-input id="nombre" class="block w-full mt-1" type="text" name="nombre"
                                value="{{ $tipodocumentacion->nombre }}" required autofocus autocomplete="nombre" />
                            <input type="hidden" name="id" value="{{ $tipodocumentacion->id }}">
                        </div>

                        <div class="mt-4">
                            <x-jet-label for="descripcion" value="Descripción" class="text-white" />
                            <x-jet-input id="descripcion" class="block w-full mt-1" type="text" name="descripcion"
                                value="{{ $tipodocumentacion->descripcion }}" required />
                        </div>
                        <div class="mt-4">
                            <x-jet-label for="estado" value="Estado" class="text-white" />
                            <select id="estado" class="block w-full mt-1" type="text" name="estado"
                                value="{{ $tipodocumentacion->estado }}" required>
                                <option value="1" {{ $tipodocumentacion->estado == '1' ? 'selected' : '' }}>
                                    Activo</option>
                                <option value="0" {{ $tipodocumentacion->estado == '0' ? 'selected' : '' }}>
                                    Inactivo</-jet-option>
                            </select>
                        </div>
                        <div>
                            <x-jet-label for="nombreguardado" value="Cómo debe guardarse" class="text-white" />
                            <x-jet-input id="nombre_guardado" class="block w-full mt-1" type="text"
                                name="nombre_guardado" value="{{ $tipodocumentacion->nombre_guardado }}" required
                                autofocus autocomplete="nombre guardado" />
                        </div>
                        <div>
                            <x-jet-label for="tiene_vigencia" value="Tiene Vigencia" class="text-white" />
                            <select id="tiene_vigencia" class="block w-full mt-1" type="text"
                                name="tiene_vigencia" required>
                                <option value="1" selected>Con Vigencia</-option>
                                <option value="0">Sin vigencia</-jet-option>
                            </select>
                        </div>
                        <div>
                            <x-jet-label for="vigencia" value="Vigencia en días" class="text-white" />
                            <input id="fecha_vigencia" class="block mt-1" type="number" min="0"
                                max="731" name="fecha_vigencia"
                                value="{{ $tipodocumentacion->fecha_vigencia }}" autofocus
                                autocomplete="fecha_vigencia" />
                        </div>
                        <div>
                            <x-jet-label for="obligatorio" value="Obligatorio" class="text-white" />
                            <input id="obligatorio" class="block mt-1" type="checkbox" name="obligatorio"
                                value="{{ $tipodocumentacion->obligatorio }}"
                                {{ $tipodocumentacion->obligatorio == '1' ? 'checked' : '' }} autofocus
                                autocomplete="Obligatorio" />
                        </div>

                        <div>
                            <x-jet-label for="creado_por" value="Creado por" class="text-white" />
                            <input id="creado_por_nombre" class="block w-full mt-1" type="text" @readonly(true)
                                name="creado_por_nombre" value="{{ $usuario->name }}" autofocus
                                autocomplete="creado_por_nombre" />
                            <x-jet-input id="creado_por" class="block w-full mt-1" type="hidden" name="creado_por"
                                value="{{ $user->id }}" required autofocus autocomplete="creado_por" />
                        </div>
                        <div class="flex items-center justify-end mt-4">



                            <x-jet-button class="ml-4">
                                {{ __('Editar Tipo de Documento') }}
                            </x-jet-button>
                            <x-jet-button type="button" class="ml-4"
                                onclick="window.location.href='{{ route('tipodocumentacions.index') }}'">
                                {{ __('Volver') }}
                                </x-jet->
                        </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $("#global").change(function() {
            if ($(this).val() == 1) {
                $("#pais_id").prop("disabled", true);
                //$("#especie_id").prop("disabled", true);
            } else {
                $("#pais_id").prop("disabled", false);
                //$("#especie_id").prop("disabled", false);
            }
        });
    </script>

</x-app-layout>
