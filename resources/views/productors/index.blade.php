<x-app-layout>
    <x-slot name="header">
       
    </x-slot>


                    

                    @livewire('productor.productor-search')

              
               
             
                        
               <script>
               function dropdownFunction(element) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                let list = element.parentElement.parentElement.getElementsByClassName("dropdown-content")[0];
                list.classList.add("target");
                for (i = 0; i < dropdowns.length; i++) {
                    if (!dropdowns[i].classList.contains("target")) {
                        dropdowns[i].classList.add("hidden");
                    }
                }
                list.classList.toggle("hidden");
            }</script>

</x-app-layout>
