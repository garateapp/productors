<x-app-layout>
    <x-slot name="header">
       
    </x-slot>

    @livewire('calidad.agregar-cc', ['recepcion' => $recepcion], key($recepcion->id))         
     

</x-app-layout>
