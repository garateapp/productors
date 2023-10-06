<div>
    <main class="flex w-full h-full shadow-lg rounded-3xl">
        <section class="hidden sm:flex flex-col w-2/12 bg-white rounded-l-3xl ">
          <div class="w-16 mx-auto mt-12 mb-20 p-4 bg-indigo-600 rounded-2xl text-white">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                d="M3 19v-8.93a2 2 0 01.89-1.664l7-4.666a2 2 0 012.22 0l7 4.666A2 2 0 0121 10.07V19M3 19a2 2 0 002 2h14a2 2 0 002-2M3 19l6.75-4.5M21 19l-6.75-4.5M3 10l6.75 4.5M21 10l-6.75 4.5m0 0l-1.14.76a2 2 0 01-2.22 0l-1.14-.76" />
            </svg>
          </div>
          <nav class="relative flex flex-col py-4 items-center">
            @if ($mensajespendientes->count())
                <a href="#" class="relative w-16 p-4 bg-purple-100 text-purple-900 rounded-2xl mb-4">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                  d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20" />
              </svg>
              <span class="absolute -top-2 -right-2 bg-red-600 h-6 w-6 p-2 flex justify-center items-center text-white rounded-full">{{$mensajespendientes->count()}}</span>
              </a>
             @else
                <a href="#" class="w-16 p-4 border text-gray-700 rounded-2xl mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                        d="M8 4H6a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-2m-4-1v8m0 0l3-3m-3 3L9 8m-5 5h2.586a1 1 0 01.707.293l2.414 2.414a1 1 0 00.707.293h3.172a1 1 0 00.707-.293l2.414-2.414a1 1 0 01.707-.293H20" />
                    </svg>
                  
                </a>
             @endif
           
           
          </nav>
        </section>
        <section class="hidden sm:flex flex-col pt-3 w-full sm:w-4/12 bg-gray-50 h-full overflow-y-scroll order-2 lg:order-1">
          <label class="px-3">
            <input class="rounded-lg p-4 bg-gray-100 transition duration-200 focus:outline-none focus:ring-2 w-full"
              placeholder="Buscar..." />
          </label>
         
          <ul class="mt-6">
            
            @foreach ($mensajes as $item)
                @if ($current->id==$item->id)
                    <li class="py-5 border-b px-3 bg-indigo-600 text-white" wire:click="changemensaje({{$item->id}})">
                        <a class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold">{{$item->tipo}} del Usuario {{$emisor->name}}</h3>
                        <p class="text-md">{{$item->created_at->format('d/m/Y')}}</p>
                        </a>
                        @if ($item->status==1)
                            <div class="text-md">Mensaje Pendiente de Responder!</div>
                        @else
                            <div class="text-md">Mensaje leido!</div>
                        @endif
                        
                    </li>
                @else
                    <li class="py-5 border-b px-3 transition hover:bg-indigo-100" wire:click="changemensaje({{$item->id}})">
                        <a class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold">{{$item->tipo}} del Usuario {{$emisor->name}}</h3>
                        <p class="text-md text-gray-400">{{$item->created_at->format('d/m/Y')}}</p>
                        </a>
                        @if ($item->status==1)
                            <div class="text-md">Mensaje Pendiente de Responder!</div>
                        @else
                            <div class="text-md">Mensaje leido!</div>
                        @endif
                    </li>
                @endif
                
            @endforeach
           
           
          </ul>
        </section>
        <section class="w-full sm:w-6/12 px-4 flex flex-col bg-white rounded-r-3xl order-1 lg:order-2">
            @if ($current)
                <div class="flex justify-between items-center h-48 border-b-2 mb-2">
                    <div class="flex space-x-4 items-center">
                        <div class="h-12 w-12 rounded-full overflow-hidden">
                            <img src="{{ Auth::user()->profile_photo_url }}" loading="lazy" class="h-full w-full object-cover" />
                        </div>
                        <div class="flex flex-col">
                            <h3 class="font-semibold text-lg">{{$emisor->name}}</h3>
                            <p class="text-light text-gray-400">{{$emisor->email}}</p>
                        </div>
                    </div>
                    <div>
                    <ul class="flex text-gray-400 space-x-4">
                        <li class="w-6 h-6">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 15l-3-3m0 0l3-3m-3 3h8M3 12a9 9 0 1118 0 9 9 0 01-18 0z" />
                        </svg>
                        </li>
                        <li class="w-6 h-6">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 9l3 3m0 0l-3 3m3-3H8m13 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        </li>
            
                    </ul>
                    </div>
              </div>
              <section>
                <h1 class="font-bold text-2xl">{{$item->tipo}} del Usuario {{$emisor->name}}</h1>
                <article class="mt-8 text-gray-500 leading-7 tracking-wider">
                  
                       
             

                  <p>{!!$current->observacion!!}</p>
                 
                  <footer class="mt-12">
                    <p>Atte. {{$emisor->name}}</p>
                  
                  </footer>
                </article>
                {!! Form::model($current, ['route'=>['tickets.update',$current],'method' => 'put', 'autocomplete'=>'off']) !!}                
           
                
                @if ($current->respuesta)
                    <article class="mt-8 text-gray-500 leading-7 m-2 p-4 shadow-lg tracking-wider">
                        <h1 class="text-center font-bold text-xs mt-6">Respuesta: {{$receptor->name}} </h1>
                        
                

                        <p>{!!$current->respuesta!!}</p>
                    
                        <footer class="mt-12">
                        <p>Atte. {{$receptor->name}}</p>
                        
                        </footer>
                    </article>
                   
                @else
                    
                    <h1 class="text-center text-xs mt-6">Sección para Responder</h1>
                
                           {!! Form::textarea('respuesta', null , ['class' => 'mt-1 block w-full']) !!}
                @endif 
               
              </section>
              <section class="flex mt-6 rounded-xl mb-3 justify-end">
                @if (IS_NULL($current->respuesta))
                    
                
                    {!! Form::submit('Responder', ['class'=>'hover:bg-green-500 bg-green-600 text-white px-6 py-2 ml-auto rounded-xl']) !!}
                
                @endif
            </section>
             
              {!! Form::close() !!}
            @endif
        </section>
      </main>
      <section class="flex sm:hidden flex-col pt-3 w-full sm:w-4/12 bg-gray-50 h-full overflow-y-scroll order-2 lg:order-1 mb-8">
        <label class="px-3">
          <input class="rounded-lg p-4 bg-gray-100 transition duration-200 focus:outline-none focus:ring-2 w-full"
            placeholder="Buscar..." />
        </label>
       
        <ul class="my-6">
          
          @foreach ($mensajes as $item)
              @if ($current->id==$item->id)
                  <li class="py-5 border-b px-3 bg-indigo-600 text-white" wire:click="changemensaje({{$item->id}})">
                      <a class="flex justify-between items-center">
                      <h3 class="text-lg font-semibold">{{$item->tipo}} del Usuario {{$emisor->name}}</h3>
                      <p class="text-md">{{$item->created_at->format('d/m/Y')}}</p>
                      </a>
                      @if ($item->status==1)
                          <div class="text-md">Mensaje Pendiente de Responder!</div>
                      @else
                          <div class="text-md">Mensaje leido!</div>
                      @endif
                      
                  </li>
              @else
                  <li class="py-5 border-b px-3 transition hover:bg-indigo-100" wire:click="changemensaje({{$item->id}})">
                      <a class="flex justify-between items-center">
                      <h3 class="text-lg font-semibold">{{$item->tipo}} del Usuario {{$emisor->name}}</h3>
                      <p class="text-md text-gray-400">{{$item->created_at->format('d/m/Y')}}</p>
                      </a>
                      @if ($item->status==1)
                          <div class="text-md">Mensaje Pendiente de Responder!</div>
                      @else
                          <div class="text-md">Mensaje leido!</div>
                      @endif
                  </li>
              @endif
              
          @endforeach
         
         
        </ul>
      </section>
</div>
