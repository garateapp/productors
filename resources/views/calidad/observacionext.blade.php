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
        
        </div>
    </div>
    
</x-app-layout>