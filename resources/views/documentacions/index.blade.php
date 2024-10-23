@php
    use App\Models\User;
@endphp
<x-app-layout>
    <link href="
https://cdn.jsdelivr.net/npm/sweetalert2@11.14.3/dist/sweetalert2.min.css
" rel="stylesheet">
    <x-slot name="header">
        <div class="flex justify-end">
            <a href="{{ route('documentacions.create') }}">
                <button
                    class="items-center px-6 py-3 ml-auto bg-gray-500 rounded focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 hover:bg-gray-500 focus:outline-none">
                    <p class="text-sm font-medium leading-none text-white">Subir Documentación Productores</p>
                </button>
            </a>
            <input type="text" id="searchInput" class="items-center py-3 ml-auto px-36" wire:model="search"
                placeholder="Buscar Productor por CSG o Nombre">

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


        {{-- @forelse ($paises as $pais)
            <h3 class="my-4 text-2xl font-bold text-left">{{ $pais->nombre }}
                @forelse ($especies as  $especie)
                    - {{ $especie->name }}
                @empty
            </h3>
        @endforelse
    @empty
        @endforelse --}}


        <x-table-responsive>

            <table class="min-w-full pb-20 mb-20 divide-y divide-gray-200" id="tblProductores">

                <thead class="rounded-full bg-gray-50">
                    <th>N°</th>
                    <th>Productor</th>
                    <th>CSG</th>
                    <th>RUT</th>

                </thead>
                <tbody>


                    @forelse ($productores as $productor)
                        {{-- comment  --}}
                        <tr tabindex="0" class="h-16 border border-gray-100 rounded focus:outline-none">
                            <td class="text-left">
                                <p class="mr-2 text-base font-medium leading-none text-gray-700">
                                    {{ $productor->id }}
                                </p>
                            </td>
                            <td class="text-left">
                                <p class="mr-2 text-base font-medium leading-none text-gray-700">
                                    {{ $productor->name }}
                                </p>
                            </td>
                            <td class="text-center">
                                <p class="mr-2 text-base font-medium leading-none text-gray-700">
                                    {{ $productor->csg }}
                                </p>
                            </td>
                            <td class="text-center">
                                <p class="mr-2 text-base font-medium leading-none text-gray-700">
                                    {{ $productor->rut }}
                                </p>
                            </td>

                            <td width='120px'>
                                <a href="#">
                                    <button
                                        class="items-center px-6 py-3 ml-auto bg-gray-500 rounded focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 hover:bg-gray-500 focus:outline-none"
                                        id="verDocumentos" data-id="{{ $productor->id }}"
                                        data-nombre="{{ $productor->name }}">
                                        <p class="text-sm font-medium leading-none text-white">Ver
                                            Documentación</p>
                                    </button>

                                </a>
                            </td>

                            {{-- <td width='120px'>
                                <form action="{{ route('tipodocumentacions.destroy', $tipodocumentacion) }}"
                                    method="POST">
                                    @method('delete')
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $tipodocumentacion->id }}">
                                    <button class="btn btn-danger" type='submit'>Eliminar</button>
                                </form>
                            </td> --}}


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
                    @endforelse






                </tbody>
            </table>
        </x-table-responsive>
        |
        {{-- @livewire('tipodocumentacions.show') --}}

    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).on('click', '#verDocumentos', function() {
            var productorId = $(this).data('id');
            var productorNombre = $(this).data('nombre');
            Swal.fire({
                title: "Documentos de " + productorNombre,
                width: '70%',
                height: '70%',
                html: '<div id="contenedor-listado"></div>',
                showClass: {
                    popup: `
                animate__animated
                animate__fadeInUp
                animate__faster
                `
                },
                hideClass: {
                    popup: `
                animate__animated
                animate__fadeOutDown
                animate__faster
                `
                }
            });
            $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    url: '/documentacions/obtenerDocumentoxProductor',
                    data: {
                        ids: productorId,
                    }
                })
                .done(function(response) {
                    console.log(response);
                    generarListado(response, productorNombre, productorId);
                    // $("#nombredocto").val(response.nombre);
                    // $("#descripciondocto").val(response.descripcion);
                    // $("#tipodocto").val(response.tipo_documentacion_id);
                    // $("#doctoid").val(response.id);
                    // $("#doctofecha_vigencia").val(response.fecha_vigencia);
                    // $("#agregardocto").val("MODIFICAR");
                })
                .fail(function(response) {
                    console.log(response);
                });
        });

        $('#searchInput').on('keyup', function() {
            var value = $(this).val().toLowerCase(); // Obtiene el valor del input y lo convierte a minúsculas
            $('#tblProductores tbody tr').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -
                    1) // Muestra/oculta las filas basadas en la búsqueda
            });
        });

        function generarListado(data, productorNombre, productorId) {
            // Limpiar el contenedor donde se mostrará la tabla
            $('#contenedor-listado').empty();
            var separador = "<hr class='my-4' />";
            // Agrupar los documentos por país y especie
            data.paises.forEach(function(pais) {
                // Crear encabezado del país
                var paisHTML = `<h3>${pais.nombre}`;
                // $('#contenedor-listado').append(paisHTML);

                // Filtrar las especies relacionadas con el país
                var especiesRelacionadas = data.especies.filter(function(especie) {
                    return data.tipos.some(function(tipo) {
                        return tipo.pais_id == pais.id && tipo.especie_id == especie.id;
                    });
                });

                especiesRelacionadas.forEach(function(especie) {
                    // Crear encabezado de especie dentro del país

                    var especieHTML =
                        `<h3 class="my-4 text-2xl font-bold text-left">${pais.nombre} - ${especie.name}</h3>`;
                    $('#contenedor-listado').append(separador);
                    $('#contenedor-listado').append(especieHTML);
                    // $('#contenedor-listado').append(especieHTML);

                    // Obtener los documentos asociados a esta especie y país
                    var documentosRelacionados = data.documentos.filter(function(documento) {
                        return documento.tipo_documentacion.especie_id == especie.id &&
                            documento.tipo_documentacion.pais_id == pais.id;
                    });

                    // Crear la tabla para los documentos
                    if (documentosRelacionados.length > 0) {

                        var tablaHTML = `
                    <table class="min-w-full pb-20 mb-20 divide-y divide-gray-200">
                        <thead clas="rounded-full bg-gray-50">
                            <tr>
                                <th></th>
                                <th>ID</th>
                                <th>Nombre Documento</th>
                                <th>Fecha</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                `;

                        documentosRelacionados.forEach(function(documento) {
                            var fechaFormateada = formatearFecha(documento.created_at);
                            tablaHTML += `
                        <tr>
                            <td><input type="checkbox" class="form-checkbox" id="check${documento.id}" name="check${documento.id}" value="${documento.id}"></td>
                            <td class="text-center"><p class="mr-2 text-base font-medium leading-none text-gray-700">${documento.id}</p></td>
                            <td class="text-center"><p class="mr-2 text-base font-medium leading-none text-gray-700">${documento.tipo_documentacion.nombre}</p></td>
                            <td class="text-center"><p class="mr-2 text-base font-medium leading-none text-gray-700">${fechaFormateada}</p></td>
                            <td>
                                <!-- Aquí puedes agregar un botón de descarga, ver, o lo que necesites -->
                                 <form action="{{ route('documentacions.edit') }}" method="POST">
                               <a href="{{ asset('storage') }}/${documento.file}"
                                                            target="_blank" title="Ver Documento"
                                                            class="mb-2 ml-2 text-2xl text-green-500 cursor-pointer fa-solid fas fa-file-pdf">

                                                        </a>

                                                            @csrf
                                                            <input type="hidden" name="id" value="${documento.id}">
                                                            <input type="hidden" name="user_id" value="${productorId}">
                                                            <button type="submit" class="mb-2 ml-2 text-2xl text-gray-500 cursor-pointer fa-solid fas fa-edit"></button>
                                                            </form>


                            </td>
                        </tr>
                    `;
                        });

                        tablaHTML += `</tbody></table>`;
                        $('#contenedor-listado').append(tablaHTML);

                    } else {
                        $('#contenedor-listado').append(
                            '<p>No hay documentos disponibles para esta especie y país.</p>');
                    }
                });
            });
            var descargaSeleccionados =
                "<hr/><br/><button id='btn-procesar' type='button' class='mb-2 ml-2 text-2xl text-gray-500 cursor-pointer fa-solid fas fa-download'>Descargar Seleccionados</button>";
            var productor =
                "<input type = 'hidden' name = 'productor' id = 'productor'             value = '" + productorNombre +
                "' >";
            $('#contenedor-listado').append(productor);
            $('#contenedor-listado').append(descargaSeleccionados);
        }

        function formatearFecha(fechaISO) {
            var fecha = new Date(fechaISO);
            var dia = ('0' + fecha.getDate()).slice(-2); // Añadir cero delante si es necesario
            var mes = ('0' + (fecha.getMonth() + 1)).slice(-2); // Meses en JavaScript van de 0 a 11, sumamos 1
            var anio = fecha.getFullYear();
            var horas = ('0' + fecha.getHours()).slice(-2);
            var minutos = ('0' + fecha.getMinutes()).slice(-2);

            return `${dia}-${mes}-${anio} ${horas}:${minutos}`;
        }
        $(document).on('click', '#btn-procesar', function() {
            // Obtener los checkboxes seleccionados de la tabla 1
            var seleccionados = [];
            $('.form-checkbox:checked').each(function() {
                seleccionados.push($(this).val());
            });


            $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'POST',
                    url: '/documentacions/descargaSeleccionados',
                    data: {
                        seleccionados: seleccionados,
                        nombre: $("#productor").val()
                    }
                })
                .done(function(response) {
                    console.log(response);
                    window.open(response.url, '_blank');
                    // $("#nombredocto").val(response.nombre);
                    // $("#descripciondocto").val(response.descripcion);
                    // $("#tipodocto").val(response.tipo_documentacion_id);
                    // $("#doctoid").val(response.id);
                    // $("#doctofecha_vigencia").val(response.fecha_vigencia);
                    // $("#agregardocto").val("MODIFICAR");
                })
                .fail(function(response) {
                    console.log(response);
                });
        });
    </script>
</x-app-layout>
