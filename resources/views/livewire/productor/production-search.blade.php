<div>
    <div class="pb-12">
        <div class="sm:px-6 w-full">
        <div class="px-6 py-4">
            <input wire:keydown="limpiar_page" wire:model="search"  class="form-input flex-1 w-full shadow-sm  border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg focus:outline-none" placeholder="Ingrese el variedad, especie o lote de la recepción" autocomplete="off">
        </div>
        
        <div class="sm:flex items-center justify-between my-2">
            <p class="text-sm font-medium leading-none text-gray-800">Recepciones: {{$allrecepcions->count()}}</p>
            <div class="flex"> 
                <a href="{{route('production.refresh')}}">
                    <button  class="focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 mt-4 sm:mt-0 inline-flex items-start justify-start px-6 py-3 bg-gray-500 hover:bg-gray-500 focus:outline-none rounded">
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
        </div>
                        

        <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10">
            <x-table-responsive>   
            <table class="min-w-full divide-y divide-gray-200 mb-20 pb-20">
    
                <thead class="bg-gray-50 rounded-full">
                    <th>ID</th>
                    <th>Agricola</th>
                    <th>Especie</th>
                    <th>Variedad</th>
                    <th class="text-center">Fecha</th>
                    <th class="text-center">Lote</th>
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
                {{-- comment        {{$n.') '.$recepcion}}<br>
                                        @php
                                            $m=1;
                                            $n+=1;
                                        @endphp
                                        
                                    @foreach ($recepcion as $item)
                                    {{$m}}) {{$item}}<br>
                                        
                                            @php
                                                $m+=1;
                                            @endphp
                                    @endforeach
                                    --}}  
                        {{-- comment  --}}    
                        <tr tabindex="0" class="focus:outline-none h-16 border border-gray-100 rounded">
                            <td class="text-center">
                            <p class="text-base font-medium leading-none text-gray-700 mr-2">

                            

                                    
                                @if ($recepcion->id_g_recepcion)
                                    {{$recepcion->id_g_recepcion}}
                                @endif 
                                
                                    
                            </p>
                            
                            </td>
                            <td class="text-center">
                                <p class="text-base font-medium leading-none text-gray-700 mr-2">
    
                                
    
                                    @if ($recepcion->n_emisor)
                                        {{$recepcion->n_emisor}}
                                        
                                    @endif
                                
                                    
                                </p>
                            
                            </td>
                            <td class="">
                                <div class="flex items-center pl-5">
                                    <p class="text-base font-medium leading-none text-gray-700 mr-2">
    
                                    
                                        @if ($recepcion->n_especie)
                                        {{$recepcion->n_especie}}
                                        
                                        @endif
                                    
                                        
                                    </p>
                                
                                </div>
                            </td>
                            <td class="pl-5">
                                <div class="whitespace-nowrap flex items-center text-center">
                                    
                                    <p class="whitespace-nowrap text-sm leading-none text-gray-600 ml-2">
                                
                                        @if ($recepcion->n_variedad)
                                            {{$recepcion->n_variedad}}
                                            
                                        @endif
                                    </p>
                                </div>
                            </td>
                            <td class="pl-5 text-center whitespace-nowrap">
                                <p class="whitespace-nowrap text-base text-center font-medium leading-none text-gray-700 mr-2">
    
                            
                                @if ($recepcion->fecha_g_recepcion)
                                        {{date('d M Y g:i a', strtotime($recepcion->fecha_g_recepcion))}}
                                        
                                        
                                    @endif
                                
                                </p>
                            
                            </td>
                            <td class="pl-5 whitespace-nowrap">
                                <p class="whitespace-nowrap  text-base flex font-medium leading-none text-gray-700 mr-2">

                            

                                        @if ($recepcion->numero_g_recepcion)
                                        {{$recepcion->numero_g_recepcion}}
                                        @endif
                                        
                                </p>
                                
                            </td>
                            <td class="pl-5 whitespace-nowrap">
                                <p class="whitespace-nowrap  text-base flex font-medium leading-none text-gray-700 mr-2">

                            

                                        @if ($recepcion->numero_documento_recepcion)
                                        {{$recepcion->numero_documento_recepcion}}
                                        @endif
                                        
                                </p>
                                
                            </td>
                                <td class="pl-5 whitespace-nowrap">
                                    <p class="whitespace-nowrap  text-base flex font-medium leading-none text-gray-700 mr-2">
    
                                    
    
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
                            
                                        {{-- commen
                            <td class="pl-4">
                                <button class="focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none text-gray-600 py-3 px-5 bg-gray-100 rounded hover:bg-gray-200 focus:outline-none">Ver</button>
                            </td> --}}
                            <td>
                                <div class="relative px-5 pt-2">
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
        </div>
    </div>
              
</div>
