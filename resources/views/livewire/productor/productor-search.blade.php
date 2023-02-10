<div>
    <div class="pb-12">
        <div class="sm:px-6 w-full">
            <!--- more free and premium Tailwind CSS components at https://tailwinduikit.com/ --->

            <div class="px-6 py-4">
                <input wire:keydown="limpiar_page" wire:model="search"  class="form-input flex-1 w-full shadow-sm  border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg focus:outline-none" placeholder="Ingrese el nombre, rut o csg del productor" autocomplete="off">
            </div>
    
      
            <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10">
                <div class="sm:flex items-center justify-between">
                    <p class="text-sm font-medium leading-none text-gray-800">Productores: {{$allusers->count()}}</p>
                   <div class="flex"> 
                    <a href="{{route('productor.refresh')}}">
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

            
            



                    <x-table-responsive>   
                        <table class="min-w-full divide-y divide-gray-200 mb-20 pb-20">
        
                            <thead class="bg-gray-50">
                                <th>ID</th>
                                <th>Empresa</th>
                                <th>RUT Empresa</th>
                                <th class="text-center">CSG</th>
                                <th class="text-center">Usurio</th>
                                <th class="text-center">Pass</th>
                                <th>CELULAR</th>
                                <th>EMAIL</th>
                                <th>ULTIMA MODIFICACIÓN</th>
                                
                                <th>Estado</th>
                            </thead>
                            <tbody>
                                @php
                                    $n=1;
                                @endphp
                                
                                @foreach ($users->reverse() as $user)
                                                    @php
                                                        $m=1;
                                                    @endphp
                                                @foreach ($user as $item)
                                            {{-- comment        {{$m}}) {{$item}}<br>
                                                    --}}
                                                        @php
                                                            $m+=1;
                                                        @endphp
                                                @endforeach
                                                
                                    
                                    <tr tabindex="0" class="focus:outline-none h-16 border border-gray-100 rounded">
                                        <td class="text-center">
                                            <p class="text-base font-medium leading-none text-gray-700 mr-2">

                                            

                                                @if ($user->idprod)
                                                    {{$user->idprod}}
                                                    
                                                @endif
                                            
                                                
                                            </p>
                                        
                                        </td>
                                        <td class="">
                                            <div class="flex items-center pl-5">
                                                <p class="text-base font-medium leading-none text-gray-700 mr-2">

                                                
                                                    @if ($user->name)
                                                    {{$user->name}}
                                                    
                                                    @endif
                                                
                                                    
                                                </p>
                                            
                                            </div>
                                        </td>
                                        <td class="pl-5">
                                            <div class="whitespace-nowrap flex items-center text-center">
                                                
                                                <p class="whitespace-nowrap text-sm leading-none text-gray-600 ml-2">
                                            
                                                    @if ($user->rut)
                                                        {{$user->rut}}
                                                        
                                                    @endif
                                                </p>
                                            </div>
                                        </td>
                                        <td class="pl-5 text-center">
                                            <p class="text-base text-center font-medium leading-none text-gray-700 mr-2">

                                        
                                            @if ($user->csg)
                                                    {{$user->csg}}
                                                    
                                                @endif
                                            
                                            </p>
                                        
                                        </td>
                                            <td class="pl-5 whitespace-nowrap">
                                                <p class="whitespace-nowrap  text-base flex font-medium leading-none text-gray-700 mr-2">

                                                

                                                @if ($user->user)
                                                    {{$user->user}}
                                                @endif
                                                
                                            </p>
                                            
                                        </td>
                                        
                                        <td class="pl-5">
                                        

                                        
                                        <button  class="mx-4 focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 mt-4 sm:mt-0 inline-flex items-start justify-start px-6 py-3 bg-gray-500 hover:bg-gray-500 focus:outline-none rounded">

                                            <h1 style="font-size: 1rem;white-space: nowrap;" class="text-center text-white font-bold inline w-full" >gre1234</h1>
                                        </button>
                                        
                                                
                                        
                                    
                                        
                                    
                                       </td>
                                    
                                        <td class="pl-5">
                                            @if ($user->id==$cellid)
                                                <button wire:click="cellid_clean" class="mx-4 focus:ring-2 focus:ring-offset-2 focus:ring-green-500 mt-4 sm:mt-0 inline-flex items-start justify-start px-6 py-3 bg-green-500 hover:bg-green-500 focus:outline-none rounded">

                                                    <h1 style="font-size: 1rem;white-space: nowrap;" class="text-center text-white font-bold inline w-full" >
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                                            <path fill-rule="evenodd" d="M2 3.5A1.5 1.5 0 013.5 2h1.148a1.5 1.5 0 011.465 1.175l.716 3.223a1.5 1.5 0 01-1.052 1.767l-.933.267c-.41.117-.643.555-.48.95a11.542 11.542 0 006.254 6.254c.395.163.833-.07.95-.48l.267-.933a1.5 1.5 0 011.767-1.052l3.223.716A1.5 1.5 0 0118 15.352V16.5a1.5 1.5 0 01-1.5 1.5H15c-1.149 0-2.263-.15-3.326-.43A13.022 13.022 0 012.43 8.326 13.019 13.019 0 012 5V3.5z" clip-rule="evenodd" />
                                                        </svg>
                                                        
                                                    </h1>
                                                </button>
                                            @else
                                                <button wire:click="set_iduser({{$user->id}})" class="mx-4 focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 mt-4 sm:mt-0 inline-flex items-start justify-start px-6 py-3 bg-gray-500 hover:bg-gray-500 focus:outline-none rounded">

                                                    <h1 style="font-size: 1rem;white-space: nowrap;" class="text-center text-white font-bold inline w-full" >
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5 h-5">
                                                            <path fill-rule="evenodd" d="M2 3.5A1.5 1.5 0 013.5 2h1.148a1.5 1.5 0 011.465 1.175l.716 3.223a1.5 1.5 0 01-1.052 1.767l-.933.267c-.41.117-.643.555-.48.95a11.542 11.542 0 006.254 6.254c.395.163.833-.07.95-.48l.267-.933a1.5 1.5 0 011.767-1.052l3.223.716A1.5 1.5 0 0118 15.352V16.5a1.5 1.5 0 01-1.5 1.5H15c-1.149 0-2.263-.15-3.326-.43A13.022 13.022 0 012.43 8.326 13.019 13.019 0 012 5V3.5z" clip-rule="evenodd" />
                                                        </svg>
                                                        
                                                    </h1>
                                                </button>
                                            @endif
                                                                                        
                                        </td>
                                        <td class="pl-5">
                                            <div class="flex items-center">
                                            
                                                <p class="text-sm leading-none text-gray-600 ml-2">
                                                @if ($user->email)
                                                    {{$user->email}}
                                                @endif
                                                </p>
                                            </div>
                                        </td>
                                        <td class="pl-5">
                                            <div class="flex items-center">
                                            
                                                <p class="text-base font-medium leading-none text-gray-700 mr-2">

                                                    @php
                                                        $m=1;
                                                    @endphp
                                                    {{-- NOMBRE --}}
                                                    @foreach ($user as $item)
                                                        @if ($m==34)
                                                            {{$item}}<br>
                                                        @endif
                                                    
                                                        @php
                                                            $m+=1;
                                                        @endphp
                                                    @endforeach
                                                
                                                    
                                                </p>
                                            </div>
                                        </td>
                                    
                                        <td class="pl-5">
                                            <button class="py-3 px-3 text-sm focus:outline-none leading-none text-red-700 bg-red-100 rounded">Usuario ya creado</button>
                                        </td>
                                                    {{-- commen
                                        <td class="pl-4">
                                            <button class="focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none text-gray-600 py-3 px-5 bg-gray-100 rounded hover:bg-gray-200 focus:outline-none">Ver</button>
                                        </td>
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
                                                    t --}}
                                    </tr>
                                @if ($cellid==$user->id)

                                    <tr tabindex="0" class="focus:outline-none h-16 border border-gray-100 rounded">
                                        <td class="text-center">
                                            <p class="text-base font-medium leading-none text-gray-700 mr-2">

                                            
                                                
                                                
                                            </p>
                                        
                                        </td>
                                        <td class="">
                                            <div class="flex items-center pl-5">
                                                <p class="text-base font-medium leading-none text-gray-700 mr-2">

                                                
                                                    
                                                </p>
                                            
                                            </div>
                                        </td>
                                        <td class="pl-5">
                                            <div class="whitespace-nowrap flex items-center text-center">
                                                
                                                <p class="whitespace-nowrap text-sm leading-none text-gray-600 ml-2">
                                                    
                                                </p>
                                            </div>
                                        </td>
                                        <td class="pl-5">
                                            <p class="text-base font-medium leading-none text-gray-700 mr-2">

                                        
                                            
                                        </p>
                                        
                                        </td>
                                            <td class="pl-5 whitespace-nowrap">
                                                <p class="whitespace-nowrap  text-base flex font-medium leading-none text-gray-700 mr-2">

                                                

                                                
                                            </p>
                                            
                                        </td>
                                        
                                        <td class="pl-5">
                                        

                                        
                                    
                                        
                                    
                                            </td>
                                    
                                        <td class="pl-5 text-center">

                                            @if ($user->telefonos)
                                                @foreach ($user->telefonos as $telefono)
                                                <div class="flex text-center justify-center">
                                                    <b>{{$telefono->numero}}  </b>
                                                    <p wire:click="phone_destroy({{$telefono}})" class="text-red-500 cursor-pointer ml-1"> (X)</p>

                                                </div>
                                                    <br>
                                                    
                                                @endforeach
                                                
                                            @endif

                                           
                                           
                                           
                                        </td>
                                        <td class="pl-5">
                                            <div class="flex items-center">
                                            
                                                
                                                <div class="flex items-center">
                                                    <label class="w-32 mx-2"><strong>Agregar:</strong></label>
                                                    <input wire:model="phone" class="form-input w-full border-2 border-gray-300 bg-white h-10 rounded-lg text-sm focus:outline-none">
                                                </div>
                                
                                                @error('name')
                                                    <span class="text-sm text-red-500">{{$message}}</span>
                                                @enderror
                                               
                                               
                                                <button wire:click="storephone" class="mx-4 focus:ring-2 focus:ring-offset-2 focus:ring-green-500 mt-4 sm:mt-0 inline-flex items-start justify-start px-6 py-3 bg-green-500 hover:bg-green-500 focus:outline-none rounded">

                                                    <h1 style="font-size: 1rem;white-space: nowrap;" class="text-center text-white font-bold inline w-full" >
                                                        +
                                                        
                                                    </h1>
                                                </button>
                                            </div>
                                        </td>
                                        <td class="pl-5">
                                            <div class="flex items-center">
                                            
                                                <p class="text-base font-medium leading-none text-gray-700 mr-2">

                                                    @php
                                                        $m=1;
                                                    @endphp
                                                    {{-- NOMBRE --}}
                                                    @foreach ($user as $item)
                                                        @if ($m==34)
                                                            {{$item}}<br>
                                                        @endif
                                                    
                                                        @php
                                                            $m+=1;
                                                        @endphp
                                                    @endforeach
                                                
                                                    
                                                </p>
                                            </div>
                                        </td>
                                    
                                        <td class="pl-5">
                                       
                                        </td>
                                        <td class="pl-4">
                                         
                                        </td>
                                        <td>
                                           
                                        </td>
                                    </tr>

                                @endif


                                @endforeach
                            
                            
                            </tbody>
                        </table>
                    </x-table-responsive>
                    @if ($users->count())
                        <div class="">
                            {{$users->links()}}
                        </div>
                   
                    @endif 
            </div>

        </div>
    </div>
</div>
