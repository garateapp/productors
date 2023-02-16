<x-app-layout>
    <x-slot name="header">
       
    </x-slot>
    <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10 ">

    @if(session('info'))
    <div class="flex justify-center">
        <div class="justify-center">
          <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded justify-center w-full flex" role="alert">
            <strong class="font-bold mx-2">Exito!</strong>
            <span class="flex">{{session('info')}}</span>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
              <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
          </div>
        </div>
    </div>
      @endif

  
      <div class="flex justify-end">
         <a href="{{route('admin.roles.create')}}">
            <button  class="ml-auto items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-6 py-3 bg-gray-500 hover:bg-gray-500 focus:outline-none rounded">
               <p class="text-sm font-medium leading-none text-white">Crear Rol</p>
            </button>
         </a>
      </div>

        <x-table-responsive>   
           <table class="min-w-full divide-y divide-gray-200 mb-20 pb-20">
    
              <thead class="bg-gray-50 rounded-full">
                  <th>ID</th>
                 <th>Rol</th>
              
               
                
              </thead>
              <tbody>
             
    
                   @forelse ($roles as $role)
                       
                  
                   
                         {{-- comment  --}}    
                         <tr tabindex="0" class="focus:outline-none h-16 border border-gray-100 rounded">
                           <td class="text-center">
                              <p class="text-base font-medium leading-none text-gray-700 mr-2">
   
                              
                                                            {{$role->id}}
                              
                                    
                              </p>
                           
                           </td>
                            <td class="text-center">
                               <p class="text-base font-medium leading-none text-gray-700 mr-2">
    
                               
                                                             {{$role->name}}
                               
                                     
                               </p>
                            
                            </td>
                              

                           <td width='120px'> 
                              <a href="{{route('admin.roles.edit', $role)}}">
                                 <button class="ml-auto items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-6 py-3 bg-gray-500 hover:bg-gray-500 focus:outline-none rounded">
                                    <p class="text-sm font-medium leading-none text-white">EDIT</p>
                                </button>
                              </a>
                           </td>
                           <td width='120px'>
                              <form action="{{route('admin.roles.destroy', $role)}}" method="POST">
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
    
                               
                                 No hay ningun roll registrado
                               
                                     
                               </p>
                            
                            </td>
                          
                         </tr>
                     
                       
                    @endforelse ($roles as $role)
    
              
                
               
              
              
              </tbody>
           </table>
        </x-table-responsive>

        @livewire('admin.users-show')

    </div>
               
             
            
</x-app-layout>
