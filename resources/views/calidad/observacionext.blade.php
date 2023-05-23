<x-app-layout>
    <x-slot name="header">
       
    </x-slot>
    
    <div class="max-w-7xl mx-auto px-4 ">

       

        <div class="bg-white shadow-lg rounded overflow-hidden py-12 mt-8">
          <div class="flex justify-center">
              <img class="w-16 my-4" src="https://static.vecteezy.com/system/resources/previews/005/165/267/non_2x/file-upload-concept-in-flat-style-file-with-arrow-vector.jpg" alt="">
          </div>  
          <h1 class="text-center text-2xl">Agregar Observación Externa de la Recepción Nro: {{$recepcion->numero_g_recepcion}}</h1>


          <div class="mt-4 mx-12">
            <div class="grid grid-cols-2 gap-x-4 mt-4 max-w-4xl mx-auto">
                <div>
                    {!! Form::model($recepcion->calidad, ['route'=>['detalle.update',$recepcion->calidad],'method' => 'put', 'autocomplete'=>'off']) !!}      
                </div>
             
                <div class="col-span-2 text-center mt-4" wire:ignore>
                   
                    
                  
                         
                


                        {!! Form::label('obs_ext', 'Mensaje', ['class'=>'font-bold text-center']) !!}
                        {!! Form::text('obs_ext', null , ['class' => 'form-input block w-full mt-1 h-max']) !!}
                        
                    
                </div>
            </div>
          </div>
          <div>
          
            
          </div>
     
      <div class="flex justify-center mt-4">
       
            <div class="flex justify-end">
                {!! Form::submit('ENVIAR', ['class'=>'text-center text-white font-bold inline w-full mx-4 focus:ring-2 focus:ring-offset-2 focus:ring-green-500 mt-4 sm:mt-0 inline-flex items-start justify-start px-6 py-3 bg-green-500 hover:bg-green-500 focus:outline-none rounded cursor-pointer']) !!}
            </div>

            {!! Form::close() !!}
        </div>
        <div class="flex justify-center max-w-3xl">
            @if (session('info'))
                <div x-data="{open: true}">
                    <div x-show="open"  class="bg-white mt-4 border border-gray-400 text-gray-700 px-4 py-3 rounded relative" role="alert">
                        <strong class="font-bold">Felicidades!</strong>
                        <span class="block sm:inline ml-4 mr-6">{{session('info')}}</span>
                        <span x-on:click="open=false" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg class="fill-current h-6 w-6 text-gray-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                        </span>
                    </div>
                </div>
            @endif
        </div>
        
        </div>
    </div>
    
</x-app-layout>