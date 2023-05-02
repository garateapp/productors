<x-app-layout>
    <x-slot name="header">
       
    </x-slot>
    
      
       @livewire('procesos.proceso-variedad', ['variedad' => $variedad],key($variedad->id))
             
            
</x-app-layout>
