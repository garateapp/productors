<div>
    @php
    $cant=0;
    $cant2=0;
        foreach($allrecepcions as $recepcion){
            $cant+=$recepcion->peso_neto;
        }
        foreach($allsubrecepcions as $recepcion){
            $cant2+=$recepcion->peso_neto;
        }

    @endphp
    <div class="pb-12">
        <div class="w-full sm:px-6">
        <div class="hidden px-6 py-4">
            <input wire:keydown="limpiar_page" wire:model="search"  class="flex-1 w-full h-10 px-5 pr-16 bg-white border-2 border-gray-300 rounded-lg shadow-sm form-input focus:outline-none" placeholder="Ingrese la variedad, especie o lote de la recepción" autocomplete="off">
        </div>

        <div class="items-center justify-between my-2 sm:flex">

            <div class="flex justify-between">
                @if ($recep)
                    <div class="p-4 my-4 ml-12 mr-2 bg-white rounded-lg shadow max-w-7xl sm:p-4 xl:p-4">
                    <div class="flex items-center justify-center">
                        <div class="flex-shrink-0 text-center">
                            <span class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl"> {{$recep->numero_g_recepcion}}</span>
                            <h3 class="text-base font-normal text-gray-500">Lote</h3>
                        </div>

                    </div>
                    </div>
                    <div class="p-4 my-4 ml-12 mr-2 bg-white rounded-lg shadow max-w-7xl sm:p-4 xl:p-4">
                        <div class="flex items-center justify-center">
                            <div class="flex-shrink-0 text-left">
                                <h3 class="text-base font-normal text-gray-500">{{$recep->n_emisor}}</h3>
                                <h3 class="text-base font-normal text-gray-500">Guia: {{$recep->numero_documento_recepcion}}</h3>
                                <h3 class="text-base font-normal text-gray-500">Especie: {{$recep->n_especie}}</h3>
                                <h3 class="text-base font-normal text-gray-500">Variedad: {{$recep->n_variedad}}</h3>
                            </div>

                        </div>
                    </div>

                    <div class="hidden p-4 my-4 ml-12 mr-2 bg-white rounded-lg shadow max-w-7xl sm:p-6 xl:p-8">
                        <div class="flex items-center justify-center">
                            <div class="flex-shrink-0 text-left">
                                <div class="flex justify-between">
                                    <label class="w-32 mx-2"><strong>Nro Muestra:</strong></label>
                                    @if ($calidad)
                                        {{$calidad->nro_muestra}}
                                    @else
                                        <label class=""><strong>{{$nro_muestra}}</strong></label>
                                    @endif
                                </div>
                                @if (IS_NULL($calidad))
                                    <div class="flex mb-2 gap-x-2">
                                        <button  class="items-center px-6 py-3 bg-gray-500 rounded focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 hover:bg-gray-500 focus:outline-none">
                                            <p class="text-sm font-medium leading-none text-white">50</p>
                                        </button>
                                        <button  class="items-center px-6 py-3 bg-gray-500 rounded focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 hover:bg-gray-500 focus:outline-none">
                                            <p class="text-sm font-medium leading-none text-white">80</p>
                                        </button>
                                        <button  class="items-center px-6 py-3 bg-gray-500 rounded focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 hover:bg-gray-500 focus:outline-none">
                                            <p class="text-sm font-medium leading-none text-white">100</p>
                                        </button>
                                    </div>
                                    <input wire:model="nro_muestra" type="number" class="w-full h-10 text-sm bg-white border-2 border-gray-300 rounded-lg form-input focus:outline-none">
                                    <div class="flex justify-center mt-2">
                                        <button wire:click="calidad_store" class="inline-flex items-start justify-start px-6 py-3 mx-4 mt-4 bg-green-500 rounded focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 hover:bg-green-500 focus:outline-none">
                                            <h1 style="font-size: 1rem;white-space: nowrap;" class="inline w-full font-bold text-center text-white" >
                                            Ingresar
                                            </h1>
                                        </button>
                                    </div>
                                @endif
                            </div>

                        </div>
                    </div>


                @endif

            </div>



                @if (IS_NULL($recep))


                    <h1 class="hidden mx-6 my-4 text-sm text-center"><b>Ultima Sincronizacion:</b> {{date('d M Y g:i a', strtotime($sync->fecha))}} <b>Tipo:</b> {{$sync->tipo}} <b>Cantidad:</b> {{$sync->cantidad}}</h1>



                    <div class="flex items-center content-center justify-center mb-2">
                        <a href="{{route('production.refresh')}}">
                            <button  class="items-center hidden px-6 py-3 bg-gray-500 rounded focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 hover:bg-gray-500 focus:outline-none">
                                <p class="text-sm font-medium leading-none text-white">FX IMPORT</p>
                            </button>
                        </a>
                        <select wire:model="ctd" class="max-w-xl px-6 py-3 mx-2 text-gray-700 bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="25" class="px-10 text-left">25 </option>
                            <option value="50" class="px-10 text-left">50 </option>
                            <option value="100" class="px-10 text-left">100 </option>
                            <option value="500" class="px-10 text-left">500 </option>

                        </select>
                    </div>
                @else

                <h1 class="text-center">
                    @if ($recep->fecha_g_recepcion)
                        {{date('d M Y g:i a', strtotime($recep->fecha_g_recepcion))}}
                    @endif
                </h1>

                @endif
        </div>



        @if ($recep)
            <div class="flex justify-center mt-4">
                <div class="grid max-w-5xl grid-cols-3 mx-12 mt-4 gap-x-4">
                    <div>
                        @if ($tipo_control=='cc')
                            <p class="font-bold">Tipo Item: </p>
                        @endif
                        @if ($tipo_control=='ss')
                            <p class="font-bold">Tamaño: </p>
                        @endif


                        <select wire:model="selectedparametro" id="selectedparametro" class="block w-full px-4 py-3 pr-8 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="" class="text-center">Selecciona una categoría</option>

                                @foreach ($parametros as $parametro)

                                    <option value="{{$parametro->id}}" class="text-center">{{$parametro->name}}</option>

                                @endforeach

                        </select>
                    </div>
                    <div>
                        @if ($tipo_control=='cc')
                            <p class="font-bold">Detalle item: </p>
                        @endif
                        @if ($tipo_control=='ss')
                            <p class="font-bold">Nombre: </p>
                        @endif

                        <select wire:model="selectedvalor" class="block w-full px-4 py-3 pr-8 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="" class="text-center">Seleccione..</option>
                            @if ($valores)
                                @foreach ($valores as $item)

                                    <option value="{{$item->id}}" class="text-center">{{$item->name}}</option>

                                @endforeach
                            @endif
                        </select>

                        @error('detalle')
                            <span class="text-sm text-red-500">{{$message}}</span>
                        @enderror
                    </div>
                    <div id="divCategoria">
                        @if ($tipo_control=='cc')

                            <p class="font-bold">Categoría: </p>
                            <select wire:model="categoria" class="block w-full px-4 py-3 pr-8 leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500" id="categoria" name="categoria" required>
                                <option value="" class="text-center" selected>Seleccione..</option>
                                <option value="1" class="text-center">Exportable</option>
                                <option value="2" class="text-center">No Exportable</option>
                            </select>

                        @endif
                        @if ($tipo_control=='ss')

                        @endif


                    </div>
                    <div>
                        <p class="hidden font-bold">Fecha </p>
                        <input type="date" wire:model="fecha" class="flex-1 hidden w-full h-10 px-5 pr-16 bg-white border-2 border-gray-300 rounded-lg shadow-sm form-input focus:outline-none" >


                    </div>
                </div>

            </div>
            <div class="flex justify-center mt-4">
                <div class="grid max-w-5xl grid-cols-3 mx-12 mt-4 gap-x-4">
                    <div class="content-center justify-center">
                        @if ($tipo_control=='cc')
                            <p class="font-bold">Embalaje: </p>
                            <input wire:model="embalaje" type="number"  class="flex-1 w-full h-10 px-5 pr-16 bg-white border-2 border-gray-300 rounded-lg shadow-sm form-input focus:outline-none" autocomplete="off">
                        @endif
                        @if ($tipo_control=='ss')
                            <p class="font-bold">Temperatura: </p>
                            <input wire:model="temperatura" type="number" placeholder="20.9" class="flex-1 w-full h-10 px-5 pr-16 bg-white border-2 border-gray-300 rounded-lg shadow-sm form-input focus:outline-none" autocomplete="off">
                        @endif


                    </div>
                    <div class="content-center justify-center">
                        @if ($total_muestra==0)

                            <button wire:click="muestra_clean" class="px-5 py-3 mb-4 text-sm leading-none text-red-600 bg-red-600 rounded focus:ring-2 focus:ring-offset-2 focus:ring-red-300 hover:bg-red-500 focus:outline-none">

                                <h1 style="font-size: 1rem;white-space: nowrap;" class="inline w-full font-bold text-center text-white" >
                                    ERROR! Total Muestra = 0

                                </h1>
                            </button>
                        @endif
                        @if ($tipo_control=='cc')
                            <p class="font-bold">% Muestra: </p>
                            <input wire:model="porcentaje_muestra" type="number" disabled placeholder="25.3" class="flex-1 w-full h-10 px-5 pr-16 bg-white border-2 border-gray-300 rounded-lg shadow-sm form-input focus:outline-none" autocomplete="off">
                        @endif
                        @if ($tipo_control=='ss')
                            <p class="font-bold">Valor: </p>
                            <input wire:model="valor" type="number"  class="flex-1 w-full h-10 px-5 pr-16 bg-white border-2 border-gray-300 rounded-lg shadow-sm form-input focus:outline-none" autocomplete="off">

                        @endif






                    </div>
                    <div class="content-center justify-center">
                        @if ($tipo_control=='cc')
                            <p class="font-bold">Cantidad Muestra: </p>
                            <input wire:change="actualizar_porcentaje" wire:model="cantidad" type="number" class="flex-1 w-full h-10 px-5 pr-16 bg-white border-2 border-gray-300 rounded-lg shadow-sm form-input focus:outline-none" autocomplete="off">
                            @error('cantidad')
                                <span class="text-sm text-red-500">{{$message}}</span>
                            @enderror
                            <p class="font-bold">Total Muestra: </p>
                            <input wire:change="actualizar_porcentaje" wire:model="total_muestra" type="number"  class="flex-1 w-full h-10 px-5 pr-16 bg-white border-2 border-gray-300 rounded-lg shadow-sm form-input focus:outline-none" autocomplete="off">
                        @endif

                    </div>
                </div>

            </div>

            <div class="flex justify-center gap-2 mt-4">

                @if ($tipo_control=='cc')
                    <button wire:click="detalle_store" class="px-5 py-3 mb-4 text-sm leading-none text-green-600 bg-green-600 rounded focus:ring-2 focus:ring-offset-2 focus:ring-green-300 hover:bg-green-500 focus:outline-none">

                        <h1 style="font-size: 1rem;white-space: nowrap;" class="inline w-full font-bold text-center text-white" >
                        Agregar

                        </h1>
                    </button>
                @endif
                @if ($tipo_control=='ss')
                    <button wire:click="ss_store" class="px-5 py-3 mb-4 text-sm leading-none text-green-600 bg-green-600 rounded focus:ring-2 focus:ring-offset-2 focus:ring-green-300 hover:bg-green-500 focus:outline-none">

                        <h1 style="font-size: 1rem;white-space: nowrap;" class="inline w-full font-bold text-center text-white" >
                        Agregar

                        </h1>
                    </button>
                @endif
                <a href="{{route('productioncc.index')}}">
                    <button class="px-5 py-3 mb-4 text-sm leading-none text-red-600 bg-red-600 rounded focus:ring-2 focus:ring-offset-2 focus:ring-red-300 hover:bg-red-500 focus:outline-none">
                    <h1 style="font-size: 1rem;white-space: nowrap;" class="inline w-full font-bold text-center text-white" >
                        Cancelar
                    </h1>
                    </button>
                </a>

            </div>

            <div class="px-4 py-4 mt-6 bg-white md:py-7 md:px-8 xl:px-10">
                <x-table-responsive>
                    <table class="min-w-full pb-20 mb-20 divide-y divide-gray-200">

                        <thead class="rounded-full bg-gray-50">
                        @if ($tipo_control=='cc')
                            <th>ID</th>
                            <th>Lote</th>
                            <th>Embalaje</th>
                            <th>Cantidad</th>
                            <th class="text-center">Tipo Item</th>
                            <th class="text-center">Detalle Item</th>
                            <th class="text-center">% Muestra</th>
                            <th class="text-center">Cantidad Muestra</th>
                            <th>Estado</th>
                            <th class="text-center">Fecha</th>
                            <th class="text-center">Categoría</th>
                        @endif
                        @if ($tipo_control=='ss')
                            <th>ID</th>
                            <th>Lote</th>
                            <th>temperatura</th>
                            <th>Cantidad</th>
                            <th class="text-center">Tamaño</th>
                            <th class="text-center">Nombre Presión</th>
                            <th class="text-center">Valor Presión</th>
                            <th class="text-center">Fecha</th>
                        @endif


                        </thead>
                        <tbody>
                            @php
                                $n=1;
                            @endphp
                            @if ($recep->calidad->detalles)
                                @foreach ($recep->calidad->detalles as $detalle)


                                @if ($detalle->tipo_detalle==$tipo_control)

                                @if ($tipo_control=='cc')
                                    <tr tabindex="0" class="h-10 border border-gray-100 rounded focus:outline-none">
                                        <td class="text-center">
                                        <p class="mr-2 text-base font-medium leading-none text-gray-700">




                                            @if ($recep->id_g_recepcion)
                                                {{$recep->id_g_recepcion}}
                                            @endif


                                        </p>

                                        </td>
                                        <td class="text-center">
                                            <p class="mr-2 text-base font-medium leading-none text-gray-700">



                                                @if ($recep->numero_g_recepcion)
                                                    {{$recep->numero_g_recepcion}}

                                                @endif


                                            </p>

                                        </td>
                                        <td class="text-center">

                                                <p class="mr-2 text-base font-medium leading-none text-center text-gray-700">


                                                    @if ($detalle->embalaje)
                                                        {{$detalle->embalaje}}
                                                    @endif


                                                </p>

                                        </td>
                                        <td class="pl-5">
                                            <div class="flex items-center text-center whitespace-nowrap">

                                                <p class="ml-2 text-sm leading-none text-gray-600 whitespace-nowrap">

                                                    1737
                                                </p>
                                            </div>
                                        </td>
                                        <td class="pl-5 whitespace-nowrap">
                                            <p class="mr-2 text-base font-medium leading-none text-gray-700 whitespace-nowrap">


                                                @if ($detalle->tipo_item)
                                                    {{$detalle->tipo_item}}
                                                @endif

                                            </p>

                                        </td>
                                        <td class="pl-5 whitespace-nowrap">
                                            <p class="flex mr-2 text-base font-medium leading-none text-gray-700 whitespace-nowrap">



                                                @if ($detalle->detalle_item)
                                                    {{$detalle->detalle_item}}
                                                @endif

                                            </p>

                                        </td>
                                        <td class="pl-5 whitespace-nowrap">
                                            <p class="flex mr-2 text-base font-medium leading-none text-gray-700 whitespace-nowrap">

                                                @if ($recep->n_especie=='Cherries')

                                                        {{$detalle->valor_ss}}

                                                @endif

                                                @if ($detalle->tipo_item!='DISTRIBUCIÓN DE CALIBRES')
                                                    @if ($detalle->porcentaje_muestra>=0)
                                                        {{$detalle->porcentaje_muestra}}
                                                    @endif
                                                @elseif($recep->n_especie=='Orange' || $recep->n_especie=='Peaches' || $recep->n_especie=='Apples' || $recep->n_especie=='Pears' || $recep->n_especie=='Nectarines' || $recep->n_especie=='Plums' || $recep->n_especie=='Mandarinas' || $recep->n_especie=='Membrillos' || $recep->n_especie=='Paltas')
                                                    @if ($detalle->porcentaje_muestra>=0)
                                                        {{$detalle->porcentaje_muestra}}

                                                    @endif
                                                @endif


                                            </p>

                                        </td>
                                            <td class="pl-5 whitespace-nowrap">
                                                <p class="flex mr-2 text-base font-medium leading-none text-gray-700 whitespace-nowrap">


                                                    @if ($recep->n_especie=='Cherries' || $recep->n_variedad=='Dagen')
                                                        @if ($detalle->valor_ss==0)
                                                            0
                                                        @else
                                                            {{$detalle->valor_ss}}
                                                        @endif
                                                    @else

                                                        @if ($detalle->cantidad==0)
                                                            0
                                                        @elseif ($detalle->cantidad>=0)
                                                            {{$detalle->cantidad}}
                                                        @endif

                                                    @endif

                                                </p>

                                        </td>

                                        <td class="pl-5 text-center">



                                            @switch($detalle->estado)
                                            @case(1)
                                                <span class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">
                                                    Pendiente
                                                </span>
                                                @break
                                            @case(2)
                                                <span class="inline-flex px-2 text-xs font-semibold leading-5 text-red-800 bg-red-100 rounded-full">
                                                Aprobado
                                                </span>
                                                @break

                                            @default

                                        @endswitch






                                        </td>

                                        <td class="pl-5 text-center">

                                            @if ($detalle->fecha)
                                                {{date('d M Y', strtotime($detalle->fecha))}}
                                            @else
                                                {{date('d M Y', strtotime($detalle->created_at))}}
                                            @endif




                                        </td>

                                        <td class="pl-5 text-center">

                                            @if ($detalle->categoria==1)
                                                Exportable
                                            @elseif ($detalle->categoria==2)
                                                No Exportable
                                            @endif




                                        </td>

                                        <td>
                                            <div tabindex="0" wire:click="delete_detalle({{$detalle}})" class="w-full px-4 py-4 text-xs text-green-600 cursor-pointer focus:outline-none hover:text-red-600">
                                                <p>Eliminar</p>
                                            </div>
                                        </td>

                                    </tr>
                                @endif
                                @if ($tipo_control=='ss')
                                    <tr tabindex="0" class="h-10 border border-gray-100 rounded focus:outline-none">
                                        <td class="text-center">
                                        <p class="mr-2 text-base font-medium leading-none text-gray-700">




                                            @if ($recep->id_g_recepcion)
                                                {{$recep->id_g_recepcion}}
                                            @endif


                                        </p>

                                        </td>
                                        <td class="text-center">
                                            <p class="mr-2 text-base font-medium leading-none text-gray-700">



                                                @if ($recep->numero_g_recepcion)
                                                    {{$recep->numero_g_recepcion}}

                                                @endif


                                            </p>

                                        </td>
                                        <td class="text-center">

                                                <p class="mr-2 text-base font-medium leading-none text-center text-gray-700">


                                                    @if ($detalle->temperatura)
                                                        {{$detalle->temperatura}}
                                                    @endif


                                                </p>

                                        </td>
                                        <td class="text-center">

                                            <p class="mr-2 text-base font-medium leading-none text-center text-gray-700">


                                                <p class="ml-2 text-sm leading-none text-gray-600 whitespace-nowrap">

                                                    1737
                                                </p>
                                            </div>
                                        </td>
                                        <td class="text-center">

                                                <p class="mr-2 text-base font-medium leading-none text-center text-gray-700">


                                                @if ($detalle->tipo_item)
                                                    {{$detalle->tipo_item}}
                                                @endif

                                            </p>

                                        </td>
                                        <td class="text-center">

                                            <p class="mr-2 text-base font-medium leading-none text-center text-gray-700">


                                                @if ($detalle->detalle_item)
                                                    {{$detalle->detalle_item}}
                                                @endif

                                            </p>

                                        </td>
                                        <td class="text-center">

                                            <p class="mr-2 text-base font-medium leading-none text-center text-gray-700">


                                                @if ($detalle->valor_ss)
                                                    {{$detalle->valor_ss}}

                                                @endif

                                            </p>

                                        </td>




                                        <td class="pl-5 text-center">

                                            @if ($detalle->fecha)
                                                {{date('d M Y', strtotime($detalle->fecha))}}
                                            @else
                                                {{date('d M Y', strtotime($detalle->created_at))}}
                                            @endif




                                        </td>



                                        <td>
                                            <div tabindex="0" wire:click="delete_detalle({{$detalle}})" class="w-full px-4 py-4 text-xs text-green-600 cursor-pointer focus:outline-none hover:text-red-600">
                                                <p>Eliminar</p>
                                            </div>
                                        </td>

                                    </tr>
                                @endif


                                @endif



                                @endforeach
                            @endif

                        </tbody>
                    </table>
                </x-table-responsive>
                @if ($detalles)
                    <div class="">
                        {{$detalles->links()}}
                    </div>

                @endif
            </div>

            <br>


        @else

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
                                    $n=1;
                                @endphp

                                @foreach ($recepcions as $recepcion)
                                    <tr class="text-white" style="background-color: #74b72f;">
                                        <td class="my-4 text-white">
                                            Agregar:
                                        </td>
                                        <td class="flex items-center content-center justify-center pb-1">
                                            <div class="px-2 py-1 mt-1 mb-1 text-xs leading-none text-center text-gray-600 bg-gray-100 rounded cursor-pointer focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 hover:bg-gray-200 focus:outline-none">
                                                Observación
                                            </div>

                                        </td>
                                        <td class="items-center content-center justify-center pb-1">
                                            <div class="px-2 py-1 mx-6 mt-1 mb-1 text-xs leading-none text-center text-gray-600 bg-gray-100 rounded cursor-pointer focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 hover:bg-gray-200 focus:outline-none">
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
                                    <tr tabindex="0" class="h-16 text-white border border-gray-100 rounded focus:outline-none" style="background-color: #008d39;">
                                        <td class="text-center">
                                        <p class="mr-2 text-base font-medium leading-none">




                                            @if ($recepcion->numero_g_recepcion)
                                        Lote: {{$recepcion->numero_g_recepcion}}
                                            @endif


                                        </p>

                                        </td>
                                        <td class="text-center">
                                            <p class="mr-2 text-base font-medium leading-none">



                                                @if ($recepcion->n_emisor)
                                                    {{$recepcion->n_emisor}}

                                                @endif


                                            </p>

                                        </td>
                                        <td class="">
                                            <div class="flex items-center pl-5">
                                                <p class="mr-2 text-base font-medium leading-none">


                                                    @if ($recepcion->n_especie)
                                                    {{$recepcion->n_especie}}

                                                    @endif


                                                </p>

                                            </div>
                                        </td>
                                        <td class="pl-5">
                                            <div class="flex items-center text-center whitespace-nowrap">

                                                <p class="ml-2 text-sm leading-none whitespace-nowrap">

                                                    @if ($recepcion->n_variedad)
                                                        {{$recepcion->n_variedad}}

                                                    @endif
                                                </p>
                                            </div>
                                        </td>
                                        <td class="pl-5 text-center whitespace-nowrap">
                                            <p class="mr-2 text-base font-medium leading-none text-center whitespace-nowrap">


                                            @if ($recepcion->fecha_g_recepcion)
                                                    {{date('d M Y g:i a', strtotime($recepcion->fecha_g_recepcion))}}


                                                @endif

                                            </p>

                                        </td>

                                        <td class="text-center">

                                            <p class="text-base ">



                                                    @if ($recepcion->numero_documento_recepcion)
                                                    {{$recepcion->numero_documento_recepcion}}
                                                    @endif

                                            </p>

                                        </td>
                                            <td class="pl-5 whitespace-nowrap">
                                                <p class="flex mr-2 text-base font-medium leading-none whitespace-nowrap">



                                                @if ($recepcion->cantidad)
                                                    {{number_format($recepcion->cantidad)}}
                                                @endif

                                            </p>

                                        </td>

                                        <td class="pl-5">


                                            @if ($recepcion->peso_neto)
                                                {{number_format($recepcion->peso_neto)}}
                                            @endif






                                        </td>

                                        <td class="pl-5 text-center">

                                            @if ($recepcion->nota_calidad==0)
                                                    S/N
                                            @elseif($recepcion->nota_calidad)
                                                {{number_format($recepcion->nota_calidad)}}
                                            @endif



                                        </td>



                                        <td>
                                            <div class="relative px-2 pt-2">
                                                <button class="rounded-md focus:ring-2 focus:outline-none" onclick="dropdownFunction(this)" role="button" aria-label="option">
                                                    <svg class="dropbtn" onclick="dropdownFunction(this)" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                        <path d="M4.16667 10.8332C4.62691 10.8332 5 10.4601 5 9.99984C5 9.5396 4.62691 9.1665 4.16667 9.1665C3.70643 9.1665 3.33334 9.5396 3.33334 9.99984C3.33334 10.4601 3.70643 10.8332 4.16667 10.8332Z" stroke="#9CA3AF" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M10 10.8332C10.4602 10.8332 10.8333 10.4601 10.8333 9.99984C10.8333 9.5396 10.4602 9.1665 10 9.1665C9.53976 9.1665 9.16666 9.5396 9.16666 9.99984C9.16666 10.4601 9.53976 10.8332 10 10.8332Z" stroke="#9CA3AF" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M15.8333 10.8332C16.2936 10.8332 16.6667 10.4601 16.6667 9.99984C16.6667 9.5396 16.2936 9.1665 15.8333 9.1665C15.3731 9.1665 15 9.5396 15 9.99984C15 10.4601 15.3731 10.8332 15.8333 10.8332Z" stroke="#9CA3AF" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                </button>
                                                <div class="absolute right-0 z-30 hidden w-24 mr-6 bg-white shadow dropdown-content">
                                                    <div tabindex="0" class="w-full px-4 py-4 text-xs cursor-pointer focus:outline-none focus:text-indigo-600 hover:bg-indigo-700 hover:text-white">
                                                        <p>Edit</p>
                                                    </div>
                                                    <div tabindex="0" class="w-full px-4 py-4 text-xs cursor-pointer focus:outline-none focus:text-indigo-600 hover:bg-indigo-700 hover:text-white">
                                                        <p>Delete</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                    </tr>



                                    @livewire('calidad.actualizar-datos', ['recepcion' => $recepcion], key($recepcion->id))



                                    <tr tabindex="0" class="h-20 border border-gray-100 rounded focus:outline-none">
                                        <td class="text-center">

                                        </td>
                                        <td class="text-center">
                                        <a href="{{route('agregar.cc',$recepcion)}}">
                                            <button  class="px-5 py-3 mb-4 text-sm leading-none text-red-600 bg-red-100 rounded focus:ring-2 focus:ring-offset-2 focus:ring-red-300 hover:bg-red-200 focus:outline-none">
                                                {{--
                                                @if ($recepcion->calidad->detalles->count())
                                                    FINALIZAR CC
                                                @else
                                                    AGREGAR CC
                                                @endif
                                                    --}}
                                                    AGREGAR CC


                                            </button>
                                        </a>
                                        </td>

                                        <td class="">
                                            <div class="flex items-center pl-5">

                                            <button wire:click="set_recepcion_ss({{$recepcion->id}})" class="px-5 py-3 mb-4 text-sm leading-none text-red-600 bg-red-100 rounded focus:ring-2 focus:ring-offset-2 focus:ring-red-300 hover:bg-red-200 focus:outline-none">
                                                AGREGAR SS
                                            </button>

                                            </div>
                                        </td>
                                        <td class="pl-5">
                                            <div class="flex items-center text-center whitespace-nowrap">
                                            <a href="{{route('informe.download',$recepcion)}}">
                                                <button class="px-5 py-3 mb-4 text-sm leading-none text-red-600 bg-red-100 rounded focus:ring-2 focus:ring-offset-2 focus:ring-red-300 hover:bg-red-200 focus:outline-none">
                                                    VER INFORME PREVIO2
                                                </button>
                                            </a>
                                            <a href="{{route('calibre_brix',$recepcion)}}" target="_blank" class="px-5 py-3 mb-4 text-sm leading-none text-red-600 bg-red-100 rounded focus:ring-2 focus:ring-offset-2 focus:ring-red-300 hover:bg-red-200 focus:outline-none">VER CALIBRE-BRIX</a>

                                            </div>
                                        </td>
                                        <td class="pl-5 text-center whitespace-nowrap">

                                            <button class="px-5 py-3 mb-4 text-sm leading-none text-red-600 bg-red-100 rounded focus:ring-2 focus:ring-offset-2 focus:ring-red-300 hover:bg-red-200 focus:outline-none">
                                                VALIDAR INFORME
                                            </button>


                                        </td>
                                        <td class="pl-5 whitespace-nowrap">
                                            <button class="px-5 py-3 mb-4 text-sm leading-none text-red-600 bg-red-100 rounded focus:ring-2 focus:ring-offset-2 focus:ring-red-300 hover:bg-red-200 focus:outline-none">
                                            CARGAR FIMPRO
                                            </button>


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





                                @endforeach


                            </tbody>
                        </table>
                    </x-table-responsive>
                    @if ($recepcions->count())
                    <div class="">
                        {{$recepcions->links()}}
                    </div>

                    @endif
            </div>

        @endif


        </div>
    </div>

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $("#divCategoria").hide();
        $("#selectedparametro").on("change", function() {
            var selectedValue = $(this).val();
            if(selectedValue == "4" || selectedValue == "5"){
                $("#divCategoria").show();

            }
            else{
                $("#divCategoria").hide();
            }
        })
    });
    </script>
