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
           
            <a href="#" class="w-16 p-4 border text-gray-700 rounded-2xl mb-24">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
              </svg>
            </a>
            <a href="#" class="w-16 p-4 border text-gray-700 rounded-2xl">
              <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                  d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                  d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
              </svg>
            </a>
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
                    <li class="py-5 border-b px-3 bg-indigo-600 text-white">
                        <a class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold">{{$item->tipo}} Para Productores De {{$item->especie}}</h3>
                        <p class="text-md">23m ago</p>
                        </a>
                        @if ($item->status==1)
                            <div class="text-md">Mensaje Pendiente de Leer!</div>
                        @else
                            <div class="text-md">Mensaje leido!</div>
                        @endif
                        
                    </li>
                @else
                    <li class="py-5 border-b px-3 transition hover:bg-indigo-100" wire:click="changemensaje({{$item->id}})">
                        <a class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold">{{$item->tipo}} Para Productores De {{$item->especie}}</h3>
                        <p class="text-md text-gray-400">23m ago</p>
                        </a>
                        @if ($item->status==1)
                            <div class="text-md">Mensaje Pendiente de Leer!</div>
                        @else
                            <div class="text-md">Mensaje leido!</div>
                        @endif
                    </li>
                @endif
                
            @endforeach
           
           
          </ul>
        </section>
        <section class="w-full sm:w-6/12 px-4 flex flex-col bg-white rounded-r-3xl">
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
                <h1 class="font-bold text-2xl">{{$current->tipo}} Para Productores De {{$current->especie}}</h1>
                <article class="mt-8 text-gray-500 leading-7 tracking-wider">
                  <p>{{$current->observacion}}</p>
                 
                  <footer class="mt-12">
                    <p>Atte. Administración</p>
                    <p>Greenex</p>
                  </footer>
                </article>
                <ul class="flex justify-center space-x-4 mt-4">
                  <li class="w-max-3xl content-center my-auto flex h-10 border rounded-lg p-1 justify-between cursor-pointer transition duration-200 text-indigo-600 hover:bg-blue-100" wire:click="download({{$current->id}})">
                    <h1 class="content-center my-auto">DESCARGAR ARCHIVO</h1>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-10">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                        d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                    </svg>
                  </li>
                 
                </ul>
              </section>
              <section class="flex mt-6 rounded-xl mb-3 justify-end">
                
                <button class="bg-green-600 text-white px-6 py-2 ml-auto rounded-xl" wire:click="leido({{$current->id}})">Entendido</button>
              </section>
            @endif
        </section>
      </main>
      <section class="flex sm:hidden flex-col pt-3 w-full sm:w-4/12 bg-gray-50 h-full overflow-y-scroll order-2 lg:order-1">
        <label class="px-3">
          <input class="rounded-lg p-4 bg-gray-100 transition duration-200 focus:outline-none focus:ring-2 w-full"
            placeholder="Buscar..." />
        </label>
       
        <ul class="mt-6">
          
          @foreach ($mensajes as $item)
              @if ($current->id==$item->id)
                  <li class="py-5 border-b px-3 bg-indigo-600 text-white">
                      <a class="flex justify-between items-center">
                      <h3 class="text-lg font-semibold">{{$item->tipo}} Para Productores De {{$item->especie}}</h3>
                      <p class="text-md">23m ago</p>
                      </a>
                      @if ($item->status==1)
                          <div class="text-md">Mensaje Pendiente de Leer!</div>
                      @else
                          <div class="text-md">Mensaje leido!</div>
                      @endif
                      
                  </li>
              @else
                  <li class="py-5 border-b px-3 transition hover:bg-indigo-100" wire:click="changemensaje({{$item->id}})">
                      <a class="flex justify-between items-center">
                      <h3 class="text-lg font-semibold">{{$item->tipo}} Para Productores De {{$item->especie}}</h3>
                      <p class="text-md text-gray-400">23m ago</p>
                      </a>
                      @if ($item->status==1)
                          <div class="text-md">Mensaje Pendiente de Leer!</div>
                      @else
                          <div class="text-md">Mensaje leido!</div>
                      @endif
                  </li>
              @endif
              
          @endforeach
         
         
        </ul>
      </section>
</div>
