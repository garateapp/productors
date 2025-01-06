@php
    use App\Models\User;
@endphp
<x-app-layout>
    <link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.14.3/dist/sweetalert2.min.css
" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <x-slot name="header">
        <div class="flex justify-end">
            <a href="{{ route('valor.create') }}">
                <button
                    class="items-center px-6 py-3 ml-auto bg-gray-500 rounded focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 hover:bg-gray-500 focus:outline-none">
                    <p class="text-sm font-medium leading-none text-white">Daños</p>
                </button>
            </a>
            <input type="text" id="searchInput" class="items-center py-3 ml-auto px-36" placeholder="Buscar">

        </div>

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
            <a href="{{ route('valor.create') }}">
                <button
                    class="items-center px-6 py-3 ml-auto bg-gray-500 rounded focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 hover:bg-gray-500 focus:outline-none">
                    <p class="text-sm font-medium leading-none text-white">Crear Daño</p>
                </button>
            </a>
        </div>

        <table class="min-w-full pb-20 mb-20 divide-y divide-gray-200">

            <thead class="rounded-full bg-gray-50">
                <th>ID</th>
                {{-- <th>Especie</th> --}}
                <th>Especie</th>
                <th>Parametro</th>
                <th>Valor</th>

            </thead>
            <tbody id="tableBody">
                @foreach ($dagnos as $dagno)

                    <tr>
                        <td class="text-center">{{ $dagno->id }}</td>
                        <td class="text-center">{{ $dagno->especie }}</td>
                        <td class="text-center">{{ $dagno->parametro }}</td>
                        <td class="text-center">{{ $dagno->name }}</td>


                        <td class="text-center">
                            <form action="{{ route('valor.destroy', $dagno->id) }}" method="POST" style="display: inline;">
                            <a href="{{ route('valor.edit',$dagno->id) }}" class="text-white">
                                <button
                                    class="items-center px-6 py-2 ml-auto bg-green-500 rounded focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 hover:bg-gray-500 focus:outline-none">
                                    Editar
                                </button>
                            </a>

                                @csrf
                                @method('DELETE') <!-- Indica que es una solicitud DELETE -->
                                <button type="submit" class="items-center px-6 py-2 ml-auto bg-red-500 rounded btn focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 hover:bg-gray-500">
                                    Eliminar
                                </button>
                            </form>

                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>


 <!-- Delete User Confirmation Modal -->


 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
 <script>

    // Capturamos el input de búsqueda
    $(document).ready(function () {
        // Detectar cambios en el input de búsqueda
        $('#searchInput').on('keyup', function () {
            var searchTerm = $(this).val().toLowerCase();

            // Iterar sobre cada fila del tbody
            $('#tableBody tr').filter(function () {
                // Mostrar u ocultar la fila según el texto
                $(this).toggle($(this).text().toLowerCase().indexOf(searchTerm) > -1);
            });
        });
    });
     </script>
</x-app-layout>
