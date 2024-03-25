<div>
    <div class="flex justify-end my-4">                     
            <div class="flex"> 
                <select wire:model.live="selectedespecie" class="mx-auto w-full block appearance-none bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option value="" class="text-center"> - </option>
                    @foreach ($especies as $especie)
                        <option value="{{$especie->id}}" class="text-center mx-4">{{$especie->name}}</option>
                    @endforeach
                      
                </select> 

                <button class="mx-2 items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-6 py-3 bg-gray-500 hover:bg-gray-600 focus:outline-none rounded">
                    <p class="text-sm font-medium leading-none text-white">Exportar en Excel</p>
                </button>
            </div>
       
    </div>
        <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10 mt-6">
            <x-table-responsive>   
                <table class="min-w-full divide-y divide-gray-200 mb-20 pb-20">
        
                    <thead class="bg-gray-50 rounded-full">
                        <th>ID</th>
                        <th>Lote</th>
                        <th>Especie</th>
                        <th>Embalaje</th>
                        <th>Cantidad</th>
                        <th class="text-center">Tipo Item</th>
                        <th class="text-center">Detalle Item</th>
                        <th class="text-center">% Muestra</th>
                        <th class="text-center">Cantidad Muestra</th>
                        <th>Estado</th>
                        <th class="text-center">Fecha</th>
                   
                        
                    
                      
                  
                        
                    </thead>
                    <tbody>
                        @php
                            $n=1;
                        @endphp
                        @if ($detalles->count()>0)
                            @foreach ($detalles as $detalle)
    
                        
                           
                                    
                                @if ($detalle->tipo_detalle=='cc')
                                    <tr tabindex="0" class="focus:outline-none h-10 border border-gray-100 rounded">
                                        <td class="text-center">
                                        <p class="text-base font-medium leading-none text-gray-700 mr-2">
    
                                        
    
                                                
                                            @if ($detalle->calidad->recepcion->id_g_recepcion)
                                                {{$detalle->calidad->recepcion->id_g_recepcion}} (CC)
                                            @endif 
                                            
                                                
                                        </p>
                                        
                                        </td>
                                        <td class="text-center">
                                            <p class="text-base font-medium leading-none text-gray-700 mr-2">
                
                                            
                
                                                @if ($detalle->calidad->recepcion->numero_g_recepcion)
                                                    {{$detalle->calidad->recepcion->numero_g_recepcion}}
                                                    
                                                @endif
                                            
                                                
                                            </p>
                                        
                                        </td>
                                        <td class="text-center">
                                            <p class="text-base font-medium leading-none text-gray-700 mr-2">
                
                                            
                
                                                @if ($detalle->calidad->recepcion->numero_g_recepcion)
                                                    {{$detalle->calidad->recepcion->n_especie}}
                                                    
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
    
                                                @if ($detalle->calidad->recepcion->n_especie=='Cherries') 
                                                    
                                                        {{$detalle->valor_ss}}
                                                    
                                                @endif
                                                
                                                @if ($detalle->tipo_item!='DISTRIBUCIÓN DE CALIBRES')
                                                    @if ($detalle->porcentaje_muestra>=0)
                                                        {{$detalle->porcentaje_muestra}}
                                                    @endif
                                                @elseif($detalle->calidad->recepcion->n_especie=='Orange' || $detalle->calidad->recepcion->n_especie=='Peaches' || $detalle->calidad->recepcion->n_especie=='Apples' || $detalle->calidad->recepcion->n_especie=='Pears' || $detalle->calidad->recepcion->n_especie=='Nectarines' || $detalle->calidad->recepcion->n_especie=='Plums' || $detalle->calidad->recepcion->n_especie=='Mandarinas' || $detalle->calidad->recepcion->n_especie=='Membrillos' || $detalle->calidad->recepcion->n_especie=='Paltas')
                                                    @if ($detalle->porcentaje_muestra>=0)
                                                        {{$detalle->porcentaje_muestra}}
                                                
                                                    @endif
                                                @endif
                                            
                                                    
                                            </p>
                                            
                                        </td>
                                            <td class="pl-5 whitespace-nowrap">
                                                <p class="whitespace-nowrap  text-base flex font-medium leading-none text-gray-700 mr-2">
                
                                                
                                                    @if ($detalle->calidad->recepcion->n_especie=='Cherries' || $detalle->calidad->recepcion->n_variedad=='Dagen') 
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
                                          
                                            
                                        </td>
                                    
                                    </tr>
                                @endif
                                @if ($detalle->tipo_detalle=='ss')
                                    <tr tabindex="0" class="focus:outline-none h-10 border border-gray-100 rounded">
                                        <td class="text-center">
                                        <p class="text-base font-medium leading-none text-gray-700 mr-2">
    
                                        
    
                                                
                                            @if ($detalle->calidad->recepcion->id_g_recepcion)
                                                {{$detalle->calidad->recepcion->id_g_recepcion}} (SS)
                                            @endif 
                                            
                                                
                                        </p>
                                        
                                        </td>
                                        <td class="text-center">
                                            <p class="text-base font-medium leading-none text-gray-700 mr-2">
                
                                            
                
                                                @if ($detalle->calidad->recepcion->numero_g_recepcion)
                                                    {{$detalle->calidad->recepcion->numero_g_recepcion}}
                                                    
                                                @endif
                                            
                                                
                                            </p>
                                        
                                        </td>
                                        <td class="text-center">
                                            <p class="text-base font-medium leading-none text-gray-700 mr-2">
                
                                            
                
                                                @if ($detalle->calidad->recepcion->numero_g_recepcion)
                                                    {{$detalle->calidad->recepcion->n_especie}}
                                                    
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
                                        <td class="text-center">
    
                                            <p class="text-base font-medium leading-none text-gray-700 mr-2 text-center">
            
                                        
                                                @if ($detalle->valor_ss)
                                                    {{$detalle->valor_ss}}
                                                    
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
                                           
                                        </td>
                                    
                                    </tr>
                                @endif
                            
                        
                                
            
                            @endforeach
                        @endif
                    
                    </tbody>
                </table>
            </x-table-responsive>
            <div>
                {{$detalles->links()}}
            </div>
        </div>
</div>
