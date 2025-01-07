<div>
    @php
        $cant = 0;
        $cant2 = 0;
        foreach ($allrecepcions as $recepcion) {
            $cant += $recepcion->peso_neto;
        }
        foreach ($allsubrecepcions as $recepcion) {
            $cant2 += $recepcion->peso_neto;
        }

    @endphp
    <div class="pb-12">
        <div class="w-full sm:px-6">
            <div class="flex justify-center mt-2">
                <div>
                    @if ($temporada == 'actual')
                        <button
                            class="items-center px-6 py-3 mx-2 bg-red-500 rounded focus:ring-2 focus:ring-offset-2 focus:red-green-500 sm:mt-0 hover:bg-red-500 focus:outline-none">
                            <p class="text-sm font-medium leading-none text-white">T24/25</p>
                        </button>
                    @else
                        <a href="{{ route('productioncc.index') }}">
                            <button
                                class="items-center px-6 py-3 mx-2 bg-green-500 rounded focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 hover:bg-green-500 focus:outline-none">
                                <p class="text-sm font-medium leading-none text-white">T24/25</p>
                            </button>
                        </a>
                    @endif


                </div>
                <div>
                    @if ($temporada == 'anterior')
                        <button
                            class="items-center px-6 py-3 mx-2 bg-red-500 rounded focus:ring-2 focus:ring-offset-2 focus:red-green-500 sm:mt-0 hover:bg-red-500 focus:outline-none">
                            <p class="text-sm font-medium leading-none text-white">T23/24</p>
                        </button>
                    @else
                        <a href="{{ route('productioncc.index.anterior') }}">
                            <button
                                class="items-center px-6 py-3 mx-2 bg-green-500 rounded focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 hover:bg-green-500 focus:outline-none">
                                <p class="text-sm font-medium leading-none text-white">T23/24</p>
                            </button>
                        </a>
                    @endif
                </div>
            </div>
            <div class="px-6 py-4">
                <input wire:keydown="limpiar_page" wire:model="search"
                    class="flex-1 w-full h-10 px-5 pr-16 bg-white border-2 border-gray-300 rounded-lg shadow-sm form-input focus:outline-none"
                    placeholder="Ingrese la variedad, especie o lote de la recepción" autocomplete="off">
            </div>

            <div
                class="grid content-center justify-between grid-cols-3 mx-2 sm:mx-12 md:mx-14 sm:grid-cols-3 md:grid-cols-6 lg:grid-cols-9 gap-y-4 gap-x-3">
                @if ($espec)
                    <button wire:click="espec_clean"
                        class="items-center content-center px-3 py-3 rounded focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 hover:bg-gray-500 focus:outline-none"
                        style="background-color: #FF8000;">
                        <p class="text-sm font-medium leading-none text-white">{{ $espec->name }}</p>
                    </button>

                    @if ($variedades)

                        @if ($varie)
                            <button wire:click="varie_clean"
                                class="items-center px-3 py-3 rounded focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 hover:bg-gray-500 focus:outline-none"
                                style="background-color: #008d39;">
                                <p class="text-sm font-medium leading-none text-white whitespace-nowrap">
                                    {{ $varie->name }}</p>
                            </button>
                        @else
                            @foreach ($variedades as $variedad)
                                @if ($variedad->especie_id == $espec->id)
                                    <div class="flex justify-center">
                                        <button wire:click="set_varie({{ $variedad->id }})"
                                            class="items-center w-full px-2 py-3 rounded focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 hover:bg-gray-500 focus:outline-none"
                                            style="background-color: #008d39;">
                                            <p class="text-sm font-medium leading-none text-white whitespace-nowrap">
                                                {{ $variedad->name }}</p>
                                        </button>
                                    </div>
                                @endif
                            @endforeach
                        @endif


                    @endif
                @else
                    @foreach ($especies as $especie)
                        <div class="justify-center ">
                            <button wire:click="set_especie({{ $especie->id }})"
                                class="items-center w-full px-4 py-3 rounded focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 hover:bg-gray-500 focus:outline-none"
                                style="background-color: #008d39;">
                                <p class="text-sm font-medium leading-none text-white whitespace-nowrap">
                                    {{ $especie->name }}</p>
                            </button>
                        </div>
                    @endforeach

                @endif

            </div>

            <div class="items-center justify-between my-2 sm:flex">

                <div class="flex justify-between">


                </div>



                @if (IS_NULL($recep))


                    <h1 class="hidden mx-6 my-4 text-sm text-center"><b>Ultima Sincronizacion:</b>
                        {{ date('d M Y g:i a', strtotime($sync->fecha)) }} <b>Tipo:</b> {{ $sync->tipo }}
                        <b>Cantidad:</b> {{ $sync->cantidad }}</h1>



                    <div class="flex items-center content-center justify-center mb-2">
                        <a href="{{ route('production.refresh') }}">
                            <button
                                class="items-center hidden px-6 py-3 bg-gray-500 rounded focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 hover:bg-gray-500 focus:outline-none">
                                <p class="text-sm font-medium leading-none text-white">FX IMPORT</p>
                            </button>
                        </a>
                        <a href="{{ route('danos.greenvic') }}">
                            <button
                                class="items-center px-6 py-3 mx-2 bg-gray-500 rounded focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 hover:bg-gray-600 focus:outline-none">
                                <p class="text-sm font-medium leading-none text-white">Subir Recepción Greenvic</p>
                            </button>
                        </a>

                        <a href="{{ route('danos.index') }}">
                            <button
                                class="items-center px-6 py-3 mx-2 bg-gray-500 rounded focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 hover:bg-gray-600 focus:outline-none">
                                <p class="text-sm font-medium leading-none text-white">Reporte de Calidad</p>
                            </button>
                        </a>
                        <select wire:model="ctd"
                            class="max-w-xl px-6 py-3 mx-2 text-gray-700 bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="25" class="px-10 text-left">25 </option>
                            <option value="50" class="px-10 text-left">50 </option>
                            <option value="100" class="px-10 text-left">100 </option>
                            <option value="500" class="px-10 text-left">500 </option>

                        </select>
                    </div>
                @else
                    <h1 class="text-center">
                        @if ($recep->fecha_g_recepcion)
                            {{ date('d M Y g:i a', strtotime($recep->fecha_g_recepcion)) }}
                        @endif
                    </h1>

                @endif
            </div>





            <div class="px-4 py-4 bg-white md:py-7 md:px-8 xl:px-10">
                <x-table-responsive>
                    <table class="min-w-full pb-20 mb-20 divide-y divide-gray-200">

                        <thead class="rounded-full bg-gray-50">
                            <th>ID</th>
                            <th>Agricola</th>
                            <th>Especie</th>
                            <th>Variedad</th>
                            <th class="text-center">Fecha</th>
                            <th class="text-center">Guia</th>
                            <th class="text-center">Cantidad</th>
                            <th>Kilos</th>
                            <th class="text-center">Nota</th>


                        </thead>
                        <tbody>
                            @php
                                $n = 1;
                            @endphp

                            @foreach ($recepcions as $recepcion)
                                <tr class="h-5 text-white" style="background-color: #74b72f;">
                                    <td class="my-4 text-white">
                                        {{-- Agregar: --}}
                                    </td>
                                    <td class="items-center content-center pb-1">
                                        <div class="flex justify-center ">
                                            <a href="{{ route('observacion.externa', $recepcion) }}" target="_blank">
                                                <div
                                                    class="px-2 py-1 mt-1 text-xs leading-none text-center text-gray-600 bg-gray-100 rounded cursor-pointer focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 hover:bg-gray-200 focus:outline-none">
                                                    Observación
                                                </div>
                                            </a>
                                        </div>
                                        @if ($recepcion->calidad!=null && $recepcion->calidad->obs_ext)
                                            <div class="flex justify-center ">
                                                <div
                                                    class="px-2 py-1 mx-12 mt-1 mb-1 text-xs leading-none text-center text-gray-600 bg-gray-100 rounded cursor-pointer focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 hover:bg-gray-200 focus:outline-none">
                                                    {{ Str::limit($recepcion->calidad->obs_ext, 30) }}
                                                </div>
                                            </div>
                                        @endif

                                    </td>
                                    <td class="items-center content-center justify-center pb-1">
                                        <div
                                            class="px-2 py-1 mx-6 mt-1 mb-1 text-xs leading-none text-center text-gray-600 bg-gray-100 rounded cursor-pointer focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 hover:bg-gray-200 focus:outline-none">
                                            Obs Int
                                        </div>

                                    </td>
                                    <td>

                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>

                                </tr>
                                @if ($recep)
                                    @if ($recep->id == $recepcion->id)
                                        <tr tabindex="0" wire:click="clean_recep()"
                                            class="h-16 text-white border border-gray-100 rounded cursor-pointer focus:outline-none"
                                            style="background-color: #008d39;">
                                            <td class="text-center">

                                                <p class="mr-2 text-base font-medium leading-none">






                                                    @if ($recepcion->numero_g_recepcion)
                                                        Lote: {{ $recepcion->numero_g_recepcion }}
                                                    @endif


                                                </p>

                                            </td>
                                            <td class="text-center">
                                                <p class="mr-2 text-base font-medium leading-none">



                                                    @if ($recepcion->n_emisor)
                                                        {{ $recepcion->n_emisor }}
                                                    @endif


                                                </p>

                                            </td>
                                            <td class="">
                                                <div class="flex items-center pl-5">
                                                    <p class="mr-2 text-base font-medium leading-none">


                                                        @if ($recepcion->n_especie)
                                                            {{ $recepcion->n_especie }}
                                                        @endif


                                                    </p>

                                                </div>
                                            </td>
                                            <td class="pl-5">
                                                <div class="flex items-center text-center whitespace-nowrap">

                                                    <p class="ml-2 text-sm leading-none whitespace-nowrap">

                                                        @if ($recepcion->n_variedad)
                                                            {{ $recepcion->n_variedad }}
                                                        @endif
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="pl-5 text-center whitespace-nowrap">
                                                <p
                                                    class="mr-2 text-base font-medium leading-none text-center whitespace-nowrap">


                                                    @if ($recepcion->fecha_g_recepcion)
                                                        {{ date('d M Y g:i a', strtotime($recepcion->fecha_g_recepcion)) }}
                                                    @endif

                                                </p>

                                            </td>

                                            <td class="text-center">

                                                <p class="text-base ">



                                                    @if ($recepcion->numero_documento_recepcion)
                                                        {{ $recepcion->numero_documento_recepcion }}
                                                    @endif

                                                </p>

                                            </td>
                                            <td class="pl-5 whitespace-nowrap">
                                                <p
                                                    class="flex mr-2 text-base font-medium leading-none whitespace-nowrap">



                                                    @if ($recepcion->cantidad)
                                                        {{ number_format($recepcion->cantidad) }}
                                                    @endif

                                                </p>

                                            </td>

                                            <td class="pl-5">


                                                @if ($recepcion->peso_neto)
                                                    {{ number_format($recepcion->peso_neto) }}
                                                @endif






                                            </td>

                                            <td class="pl-5 text-center">

                                                @if ($recepcion->nota_calidad == 0)
                                                    S/N
                                                @elseif($recepcion->nota_calidad)
                                                    {{ number_format($recepcion->nota_calidad) }}
                                                @endif



                                            </td>



                                            @if ($recepcion->n_estado == 'CERRADO')
                                                <td class="justify-center text-center">

                                                    <a href="{{ route('informe.download', $recepcion) }}"
                                                        target="_blank">
                                                        <img class="w-10 mx-auto my-2"
                                                            src="{{ asset('image/pdf_icon2.png') }}"
                                                            title="Descargar" alt="">
                                                    </a>


                                                </td>
                                            @else
                                                <td>
                                                    <div class="relative px-2 pt-2">
                                                        <button class="rounded-md focus:ring-2 focus:outline-none"
                                                            onclick="dropdownFunction(this)" role="button"
                                                            aria-label="option">
                                                            <svg class="dropbtn" onclick="dropdownFunction(this)"
                                                                xmlns="http://www.w3.org/2000/svg" width="20"
                                                                height="20" viewBox="0 0 20 20" fill="none">
                                                                <path
                                                                    d="M4.16667 10.8332C4.62691 10.8332 5 10.4601 5 9.99984C5 9.5396 4.62691 9.1665 4.16667 9.1665C3.70643 9.1665 3.33334 9.5396 3.33334 9.99984C3.33334 10.4601 3.70643 10.8332 4.16667 10.8332Z"
                                                                    stroke="#9CA3AF" stroke-width="1.25"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                </path>
                                                                <path
                                                                    d="M10 10.8332C10.4602 10.8332 10.8333 10.4601 10.8333 9.99984C10.8333 9.5396 10.4602 9.1665 10 9.1665C9.53976 9.1665 9.16666 9.5396 9.16666 9.99984C9.16666 10.4601 9.53976 10.8332 10 10.8332Z"
                                                                    stroke="#9CA3AF" stroke-width="1.25"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                </path>
                                                                <path
                                                                    d="M15.8333 10.8332C16.2936 10.8332 16.6667 10.4601 16.6667 9.99984C16.6667 9.5396 16.2936 9.1665 15.8333 9.1665C15.3731 9.1665 15 9.5396 15 9.99984C15 10.4601 15.3731 10.8332 15.8333 10.8332Z"
                                                                    stroke="#9CA3AF" stroke-width="1.25"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                </path>
                                                            </svg>
                                                        </button>
                                                        <div
                                                            class="absolute right-0 z-30 hidden w-24 mr-6 bg-white shadow dropdown-content">
                                                            <div tabindex="0"
                                                                class="w-full px-4 py-4 text-xs cursor-pointer focus:outline-none focus:text-indigo-600 hover:bg-indigo-700 hover:text-white">
                                                                <p>Editar</p>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </td>
                                            @endif

                                        </tr>
                                    @else
                                        <tr tabindex="0" wire:click="set_recep({{ $recepcion->id }})"
                                            class="h-16 text-white border border-gray-100 rounded cursor-pointer focus:outline-none"
                                            style="background-color: #008d39;">
                                            <td class="text-center">

                                                <p class="mr-2 text-base font-medium leading-none">






                                                    @if ($recepcion->numero_g_recepcion)
                                                        Lote: {{ $recepcion->numero_g_recepcion }}
                                                    @endif


                                                </p>

                                            </td>
                                            <td class="text-center">
                                                <p class="mr-2 text-base font-medium leading-none">



                                                    @if ($recepcion->n_emisor)
                                                        {{ $recepcion->n_emisor }}
                                                    @endif


                                                </p>

                                            </td>
                                            <td class="">
                                                <div class="flex items-center pl-5">
                                                    <p class="mr-2 text-base font-medium leading-none">


                                                        @if ($recepcion->n_especie)
                                                            {{ $recepcion->n_especie }}
                                                        @endif


                                                    </p>

                                                </div>
                                            </td>
                                            <td class="pl-5">
                                                <div class="flex items-center text-center whitespace-nowrap">

                                                    <p class="ml-2 text-sm leading-none whitespace-nowrap">

                                                        @if ($recepcion->n_variedad)
                                                            {{ $recepcion->n_variedad }}
                                                        @endif
                                                    </p>
                                                </div>
                                            </td>
                                            <td class="pl-5 text-center whitespace-nowrap">
                                                <p
                                                    class="mr-2 text-base font-medium leading-none text-center whitespace-nowrap">


                                                    @if ($recepcion->fecha_g_recepcion)
                                                        {{ date('d M Y g:i a', strtotime($recepcion->fecha_g_recepcion)) }}
                                                    @endif

                                                </p>

                                            </td>

                                            <td class="text-center">

                                                <p class="text-base ">



                                                    @if ($recepcion->numero_documento_recepcion)
                                                        {{ $recepcion->numero_documento_recepcion }}
                                                    @endif

                                                </p>

                                            </td>
                                            <td class="pl-5 whitespace-nowrap">
                                                <p
                                                    class="flex mr-2 text-base font-medium leading-none whitespace-nowrap">



                                                    @if ($recepcion->cantidad)
                                                        {{ number_format($recepcion->cantidad) }}
                                                    @endif

                                                </p>

                                            </td>

                                            <td class="pl-5">


                                                @if ($recepcion->peso_neto)
                                                    {{ number_format($recepcion->peso_neto) }}
                                                @endif






                                            </td>

                                            <td class="pl-5 text-center">

                                                @if ($recepcion->nota_calidad == 0)
                                                    S/N
                                                @elseif($recepcion->nota_calidad)
                                                    {{ number_format($recepcion->nota_calidad) }}
                                                @endif



                                            </td>



                                            @if ($recepcion->n_estado == 'CERRADO')
                                                <td class="justify-center text-center">

                                                    <a href="{{ route('informe.download', $recepcion) }}"
                                                        target="_blank">
                                                        <img class="w-10 mx-auto my-2"
                                                            src="{{ asset('image/pdf_icon2.png') }}"
                                                            title="Descargar" alt="">
                                                    </a>



                                                </td>
                                            @else
                                                <td>
                                                    <div class="relative px-2 pt-2">
                                                        <button class="rounded-md focus:ring-2 focus:outline-none"
                                                            onclick="dropdownFunction(this)" role="button"
                                                            aria-label="option">
                                                            <svg class="dropbtn" onclick="dropdownFunction(this)"
                                                                xmlns="http://www.w3.org/2000/svg" width="20"
                                                                height="20" viewBox="0 0 20 20" fill="none">
                                                                <path
                                                                    d="M4.16667 10.8332C4.62691 10.8332 5 10.4601 5 9.99984C5 9.5396 4.62691 9.1665 4.16667 9.1665C3.70643 9.1665 3.33334 9.5396 3.33334 9.99984C3.33334 10.4601 3.70643 10.8332 4.16667 10.8332Z"
                                                                    stroke="#9CA3AF" stroke-width="1.25"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                </path>
                                                                <path
                                                                    d="M10 10.8332C10.4602 10.8332 10.8333 10.4601 10.8333 9.99984C10.8333 9.5396 10.4602 9.1665 10 9.1665C9.53976 9.1665 9.16666 9.5396 9.16666 9.99984C9.16666 10.4601 9.53976 10.8332 10 10.8332Z"
                                                                    stroke="#9CA3AF" stroke-width="1.25"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                </path>
                                                                <path
                                                                    d="M15.8333 10.8332C16.2936 10.8332 16.6667 10.4601 16.6667 9.99984C16.6667 9.5396 16.2936 9.1665 15.8333 9.1665C15.3731 9.1665 15 9.5396 15 9.99984C15 10.4601 15.3731 10.8332 15.8333 10.8332Z"
                                                                    stroke="#9CA3AF" stroke-width="1.25"
                                                                    stroke-linecap="round" stroke-linejoin="round">
                                                                </path>
                                                            </svg>
                                                        </button>
                                                        <div
                                                            class="absolute right-0 z-30 hidden w-24 mr-6 bg-white shadow dropdown-content">
                                                            <div tabindex="0"
                                                                class="w-full px-4 py-4 text-xs cursor-pointer focus:outline-none focus:text-indigo-600 hover:bg-indigo-700 hover:text-white">
                                                                <p>Edit</p>
                                                            </div>
                                                            <div tabindex="0"
                                                                class="w-full px-4 py-4 text-xs cursor-pointer focus:outline-none focus:text-indigo-600 hover:bg-indigo-700 hover:text-white">
                                                                <p>Delete</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            @endif

                                        </tr>
                                    @endif
                                @else
                                    <tr tabindex="0" wire:click="set_recep({{ $recepcion->id }})"
                                        class="h-16 text-white border border-gray-100 rounded cursor-pointer focus:outline-none"
                                        style="background-color: #008d39;">
                                        <td class="text-center">

                                            <p class="mr-2 text-base font-medium leading-none">






                                                @if ($recepcion->numero_g_recepcion)
                                                    Lote: {{ $recepcion->numero_g_recepcion }}
                                                @endif


                                            </p>

                                        </td>
                                        <td class="text-center">
                                            <p class="mr-2 text-base font-medium leading-none">



                                                @if ($recepcion->n_emisor)
                                                    {{ $recepcion->n_emisor }}
                                                @endif


                                            </p>

                                        </td>
                                        <td class="">
                                            <div class="flex items-center pl-5">
                                                <p class="mr-2 text-base font-medium leading-none">


                                                    @if ($recepcion->n_especie)
                                                        {{ $recepcion->n_especie }}
                                                    @endif


                                                </p>

                                            </div>
                                        </td>
                                        <td class="pl-5">
                                            <div class="flex items-center text-center whitespace-nowrap">

                                                <p class="ml-2 text-sm leading-none whitespace-nowrap">

                                                    @if ($recepcion->n_variedad)
                                                        {{ $recepcion->n_variedad }}
                                                    @endif
                                                </p>
                                            </div>
                                        </td>
                                        <td class="pl-5 text-center whitespace-nowrap">
                                            <p
                                                class="mr-2 text-base font-medium leading-none text-center whitespace-nowrap">


                                                @if ($recepcion->fecha_g_recepcion)
                                                    {{ date('d M Y g:i a', strtotime($recepcion->fecha_g_recepcion)) }}
                                                @endif

                                            </p>

                                        </td>

                                        <td class="text-center">

                                            <p class="text-base ">



                                                @if ($recepcion->numero_documento_recepcion)
                                                    {{ $recepcion->numero_documento_recepcion }}
                                                @endif

                                            </p>

                                        </td>
                                        <td class="pl-5 whitespace-nowrap">
                                            <p class="flex mr-2 text-base font-medium leading-none whitespace-nowrap">



                                                @if ($recepcion->cantidad)
                                                    {{ number_format($recepcion->cantidad) }}
                                                @endif

                                            </p>

                                        </td>

                                        <td class="pl-5">


                                            @if ($recepcion->peso_neto)
                                                {{ number_format($recepcion->peso_neto) }}
                                            @endif






                                        </td>

                                        <td class="pl-5 text-center">

                                            @if ($recepcion->nota_calidad == 0)
                                                S/N
                                            @elseif($recepcion->nota_calidad)
                                                {{ number_format($recepcion->nota_calidad) }}
                                            @endif



                                        </td>


                                        @if ($recepcion->n_estado == 'CERRADO')
                                            <td class="justify-center text-center">

                                                <a href="{{ route('informe.download', $recepcion) }}" target="_blank">
                                                    <img class="w-10 mx-auto my-2"
                                                        src="{{ asset('image/pdf_icon2.png') }}" title="Descargar"
                                                        alt="">
                                                </a>

                                                <button wire:click="reenviar_informe({{ $recepcion->id }})"
                                                    class="px-3 py-1 mt-2 mb-2 text-xs font-bold text-white bg-green-500 rounded-full"
                                                    type="submit" title="Reenviar Whatsapp">Reenviar
                                                    Whatsapp</button>


                                            </td>
                                        @else
                                            <td>
                                                <div class="relative px-2 pt-2">
                                                    <button class="rounded-md focus:ring-2 focus:outline-none"
                                                        onclick="dropdownFunction(this)" role="button"
                                                        aria-label="option">
                                                        <svg class="dropbtn" onclick="dropdownFunction(this)"
                                                            xmlns="http://www.w3.org/2000/svg" width="20"
                                                            height="20" viewBox="0 0 20 20" fill="none">
                                                            <path
                                                                d="M4.16667 10.8332C4.62691 10.8332 5 10.4601 5 9.99984C5 9.5396 4.62691 9.1665 4.16667 9.1665C3.70643 9.1665 3.33334 9.5396 3.33334 9.99984C3.33334 10.4601 3.70643 10.8332 4.16667 10.8332Z"
                                                                stroke="#9CA3AF" stroke-width="1.25"
                                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path
                                                                d="M10 10.8332C10.4602 10.8332 10.8333 10.4601 10.8333 9.99984C10.8333 9.5396 10.4602 9.1665 10 9.1665C9.53976 9.1665 9.16666 9.5396 9.16666 9.99984C9.16666 10.4601 9.53976 10.8332 10 10.8332Z"
                                                                stroke="#9CA3AF" stroke-width="1.25"
                                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                                            <path
                                                                d="M15.8333 10.8332C16.2936 10.8332 16.6667 10.4601 16.6667 9.99984C16.6667 9.5396 16.2936 9.1665 15.8333 9.1665C15.3731 9.1665 15 9.5396 15 9.99984C15 10.4601 15.3731 10.8332 15.8333 10.8332Z"
                                                                stroke="#9CA3AF" stroke-width="1.25"
                                                                stroke-linecap="round" stroke-linejoin="round"></path>
                                                        </svg>
                                                    </button>
                                                    <div
                                                        class="absolute right-0 z-30 hidden w-24 mr-6 bg-white shadow dropdown-content">
                                                        <div tabindex="0"
                                                            class="w-full px-4 py-4 text-xs cursor-pointer focus:outline-none focus:text-indigo-600 hover:bg-indigo-700 hover:text-white">
                                                            <p>Edit</p>
                                                        </div>
                                                        <div tabindex="0"
                                                            class="w-full px-4 py-4 text-xs cursor-pointer focus:outline-none focus:text-indigo-600 hover:bg-indigo-700 hover:text-white">
                                                            <p>Delete</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        @endif

                                    </tr>
                                @endif

                                @if ($recep)

                                    @if ($recep->id == $recepcion->id)
                                        @livewire('calidad.actualizar-datos', ['recepcion' => $recepcion], key($recepcion->id))


                                        @if ($recepcion->n_estado != 'CERRADO')
                                            <tr tabindex="0"
                                                class="h-20 border border-gray-100 rounded focus:outline-none">
                                                <td class="text-center">

                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('agregar.cc', $recepcion) }}" target="_blank">
                                                        <button
                                                            class="px-5 py-3 mb-4 text-sm leading-none text-red-600 bg-red-100 rounded focus:ring-2 focus:ring-offset-2 focus:ring-red-300 hover:bg-red-200 focus:outline-none">
                                                            AGREGAR CC
                                                        </button>
                                                    </a>
                                                </td>

                                                <td class="">
                                                    <div class="flex items-center pl-5">
                                                        <a href="{{ route('agregar.ss', $recepcion) }}"
                                                            target="_blank">
                                                            <button
                                                                class="px-5 py-3 mb-4 text-sm leading-none text-red-600 bg-red-100 rounded focus:ring-2 focus:ring-offset-2 focus:ring-red-300 hover:bg-red-200 focus:outline-none">
                                                                AGREGAR SS
                                                            </button>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td class="pl-5">
                                                    <div class="flex items-center text-center whitespace-nowrap">
                                                        <a href="{{ route('informe.view', $recepcion) }}"
                                                            target="blank">
                                                            <button
                                                                class="px-5 py-3 mb-4 text-sm leading-none text-red-600 bg-red-100 rounded focus:ring-2 focus:ring-offset-2 focus:ring-red-300 hover:bg-red-200 focus:outline-none">
                                                                VER INFORME PREVIO
                                                            </button>
                                                        </a>
                                                        {{-- <a href="{{route('promedio.firmeza',$recepcion)}}" target="_blank" class="px-5 py-3 mb-4 text-sm leading-none text-red-600 bg-red-100 rounded focus:ring-2 focus:ring-offset-2 focus:ring-red-300 hover:bg-red-200 focus:outline-none">VER PROMEDIO FIRMEZA</a>
                                                        <br/>
                                                        <a href="{{route('promedio.brix',$recepcion)}}" target="_blank" class="px-5 py-3 mb-4 text-sm leading-none text-red-600 bg-red-100 rounded focus:ring-2 focus:ring-offset-2 focus:ring-red-300 hover:bg-red-200 focus:outline-none"> PROMEDIO BRIX</a>
                                                        <br/>
                                                        <a href="{{route('distribucion.calibre',$recepcion)}}" target="_blank" class="px-5 py-3 mb-4 text-sm leading-none text-red-600 bg-red-100 rounded focus:ring-2 focus:ring-offset-2 focus:ring-red-300 hover:bg-red-200 focus:outline-none">DISTRIBUCION CALIBRE</a>
                                                        <br/>
                                                        <a href="{{route('distribucion.color',$recepcion)}}" target="_blank" class="px-5 py-3 mb-4 text-sm leading-none text-red-600 bg-red-100 rounded focus:ring-2 focus:ring-offset-2 focus:ring-red-300 hover:bg-red-200 focus:outline-none">DISTRIBUCION COLOR</a>

                                                        <br/>
                                                        <a href="{{route('porcentaje.firmeza',$recepcion)}}" target="_blank" class="px-5 py-3 mb-4 text-sm leading-none text-red-600 bg-red-100 rounded focus:ring-2 focus:ring-offset-2 focus:ring-red-300 hover:bg-red-200 focus:outline-none">% Firmeza</a> --}}

                                                    </div>
                                                </td>
                                                <td class="pl-5 text-center">
                                                    @if (IS_NULL($recepcion->informe))
                                                        <button
                                                            class="px-5 py-3 mb-4 text-sm leading-none text-gray-600 bg-gray-100 rounded focus:ring-2 focus:outline-none">
                                                            VALIDAR INFORME
                                                        </button>
                                                    @else
                                                        <div class="block">
                                                            <button wire:click="validar_informe({{ $recepcion->id }})"
                                                                class="px-5 py-3 mb-4 text-sm leading-none text-red-600 bg-red-100 rounded focus:ring-2 focus:ring-offset-2 focus:ring-red-300 hover:bg-red-200 focus:outline-none">
                                                                VALIDAR INFORME
                                                            </button>
                                                            <button
                                                                wire:click="revalidar_informe({{ $recepcion->id }})"
                                                                class="px-5 py-3 mb-4 text-sm leading-none text-red-600 bg-red-100 rounded focus:ring-2 focus:ring-offset-2 focus:ring-red-300 hover:bg-red-200 focus:outline-none">
                                                                REVALIDAR
                                                            </button>
                                                        </div>
                                                    @endif



                                                </td>
                                                <td class="pl-5 whitespace-nowrap">

                                                    @if ($recepcion->calidad->detalles->where('tipo_item', 'DISTRIBUCIÓN DE FIRMEZA')->count())
                                                        <button
                                                            class="px-5 py-3 mb-4 text-sm leading-none text-green-600 bg-green-100 rounded focus:ring-2 focus:ring-offset-2 focus:ring-green-300 hover:bg-green-200 focus:outline-none">
                                                            FIRMPRO CARGADO
                                                        </button>
                                                    @else
                                                        <button wire:click="cargar_firmpro({{ $recepcion->id }})"
                                                            class="px-5 py-3 mb-4 text-sm leading-none text-red-600 bg-red-100 rounded focus:ring-2 focus:ring-offset-2 focus:ring-red-300 hover:bg-red-200 focus:outline-none">
                                                            CARGAR FIMPRO
                                                        </button>
                                                    @endif



                                                    @if ($firmpro)
                                                        @foreach ($firmpro as $items)
                                                            @php
                                                                $n = 1;
                                                            @endphp
                                                            @foreach ($items as $item)
                                                                @php
                                                                    if ($n == 24) {
                                                                        $precalibre = $item;
                                                                    }
                                                                    if ($n == 25) {
                                                                        $l = $item;
                                                                    }
                                                                    if ($n == 26) {
                                                                        $xl = $item;
                                                                    }
                                                                    if ($n == 27) {
                                                                        $j = $item;
                                                                    }
                                                                    if ($n == 28) {
                                                                        $jj = $item;
                                                                    }
                                                                    if ($n == 29) {
                                                                        $jjj = $item;
                                                                    }
                                                                    if ($n == 30) {
                                                                        $jjjj = $item;
                                                                    }
                                                                    if ($n == 31) {
                                                                        $jjjjj = $item;
                                                                    }
                                                                    $n += 1;
                                                                @endphp
                                                            @endforeach
                                                        @endforeach

                                                        Datos Cargados Exitosamente!
                                                    @endif


                                                </td>

                                                <td class="pl-5 whitespace-nowrap">


                                                </td>



                                                <td class="pl-5 text-center">





                                                </td>


                                                <td class="pl-4">

                                                </td>
                                                <td>

                                                </td>
                                            </tr>
                                        @else
                                            <tr tabindex="0"
                                                class="h-10 border border-gray-100 rounded focus:outline-none">
                                                <td class="text-center">

                                                </td>
                                                <td class="text-center">

                                                </td>

                                                <td class="">

                                                </td>
                                                <td class="pl-5">

                                                </td>
                                                <td class="pl-5 text-center whitespace-nowrap">


                                                </td>
                                                <td class="pl-5 whitespace-nowrap">


                                                </td>

                                                <td class="pl-5 whitespace-nowrap">

                                                </td>



                                                <td class="pl-5 text-center">





                                                </td>


                                                <td class="pl-4">

                                                </td>
                                                <td>

                                                </td>
                                            </tr>
                                        @endif
                                    @endif
                                @endif
                                <tr class="h-5 text-white" style="background-color: #ffffff;">
                                    <td class="my-4 text-white">
                                        {{-- Agregar: --}}
                                    </td>
                                    <td class="flex items-center content-center justify-center pb-1">


                                    </td>
                                    <td class="items-center content-center justify-center pb-1">


                                    </td>
                                    <td>

                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <div
                                            class="px-2 py-1 mt-1 mb-1 text-xs leading-none text-center text-gray-600 bg-gray-100 rounded cursor-pointer focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 hover:bg-gray-200 focus:outline-none">
                                            -
                                        </div>
                                    </td>

                                </tr>







                            @endforeach


                        </tbody>
                    </table>
                </x-table-responsive>
                @if ($recepcions->count())
                    <div class="">
                        {{ $recepcions->links() }}
                    </div>
                @endif
            </div>




        </div>
    </div>

</div>
