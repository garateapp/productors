<x-app-layout>
    <x-slot name="header">
       
    </x-slot>

    <div class="flex flex-col sm:justify-center items-center sm:pt-4" >
      
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

      <h1 class="text-center font-bold text-2xl mb-2">
        Gestión Equipo de Agrónomos
        </h1>

      <h1 class="text-center mt-4">
       ¿Deseas agregar un nuevo Agrónomo?
        </h1>

        @livewire('agronomo.asignacion-rol',['type'=>'Agronomo','user_id'=>null])

        @if ($users->count()>0)
            
        
      <h1 class="text-center mt-6 font-bold mb-2">
        LISTADO DE AGRÓNOMOS
        </h1>
        <x-table-responsive>   
          <table class="min-w-full divide-y divide-gray-200 mb-20 pb-20">
    
             <thead class="bg-gray-50 rounded-full">
          
                <th>Nombre</th>
                <th>Email</th>
                <th>Nro<br>Productores<br>Asignados</th>
                <th>Listado</th>
                <th>Nro<br>Productores<br>Finalizados</th>
                <th>Nro<br>Productores<br>Pendiente</th>
                <th class="relative px-6 py-3">
                  <span class="sr-only">Detalle</span>
                  </th>
                  <th class="relative px-6 py-3">
                    <span class="sr-only">Detalle</span>
                    </th>
                    <th class="relative px-6 py-3">
                      <span class="sr-only">Detalle</span>
                      </th>
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
                                @else
                                  (Sin Email)
                                @endif
                                       
                              </p>
                           
                           </td>
                           <td class="text-center">
                            <p class="text-base font-medium  text-gray-700">
                                {{$user->campos->count()}}
                            </p>
                              
                            </td>
                            <td class="text-center">
                              @if ($user->campos->count()>0)
                                @foreach ($user->campos as $campo)
                                  {{$campo->user->name}}  <br>   
                                @endforeach
                              @else
                                  -
                              @endif
                              
                            </td>

                            <td class="text-center">
                                <p class="text-base font-medium  text-gray-700">
                                   0
                                </p>
                            </td>
                            <td class="text-center">
                              <p class="text-base font-medium  text-gray-700">
                                {{$user->campos->count()}}    
                              </p>
                            </td>
                        
                            <td class="text-center pr-10">
                              <a href="{{Route('agronomo.show',$user)}}">
                                <p class="text-base font-medium  text-blue-500 cursor-pointer">
                                    Detalle
                                </p>
                              </a>
                            </td>
                            <td class="text-center pr-10">
                              <p class="text-base font-medium  text-orange-500 cursor-pointer">
                                  Cambiar
                              </p>
                            </td>
                            <td class="text-center pr-10">
                                {!! Form::model($user, ['route'=>['users.update',$user],'method' => 'put']) !!}

                                        @foreach ($user->roles as $role)
                                          @if ($role->id!=5)
                                            {!! Form::hidden('roles[]', $role->id) !!}
                                          @endif
                                        @endforeach
                                                 
                                                
                                    
                                    
                                    <button class="text-base font-medium  text-red-500 cursor-pointer">
                                        <p>Eliminar</p>
                                    </button>
                                {!! Form::close() !!}
                           
                            </td>
                           
                        <td>
                          
                        </td>
                            
                         
                         
                      </tr>
                   
                   @endforeach
    
             
                
                
             
             
             </tbody>
          </table>
       </x-table-responsive>
       @else
          <h1 class="text-center mt-6 font-bold mb-2">
            AGREGA AL PRIMER AGRÓNOMO
            </h1>
       @endif
    </div>


  

 
             
            
</x-app-layout>
