<x-app-layout>
    <x-slot name="header">
       
    </x-slot>

    <div class="flex flex-col sm:justify-center items-center sm:pt-14" >
      
      @if (session('info'))
          <div x-data="{open: true}">
            <div x-show="open"  class="bg-white border border-gray-400 text-gray-700 px-4 py-3 rounded relative flex" role="alert">
                <strong class="font-bold content-center items-center my-auto">Felicidades!</strong>
                <span class="block sm:inline content-center items-center my-auto ml-2">{{session('info')}}</span>
                <span x-on:click="open=false" class="top-0 bottom-0 right-0 px-4 py-3 ">
                <svg class="fill-current h-6 w-6 text-gray-500 ml-4" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </span>
            </div>
        </div>
      @endif
      @if (session('fail'))
          <div x-data="{open: true}">
              <div x-show="open"  class="bg-white border border-gray-400 text-gray-700 px-4 py-3 rounded relative flex" role="alert">
                  <strong class="font-bold content-center items-center my-auto">Error!</strong>
                  <span class="block sm:inline content-center items-center my-auto ml-2">{{session('fail')}}</span>
                  <span x-on:click="open=false" class="top-0 bottom-0 right-0 px-4 py-3 ">
                  <svg class="fill-current h-6 w-6 text-gray-500 ml-4" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                  </span>
              </div>
          </div>
      @endif

      
      <h1 class="text-center mt-4">
       ¿Deseas agregar un nuevo Agrónomo?
        </h1>

        @livewire('agronomo.asignacion-rol')

      <h1 class="text-center mt-6">
        LISTADO DE AGRONOMOS
        </h1>
        
      <h1 class="text-center">
      Nombre/Apellido  / Nro Productores asignados / Nro Productores finalizados / Nro Productores pendientes / Detalle
        </h1>
                   
        <x-table-responsive>   
          <table class="min-w-full divide-y divide-gray-200 mb-20 pb-20">
    
             <thead class="bg-gray-50 rounded-full">
          
                <th>Nombre</th>
                <th>Email</th>
                
                
             </thead>

             <tbody>
                @php
                      $n=1;
                @endphp
             
                   @foreach ($users as $user)
                    
                      <tr class="h-16 border border-gray-100 rounded">
                         
                            <td class="text-center">
                               <p class="text-base font-medium  text-gray-700">
                                        {{$user->name}}
                               </p>
                            
                            </td>
                            <td class="text-center">
                              <p class="text-base font-medium  text-gray-700">
                                @if ($user->email)
                                  {{$user->email}}
                                @endif
                                       
                              </p>
                           
                           </td>
                   
                            
                         
                         
                      </tr>
                   
                   @endforeach
    
             
                
                
             
             
             </tbody>
          </table>
       </x-table-responsive>

      
    </div>


  

 
             
            
</x-app-layout>
