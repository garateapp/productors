<x-app-layout>
  
    @section('css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css" integrity="sha512-3g+prZHHfmnvE1HBLwUnVuunaPOob7dpksI7/v6UnF/rnKGwHf/GdEq9K7iEN7qTtW+S0iivTcGpeTBqqB04wA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @endsection




    <div class="max-w-7xl mx-auto px-4 ">
        <div class="bg-white shadow-lg rounded overflow-hidden pb-12">
            <div class="px-6 py-12">
              <div class="flex justify-center">
                  <img class="h-16 my-4" src="{{asset('image/logogreenex.png')}}" alt="">
              </div>  
              <div class="flex justify-center mt-2">
                  <div>
                    <a href="{{route('subir.procesos')}}">
                        <button class="mx-2 items-center focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 px-6 py-3 bg-green-500 hover:bg-green-500 focus:outline-none rounded">
                            <p class="text-sm font-medium leading-none text-white">ACTUAL</p>
                        </button>
                    </a>
                    
                  </div>
                  <div>
                         
                            <button class="mx-2 items-center focus:ring-2 focus:ring-offset-2 focus:red-green-500 sm:mt-0 px-6 py-3 bg-red-500 hover:bg-red-500 focus:outline-none rounded">
                                <p class="text-sm font-medium leading-none text-white">ANTERIOR</p>
                            </button>
                         
                  </div>
              </div>
              <h1 class="text-center text-2xl py-12">Cargar Archivos de Procesos Temporada Anterior</h1>
                <form action="{{route('proceso.upload.anterior')}}"
                method="POST"
                class="dropzone"
                id="my-awesome-dropzone">
                @csrf
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
            acceptedFiles: "application/pdf",
            maxFiles: 20,
            
    
              
              };
             
              
          
        </script>
  
      </x-slot>
             
            
</x-app-layout>
