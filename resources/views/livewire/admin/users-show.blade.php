<div>
    <div class="px-6 py-4">
        <input wire:keydown="limpiar_page" wire:model="search"  class="form-input flex-1 w-full shadow-sm  border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg focus:outline-none" placeholder="Ingrese el nombre, rut o csg del usuario" autocomplete="off">
    </div>

    @if ($users->count())
        <x-table-responsive>   
            <table class="min-w-full divide-y divide-gray-200 mb-20 pb-20">
    
            <thead class="bg-gray-50 rounded-full">
                <th>ID</th>
                <th>Nombre</th>
                <th>Roles</th>
            
                
                
            </thead>
            <tbody>
            
    
                    @forelse ($users as $user)
                        
                
                    
                        {{-- comment  --}}    
                        <tr tabindex="0" class="focus:outline-none h-16 border border-gray-100 rounded">
                            <td class="text-center">
                            <p class="text-base font-medium leading-none text-gray-700 mr-2">

                            
                                                            {{$user->id}}
                            
                                    
                            </p>
                            
                            </td>
                            <td class="text-center">
                                <p class="text-base font-medium leading-none text-gray-700 mr-2">
    
                                
                                                            {{$user->name}}
                                
                                    
                                </p>
                            
                            </td>
                            <td class="text-center">
                                <p class="text-base font-medium leading-none text-white mr-2">
    
                                                    @forelse ($user->roles as $role)
                                                        <button class="ml-auto items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-6 py-3 bg-gray-500 hover:bg-gray-500 focus:outline-none rounded">
                                                            {{$role->name}}
                                                        </button>
                                                    @empty
                                                        -    

                                                    @endforelse
                                                          
                                
                                    
                                </p>
                            
                            </td>
                            

                            <td width='120px'> 
                            <a href="{{route('users.edit', $user)}}">
                                <button  class="ml-auto items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-6 py-3 bg-gray-500 hover:bg-gray-500 focus:outline-none rounded">
                                    <p class="text-sm font-medium leading-none text-white">Edit</p>
                                 </button>
                            </a>
                            </td>
                            <td width='120px'>
                            <form action="{{route('users.destroy', $user)}}" method="POST">
                            @method('delete')
                            @csrf

                            <button class="btn btn-danger" type='submit'>Eliminar</button>
                            </form>
                            </td>
                            
                        
                        </tr>
                        
                    
                    @empty

                
                        {{-- comment  --}}    
                        <tr tabindex="0" class="focus:outline-none h-16 border border-gray-100 rounded">
                            <td class="text-center">
                            <p class="text-base font-medium leading-none text-gray-700 mr-2">

                            
                                -
                            
                                    
                            </p>
                            
                            </td>
                            <td class="text-center">
                                <p class="text-base font-medium leading-none text-gray-700 mr-2">
    
                                
                                No hay ningun usuario registrado
                                
                                    
                                </p>
                            
                            </td>
                        
                        </tr>
                    
                        
                    @endforelse ($roles as $user)
    
            
                
                
            
            
            </tbody>
            </table>
        </x-table-responsive>
    @endif
</div>
