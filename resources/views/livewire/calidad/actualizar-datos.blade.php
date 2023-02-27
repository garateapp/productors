<tr tabindex="0" class="focus:outline-none h-20 border border-gray-100 rounded">
    <td class="text-center">
    
    </td>
    <td class="text-center">
    
        <p class="font-bold">Materia Vegetal: </p>
        <select wire:change='actualizar_datos' wire:model="materia_vegetal" class="mx-auto w-20 block appearance-none bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
            <option value="NULL" class="text-center"> - </option>
            <option value="NO" class="text-center mx-4">NO</option>
            <option value="SI" class="text-center mx-4">SI</option>
        </select> 
    
    </td>

    <td class="text-center">

            <p class="font-bold">Piedras: </p>
            <select wire:change='actualizar_datos' wire:model="piedras" class="mx-auto w-20 block appearance-none bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                <option value="NULL" class="text-center"> - </option>
                <option value="NO" class="text-center mx-4">NO</option>
                <option value="SI" class="text-center mx-4">SI</option>
            </select> 

    </td>
    <td class="text-center">
     
            
            <p class="font-bold">Barro y/o Polvo: </p>
            <select wire:change='actualizar_datos' wire:model="barro" class="mx-auto w-20 block appearance-none bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                <option value="NULL" class="text-center"> - </option>
                <option value="NO" class="text-center mx-4">NO</option>
                <option value="SI" class="text-center mx-4">SI</option>
            </select> 
        
    </td>
    <td class="text-center">

        <p class="font-bold">Pedicelos largos: </p>
        <select wire:change='actualizar_datos' wire:model="pedicelo_largo" class="mx-auto w-20 block appearance-none bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
            <option value="NULL" class="text-center"> - </option>
            <option value="NO" class="text-center mx-4">NO</option>
            <option value="SI" class="text-center mx-4">SI</option>
        </select> 
    
    
    </td>
    <td class="text-center">
        <p class="font-bold">Fruta en Racimo: </p>
        <select wire:change='actualizar_datos' wire:model="racimo" class="mx-auto w-20 block appearance-none bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
            <option value="NULL" class="text-center"> - </option>
            <option value="NO" class="text-center mx-4">NO</option>
            <option value="SI" class="text-center mx-4">SI</option>
        </select> 
        
    </td>

    <td class="text-center">
        
        <p class="font-bold"> Esponjas: </p>
        <select wire:change='actualizar_datos' wire:model="esponjas" class="mx-auto w-20 block appearance-none bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
            <option value="NULL" class="text-center"> - </option>
            <option value="NO" class="text-center mx-4">NO</option>
            <option value="SI" class="text-center mx-4">SI</option>
        </select> 
    </td>
    


    <td class="text-center">
        
        <p class="font-bold">Humedad de esponjas: </p>
        <select wire:change='actualizar_datos' wire:model="h_esponjas" class="mx-auto w-20 block appearance-none bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
            <option value="NULL" class="text-center"> - </option>
            <option value="NO" class="text-center mx-4">NO</option>
            <option value="SI" class="text-center mx-4">SI</option>
        </select> 

    
                                                    
    </td>
    
                


</tr>
