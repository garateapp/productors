<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Editar Documento') }}
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
                    {!! Form::open([
                        'route' => 'documentacions.store',
                        'files' => true,
                        'autocomplete' => 'off',
                        'method' => 'POST',
                    ]) !!}
                    {!! Form::label('name', '¿Posee alguna documentación que desee subir?', [
                        'class' => 'font-bold text-center text-white',
                    ]) !!}


                    <div>

                        <div class="mb-2 form-group">

                            <div class="mb-2 form-group">
                                <input id="user_id" data-name = 'productor' class="block w-full mt-1" type="hidden"
                                    name="user_id" required value="{{ $documento->user_id }}">
                                <input id="user_nombre" data-name = 'productor' class="block w-full mt-1" type="hidden"
                                    name="user_nombre" required value="{{ $productores->name }}" />

                            </div>
                            <div class="mb-2 form-group">
                                <select id="tipodocto" data-name = 'doctotipo' class="block w-full mt-1" type="text"
                                    name="tipo" required>
                                    <option value="">Seleccione un Tipo de Documento</option>
                                    @foreach ($tipodocumentacions as $tipodocumentacion)
                                        <option value="{{ $tipodocumentacion->id }}"
                                            {{ $documento->tipo_documentacion_id == $tipodocumentacion->id ? 'selected' : '' }}>
                                            {{ $tipodocumentacion->pais->nombre }} -
                                            {{ $tipodocumentacion->especie->name }} -
                                            {{ $tipodocumentacion->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('name')
                                <span class="font-bold text-red-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="mb-2 form-group">
                            <input name="id" id="doctoid" type="hidden" value="{{ $documento->id }}"
                                data-name="doctoid" />
                            <input name="nombre" id="nombredocto" type="text" class="'mt-1 block w-full rounded-lg"
                                placeholder="Nombre de Documento" value="{{ $documento->nombre }}" required
                                data-name="doctonombre" />

                            @error('name')
                                <span class="font-bold text-red-500 text-">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- {!! Form::hidden('rut', $user->rut) !!} --}}






                        <div class="mb-2 form-group">

                            <input name="descripcion" id="descripciondocto" value="Editado por Administrador"
                                class="'mt-1 block w-full rounded-lg" required class='block w-full mt-1 rounded-lg'
                                placeholder='Descripción del Documento' type="hidden"></input>


                        </div>
                        <div class="mb-2 form-group">
                            {!! Form::label('fecha_vigencia', 'Fecha Vigencia', ['class' => 'font-bold text-center text-white']) !!}
                            <input name="fecha_vigencia" id="doctofecha_vigencia" type="date"
                                class="'mt-1 block w-full rounded-lg" value="{{ $documento->fecha_vigencia }}" />
                        </div>
                        <div class="mb-2 form-group">
                            {!! Form::label('file', 'Foto o Documento', ['class' => 'font-bold text-center text-white']) !!}
                            {!! Form::file('file', [
                                'class' => 'form-input w-full' . ($errors->has('file') ? ' border-red-600' : ''),
                                'id' => 'file',
                                'accept' => 'file/*',
                            ]) !!}
                        </div>
                        <br />
                        <button class="ml-4 button" type="submit">
                            {{ __('Editar Documento') }}
                        </button>
                        <x-jet-button type="button" class="ml-4"
                            onclick="window.location.href='{{ route('documentacions.index') }}'">
                            {{ __('Volver') }}
                        </x-jet-button>
                    </div>

                    {!! Form::close() !!}

                </div>
            </div>

        </div>


</x-app-layout>
