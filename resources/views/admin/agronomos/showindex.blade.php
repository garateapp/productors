<x-app-layout>
    <x-slot name="header">
      @can('Asignar roles')
        <a href="{{Route('agronomos.index')}}" class="font-bold">
        <- Lista de Agronomos
        </a>
      @endcan

    </x-slot>

    @livewire('agronomo.listado-view', ['user' => $user], key($user))


  

 
             
            
</x-app-layout>
