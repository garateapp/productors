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
        <div class="sm:px-6 w-full">
        <div class="px-6 py-4 hidden">
            <input wire:keydown="limpiar_page" wire:model="search"  class="form-input flex-1 w-full shadow-sm  border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg focus:outline-none" placeholder="Ingrese la variedad, especie o lote de la recepción" autocomplete="off">
        </div>
        
        <div class="sm:flex items-center justify-between my-2">

            <div class="flex justify-between">
                @if ($recep)
                    <div class="max-w-7xl  bg-white shadow rounded-lg p-4 sm:p-4 xl:p-4 my-4 mr-2 ml-12">
                    <div class="flex items-center justify-center">
                        <div class="flex-shrink-0 text-center">
                            <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900"> {{$recep->numero_g_recepcion}}</span>
                            <h3 class="text-base font-normal text-gray-500">Lote</h3>
                        </div>
                        
                    </div>
                    </div>
                    <div class="max-w-7xl  bg-white shadow rounded-lg p-4 sm:p-4 xl:p-4 my-4 mr-2 ml-12">
                        <div class="flex items-center justify-center">
                            <div class="flex-shrink-0 text-left">
                                <h3 class="text-base font-normal text-gray-500">{{$recep->n_emisor}}</h3>
                                <h3 class="text-base font-normal text-gray-500">Guia: {{$recep->numero_documento_recepcion}}</h3>
                                <h3 class="text-base font-normal text-gray-500">Especie: {{$recep->n_especie}}</h3>
                                <h3 class="text-base font-normal text-gray-500">Variedad: {{$recep->n_variedad}}</h3>
                            </div>
                            
                        </div>
                    </div>

                    <div class="hidden max-w-7xl  bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 my-4 mr-2 ml-12">
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
                                    <div class="flex gap-x-2 mb-2">
                                        <button  class="items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-6 py-3 bg-gray-500 hover:bg-gray-500 focus:outline-none rounded">
                                            <p class="text-sm font-medium leading-none text-white">50</p>
                                        </button>
                                        <button  class="items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-6 py-3 bg-gray-500 hover:bg-gray-500 focus:outline-none rounded">
                                            <p class="text-sm font-medium leading-none text-white">80</p>
                                        </button>
                                        <button  class="items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-6 py-3 bg-gray-500 hover:bg-gray-500 focus:outline-none rounded">
                                            <p class="text-sm font-medium leading-none text-white">100</p>
                                        </button>
                                    </div>
                                    <input wire:model="nro_muestra" type="number" class="form-input w-full border-2 border-gray-300 bg-white h-10 rounded-lg text-sm focus:outline-none">
                                    <div class="flex justify-center mt-2">
                                        <button wire:click="calidad_store" class="mx-4 focus:ring-2 focus:ring-offset-2 focus:ring-green-500 mt-4 sm:mt-0 inline-flex items-start justify-start px-6 py-3 bg-green-500 hover:bg-green-500 focus:outline-none rounded">
                                            <h1 style="font-size: 1rem;white-space: nowrap;" class="text-center text-white font-bold inline w-full" >
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
                    
                
                    <h1 class="hidden text-center text-sm my-4 mx-6"><b>Ultima Sincronizacion:</b> {{date('d M Y g:i a', strtotime($sync->fecha))}} <b>Tipo:</b> {{$sync->tipo}} <b>Cantidad:</b> {{$sync->cantidad}}</h1>
    
                        
                        
                    <div class="flex justify-center mb-2 items-center content-center"> 
                        <a href="{{route('production.refresh')}}">
                            <button  class="hidden items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-6 py-3 bg-gray-500 hover:bg-gray-500 focus:outline-none rounded">
                                <p class="text-sm font-medium leading-none text-white">FX IMPORT</p>
                            </button>
                        </a>
                        <select wire:model="ctd" class="max-w-xl  mx-2 bg-gray-200 border border-gray-200 text-gray-700 py-3 px-6 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                            <option value="25" class="text-left px-10">25 </option>
                            <option value="50" class="text-left px-10">50 </option>
                            <option value="100" class="text-left px-10">100 </option>
                            <option value="500" class="text-left px-10">500 </option>
                            
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
                <div class="max-w-5xl grid grid-cols-3 gap-x-4 mt-4 mx-12">
                    <div>
                        @if ($tipo_control=='cc')
                            <p class="font-bold">Tipo Item: </p> 
                        @endif
                        @if ($tipo_control=='ss')
                            <p class="font-bold">Tamaño: </p> 
                        @endif
                            

                        <select wire:model="selectedparametro" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
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
                    
                        <select wire:model="selectedvalor" class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
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
                    <div>
                        <p class="font-bold hidden">Fecha </p> 
                        <input type="date" wire:model="fecha" class="hidden form-input flex-1 w-full shadow-sm  border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg focus:outline-none" >
                    
                        
                    </div>
                </div>
                
            </div>
            <div class="flex justify-center mt-4">
                <div class="max-w-5xl grid grid-cols-3 gap-x-4 mt-4 mx-12">
                    <div class="justify-center content-center">
                        @if ($tipo_control=='cc')
                            <p class="font-bold">Embalaje: </p> 
                            <input wire:model="embalaje" type="number"  class="form-input flex-1 w-full shadow-sm  border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg focus:outline-none" autocomplete="off">
                        @endif
                        @if ($tipo_control=='ss')
                            <p class="font-bold">Temperatura: </p> 
                            <input wire:model="temperatura" type="number" placeholder="20.9" class="form-input flex-1 w-full shadow-sm  border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg focus:outline-none" autocomplete="off">
                        @endif
                        
                        
                    </div>
                    <div class="justify-center content-center">
                        @if ($total_muestra==0)
                            
                            <button wire:click="muestra_clean" class="mb-4 focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none text-red-600 py-3 px-5 bg-red-600 rounded hover:bg-red-500 focus:outline-none">

                                <h1 style="font-size: 1rem;white-space: nowrap;" class="text-center text-white font-bold inline w-full" >
                                    ERROR! Total Muestra = 0
                                    
                                </h1>
                            </button>
                        @endif
                        @if ($tipo_control=='cc')
                            <p class="font-bold">% Muestra: </p> 
                            <input wire:model="porcentaje_muestra" type="number" disabled placeholder="25.3" class="form-input flex-1 w-full shadow-sm  border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg focus:outline-none" autocomplete="off">
                        @endif
                        @if ($tipo_control=='ss')
                            <p class="font-bold">Valor: </p> 
                            <input wire:model="valor" type="number"  class="form-input flex-1 w-full shadow-sm  border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg focus:outline-none" autocomplete="off">
                    
                        @endif
                        
                        
                        
                        
                        

                    </div>
                    <div class="justify-center content-center">
                        @if ($tipo_control=='cc')
                            <p class="font-bold">Cantidad Muestra: </p> 
                            <input wire:change="actualizar_porcentaje" wire:model="cantidad" type="number" class="form-input flex-1 w-full shadow-sm  border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg focus:outline-none" autocomplete="off">
                            @error('cantidad')
                                <span class="text-sm text-red-500">{{$message}}</span>
                            @enderror
                            <p class="font-bold">Total Muestra: </p> 
                            <input wire:change="actualizar_porcentaje" wire:model="total_muestra" type="number"  class="form-input flex-1 w-full shadow-sm  border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg focus:outline-none" autocomplete="off">
                        @endif
                        
                    </div>
                </div>
                
            </div>

            <div class="flex justify-center gap-2 mt-4">
              
                @if ($tipo_control=='cc')
                    <button wire:click="detalle_store" class="mb-4 focus:ring-2 focus:ring-offset-2 focus:ring-green-300 text-sm leading-none text-green-600 py-3 px-5 bg-green-600 rounded hover:bg-green-500 focus:outline-none">

                        <h1 style="font-size: 1rem;white-space: nowrap;" class="text-center text-white font-bold inline w-full" >
                        Agregar
                            
                        </h1>
                    </button>
                @endif
                @if ($tipo_control=='ss')
                    <button wire:click="ss_store" class="mb-4 focus:ring-2 focus:ring-offset-2 focus:ring-green-300 text-sm leading-none text-green-600 py-3 px-5 bg-green-600 rounded hover:bg-green-500 focus:outline-none">

                        <h1 style="font-size: 1rem;white-space: nowrap;" class="text-center text-white font-bold inline w-full" >
                        Agregar
                            
                        </h1>
                    </button>
                @endif
                <a href="{{route('productioncc.index')}}">
                    <button class="mb-4 focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none text-red-600 py-3 px-5 bg-red-600 rounded hover:bg-red-500 focus:outline-none">
                    <h1 style="font-size: 1rem;white-space: nowrap;" class="text-center text-white font-bold inline w-full" >
                        Cancelar
                    </h1>
                    </button>
                </a>
            
            </div>

            <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10 mt-6">
                <x-table-responsive>   
                    <table class="min-w-full divide-y divide-gray-200 mb-20 pb-20">
            
                        <thead class="bg-gray-50 rounded-full">
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
                                    <tr tabindex="0" class="focus:outline-none h-10 border border-gray-100 rounded">
                                        <td class="text-center">
                                        <p class="text-base font-medium leading-none text-gray-700 mr-2">

                                        

                                                
                                            @if ($recep->id_g_recepcion)
                                                {{$recep->id_g_recepcion}}
                                            @endif 
                                            
                                                
                                        </p>
                                        
                                        </td>
                                        <td class="text-center">
                                            <p class="text-base font-medium leading-none text-gray-700 mr-2">
                
                                            
                
                                                @if ($recep->numero_g_recepcion)
                                                    {{$recep->numero_g_recepcion}}
                                                    
                                                @endif
                                            
                                                
                                            </p>
                                        
                                        </td>
                                        <td class="text-center">

                                                <p class="text-base font-medium leading-none text-gray-700 mr-2 text-center">
                
                                                
                                                    @if ($detalle->embalaje)
                                                        {{$detalle->embalaje}}
                                                    @endif
                                                
                                                    
                                                </p>
                                    
                                        </td>
                                        <td class="pl-5">
                                            <div class="whitespace-nowrap flex items-center text-center">
                                                
                                                <p class="whitespace-nowrap text-sm leading-none text-gray-600 ml-2">
                                            
                                                    1737
                                                </p>
                                            </div>
                                        </td>
                                        <td class="pl-5 whitespace-nowrap">
                                            <p class="whitespace-nowrap text-base font-medium leading-none text-gray-700 mr-2">
                
                                        
                                                @if ($detalle->tipo_item)
                                                    {{$detalle->tipo_item}}
                                                @endif
                                            
                                            </p>
                                        
                                        </td>
                                        <td class="pl-5 whitespace-nowrap">
                                            <p class="whitespace-nowrap  text-base flex font-medium leading-none text-gray-700 mr-2">

                                        

                                                @if ($detalle->detalle_item)
                                                    {{$detalle->detalle_item}}
                                                @endif
                                                    
                                            </p>
                                            
                                        </td>
                                        <td class="pl-5 whitespace-nowrap">
                                            <p class="whitespace-nowrap  text-base flex font-medium leading-none text-gray-700 mr-2">

                                                @if ($recep->n_especie=='Cherries') 
                                                    @if ($detalle->valor_ss)
                                                        {{$detalle->valor_ss}}
                                                    @endif
                                                @endif
                                                
                                                @if ($detalle->tipo_item!='DISTRIBUCIÓN DE CALIBRES')
                                                    @if ($detalle->porcentaje_muestra)
                                                        {{$detalle->porcentaje_muestra}}
                                                    @endif
                                                @elseif($recep->n_especie=='Orange' || $recep->n_especie=='Peaches' || $recep->n_especie=='Apples' || $recep->n_especie=='Pears' || $recep->n_especie=='Nectarines' || $recep->n_especie=='Plums' || $recep->n_especie=='Mandarinas' || $recep->n_especie=='Membrillos' || $recep->n_especie=='Paltas')
                                                    @if ($detalle->porcentaje_muestra)
                                                        {{$detalle->porcentaje_muestra}}
                                                    @endif
                                                @endif
                                               
                                                    
                                            </p>
                                            
                                        </td>
                                            <td class="pl-5 whitespace-nowrap">
                                                <p class="whitespace-nowrap  text-base flex font-medium leading-none text-gray-700 mr-2">
                
                                                
                                                    @if ($recepcion->n_especie=='Cherries') 
                                                        @if ($detalle->valor_ss)
                                                            {{$detalle->valor_ss}}
                                                        @endif
                                                    @endif
                                                   
                                                        @if ($detalle->cantidad)
                                                            {{$detalle->cantidad}}
                                                        @endif
                                                    
                                            </p>
                                            
                                        </td>
                                        
                                        <td class="pl-5 text-center">
                                        
                
                                        
                                            @switch($detalle->estado)
                                            @case(1)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                    Pendiente
                                                </span>
                                                @break
                                            @case(2)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
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
                                        
                                                    
                                    
                                        <td>
                                            <div tabindex="0" wire:click="delete_detalle({{$detalle}})" class="focus:outline-none text-green-600 text-xs w-full py-4 px-4 cursor-pointer hover:text-red-600">
                                                <p>Eliminar</p>
                                            </div>
                                        </td>
                                    
                                    </tr>
                                @endif
                                @if ($tipo_control=='ss')
                                    <tr tabindex="0" class="focus:outline-none h-10 border border-gray-100 rounded">
                                        <td class="text-center">
                                        <p class="text-base font-medium leading-none text-gray-700 mr-2">

                                        

                                                
                                            @if ($recep->id_g_recepcion)
                                                {{$recep->id_g_recepcion}}
                                            @endif 
                                            
                                                
                                        </p>
                                        
                                        </td>
                                        <td class="text-center">
                                            <p class="text-base font-medium leading-none text-gray-700 mr-2">
                
                                            
                
                                                @if ($recep->numero_g_recepcion)
                                                    {{$recep->numero_g_recepcion}}
                                                    
                                                @endif
                                            
                                                
                                            </p>
                                        
                                        </td>
                                        <td class="text-center">

                                                <p class="text-base font-medium leading-none text-gray-700 mr-2 text-center">
                
                                                
                                                    @if ($detalle->temperatura)
                                                        {{$detalle->temperatura}}
                                                    @endif
                                                
                                                    
                                                </p>
                                    
                                        </td>
                                        <td class="text-center">

                                            <p class="text-base font-medium leading-none text-gray-700 mr-2 text-center">
            
                                                
                                                <p class="whitespace-nowrap text-sm leading-none text-gray-600 ml-2">
                                            
                                                    1737
                                                </p>
                                            </div>
                                        </td>
                                        <td class="text-center">

                                                <p class="text-base font-medium leading-none text-gray-700 mr-2 text-center">
                
                                        
                                                @if ($detalle->tipo_item)
                                                    {{$detalle->tipo_item}}
                                                @endif
                                            
                                            </p>
                                        
                                        </td>
                                        <td class="text-center">

                                            <p class="text-base font-medium leading-none text-gray-700 mr-2 text-center">
            

                                                @if ($detalle->detalle_item)
                                                    {{$detalle->detalle_item}}
                                                @endif
                                                    
                                            </p>
                                            
                                        </td>
                                        <td class="text-center">

                                            <p class="text-base font-medium leading-none text-gray-700 mr-2 text-center">
            
                                        
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
                                            <div tabindex="0" wire:click="delete_detalle({{$detalle}})" class="focus:outline-none text-green-600 text-xs w-full py-4 px-4 cursor-pointer hover:text-red-600">
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

            <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10">
                    <x-table-responsive>   
                        <table class="min-w-full divide-y divide-gray-200 mb-20 pb-20">
                
                            <thead class="bg-gray-50 rounded-full">
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
                                        <td class="flex justify-center items-center content-center pb-1">
                                            <div class="text-center cursor-pointer focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 text-xs leading-none text-gray-600 py-1 px-2 bg-gray-100 rounded hover:bg-gray-200 focus:outline-none mb-1 mt-1">
                                                Observación
                                            </div>
                                        
                                        </td>
                                        <td class="justify-center items-center content-center pb-1">
                                            <div class="text-center cursor-pointer focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 text-xs leading-none text-gray-600 py-1 px-2 bg-gray-100 rounded hover:bg-gray-200 focus:outline-none mb-1 mt-1 mx-6">
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
                                    <tr tabindex="0" class="focus:outline-none h-16 border border-gray-100 rounded text-white" style="background-color: #008d39;">
                                        <td class="text-center">
                                        <p class="text-base font-medium leading-none  mr-2">

                                        

                                                
                                            @if ($recepcion->numero_g_recepcion)
                                        Lote: {{$recepcion->numero_g_recepcion}}
                                            @endif 
                                            
                                                
                                        </p>
                                        
                                        </td>
                                        <td class="text-center">
                                            <p class="text-base font-medium leading-none  mr-2">
                
                                            
                
                                                @if ($recepcion->n_emisor)
                                                    {{$recepcion->n_emisor}}
                                                    
                                                @endif
                                            
                                                
                                            </p>
                                        
                                        </td>
                                        <td class="">
                                            <div class="flex items-center pl-5">
                                                <p class="text-base font-medium leading-none  mr-2">
                
                                                
                                                    @if ($recepcion->n_especie)
                                                    {{$recepcion->n_especie}}
                                                    
                                                    @endif
                                                
                                                    
                                                </p>
                                            
                                            </div>
                                        </td>
                                        <td class="pl-5">
                                            <div class="whitespace-nowrap flex items-center text-center">
                                                
                                                <p class="whitespace-nowrap text-sm leading-none  ml-2">
                                            
                                                    @if ($recepcion->n_variedad)
                                                        {{$recepcion->n_variedad}}
                                                        
                                                    @endif
                                                </p>
                                            </div>
                                        </td>
                                        <td class="pl-5 text-center whitespace-nowrap">
                                            <p class="whitespace-nowrap text-base text-center font-medium leading-none  mr-2">
                
                                        
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
                                                <p class="whitespace-nowrap  text-base flex font-medium leading-none  mr-2">
                
                                                
                
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
                                                <button class="focus:ring-2 rounded-md focus:outline-none" onclick="dropdownFunction(this)" role="button" aria-label="option">
                                                    <svg class="dropbtn" onclick="dropdownFunction(this)" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                        <path d="M4.16667 10.8332C4.62691 10.8332 5 10.4601 5 9.99984C5 9.5396 4.62691 9.1665 4.16667 9.1665C3.70643 9.1665 3.33334 9.5396 3.33334 9.99984C3.33334 10.4601 3.70643 10.8332 4.16667 10.8332Z" stroke="#9CA3AF" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M10 10.8332C10.4602 10.8332 10.8333 10.4601 10.8333 9.99984C10.8333 9.5396 10.4602 9.1665 10 9.1665C9.53976 9.1665 9.16666 9.5396 9.16666 9.99984C9.16666 10.4601 9.53976 10.8332 10 10.8332Z" stroke="#9CA3AF" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
                                                        <path d="M15.8333 10.8332C16.2936 10.8332 16.6667 10.4601 16.6667 9.99984C16.6667 9.5396 16.2936 9.1665 15.8333 9.1665C15.3731 9.1665 15 9.5396 15 9.99984C15 10.4601 15.3731 10.8332 15.8333 10.8332Z" stroke="#9CA3AF" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
                                                    </svg>
                                                </button>
                                                <div class="dropdown-content bg-white shadow w-24 absolute z-30 right-0 mr-6 hidden">
                                                    <div tabindex="0" class="focus:outline-none focus:text-indigo-600 text-xs w-full hover:bg-indigo-700 py-4 px-4 cursor-pointer hover:text-white">
                                                        <p>Edit</p>
                                                    </div>
                                                    <div tabindex="0" class="focus:outline-none focus:text-indigo-600 text-xs w-full hover:bg-indigo-700 py-4 px-4 cursor-pointer hover:text-white">
                                                        <p>Delete</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    
                                    </tr>

                                 
                                    
                                    @livewire('calidad.actualizar-datos', ['recepcion' => $recepcion], key($recepcion->id))

                                    

                                    <tr tabindex="0" class="focus:outline-none h-20 border border-gray-100 rounded">
                                        <td class="text-center">
                                        
                                        </td>
                                        <td class="text-center">
                                        <a href="{{route('agregar.cc',$recepcion)}}">
                                            <button  class="mb-4 focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none text-red-600 py-3 px-5 bg-red-100 rounded hover:bg-red-200 focus:outline-none">
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
                                            
                                            <button wire:click="set_recepcion_ss({{$recepcion->id}})" class="mb-4 focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none text-red-600 py-3 px-5 bg-red-100 rounded hover:bg-red-200 focus:outline-none">
                                                AGREGAR SS
                                            </button>
                                            
                                            </div>
                                        </td>
                                        <td class="pl-5">
                                            <div class="whitespace-nowrap flex items-center text-center">
                                            <a href="{{route('informe.download',$recepcion)}}">
                                                <button class="mb-4 focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none text-red-600 py-3 px-5 bg-red-100 rounded hover:bg-red-200 focus:outline-none">
                                                    VER INFORME PREVIO
                                                </button>
                                            </a>
                                            
                                            </div>
                                        </td>
                                        <td class="pl-5 text-center whitespace-nowrap">

                                            <button class="mb-4 focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none text-red-600 py-3 px-5 bg-red-100 rounded hover:bg-red-200 focus:outline-none">
                                                VALIDAR INFORME
                                            </button>
                                        
                                        
                                        </td>
                                        <td class="pl-5 whitespace-nowrap">
                                            <button class="mb-4 focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none text-red-600 py-3 px-5 bg-red-100 rounded hover:bg-red-200 focus:outline-none">
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