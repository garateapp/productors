<x-app-layout>
    <x-slot name="header">
       
    </x-slot>
    
      
       @livewire('procesos.proceso-variedad', ['variedad' => $variedad,'temporada'=>'anterior'],key($variedad->id))
             
            
</x-app-layout>
