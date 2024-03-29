<x-app-layout>
    <x-slot name="header">
       
    </x-slot>
    <div class="bg-white shadow-lg rounded overflow-hidden">

        @if(session('info'))
            <div class="flex justify-center">
                <div class="justify-center">
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded justify-center w-full flex" role="alert">
                    <strong class="font-bold mx-2">Exito!</strong>
                    <span class="flex">{{session('info')}}</span>
                    <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                    </span>
                </div>
                </div>
            </div>
        @endif

   

   
            <div class="grid grid-cols-1 md:grid-cols-2">
                <div>
                        <div class="form-group flex justify-center">
                            <div class="block">
                                <h1 class="h5">Nombre:</h1>
                                {{$user->name}}
                            </div>
                            
                        </div>
                       
                            @isset($user->profile_photo_path)
                                <figure class="flex justify-center">               
                                    <img id="picture" class="w-20 h-20 object-cover object-center"src="{{$user->profile_photo_url}}" alt="">
                                </figure>
                                {!! Form::model($user, ['route'=>['productor.users.update',$user] ,'method' => 'put', 'autocomplete'=>'off']) !!}                
                                    @csrf
                                   
                            
                                <div class="flex justify-center mt-2">
                                    {!! Form::file('profile_photo_path', ['class'=>'hidden form-input w-full'.($errors->has('file')?' border-red-600':''), 'id'=>'file','accept'=>'image/*']) !!}
                            
                                    <button  class="my-4 items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-6 py-3 bg-gray-500 hover:bg-gray-500 focus:outline-none rounded">
                                        <p class="text-sm font-medium leading-none text-white">Eliminar</p>
                                    </button>
                                </div>
                                {!! Form::close() !!}
                           

                            @else
                                <figure class="flex justify-center">
                                    <img id="picture" class="w-20 h-20 object-cover object-center"src="{{$user->profile_photo_url}}" alt="">
                                </figure>
                            @endisset
                       
                </div>
                <div>
                    <strong class="flex justify-center">Subir Logo</strong>
                
                    {!! Form::model($user, ['route'=>['update.logo',$user],'files'=>true ,'method' => 'post', 'autocomplete'=>'off']) !!}                
                        @csrf
                    <div class="flex justify-center mx-6">
                        
                    <div class="grid grid-cols-1 gap-4">
                       
                            <p class="mb-2">Una vez que el logo haya sido subido, automaticamente sera  reemplazado en el informe de recepciónes, para restituirlo solo se debe eliminar el logo.</p>
                           {{-- comment {!! Form::text('profile_photo_path', null , ['class' => 'form-input block w-full mt-1'.($errors->has('subtitulo')?' border-red-600':'')]) !!}
                            --}}
                             {!! Form::file('profile_photo_path', null, ['class'=>'form-input w-full'.($errors->has('file')?' border-red-600':''), 'id'=>'file','accept'=>'image/*']) !!}
                            
                            @error('file')
                                <strong class="text-xs text-red-600">{{$message}}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="flex justify-center mt-2">
                        <button  class="my-4 items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-6 py-3 bg-gray-500 hover:bg-gray-500 focus:outline-none rounded">
                            <p class="text-sm font-medium leading-none text-white">Agregar Logo</p>
                        </button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>


    </div>

            
</x-app-layout>
