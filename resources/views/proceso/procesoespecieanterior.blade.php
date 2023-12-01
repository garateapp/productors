<x-app-layout>
    <x-slot name="header">
       
    </x-slot>
    
      
       @livewire('procesos.proceso-especie', ['especie' => $especie,'temporada'=>'anterior'],key($especie->id))
             
            
</x-app-layout>
