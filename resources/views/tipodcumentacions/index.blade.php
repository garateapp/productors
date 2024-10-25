@php
    use App\Models\User;
@endphp
<x-app-layout>
    <x-slot name="header">

    </x-slot>
    <div class="px-4 py-4 bg-white md:py-7 md:px-8 xl:px-10 ">

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


        <div class="flex justify-end">
            <a href="{{ route('tipodocumentacions.create') }}">
                <button
                    class="items-center px-6 py-3 ml-auto bg-gray-500 rounded focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 hover:bg-gray-500 focus:outline-none">
                    <p class="text-sm font-medium leading-none text-white">Crear Tipo de Documento</p>
                </button>
            </a>
        </div>
        <div class="flex justify-end">
            <h4 class="ss="text-lg font-medium leading-6 text-gray-900">Documentos Globales</h4>
        </div>
        <table class="min-w-full pb-20 mb-20 divide-y divide-gray-200">

            <thead class="rounded-full bg-gray-50">
                <th>ID</th>
                {{-- <th>Especie</th> --}}
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Estado</th>
                <th>Obligatorio</th>
            </thead>
            <tbody>
                @forelse ($tiposglobales as $tipoglobal)
                    <tr tabindex="0" class="h-16 border border-gray-100 rounded focus:outline-none">
                        <td class="text-center">
                            <p class="mr-2 text-base font-medium leading-none text-gray-700">
                                {{ $tipoglobal->id }}
                            </p>
                        </td>

                        <td class="text-center">
                            <p class="mr-2 text-base font-medium leading-none text-gray-700">
                                {{ $tipoglobal->nombre_guardado }}
                            </p>
                        </td>
                        {{-- <td class="text-center">
                        <p class="mr-2 text-base font-medium leading-none text-gray-700">
                            {{ $tipodocumentacion->descripcion }}
                        </p>
                    </td> --}}
                        <td class="text-center">
                            <p class="mr-2 text-base font-medium leading-none text-gray-700">
                                {{ $tipoglobal->estado == 1 ? 'ACTIVO' : 'INACTIVO' }}
                            </p>
                        </td>
                        {{-- <td class="text-center">
                        <p class="mr-2 text-base font-medium leading-none text-gray-700">
                            {{ $tipodocumentacion->nombre_guardado }}
                        </p>
                    </td> --}}

                        <td class="text-center">
                            <p class="mr-2 text-base font-medium leading-none text-gray-700">
                                {{ $tipoglobal->obligatorio == 1 ? 'SI' : 'NO' }}
                            </p>
                        </td>
                        {{-- <td class="text-center">
                        <p class="mr-2 text-base font-medium leading-none text-gray-700">
                            {{ User::find($tipodocumentacion->creado_por)->name }}
                        </p>
                    </td> --}}

                        <td width='120px'>
                            <a href="{{ route('tipodocumentacions.edit', $tipoglobal) }}">
                                <button
                                    class="items-center px-6 py-3 ml-auto bg-gray-500 rounded focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 hover:bg-gray-500 focus:outline-none">
                                    <p class="text-sm font-medium leading-none text-white">EDITAR</p>
                                </button>
                            </a>
                        </td>

                        <td width='120px'>
                            <form action="{{ route('tipodocumentacions.destroy', $tipoglobal) }}" method="POST">
                                @method('delete')
                                @csrf
                                <input type="hidden" name="id" value="{{ $tipoglobal->id }}">
                                <button class="btn btn-danger" type='submit'>Eliminar</button>
                            </form>
                        </td>


                    </tr>
                @empty


                    {{-- comment  --}}
                    <tr tabindex="0" class="h-16 border border-gray-100 rounded focus:outline-none">
                        <td class="text-center">
                            <p class="mr-2 text-base font-medium leading-none text-gray-700">


                                -


                            </p>

                        </td>
                        <td class="text-center">
                            <p class="mr-2 text-base font-medium leading-none text-gray-700">


                                No hay ningun Tipo de Documentación Global


                            </p>

                        </td>

                    </tr>
                @endforelse ($tiposglobales as $tipoglobal)
            </tbody>
        </table>
        <x-table-responsive>
            <table class="min-w-full pb-20 mb-20 divide-y divide-gray-200">

                <thead class="rounded-full bg-gray-50">
                    <th>ID</th>
                    <th>País</th>
                    <th>Especie</th>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Obligatorio</th>

                </thead>
                <tbody>


                    @forelse ($tipos as $tipodocumentacion)
                        {{-- comment  --}}
                        <tr tabindex="0" class="h-16 border border-gray-100 rounded focus:outline-none">
                            <td class="text-center">
                                <p class="mr-2 text-base font-medium leading-none text-gray-700">
                                    {{ $tipodocumentacion->id }}
                                </p>
                            </td>
                            <td class="text-center">
                                <p class="mr-2 text-base font-medium leading-none text-gray-700">
                                    {{ $tipodocumentacion->Pais->nombre }}
                                </p>
                            </td>
                            <td class="text-center">
                                <p class="mr-2 text-base font-medium leading-none text-gray-700">
                                    {{ $tipodocumentacion->especie->name }}
                                </p>
                            </td>
                            <td class="text-center">
                                <p class="mr-2 text-base font-medium leading-none text-gray-700">
                                    {{ $tipodocumentacion->nombre_guardado }}
                                </p>
                            </td>
                            {{-- <td class="text-center">
                                <p class="mr-2 text-base font-medium leading-none text-gray-700">
                                    {{ $tipodocumentacion->descripcion }}
                                </p>
                            </td> --}}
                            <td class="text-center">
                                <p class="mr-2 text-base font-medium leading-none text-gray-700">
                                    {{ $tipodocumentacion->estado == 1 ? 'ACTIVO' : 'INACTIVO' }}
                                </p>
                            </td>
                            {{-- <td class="text-center">
                                <p class="mr-2 text-base font-medium leading-none text-gray-700">
                                    {{ $tipodocumentacion->nombre_guardado }}
                                </p>
                            </td> --}}

                            <td class="text-center">
                                <p class="mr-2 text-base font-medium leading-none text-gray-700">
                                    {{ $tipodocumentacion->obligatorio == 1 ? 'SI' : 'NO' }}
                                </p>
                            </td>
                            {{-- <td class="text-center">
                                <p class="mr-2 text-base font-medium leading-none text-gray-700">
                                    {{ User::find($tipodocumentacion->creado_por)->name }}
                                </p>
                            </td> --}}

                            <td width='120px'>
                                <a href="{{ route('tipodocumentacions.edit', $tipodocumentacion) }}">
                                    <button
                                        class="items-center px-6 py-3 ml-auto bg-gray-500 rounded focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 hover:bg-gray-500 focus:outline-none">
                                        <p class="text-sm font-medium leading-none text-white">EDITAR</p>
                                    </button>
                                </a>
                            </td>

                            <td width='120px'>
                                <form action="{{ route('tipodocumentacions.destroy', $tipodocumentacion) }}"
                                    method="POST">
                                    @method('delete')
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $tipodocumentacion->id }}">
                                    <button class="btn btn-danger" type='submit'>Eliminar</button>
                                </form>
                            </td>


                        </tr>


                    @empty


                        {{-- comment  --}}
                        <tr tabindex="0" class="h-16 border border-gray-100 rounded focus:outline-none">
                            <td class="text-center">
                                <p class="mr-2 text-base font-medium leading-none text-gray-700">


                                    -


                                </p>

                            </td>
                            <td class="text-center">
                                <p class="mr-2 text-base font-medium leading-none text-gray-700">


                                    No hay ningun Tipo de Documentación registrado


                                </p>

                            </td>

                        </tr>
                    @endforelse ($tipos as $tipodocumentacion)






                </tbody>
            </table>
        </x-table-responsive>
        |
        {{-- @livewire('tipodocumentacions.show') --}}

    </div>



</x-app-layout>
