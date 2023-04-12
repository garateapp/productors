<x-app-layout>
  
    @section('css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.2/dropzone.min.css" integrity="sha512-3g+prZHHfmnvE1HBLwUnVuunaPOob7dpksI7/v6UnF/rnKGwHf/GdEq9K7iEN7qTtW+S0iivTcGpeTBqqB04wA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @endsection


    <div class="max-w-7xl mx-auto px-4 ">
        <div class="bg-white shadow-lg rounded overflow-hidden py-12">
          <div class="flex justify-center">
              <img class="w-16 my-4" src="https://static.vecteezy.com/system/resources/previews/005/165/267/non_2x/file-upload-concept-in-flat-style-file-with-arrow-vector.jpg" alt="">
          </div>  
          <h1 class="text-center text-2xl">Cargar Archivos</h1>

          <div class="flex justify-center mt-4">
            <div class="max-w-5xl grid grid-cols-3 gap-x-4 mt-4 mx-12">
                <div>
                    
                        <p class="font-bold">Especie: </p> 
                 
                        

                    <select class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        <option value="" class="text-center">Selecciona una especie</option>

                            @foreach ($especies as $especie)

                                <option value="{{$especie->id}}" class="text-center">{{$especie->name}}</option>
                                
                            @endforeach

                    </select>
                </div>
                <div>
                    
                        <p class="font-bold">Tipo de archivo: </p> 
                   
                
                    <select  class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                        <option value="" class="text-center">Seleccione..</option>
                      

                                <option value="" class="text-center">ASOEX</option>
                                <option value="" class="text-center">Boletin Técnico</option>
                                <option value="" class="text-center">Programa Fitosanitario</option>
                                
                          
                    </select>
                
                    @error('detalle')
                        <span class="text-sm text-red-500">{{$message}}</span>
                    @enderror
                </div>
                <div>
                    <p class="font-bold">Fecha </p> 
                    <input type="date" class="form-input flex-1 w-full shadow-sm  border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg focus:outline-none" >
                
                    
                </div>
            </div>
            
        </div>
      <div class="grid grid-cols-1 sm:grid-cols-3 w-max-7xl mt-8 ">
        <div>

        </div>
          <input type="file" class="form-input shadow-sm  border-2 border-gray-300 bg-white h-20 px-5 pr-16 rounded-lg focus:outline-none" >
      </div>
      <div class="flex justify-center mt-4">
        <button class="mx-4 focus:ring-2 focus:ring-offset-2 focus:ring-green-500 mt-4 sm:mt-0 inline-flex items-start justify-start px-6 py-3 bg-green-500 hover:bg-green-500 focus:outline-none rounded">

            <h1 style="font-size: 1rem;white-space: nowrap;" class="text-center text-white font-bold inline w-full" >
                GUARDAR
                
            </h1>
        </button>
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
