<div>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/series-label.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>

    <div class="flex items-center content-center justify-between mx-12 my-2">

        <div class="p-4 my-4 ml-12 mr-2 bg-white rounded-lg shadow max-w-7xl sm:p-4 xl:p-4">
            <div class="flex items-center justify-center">
                <div class="flex-shrink-0 text-center">
                    <span
                        class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl">{{ number_format($procesosall->count()) }}</span>
                    <h3 class="text-base font-normal text-gray-500">Procesos</h3>
                </div>

            </div>
        </div>
        <div>
            <button wire:click="generateReport"
                class="items-center px-6 py-3 mx-2 bg-gray-500 rounded focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 hover:bg-gray-600 focus:outline-none">
                <p class="text-sm font-medium leading-none text-white">Descargar Excel</p>
            </button>




            <select wire:model="ctd"
                class="max-w-xl px-6 py-3 mx-2 text-gray-700 bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                <option value="25" class="px-10 text-left">25 </option>
                <option value="50" class="px-10 text-left">50 </option>
                <option value="100" class="px-10 text-left">100 </option>
                <option value="500" class="px-10 text-left">500 </option>

            </select>
        </div>


    </div>

    <div class="mx-2 sm:mx-12">

        <div
            class="grid content-center justify-between grid-cols-3 mx-2 sm:mx-12 md:mx-14 sm:grid-cols-3 md:grid-cols-6 lg:grid-cols-9 gap-y-4 gap-x-3">
            @php
                $varieds = [];
                $exportacion = [];
                $comercial = [];
                $desecho = [];
                $merma = [];
            @endphp
            @if ($espec)
                <button wire:click="espec_clean"
                    class="items-center content-center w-full px-3 py-3 rounded focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 hover:bg-gray-500 focus:outline-none"
                    style="background-color: #FF8000;">
                    <p class="text-sm font-medium leading-none text-white">{{ $espec->name }}</p>
                </button>

                @if ($variedades)

                    @if ($varie)
                        <button wire:click="varie_clean"
                            class="items-center w-full px-3 py-3 rounded focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 hover:bg-gray-500 focus:outline-none"
                            style="background-color: #008d39;">
                            <p class="text-sm font-medium leading-none text-white whitespace-nowrap">{{ $varie->name }}
                            </p>
                        </button>
                    @else
                        @foreach ($variedades as $variedad)
                            @if ($variedad->especie_id == $espec->id)
                                <div class="flex justify-center">
                                    <button wire:click="set_varie({{ $variedad->id }})"
                                        class="items-center w-full px-2 py-3 rounded  focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 hover:bg-gray-500 focus:outline-none"
                                        style="background-color: #008d39;">
                                        <p class="text-sm font-medium leading-none text-white whitespace-nowrap">
                                            {{ $variedad->name }}</p>
                                    </button>
                                </div>
                                @php
                                    $varieds[] = $variedad->name;
                                @endphp
                            @endif
                        @endforeach

                    @endif


                @endif
            @else
                @foreach ($especies as $especie)
                    <div class="justify-center ">
                        <a href="{{ route('procesos.productor.especie', $especie) }}">
                            <button
                                class="items-center w-full px-4 py-3 rounded focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 hover:bg-gray-500 focus:outline-none"
                                style="background-color: #008d39;">
                                <p class="text-sm font-medium leading-none text-white whitespace-nowrap">
                                    {{ $especie->name }}</p>
                            </button>
                        </a>
                    </div>
                    @php

                        $export = 0;
                        $comerc = 0;
                        $desec = 0;
                        $mer = 0;
                        foreach ($procesosall as $proceso) {
                            if ($proceso->especie == $especie->name) {
                                $export += $proceso->exp;
                                $comerc += $proceso->comercial;
                                $desec += $proceso->desecho;
                                $mer += $proceso->kilos_netos - $proceso->desecho - $proceso->comercial - $proceso->exp;
                            }
                        }

                        $exportacion[] = $export;
                        $comercial[] = $comerc;
                        $desecho[] = $desec;
                        $merma[] = $mer;

                        $varieds[] = $especie->name;
                    @endphp
                @endforeach

            @endif

        </div>


        <figure class="mt-6 highcharts-figure mx-14" wire:ignore>
            <div id="grafico" wire:ignore>

            </div>
        </figure>

        <div class="px-6 py-4">
            <input wire:keydown="limpiar_page" wire:model="search"
                class="flex-1 w-full h-10 px-5 pr-16 bg-white border-2 border-gray-300 rounded-lg shadow-sm form-input focus:outline-none"
                placeholder="Ingrese la variedad, especie o lote de la recepción" autocomplete="off">
        </div>

        <div class="px-4 py-4 bg-white md:py-7 md:px-8 xl:px-10 ">


            <x-table-responsive>
                <table class="min-w-full pb-20 mb-20 divide-y divide-gray-200">

                    <thead class="rounded-full bg-gray-50">

                        <th>Agricola</th>
                        <th>Nro Proceso</th>
                        <th>Especie</th>
                        <th>Variedad</th>
                        <th class="text-center">Fecha</th>
                        <th class="text-center">Kg<br>Procesados</th>
                        <th class="text-center">%<br>Exportación</th>
                        <th class="text-center">%<br>Comercial</th>
                        <th class="text-center">%<br>Desecho</th>
                        <th class="text-center">%<br>Merma</th>
                        <th class="text-center">Informe</th>
                        <th> </th>


                    </thead>
                    <tbody>
                        @php
                            $n = 1;
                        @endphp

                        @foreach ($procesos as $proceso)
                            {{-- comment        {{$n.') '.$proceso}}<br>
                                        @php
                                           $m=1;
                                           $n+=1;
                                        @endphp

                                  @foreach ($proceso as $item)
                                  {{$m}}) {{$item}}<br>

                                           @php
                                                 $m+=1;
                                           @endphp
                                     @endforeach
                                     --}}
                            {{-- comment  --}}
                            @if ($proceso->informe)
                                <tr class="h-16 border border-gray-100 rounded">

                                    <td class="text-center">
                                        <p class="text-base font-medium text-gray-700">



                                            @if ($proceso->agricola)
                                                {{ $proceso->agricola }}
                                            @endif


                                        </p>

                                    </td>
                                    <td class="">
                                        <div class="flex items-center pl-5">
                                            <p class="mr-2 text-base font-medium leading-none text-gray-700">


                                                @if ($proceso->n_proceso)
                                                    {{ $proceso->n_proceso }}
                                                @endif


                                            </p>

                                        </div>
                                    </td>
                                    <td class="">
                                        <div class="flex items-center pl-5">
                                            <p class="mr-2 text-base font-medium leading-none text-gray-700">


                                                @if ($proceso->especie)
                                                    {{ $proceso->especie }}
                                                @endif


                                            </p>

                                        </div>
                                    </td>
                                    <td class="pl-5">
                                        <div class="flex items-center text-center whitespace-nowrap">

                                            <p class="ml-2 text-sm leading-none text-gray-600 whitespace-nowrap">

                                                @if ($proceso->variedad)
                                                    {{ $proceso->variedad }}
                                                @endif
                                            </p>
                                        </div>
                                    </td>
                                    <td class="pl-5 text-center whitespace-nowrap">
                                        <p
                                            class="mr-2 text-base font-medium leading-none text-center text-gray-700 whitespace-nowrap">


                                            @if ($proceso->fecha)
                                                {{ date('d M Y g:i a', strtotime($proceso->fecha)) }}
                                            @endif

                                        </p>

                                    </td>
                                    <td class="pl-5 whitespace-nowrap">
                                        <p
                                            class="flex mr-2 text-base font-medium leading-none text-gray-700 whitespace-nowrap">



                                            @if ($proceso->kilos_netos)
                                                {{ $proceso->kilos_netos }}
                                            @endif

                                        </p>
                                    </td>

                                    <td class="pl-5 whitespace-nowrap">
                                        <p
                                            class="flex mr-2 text-base font-medium leading-none text-gray-700 whitespace-nowrap">



                                            @if ($proceso->kilos_netos > 0)
                                                {{ round(($proceso->exp * 100) / $proceso->kilos_netos, 1) }}%
                                            @endif
                                        </p>

                                    </td>
                                    <td class="pl-5 whitespace-nowrap">
                                        <p
                                            class="flex mr-2 text-base font-medium leading-none text-gray-700 whitespace-nowrap">



                                            @if ($proceso->kilos_netos > 0)
                                                {{ round(($proceso->comercial * 100) / $proceso->kilos_netos, 1) }}%
                                            @endif

                                        </p>

                                    </td>
                                    <td class="pl-5 whitespace-nowrap">
                                        <p
                                            class="flex mr-2 text-base font-medium leading-none text-gray-700 whitespace-nowrap">



                                            @if ($proceso->kilos_netos > 0)
                                                {{ round(($proceso->desecho * 100) / $proceso->kilos_netos, 1) }}%
                                            @endif

                                        </p>

                                    </td>
                                    <td class="pl-5 whitespace-nowrap">
                                        <p
                                            class="flex mr-2 text-base font-medium leading-none text-gray-700 whitespace-nowrap">



                                            @if ($proceso->kilos_netos > 0)
                                                {{ round((($proceso->kilos_netos - $proceso->exp - $proceso->comercial - $proceso->desecho) * 100) / $proceso->kilos_netos, 1) }}%
                                            @endif



                                        </p>

                                    </td>

                                    <td class="pl-5">

                                        <div class="content-center">
                                            @if ($proceso->informe)
                                                <a href="{{ route('download.proceso', $proceso) }}" target="_blank"
                                                    class="items-center content-center w-full h-10 m-2 mr-2">
                                                    <img class="w-full h-10 m-2 mr-2"
                                                        src="{{ asset('image/pdf_icon2.png') }}" title="Descargar"
                                                        alt="">
                                                </a>
                                            @else
                                            @endif


                                        </div>




                                    </td>
                                    <td class="pl-5">

                                        <div class="block w-full">


                                        </div>




                                    </td>




                                </tr>
                            @else
                                @if (Auth::user()->name == 'David Rosas' || Auth::user()->name == 'Fabian Garay')
                                    <tr class="h-16 border border-gray-100 rounded">

                                        <td class="text-center">
                                            <p class="text-base font-medium text-gray-700">



                                                @if ($proceso->agricola)
                                                    {{ $proceso->agricola }}
                                                @endif


                                            </p>

                                        </td>
                                        <td class="">
                                            <div class="flex items-center pl-5">
                                                <p class="mr-2 text-base font-medium leading-none text-gray-700">


                                                    @if ($proceso->n_proceso)
                                                        {{ $proceso->n_proceso }}
                                                    @endif


                                                </p>

                                            </div>
                                        </td>
                                        <td class="">
                                            <div class="flex items-center pl-5">
                                                <p class="mr-2 text-base font-medium leading-none text-gray-700">


                                                    @if ($proceso->especie)
                                                        {{ $proceso->especie }}
                                                    @endif


                                                </p>

                                            </div>
                                        </td>
                                        <td class="pl-5">
                                            <div class="flex items-center text-center whitespace-nowrap">

                                                <p class="ml-2 text-sm leading-none text-gray-600 whitespace-nowrap">

                                                    @if ($proceso->variedad)
                                                        {{ $proceso->variedad }}
                                                    @endif
                                                </p>
                                            </div>
                                        </td>
                                        <td class="pl-5 text-center whitespace-nowrap">
                                            <p
                                                class="mr-2 text-base font-medium leading-none text-center text-gray-700 whitespace-nowrap">


                                                @if ($proceso->fecha)
                                                    {{ date('d M Y g:i a', strtotime($proceso->fecha)) }}
                                                @endif

                                            </p>

                                        </td>
                                        <td class="pl-5 whitespace-nowrap">
                                            <p
                                                class="flex mr-2 text-base font-medium leading-none text-gray-700 whitespace-nowrap">



                                                @if ($proceso->kilos_netos)
                                                    {{ $proceso->kilos_netos }}
                                                @endif

                                            </p>
                                        </td>

                                        <td class="pl-5 whitespace-nowrap">
                                            <p
                                                class="flex mr-2 text-base font-medium leading-none text-gray-700 whitespace-nowrap">



                                                @if ($proceso->kilos_netos > 0)
                                                    {{ round(($proceso->exp * 100) / $proceso->kilos_netos, 1) }}%
                                                @endif
                                            </p>

                                        </td>
                                        <td class="pl-5 whitespace-nowrap">
                                            <p
                                                class="flex mr-2 text-base font-medium leading-none text-gray-700 whitespace-nowrap">



                                                @if ($proceso->kilos_netos > 0)
                                                    {{ round(($proceso->comercial * 100) / $proceso->kilos_netos, 1) }}%
                                                @endif

                                            </p>

                                        </td>
                                        <td class="pl-5 whitespace-nowrap">
                                            <p
                                                class="flex mr-2 text-base font-medium leading-none text-gray-700 whitespace-nowrap">



                                                @if ($proceso->kilos_netos > 0)
                                                    {{ round(($proceso->desecho * 100) / $proceso->kilos_netos, 1) }}%
                                                @endif

                                            </p>

                                        </td>
                                        <td class="pl-5 whitespace-nowrap">
                                            <p
                                                class="flex mr-2 text-base font-medium leading-none text-gray-700 whitespace-nowrap">



                                                @if ($proceso->kilos_netos > 0)
                                                    {{ round((($proceso->kilos_netos - $proceso->exp - $proceso->comercial - $proceso->desecho) * 100) / $proceso->kilos_netos, 1) }}%
                                                @endif



                                            </p>

                                        </td>

                                        <td class="pl-5">

                                            <div class="content-center">
                                                @if ($proceso->informe)
                                                    <a href="{{ route('download.proceso', $proceso) }}"
                                                        target="_blank"
                                                        class="items-center content-center w-full h-10 m-2 mr-2">
                                                        <img class="w-full h-10 m-2 mr-2"
                                                            src="{{ asset('image/pdf_icon2.png') }}"
                                                            title="Descargar" alt="">
                                                    </a>
                                                @else
                                                @endif


                                            </div>




                                        </td>
                                        <td class="pl-5">

                                            <div class="block w-full">


                                            </div>




                                        </td>




                                    </tr>
                                @endif
                            @endif
                        @endforeach






                    </tbody>
                </table>
            </x-table-responsive>

            <div class="flex justify-between mx-12 mt-4">
                @if ($procesos->count())
                    <div class="">
                        {{ $procesos->links() }}
                    </div>
                @endif
            </div>


        </div>
    </div>
    <script>
        var titulo = <?php echo json_encode($titulo); ?>;
        var variedades = <?php echo json_encode($varieds); ?>;
        var exportacion = <?php echo json_encode($exportacion); ?>;
        var comercial = <?php echo json_encode($comercial); ?>;
        var desecho = <?php echo json_encode($desecho); ?>;
        var merma = <?php echo json_encode($merma); ?>;
        // Data retrieved from https://en.wikipedia.org/wiki/Winter_Olympic_Games
        Highcharts.chart('grafico', {

            chart: {
                type: 'column'
            },

            title: {
                text: titulo,
                align: 'center'
            },

            xAxis: {
                categories: variedades
            },

            yAxis: {
                allowDecimals: false,
                min: 0,
                title: {
                    text: 'Kilos'
                }
            },

            tooltip: {
                pointFormat: '<span style="color:{series.color}">{series.name}</span>: <b>{point.y}</b> ({point.percentage:.0f}%)<br/>',
                shared: true
            },

            plotOptions: {
                column: {
                    stacking: 'percent'
                }
            },

            series: [{
                name: 'Exportacion',
                data: exportacion,
                stack: 'variedades'
            }, {
                name: 'Nacional',
                data: comercial,
                stack: 'variedades'
            }, {
                name: 'Desecho',
                data: desecho,
                stack: 'variedades'
            }, {
                name: 'Merma',
                data: merma,
                stack: 'variedades'
            }]
        });
    </script>
</div>
