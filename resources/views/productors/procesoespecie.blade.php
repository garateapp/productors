<x-app-layout>
    <x-slot name="header">
       
    </x-slot>
    
      
       @livewire('productor.proceso-especie', ['especie' => $especie],key($especie->id))
             
            
</x-app-layout>
