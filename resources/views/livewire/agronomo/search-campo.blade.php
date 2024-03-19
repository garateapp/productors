<div class="grid gap-4 grid-cols-1 md:grid-cols-1">
    @can('Asignar roles')
      @livewire('agronomo.asignacion-rol',['type'=>'campos','user_id'=>$user->id])
    @endcan

    <input wire:model="search" class="w-full border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm"
    type="search" name="search" style="z-index: 10;" autocomplete="off">
    
    <p class="text-center text-xs">Buscador de productores</p>
       

    <h1 class="text-center mt-6 font-bold mb-2">
      LISTADO DE PRODUCTORES
      </h1>

    @foreach ($uniqueUsers as $user)
    @if ($campos2->contains($user->rut))
      <a href="{{Route('agronomo.show',$user)}}" target="_blank">
        <div class="flex flex-col p-4 bg-gray-800 border-gray-800 shadow-md hover:shodow-lg rounded-2xl cursor-pointer transition ease-in duration-500  transform hover:scale-105">
          <div class="flex items-center justify-between">
            <div class="flex items-center mr-auto">
              <div class="inline-flex w-12 h-12"><img src="https://tailwindcomponents.com/storage/avatars/njkIbPhyZCftc4g9XbMWwVsa7aGVPajYLRXhEeoo.jpg" alt="aji" class=" relative p-1 w-12 h-12 object-cover rounded-2xl"><span class="absolute w-12 h-12 inline-flex border-2 rounded-2xl border-gray-600 opacity-75"></span>
                <span></span>
              </div>

              <div class="flex flex-col ml-3 min-w-0">
                <div class="font-medium leading-none text-gray-100">{{$user->name}}</div>
                <p class="text-sm text-gray-500 leading-none mt-1 truncate ">Rut: {{$user->rut}}</p>
              </div>
            </div>
            <div class="flex flex-col ml-3 min-w-0">
              <div class="flex">
                <h5 class="flex items-center font-medium text-gray-300 mr-2">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mx-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 8h6m-5 0a3 3 0 110 6H9l3 3m-3-6h6m6 1a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg> 0 / 17 Datos Completados
                </h5>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-yellow-400 ml-2" viewBox="0 0 20 20" fill="currentColor">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
              
              
              
                
              </div>
            </div>
          </div>
          <div class="grid grid-cols-6 gap-y-2 mt-2 hidden">
            @foreach ($campos as $campo)
                
                  <div class="flex justify-center">
                      <span  class="cursor-pointer py-3 px-3 text-sm focus:outline-none leading-none rounded  text-gray-700 bg-yellow-200" >Csg: {{$campo->user->csg}}</span>
                  </div>


            @endforeach

          </div>
        </div>
      </a>

    @endif
  @endforeach</div>
