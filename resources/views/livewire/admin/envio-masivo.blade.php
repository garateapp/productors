<div>
   
    <div class="max-w-7xl mx-auto px-4 ">

        <div class="bg-white shadow-lg rounded overflow-hidden py-12">
          <div class="flex justify-center">
              <img class="w-16 my-4" src="https://static.vecteezy.com/system/resources/previews/005/165/267/non_2x/file-upload-concept-in-flat-style-file-with-arrow-vector.jpg" alt="">
          </div>  
          <h1 class="text-center text-2xl">Cargar Archivos</h1>

          @if ($productors)

             
          <div class="flex justify-center">
            <div class="max-w-xs bg-green-500 text-sm text-white rounded-md shadow-lg my-3 ml-3 justify-center" role="alert">
                <div class="flex p-4">
                    {{$productors->count()}} Productores que comercializan {{$especie->name}}
            
                  
                </div>
              </div>
          </div>
              

          @endif

          <div class="mt-4 mx-12">
            <div class="grid grid-cols-2 gap-x-4 mt-4 max-w-4xl mx-auto">
                <div>
                    {!! Form::open(['route'=>'mensajes.store','files'=>true , 'autocomplete'=>'off', 'method'=> 'POST']) !!}
                        
                    {!! Form::label('especie', 'Especie',['class'=>' font-bold']) !!}
                    {!! Form::select('especie', $especies, null , ['class'=>'form-input block w-full mt-1']) !!}
                </div>
                <div>
                    
                        <p class="font-bold">Tipo de archivo: </p> 
                   
                
                    

                    {!! Form::select('tipo', array('ASOEX' => 'ASOEX', 'Boletin Técnico' => 'Boletin Técnico', 'Programa Fitosanitario' => 'Programa Fitosanitario'), 'excel',['class'=>'block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500']) !!}
                
                    @error('detalle')
                        <span class="text-sm text-red-500">{{$message}}</span>
                    @enderror
                </div>
                <div class="col-span-2 text-center mt-4" wire:ignore>
                   
                    
                  
                         
                


                        {!! Form::label('observacion', 'Mensaje', ['class'=>'font-bold text-center']) !!}
                        {!! Form::textarea('observacion', null , ['class' => 'form-input block w-full mt-1 h-max']) !!}
                        
                    
                </div>
            </div>
          </div>
          <div>
            @isset ($tipo)
                <h1 class="text-center mt-4">Selecciona un archivo {{$tipo}}</h1>
            @endisset
            
          </div>
      <div class="grid grid-cols-1 sm:grid-cols-3 w-max-7xl mt-4 ">
        <div>
            
        </div>
        {!! Form::label('file', 'Archivo', ['class'=>'font-bold text-center hidden']) !!}
        
        {!! Form::file('file', ['class'=>'form-input w-full'.($errors->has('file')?' border-red-600':''), 'id'=>'file','accept'=>'file/*']) !!}
     </div>
      <div class="flex justify-center mt-4">
       
            <div class="flex justify-end">
                {!! Form::submit('ENVIAR', ['class'=>'text-center text-white font-bold inline w-full mx-4 focus:ring-2 focus:ring-offset-2 focus:ring-green-500 mt-4 sm:mt-0 inline-flex items-start justify-start px-6 py-3 bg-green-500 hover:bg-green-500 focus:outline-none rounded cursor-pointer']) !!}
            </div>

        {!! Form::close() !!}
      </div>
        
        </div>
    </div>

    <x-slot name="js">

       
  
      </x-slot>
             
            
</div>
