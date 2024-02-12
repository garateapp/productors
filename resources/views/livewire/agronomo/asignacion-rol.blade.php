<div>

    <input wire:model="search" class="w-full border-2 border-gray-300 bg-white h-10 px-5 pr-16 rounded-lg text-sm"
    type="search" name="search" style="z-index: 10;" autocomplete="off">

         

    <div x-data="{sview: true}">
        <p class="text-center text-xs">Pincha sobre el nombre y sera agregad@ a la lista de Agrónomos <span x-on:click="sview=!sview" class="text-blue-500">(Ocultar/Mostrar)</span></p>
        
        @if ($search)
                 <ul x-show="sview" class="relative z-1 left-0 w-full bg-white mt-1 rounded-lg overflow-hidden px-4">

                    @forelse ($this->users as $user)
                        <li class="leading-10 px-5 text-sm cursor-pointer hover:bg-gray-300 flex justify-between items-center whitespace-nowrap">
                         {{$user->name}}-
                                @if ($user->email)
                                    {{$user->email}} 
                                @else
                                    (Sin Email)
                                @endif
                          
                        <div class="flex justify-end items-center"> 
                            @if ($type=='Agronomo')
                                {!! Form::model($user, ['route'=>['users.update',$user],'method' => 'put']) !!}

                                        @foreach ($user->roles as $role)
                                            {!! Form::hidden('roles[]', $role->id) !!}
                                        @endforeach
                                                    {!! Form::hidden('roles[]', 5) !!}
                                                
                                    
                                    
                                    <button class="my-auto ml-4 items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-6 py-3 bg-gray-500 hover:bg-gray-500 focus:outline-none rounded">
                                        <p class="text-sm font-medium leading-none text-white">Asignar Rol</p>
                                    </button>
                                {!! Form::close() !!}
                             @elseif ($type=='Productor')
                                <button wire:click="storeagronomo({{$user->id}})" class="my-auto ml-4 items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-6 py-3 bg-gray-500 hover:bg-gray-500 focus:outline-none rounded">
                                    <p class="text-sm font-medium leading-none text-white">Asignar Agronómo</p>
                                </button>
                            @else
                                <button wire:click="storecampo({{$user->id}})" class="my-auto ml-4 items-center focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 px-6 py-3 bg-gray-500 hover:bg-gray-500 focus:outline-none rounded">
                                    <p class="text-sm font-medium leading-none text-white">Asignar Campo</p>
                                </button>
                            @endif
                               
                        </div>
                        </li>
                        @empty
                    
                        
                
                    @endforelse
                
                    
                </ul>
           
        @endif

    </div>

</div>
