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
        <div class="px-6 py-4">
            <input wire:keydown="limpiar_page" wire:model="search"  class="form-input flex-1 w-full shadow-sm  border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg focus:outline-none" placeholder="Ingrese la variedad, especie o lote de la recepción" autocomplete="off">
        </div>

        <div class="mx-2 sm:mx-12 md:mx-14 grid grid-cols-3 sm:grid-cols-3 md:grid-cols-6 lg:grid-cols-9 gap-y-4 gap-x-3 justify-between  content-center">
            @if ($espec)
                <button wire:click="espec_clean"   class="items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-3 py-3 hover:bg-gray-500 focus:outline-none rounded content-center" style="background-color: #FF8000;">
                    <p class="text-sm font-medium leading-none text-white">{{$espec->name}}</p>
                </button>
            
                @if ($variedades)
   
                    @if ($varie)
                        <button wire:click="varie_clean"  class="items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-3 py-3 hover:bg-gray-500 focus:outline-none rounded" style="background-color: #008d39;">
                            <p class="whitespace-nowrap text-sm font-medium leading-none text-white">{{$varie->name}}</p>
                        </button>
                    @else
                        @foreach ($variedades as $variedad)
                            @if ($variedad->especie_id==$espec->id)
                              <div class="flex justify-center">
                                <button wire:click="set_varie({{$variedad->id}})"  class=" w-full items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-2 py-3 hover:bg-gray-500 focus:outline-none rounded" style="background-color: #008d39;">
                                    <p class="whitespace-nowrap text-sm font-medium leading-none text-white">{{$variedad->name}}</p>
                                </button>
                              </div>
                            @endif
                        @endforeach
                    @endif
   
                  
                @endif
            @else
                @foreach ($especies as $especie)
                <div class="justify-center ">
                    <button wire:click="set_especie({{$especie->id}})"  class="w-full items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-4 py-3 hover:bg-gray-500 focus:outline-none rounded" style="background-color: #008d39;">
                        <p class="whitespace-nowrap text-sm font-medium leading-none text-white">{{$especie->name}}</p>
                    </button>
                </div>
                @endforeach
                
            @endif
        
        </div>
        
        <div class="sm:flex items-center justify-between my-2">

            <div class="flex justify-between">
            
             
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
                                    <tr class="text-white h-5" style="background-color: #74b72f;">
                                        <td class="my-4 text-white">
                                           {{-- Agregar: --}} 
                                        </td>
                                        <td class="items-center content-center pb-1">
                                            <div class="flex justify-center ">
                                                <a href="{{route('observacion.externa',$recepcion)}}" target="_blank">
                                                    <div class="text-center cursor-pointer focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 text-xs leading-none text-gray-600 py-1 px-2 bg-gray-100 rounded hover:bg-gray-200 focus:outline-none mt-1">
                                                        Observación
                                                    </div>
                                                </a>
                                            </div>
                                            @if ($recepcion->calidad->obs_ext)
                                                <div class="flex justify-center ">
                                                    <div class="mx-12 text-center cursor-pointer focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 text-xs leading-none text-gray-600 py-1 px-2 bg-gray-100 rounded hover:bg-gray-200 focus:outline-none mb-1 mt-1">
                                                        {{Str::limit($recepcion->calidad->obs_ext,30)}}
                                                    </div>
                                                </div>
                                            @endif
                                           
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
                                        @if ($recep)
                                            @if ($recep->id==$recepcion->id)
                                                <tr tabindex="0" wire:click="clean_recep()" class="cursor-pointer focus:outline-none h-16 border border-gray-100 rounded text-white" style="background-color: #008d39;">
                                                    <td class="text-center">
                                                    
                                                            <p class="text-base font-medium leading-none  mr-2" >

                                                
                                                
                                                    

                                                            
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
                                                    
                                                                
                                                
                                                    @if ($recepcion->n_estado=='CERRADO')
                                                        <td class="text-center justify-center">
                                                            
                                                            <a href="{{route('informe.download',$recepcion)}}" target="_blank" >   
                                                                <img class="w-10 my-2 mx-auto" src="{{asset('image/pdf_icon2.png')}}" title="Descargar" alt="">
                                                            </a>
                                                            
                                                                                                        
                                                        </td>
                                                    @else    
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
                                                    @endif  
                                                
                                                </tr>
                                            @else
                                                <tr tabindex="0" wire:click="set_recep({{$recepcion->id}})" class="cursor-pointer focus:outline-none h-16 border border-gray-100 rounded text-white" style="background-color: #008d39;">
                                                    <td class="text-center">
                                                    
                                                            <p class="text-base font-medium leading-none  mr-2" >

                                                
                                                
                                                    

                                                            
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
                                                    
                                                                
                                                
                                                    @if ($recepcion->n_estado=='CERRADO')
                                                        <td class="text-center justify-center">
                                                            
                                                            <a href="{{route('informe.download',$recepcion)}}" target="_blank" >   
                                                                <img class="w-10 my-2 mx-auto" src="{{asset('image/pdf_icon2.png')}}" title="Descargar" alt="">
                                                            </a>
                                                            
                                                                                                        
                                                        </td>
                                                    @else    
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
                                                    @endif  
                                                
                                                </tr>
                                            @endif
                                        @else
                                            <tr tabindex="0" wire:click="set_recep({{$recepcion->id}})" class="cursor-pointer focus:outline-none h-16 border border-gray-100 rounded text-white" style="background-color: #008d39;">
                                                <td class="text-center">
                                                
                                                        <p class="text-base font-medium leading-none  mr-2" >

                                            
                                            
                                                

                                                        
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
                                                
                                                            
                                                @if ($recepcion->n_estado=='CERRADO')
                                                    <td class="text-center justify-center">
                                                        
                                                        <a href="{{route('informe.download',$recepcion)}}" target="_blank" >   
                                                            <img class="w-10 my-2 mx-auto" src="{{asset('image/pdf_icon2.png')}}" title="Descargar" alt="">
                                                        </a>
                                                        
                                                                                                    
                                                    </td>
                                                @else    
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
                                                @endif  

                                            </tr>
                                        @endif
                                 
                                    @if ($recep)
                                        
                                        @if ($recep->id==$recepcion->id)
                                            @livewire('calidad.actualizar-datos', ['recepcion' => $recepcion], key($recepcion->id))

                                        
                                            @if ($recepcion->n_estado!='CERRADO')
                                                <tr tabindex="0" class="focus:outline-none h-20 border border-gray-100 rounded">
                                                        <td class="text-center">
                                                        
                                                        </td>
                                                        <td class="text-center">
                                                        <a href="{{route('agregar.cc',$recepcion)}}" target="_blank" >
                                                            <button  class="mb-4 focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none text-red-600 py-3 px-5 bg-red-100 rounded hover:bg-red-200 focus:outline-none">
                                                                AGREGAR CC
                                                            </button>
                                                        </a>
                                                        </td>
                                                    
                                                        <td class="">
                                                            <div class="flex items-center pl-5">
                                                            <a href="{{route('agregar.ss',$recepcion)}}" target="_blank" >
                                                                <button  class="mb-4 focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none text-red-600 py-3 px-5 bg-red-100 rounded hover:bg-red-200 focus:outline-none">
                                                                    AGREGAR SS
                                                                </button>
                                                            </a>
                                                            </div>
                                                        </td>
                                                        <td class="pl-5">
                                                            <div class="whitespace-nowrap flex items-center text-center">
                                                            <a href="{{route('informe.view',$recepcion)}}" target="blank">
                                                                <button class="mb-4 focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none text-red-600 py-3 px-5 bg-red-100 rounded hover:bg-red-200 focus:outline-none">
                                                                    VER INFORME PREVIO
                                                                </button>
                                                            </a>
                                                            
                                                            </div>
                                                        </td>
                                                        <td class="pl-5 text-center whitespace-nowrap">
                                                        @if (IS_NULL($recepcion->informe))
                                                                <button  class="mb-4 focus:ring-2 text-sm leading-none text-gray-600 py-3 px-5 bg-gray-100 rounded focus:outline-none">
                                                                    VALIDAR INFORME
                                                                </button>  
                                                        @else
                                                                <button wire:click="validar_informe({{$recepcion->id}})" class="mb-4 focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none text-red-600 py-3 px-5 bg-red-100 rounded hover:bg-red-200 focus:outline-none">
                                                                    VALIDAR INFORME
                                                                </button>
                                                        @endif 
                                                        
                                                        
                                                        
                                                        </td>
                                                        <td class="pl-5 whitespace-nowrap">
                                                            
                                                            <button wire:click="cargar_firmpro({{$recepcion->id}})" class="mb-4 focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none text-red-600 py-3 px-5 bg-red-100 rounded hover:bg-red-200 focus:outline-none">
                                                            CARGAR FIMPRO
                                                            </button>

                                                            @if ($firmpro) 
                                                          
                                                                @foreach ($firmpro as $items)
                                                                    @php
                                                                        $n=1;
                                                                    @endphp
                                                                    @foreach ($items as $item)
                                                                        
                                                                        @php
                                                                            if ($n==24) {
                                                                                $precalibre=$item;
                                                                            }
                                                                            if ($n==25) {
                                                                                $l=$item;
                                                                            }
                                                                            if ($n==26) {
                                                                                $xl=$item;
                                                                            }
                                                                            if ($n==27) {
                                                                                $j=$item;
                                                                            }
                                                                            if ($n==28) {
                                                                                $jj=$item;
                                                                            }
                                                                            if ($n==29) {
                                                                                $jjj=$item;
                                                                            }
                                                                            if ($n==30) {
                                                                                $jjjj=$item;
                                                                            }
                                                                            if ($n==31) {
                                                                                $jjjjj=$item;
                                                                            }
                                                                            $n+=1;
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
                                                <tr tabindex="0" class="focus:outline-none h-10 border border-gray-100 rounded">
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
                                        <tr class="text-white h-5" style="background-color: #ffffff;">
                                            <td class="my-4 text-white">
                                            {{-- Agregar: --}} 
                                            </td>
                                            <td class="flex justify-center items-center content-center pb-1">
                                                
                                            
                                            </td>
                                            <td class="justify-center items-center content-center pb-1">
                                            

                                            </td>
                                            <td>

                                            </td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <div class="text-center cursor-pointer focus:ring-2 focus:ring-offset-2 focus:ring-gray-300 text-xs leading-none text-gray-600 py-1 px-2 bg-gray-100 rounded hover:bg-gray-200 focus:outline-none mb-1 mt-1">
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
                        {{$recepcions->links()}}
                    </div>
            
                    @endif 
            </div>
            
       
          

        </div>
    </div>
              
</div>