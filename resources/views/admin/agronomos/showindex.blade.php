<x-app-layout>
    <x-slot name="header">
      <a href="{{Route('agronomos.index')}}" class="font-bold">
      <- Lista de Agronomos
      </a>
    </x-slot>

    @livewire('agronomo.listado-view', ['user' => $user], key($user))


  

 
             
            
</x-app-layout>
