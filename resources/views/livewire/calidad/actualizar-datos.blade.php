<tr tabindex="0" class="h-20 border border-gray-100 rounded focus:outline-none">
    <td class="text-center">
    
    </td>
    <td class="text-center">
    
        <p class="font-bold">Materia Vegetal: </p>
        @if ($recepcion->n_estado=='CERRADO')
            <div class="flex justify-center">
                <a class="px-3 py-3 text-sm leading-none text-gray-700 bg-gray-200 border border-gray-200 rounded focus:outline-none">
                    @if ($recepcion->calidad->materia_vegetal==NULL)
                        -
                    @else
                        {{$recepcion->calidad->materia_vegetal}}
                    @endif
                </a>
            </div>
        @else
            <select wire:change='actualizar_datos' wire:model="materia_vegetal" class="block w-20 px-4 py-3 pr-8 mx-auto leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                <option value="" class="text-center"> - </option>
                <option value="NO" class="mx-4 text-center">NO</option>
                <option value="SI" class="mx-4 text-center">SI</option>
            </select> 
        @endif
      
    
    </td>

    <td class="text-center">

            <p class="font-bold">Piedras: </p>
            @if ($recepcion->n_estado=='CERRADO')
                <div class="flex justify-center">
                    <a class="px-3 py-3 text-sm leading-none text-gray-700 bg-gray-200 border border-gray-200 rounded focus:outline-none">
                        @if ($recepcion->calidad->piedras==NULL)
                            -
                        @else
                            {{$recepcion->calidad->piedras}}
                        @endif
                       
                    </a>
                </div>
            @else
                <select wire:change='actualizar_datos' wire:model="piedras" class="block w-20 px-4 py-3 pr-8 mx-auto leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                    <option value="" class="text-center"> - </option>
                    <option value="NO" class="mx-4 text-center">NO</option>
                    <option value="SI" class="mx-4 text-center">SI</option>
                </select> 
            @endif
    </td>
    <td class="text-center">
     
            
            <p class="font-bold">Barro y/o Polvo: </p>
            @if ($recepcion->n_estado=='CERRADO')
                <div class="flex justify-center">
                    <a class="px-3 py-3 text-sm leading-none text-gray-700 bg-gray-200 border border-gray-200 rounded focus:outline-none">
                        @if ($recepcion->calidad->barro==NULL)
                            -
                        @else
                            {{$recepcion->calidad->barro}}
                        @endif
                       
                    </a>
                </div>
            @else
                <select wire:change='actualizar_datos' wire:model="barro" class="block w-20 px-4 py-3 pr-8 mx-auto leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                    <option value="" class="text-center"> - </option>
                    <option value="NO" class="mx-4 text-center">NO</option>
                    <option value="SI" class="mx-4 text-center">SI</option>
                </select> 
            @endif
        
    </td>
    <td class="text-center">

        <p class="font-bold">Pedicelos largos: </p>
        @if ($recepcion->n_estado=='CERRADO')
            <div class="flex justify-center">
                <a class="px-3 py-3 text-sm leading-none text-gray-700 bg-gray-200 border border-gray-200 rounded focus:outline-none">
                    @if ($recepcion->calidad->pedicelo_largo==NULL)
                        -
                    @else
                        {{$recepcion->calidad->pedicelo_largo}}
                    @endif
                </a>
            </div>
        @else
            <select wire:change='actualizar_datos' wire:model="pedicelo_largo" class="block w-20 px-4 py-3 pr-8 mx-auto leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                <option value="" class="text-center"> - </option>
                <option value="NO" class="mx-4 text-center">NO</option>
                <option value="SI" class="mx-4 text-center">SI</option>
            </select> 
        @endif
    
    </td>
    <td class="text-center">
        <p class="font-bold">Fruta en Racimo: </p>
        @if ($recepcion->n_estado=='CERRADO')
            <div class="flex justify-center">
                <a class="px-3 py-3 text-sm leading-none text-gray-700 bg-gray-200 border border-gray-200 rounded focus:outline-none">
                    @if ($recepcion->calidad->racimo==NULL)
                        -
                    @else
                        {{$recepcion->calidad->racimo}}
                    @endif
                </a>
            </div>
        @else
            <select wire:change='actualizar_datos' wire:model="racimo" class="block w-20 px-4 py-3 pr-8 mx-auto leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                <option value="" class="text-center"> - </option>
                <option value="NO" class="mx-4 text-center">NO</option>
                <option value="SI" class="mx-4 text-center">SI</option>
            </select> 
        @endif
    </td>

    <td class="text-center">
        
        <p class="font-bold"> Esponjas: </p>
        @if ($recepcion->n_estado=='CERRADO')
            <div class="flex justify-center">
                <a class="px-3 py-3 text-sm leading-none text-gray-700 bg-gray-200 border border-gray-200 rounded focus:outline-none">
                    @if ($recepcion->calidad->esponjas==NULL)
                        -
                    @else
                        {{$recepcion->calidad->esponjas}}
                    @endif
                </a>
            </div>
        @else
            <select wire:change='actualizar_datos' wire:model="esponjas" class="block w-20 px-4 py-3 pr-8 mx-auto leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                <option value="" class="text-center"> - </option>
                <option value="NO" class="mx-4 text-center">NO</option>
                <option value="SI" class="mx-4 text-center">SI</option>
            </select> 
        @endif
    </td>
    


    <td class="text-center">
        
        <p class="font-bold">Humedad de esponjas: </p>
        @if ($recepcion->n_estado=='CERRADO')
            <div class="flex justify-center">
                <a class="px-3 py-3 text-sm leading-none text-gray-700 bg-gray-200 border border-gray-200 rounded focus:outline-none">
                    @if ($recepcion->calidad->h_esponjas==NULL)
                        -
                    @else
                        {{$recepcion->calidad->h_esponjas}}
                    @endif
                </a>
            </div>
        @else
            <select wire:change='actualizar_datos' wire:model="h_esponjas" class="block w-20 px-4 py-3 pr-8 mx-auto leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                <option value="" class="text-center"> - </option>
                <option value="BUENO" class="mx-4 text-center">BUENO</option>
                <option value="REGULAR" class="mx-4 text-center">REGULAR</option>
                <option value="MALO" class="mx-4 text-center">MALO</option>
            </select> 
        @endif
    
                                                    
    </td>
    <td class="text-center">
        
        <p class="font-bold">Llenado de tottes: </p>
        @if ($recepcion->n_estado=='CERRADO')
            <div class="flex justify-center">
                <a class="px-3 py-3 text-sm leading-none text-gray-700 bg-gray-200 border border-gray-200 rounded focus:outline-none">
                    @if ($recepcion->calidad->llenado_tottes==NULL)
                        -
                    @else
                        {{$recepcion->calidad->llenado_tottes}}
                    @endif
                </a>
            </div>
        @else
            <select wire:change='actualizar_datos' wire:model="llenado_tottes" class="block w-20 px-4 py-3 pr-8 mx-auto leading-tight text-gray-700 bg-gray-200 border border-gray-200 rounded appearance-none focus:outline-none focus:bg-white focus:border-gray-500">
                <option value="" class="text-center"> - </option>
                <option value="EXCESIVO" class="mx-4 text-center">EXCESIVO</option>
                <option value="CORRECTO" class="mx-4 text-center">CORRECTO</option>
                <option value="BAJO" class="mx-4 text-center">BAJO</option>
            </select> 
        @endif
    
                                                    
    </td>
    @if ($recepcion->n_estado=='CERRADO')
        <td class="justify-center text-center">
            
         
            
             @can('Ver produccion_total')
                <button wire:click="editar({{$recepcion->id}})" class="px-3 py-1 mt-2 text-xs font-bold text-white bg-red-500 rounded-full" type="submit">EDITAR</button>
                 
             @endcan
                
           
        
                                                        
        </td>
    @endif        


</tr>
