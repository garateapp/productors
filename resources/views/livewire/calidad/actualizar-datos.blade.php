<tr tabindex="0" class="focus:outline-none h-20 border border-gray-100 rounded">
    <td class="text-center">
    
    </td>
    <td class="text-center">
    
        <p class="font-bold">Materia Vegetal: </p>
        @if ($recepcion->n_estado=='CERRADO')
            <div class="flex justify-center">
                <a class="py-3 px-3 text-sm focus:outline-none leading-none bg-gray-200 border border-gray-200 text-gray-700 rounded">
                    @if ($recepcion->calidad->materia_vegetal==NULL)
                        -
                    @else
                        {{$recepcion->calidad->materia_vegetal}}
                    @endif
                </a>
            </div>
        @else
            <select wire:change='actualizar_datos' wire:model="materia_vegetal" class="mx-auto w-20 block appearance-none bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                <option value="" class="text-center"> - </option>
                <option value="NO" class="text-center mx-4">NO</option>
                <option value="SI" class="text-center mx-4">SI</option>
            </select> 
        @endif
      
    
    </td>

    <td class="text-center">

            <p class="font-bold">Piedras: </p>
            @if ($recepcion->n_estado=='CERRADO')
                <div class="flex justify-center">
                    <a class="py-3 px-3 text-sm focus:outline-none leading-none bg-gray-200 border border-gray-200 text-gray-700 rounded">
                        @if ($recepcion->calidad->piedras==NULL)
                            -
                        @else
                            {{$recepcion->calidad->piedras}}
                        @endif
                       
                    </a>
                </div>
            @else
                <select wire:change='actualizar_datos' wire:model="piedras" class="mx-auto w-20 block appearance-none bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option value="" class="text-center"> - </option>
                    <option value="NO" class="text-center mx-4">NO</option>
                    <option value="SI" class="text-center mx-4">SI</option>
                </select> 
            @endif
    </td>
    <td class="text-center">
     
            
            <p class="font-bold">Barro y/o Polvo: </p>
            @if ($recepcion->n_estado=='CERRADO')
                <div class="flex justify-center">
                    <a class="py-3 px-3 text-sm focus:outline-none leading-none bg-gray-200 border border-gray-200 text-gray-700 rounded">
                        @if ($recepcion->calidad->barro==NULL)
                            -
                        @else
                            {{$recepcion->calidad->barro}}
                        @endif
                       
                    </a>
                </div>
            @else
                <select wire:change='actualizar_datos' wire:model="barro" class="mx-auto w-20 block appearance-none bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                    <option value="" class="text-center"> - </option>
                    <option value="NO" class="text-center mx-4">NO</option>
                    <option value="SI" class="text-center mx-4">SI</option>
                </select> 
            @endif
        
    </td>
    <td class="text-center">

        <p class="font-bold">Pedicelos largos: </p>
        @if ($recepcion->n_estado=='CERRADO')
            <div class="flex justify-center">
                <a class="py-3 px-3 text-sm focus:outline-none leading-none bg-gray-200 border border-gray-200 text-gray-700 rounded">
                    @if ($recepcion->calidad->pedicelo_largo==NULL)
                        -
                    @else
                        {{$recepcion->calidad->pedicelo_largo}}
                    @endif
                </a>
            </div>
        @else
            <select wire:change='actualizar_datos' wire:model="pedicelo_largo" class="mx-auto w-20 block appearance-none bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                <option value="" class="text-center"> - </option>
                <option value="NO" class="text-center mx-4">NO</option>
                <option value="SI" class="text-center mx-4">SI</option>
            </select> 
        @endif
    
    </td>
    <td class="text-center">
        <p class="font-bold">Fruta en Racimo: </p>
        @if ($recepcion->n_estado=='CERRADO')
            <div class="flex justify-center">
                <a class="py-3 px-3 text-sm focus:outline-none leading-none bg-gray-200 border border-gray-200 text-gray-700 rounded">
                    @if ($recepcion->calidad->racimo==NULL)
                        -
                    @else
                        {{$recepcion->calidad->racimo}}
                    @endif
                </a>
            </div>
        @else
            <select wire:change='actualizar_datos' wire:model="racimo" class="mx-auto w-20 block appearance-none bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                <option value="" class="text-center"> - </option>
                <option value="NO" class="text-center mx-4">NO</option>
                <option value="SI" class="text-center mx-4">SI</option>
            </select> 
        @endif
    </td>

    <td class="text-center">
        
        <p class="font-bold"> Esponjas: </p>
        @if ($recepcion->n_estado=='CERRADO')
            <div class="flex justify-center">
                <a class="py-3 px-3 text-sm focus:outline-none leading-none bg-gray-200 border border-gray-200 text-gray-700 rounded">
                    @if ($recepcion->calidad->esponjas==NULL)
                        -
                    @else
                        {{$recepcion->calidad->esponjas}}
                    @endif
                </a>
            </div>
        @else
            <select wire:change='actualizar_datos' wire:model="esponjas" class="mx-auto w-20 block appearance-none bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                <option value="" class="text-center"> - </option>
                <option value="NO" class="text-center mx-4">NO</option>
                <option value="SI" class="text-center mx-4">SI</option>
            </select> 
        @endif
    </td>
    


    <td class="text-center">
        
        <p class="font-bold">Humedad de esponjas: </p>
        @if ($recepcion->n_estado=='CERRADO')
            <div class="flex justify-center">
                <a class="py-3 px-3 text-sm focus:outline-none leading-none bg-gray-200 border border-gray-200 text-gray-700 rounded">
                    @if ($recepcion->calidad->h_esponjas==NULL)
                        -
                    @else
                        {{$recepcion->calidad->h_esponjas}}
                    @endif
                </a>
            </div>
        @else
            <select wire:change='actualizar_datos' wire:model="h_esponjas" class="mx-auto w-20 block appearance-none bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                <option value="" class="text-center"> - </option>
                <option value="BUENO" class="text-center mx-4">BUENO</option>
                <option value="REGULAR" class="text-center mx-4">REGULAR</option>
                <option value="MALO" class="text-center mx-4">MALO</option>
            </select> 
        @endif
    
                                                    
    </td>
    <td class="text-center">
        
        <p class="font-bold">Llenado de tottes: </p>
        @if ($recepcion->n_estado=='CERRADO')
            <div class="flex justify-center">
                <a class="py-3 px-3 text-sm focus:outline-none leading-none bg-gray-200 border border-gray-200 text-gray-700 rounded">
                    @if ($recepcion->calidad->llenado_tottes==NULL)
                        -
                    @else
                        {{$recepcion->calidad->llenado_tottes}}
                    @endif
                </a>
            </div>
        @else
            <select wire:change='actualizar_datos' wire:model="llenado_tottes" class="mx-auto w-20 block appearance-none bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                <option value="" class="text-center"> - </option>
                <option value="EXCESIVO" class="text-center mx-4">EXCESIVO</option>
                <option value="CORRECTO" class="text-center mx-4">CORRECTO</option>
                <option value="BAJO" class="text-center mx-4">BAJO</option>
            </select> 
        @endif
    
                                                    
    </td>
    @if ($recepcion->n_estado=='CERRADO')
        <td class="text-center justify-center">
            
         
            
             @can('Ver produccion_total')
                <button wire:click="editar({{$recepcion->id}})" class="font-bold py-1 px-3 mt-2 rounded-full bg-red-500 text-white text-xs" type="submit" title="Eliminar">EDITAR</button>
                 
             @endcan
                
           
        
                                                        
        </td>
    @endif        


</tr>
