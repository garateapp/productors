<x-app-layout>
  
    @section('css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css" integrity="sha512-3g+prZHHfmnvE1HBLwUnVuunaPOob7dpksI7/v6UnF/rnKGwHf/GdEq9K7iEN7qTtW+S0iivTcGpeTBqqB04wA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @endsection

    <div class="max-w-7xl mx-auto px-4 ">
        <div class="bg-white shadow-lg rounded overflow-hidden py-12">
            <div class="px-6 py-12">
                <form action="{{route('procesos.index')}}"
                method="POST"
                class="dropzone"
                id="my-awesome-dropzone">
                <div class="dz-message " data-dz-message>
                <h1 class="text-xl font-bold">Seleccione Archivos</h1>
                <span>Puedes seleccionar multiples archivos a la vez</span>
                </div>
                </form>
            </div>
        </div>
    </div>

    <x-slot name="js">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/min/dropzone.min.js"></script>
        <script>
          
          Dropzone.options.myGreatDropzone = { // camelized version of the `id`
            headers:{
              'X-CSRF-TOKEN' : "{!! csrf_token() !!}"
            },
            acceptedFiles: "image/*",
            maxFiles: 6,
            
    
              
              };
             
              
          
        </script>
  
      </x-slot>
             
            
</x-app-layout>
