<x-app-layout>
    <x-slot name="header">
       
    </x-slot>
    
      
       @livewire('procesos.proceso-especie', ['especie' => $especie],key($especie->id))
             
            
</x-app-layout>
