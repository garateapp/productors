<x-app-layout>
    <x-slot name="header">
       
    </x-slot>

    <h1 class="text-center font-bold text-2xl my-4">Soporte y Gestion de Tickets</h1>
    <div class="pt-6 pb-8">    
        @livewire('admin.soporte')
    </div>
    <h1 class="text-center my-4 font-bold">Información de Contacto</h1>

    <div class="flex items-center justify-center">
      
        <div class="grid grid-cols-2 gap-x-6"> 
          <div>
            <div class="mx-auto w-full max-w-[550px]">
     
              <div class="mb-5">
                  {!! Form::model($soportes->where('item','direccion')->first(), ['route'=>['soportes.update',$soportes->where('item','direccion')->first()],'method' => 'put', 'autocomplete'=>'off']) !!}                
                 
               
               
              <div class="flex justify-between mb-2">
                  <div class="items-center my-auto">
                  <label
                  for="name"
                  class="block text-base font-medium text-[#07074D] "
                >
                  Dirección
                </label>
              </div>
                  {!! Form::submit('Actualizar', ['class'=>'text-white mx-4 text-sm focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 mt-4 sm:mt-0 inline-flex items-end justify-end px-3 py-2 bg-green-500 hover:bg-green-400 focus:outline-none rounded']) !!}
              </div>
                      {!! Form::text('info', null , ['class' => 'w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md']) !!}
                    
                  {!! Form::close() !!}
                                                    
  
              </div>  <div class="mb-5">
                  {!! Form::model($soportes->where('item','email')->first(), ['route'=>['soportes.update',$soportes->where('item','email')->first()],'method' => 'put', 'autocomplete'=>'off']) !!}                
                 
               
               
              <div class="flex justify-between mb-2">
                  <div class="items-center my-auto">
                  <label
                  for="name"
                  class="block text-base font-medium text-[#07074D] "
                >
                  Email
                </label>
              </div>
                  {!! Form::submit('Actualizar', ['class'=>'text-white mx-4 text-sm focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 mt-4 sm:mt-0 inline-flex items-end justify-end px-3 py-2 bg-green-500 hover:bg-green-400 focus:outline-none rounded']) !!}
              </div>
                      {!! Form::text('info', null , ['class' => 'w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md']) !!}
                    
                  {!! Form::close() !!}
                                                    
  
              </div>
            
            
            </div>
          </div>
        
          <div>
            <div class="mb-5">
              {!! Form::model($soportes->where('item','fono')->first(), ['route'=>['soportes.update',$soportes->where('item','fono')->first()],'method' => 'put', 'autocomplete'=>'off']) !!}                
                
              
              
              <div class="flex justify-between mb-2">
                  <div class="items-center my-auto">
                  <label
                  for="name"
                  class="block text-base font-medium text-[#07074D] "
                >
                  Fono
                </label>
              </div>
                  {!! Form::submit('Actualizar', ['class'=>'text-white mx-4 text-sm focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 mt-4 sm:mt-0 inline-flex items-end justify-end px-3 py-2 bg-green-500 hover:bg-green-400 focus:outline-none rounded']) !!}
              </div>
                      {!! Form::text('info', null , ['class' => 'w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md']) !!}
                    
                  {!! Form::close() !!}
                                                    

              </div>  
              <div class="mb-5">
                  {!! Form::model($soportes->where('item','descripcionportal')->first(), ['route'=>['soportes.update',$soportes->where('item','descripcionportal')->first()],'method' => 'put', 'autocomplete'=>'off']) !!}                
                
              
              
              <div class="flex justify-between mb-2">
                  <div class="items-center my-auto">
                  <label
                  class="block text-base font-medium text-[#07074D] ">
                  DESCRIPCIÓN PORTAL GREENEX
                </label>
              </div>
                  {!! Form::submit('Actualizar', ['class'=>'text-white mx-4 text-sm focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 mt-4 sm:mt-0 inline-flex items-end justify-end px-3 py-2 bg-green-500 hover:bg-green-400 focus:outline-none rounded']) !!}
              </div>
              {!! Form::text('info', null , ['class' => 'w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md']) !!}
                  
                  {!! Form::close() !!}
                                                    

              </div>
            </div>
          </div>
       
      </div>
            
</x-app-layout>
