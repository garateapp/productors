<x-app-layout>
 
    
    <div class="my-12 inset-0 flex items-center justify-center">
        <div class="w-45 px-5 py-4 bg-white shadow-menu border-b-4 border-wedges-pink-500">
            <div class="flex justify-between items-center h-48 border-b-2 mb-2">
                <div class="flex space-x-4 items-center">
                    <div class="h-12 w-12 rounded-full overflow-hidden">
                        <img src="{{ $emisor->profile_photo_url }}" loading="lazy" class="h-full w-full object-cover" />
                    </div>
                    <div class="flex flex-col">
                        <h3 class="font-semibold text-lg">Enviado por {{$emisor->name}}</h3>
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
           {!! Form::model($mensaje_hist, ['route'=>['mensaje_hists.update',$mensaje_hist],'method' => 'put', 'files'=> true , 'autocomplete'=>'off']) !!}   
               
          <section>
            <h1 class="font-bold text-2xl">{{$mensaje_hist->tipo}} Para Productores De {{$mensaje_hist->especie}}</h1>
            <article class="mt-8 text-gray-500 leading-7 tracking-wider">
                {!! Form::label('observacion', 'Mensaje', ['class'=>'font-bold text-center']) !!}
                         
                {!! Form::textarea('observacion', null , ['class' => 'mt-1 block w-full']) !!}
                  
                
             
              <footer class="mt-12">
                <p>Atte. Administración</p>
                <p>Greenex</p>
              </footer>
            </article>
           
            <ul class="flex justify-center space-x-4 mt-4">
                <a href="{{route('download.mensaje_hist',$mensaje_hist)}}" target="_blank">  
                    <li class="w-max-3xl content-center my-auto flex h-10 border rounded-lg p-1 justify-between cursor-pointer transition duration-200 text-indigo-600 hover:bg-blue-100" >
                        <h1 class="content-center my-auto">DESCARGAR ARCHIVO</h1>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="w-10">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M9 13h6m-3-3v6m-9 1V7a2 2 0 012-2h6l2 2h6a2 2 0 012 2v8a2 2 0 01-2 2H5a2 2 0 01-2-2z" />
                        </svg>
                    </li> 
                </a>
            </ul>
          </section>
          
          
    
            <div class="relative flex justify-between items-center mt-3">
                <div class="flex">
                    <img class="block w-6 h-6 rounded-full" src="https://d29lra7z8g0m3a.cloudfront.net/e3faf733-c579-4c89-81cb-972135bef85d/img/testimonials/avatar-james.jpg" alt="">
                    <div class="ml-2">
                        @if ($emisor)
                            <h4 class="text-16 font-medium">{{$emisor->name}}</h4>
                        
                        
                            <span class="text-wedges-gray-500">
                                @foreach ($emisor->roles as $role)
                                    
                                        {{$role->name}}
                                
                                @endforeach
                            </span>
                        @endif
                    </div>
                </div>
                <div class="ml-4">
                          
                    {!! Form::file('file', ['class'=>'form-input w-full'.($errors->has('file')?' border-red-600':''), 'id'=>'file','accept'=>'file/*']) !!}
              
                </div>
               
            </div>
            <div class="flex justify-center mt-2">
                {!! Form::submit('Actualizar', ['class'=>'hover:bg-green-500 bg-green-600 text-white px-6 py-2 rounded-xl']) !!}
            </div>
        </div>
         
                
        {!! Form::close() !!}
    </div>
    
    <section class="flex justify-center pt-3 w-8/12 mx-auto bg-gray-50 h-full overflow-y-scroll">
         
      
        <ul  class="mt-6 w-full">
            @foreach ($items as $item)
               
               
                    <li class="py-5 border-b px-3 transition hover:bg-indigo-100">
                        <a href="{{route('envio.masivo')}}" class="flex justify-between items-center">
                        <h3 class="text-lg font-semibold">  @foreach ($users as $user)
                            @if ($user->id==$item->receptor_id)
                                {{$user->name}}
                            @endif
                        @endforeach</h3>
                        <div>
                            <p class="text-md text-gray-400 text-center">{{$item->created_at->format('d/m/Y')}}</p>
                            @if ($item->status==1)
                                <div class="text-md">Mensaje Pendiente de Leer!</div>
                            @else
                                <div class="text-md">Mensaje leido!</div>
                            @endif
                        </div>
                        </a>
                        <div class="text-md italic text-gray-400">
                            {{$item->tipo}} Para Productores De {{$item->especie}}
                        </div>
                       
                        
                    </li>
               
               
            @endforeach
          
         
        </ul>
      </section>
      <x-slot name="js">
        <script src="https://cdn.ckeditor.com/ckeditor5/31.0.0/classic/ckeditor.js"></script>
        <script>
        ClassicEditor
            .create( document.querySelector( '#observacion'), {
                    toolbar: [ 'heading', '|', 'bold', 'italic', 'link', 'blockQuote' ],
                    heading: {
                    options: [
                            { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                            { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                            { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
                        ]
                    }
                } )
                .catch( error => {
                    console.log( error );
                    } );
             
              
          
        </script>
  
      </x-slot>
  
</x-app-layout>
