<x-app-layout>
    <x-slot name="header">
      <a href="{{Route('agronomos.index')}}" class="font-bold">
      <- Lista de Agronomos
      </a>
    </x-slot>

    <div class="flex flex-col sm:justify-center items-center sm:pt-4" >
      
      @if (session('info'))
          <div x-data="{open: true}">
            <div x-show="open"  class="bg-white border border-gray-400 text-gray-700 px-4 py-3 rounded relative flex" role="alert">
                <strong class="font-bold content-center items-center my-auto">Felicidades!</strong>
                <span class="block sm:inline content-center items-center my-auto ml-2">{{session('info')}}</span>
                <span x-on:click="open=false" class="top-0 bottom-0 right-0 px-4 py-3 ">
                <svg class="fill-current h-6 w-6 text-gray-500 ml-4" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                </span>
            </div>
        </div>
      @endif
      @if (session('fail'))
          <div x-data="{open: true}">
              <div x-show="open"  class="bg-white border border-gray-400 text-gray-700 px-4 py-3 rounded relative flex" role="alert">
                  <strong class="font-bold content-center items-center my-auto">Error!</strong>
                  <span class="block sm:inline content-center items-center my-auto ml-2">{{session('fail')}}</span>
                  <span x-on:click="open=false" class="top-0 bottom-0 right-0 px-4 py-3 ">
                  <svg class="fill-current h-6 w-6 text-gray-500 ml-4" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
                  </span>
              </div>
          </div>
      @endif


        <!-- dark theme -->
        <div class="container  m-4">
          <div class="max-w-3xl w-full mx-auto grid gap-4 grid-cols-1">
            <!-- alert -->
        
            <!-- profile card -->
            <div class="flex flex-col top-0 z-10">
              <div class="bg-gray-800 border border-gray-300 shadow-lg  rounded-2xl p-4">
                <div class="flex-none sm:flex">
                  <div class=" relative h-32 w-32   sm:mb-0 mb-3">
                    <img src="{{$user->profile_photo_url}}" alt="aji" class=" w-32 h-32 object-cover rounded-2xl">
                    <a href="#" class="absolute -right-2 bottom-2   -ml-3  text-white p-1 text-xs bg-green-400 hover:bg-green-500 font-medium tracking-wider rounded-full transition ease-in duration-300">
                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-4 w-4">
                        <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z">
                        </path>
                      </svg>
                    </a>
                  </div>
                  <div class="flex-auto sm:ml-5 justify-evenly">
                    <div class="flex items-center justify-between sm:mt-2">
                      <div class="flex items-center">
                        <div class="flex flex-col">
                          <div class="text-gray-200">Ficha productor</div>  
                          <div class="w-full flex-none text-lg text-gray-200 font-bold leading-none">{{$user->name}}</div>
                          <div class="flex-auto text-gray-400 my-1">
                            <span class="mr-3 ">Correo</span><span class="mr-3 border-r border-gray-600  max-h-0"></span><span>{{$user->email}}</span>
                          </div>
                        </div>
                      </div>

                    
                    </div>
                    <div class="flex flex-row items-center">
                      <div class="flex">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5 text-yellow-400">
                          <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                          </path>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5 text-yellow-400">
                          <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                          </path>
                        </svg><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5 text-yellow-400">
                          <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                          </path>
                        </svg><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="h-5 w-5 text-yellow-400">
                          <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z">
                          </path>
                        </svg>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" class="h-5 w-5 text-yellow-400">
                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z">
                          </path>
                        </svg>
                      </div>
                      <div class="flex-1 inline-flex   items-center ml-2 space-x-2 hidden">
                        <a hre="https://www.behance.net/ajeeshmon" target="_blank"><svg class=" cursor-pointer w-5 h-5 p-1  rounded-2xl hover:bg-blue-500 hover:text-white transition ease-in duration-300" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="48" height="48" viewBox="0 0 172 172" style=" fill:#4a90e2;">
                            <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                              <path d="M0,172v-172h172v172z" fill="none"></path>
                              <g fill="#ffffff">
                                <path d="M71.66667,82.41667c3.58333,0 14.33333,-5.79783 14.33333,-20.13117c0,-22.28475 -19.72983,-26.45217 -41.95367,-26.45217c-4.19967,0 -17.00292,0.00717 -26.12967,0.00358c-5.93758,-0.00358 -10.75,4.81242 -10.75,10.75v78.82975c0,5.93758 4.81242,10.75 10.75,10.75h42.28333c15.83475,0 29.25792,-12.52733 29.38333,-28.36208c0.16842,-21.77233 -17.91667,-25.38792 -17.91667,-25.38792zM28.66667,53.75h25.08333c5.93758,0 10.75,4.81242 10.75,10.75c0,5.93758 -4.81242,10.75 -10.75,10.75h-25.08333zM55.54167,118.25h-26.875v-25.08333h26.875c6.92658,0 12.54167,5.61508 12.54167,12.54167c0,6.92658 -5.61508,12.54167 -12.54167,12.54167zM163.0775,103.91667c2.97058,0 5.375,-2.40442 5.37858,-5.375v0c0,-20.77975 -14.37275,-37.625 -35.83333,-37.625c-19.79075,0 -35.83333,16.84525 -35.83333,37.625c0,20.77975 16.04258,37.625 35.83333,37.625c17.51175,0 27.2405,-8.1915 31.992,-20.22075c0.91733,-2.31842 -0.8815,-4.83033 -3.3755,-4.83033h-8.60358c-1.30792,0 -2.46533,0.74175 -3.14258,1.86333c-3.27517,5.41083 -8.27392,8.85442 -15.00342,8.85442c-10.07633,0 -17.415,-7.65042 -19.2855,-17.91667h38.4205zM132.62275,75.25c7.44258,0 14.65583,5.934 16.69117,14.33333h-33.22825c2.69825,-8.41725 9.08375,-14.33333 16.53708,-14.33333zM148.70833,53.75h-28.66667c-2.967,0 -5.375,-2.408 -5.375,-5.375v0c0,-2.967 2.408,-5.375 5.375,-5.375h28.66667c2.967,0 5.375,2.408 5.375,5.375v0c0,2.967 -2.408,5.375 -5.375,5.375z"></path>
                              </g>
                            </g>
                          </svg></a>
      
                        <a hre="https://www.linkedin.com/in/ajeeshmon" target="_blank"><svg class="cursor-pointer w-5 h-5 p-1  rounded-2xl hover:bg-blue-500 hover:text-white transition ease-in duration-300" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="30" height="30" viewBox="0 0 172 172" style=" fill:#ffffff;">
                            <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                              <path d="M0,172v-172h172v172z" fill="none"></path>
                              <g fill="#ffffff">
                                <path d="M51.6,143.33333h-28.66667v-86h28.66667zM37.2724,45.86667c-7.9292,0 -14.33907,-6.42707 -14.33907,-14.33907c0,-7.912 6.42133,-14.3276 14.33907,-14.3276c7.90053,0 14.3276,6.42707 14.3276,14.3276c0,7.912 -6.42707,14.33907 -14.3276,14.33907zM154.8,143.33333h-27.56013v-41.85333c0,-9.98173 -0.1892,-22.81867 -14.3276,-22.81867c-14.35053,0 -16.55787,10.8704 -16.55787,22.09627v42.57573h-27.5544v-86.06307h26.4536v11.75907h0.37267c3.6808,-6.76533 12.6764,-13.8976 26.0924,-13.8976c27.92133,0 33.08133,17.82493 33.08133,40.99907z"></path>
                              </g>
                            </g>
                          </svg></a>
                        <a hre="https://twitter.com/ajeemon?lang=en" target="_blank"><svg class="cursor-pointer w-5 h-5 p-1  rounded-2xl hover:bg-blue-400 hover:text-white transition ease-in duration-300" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="24" height="24" viewBox="0 0 172 172" style=" fill:#ffffff;">
                            <g fill="none" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal">
                              <path d="M0,172v-172h172v172z" fill="none"></path>
                              <g fill="#ffffff">
                                <path d="M155.04367,28.88883c-5.84083,2.75917 -15.781,7.9335 -20.77617,8.9225c-0.1935,0.05017 -0.35117,0.11467 -0.5375,0.16483c-5.8265,-5.74767 -13.81017,-9.3095 -22.64667,-9.3095c-17.80917,0 -32.25,14.44083 -32.25,32.25c0,0.93883 -0.07883,2.666 0,3.58333c-23.06233,0 -39.904,-12.03283 -52.51017,-27.4985c-1.68417,-2.07833 -3.47583,-0.99617 -3.8485,0.48017c-0.8385,3.33967 -1.12517,8.9225 -1.12517,12.90717c0,10.0405 7.8475,19.90183 20.06667,26.015c-2.25033,0.5805 -4.73,0.99617 -7.31,0.99617c-3.03867,0 -6.536,-0.7955 -9.59617,-2.40083c-1.13233,-0.59483 -3.57617,-0.43 -2.85233,2.46533c2.9025,11.60283 16.1465,19.75133 27.97867,22.1235c-2.6875,1.58383 -8.42083,1.26133 -11.05817,1.26133c-0.97467,0 -4.3645,-0.22933 -6.5575,-0.50167c-1.9995,-0.24367 -5.074,0.27233 -2.50117,4.171c5.5255,8.3635 18.02417,13.61667 28.78133,13.81733c-9.90433,7.76867 -26.101,10.60667 -41.61683,10.60667c-3.139,-0.07167 -2.98133,3.5045 -0.4515,4.83033c11.44517,6.00567 30.19317,9.56033 43.58767,9.56033c53.24833,0 83.51317,-40.58483 83.51317,-78.8405c0,-0.61633 -0.01433,-1.90633 -0.03583,-3.2035c0,-0.129 0.03583,-0.25083 0.03583,-0.37983c0,-0.1935 -0.05733,-0.37983 -0.05733,-0.57333c-0.0215,-0.97467 -0.043,-1.88483 -0.0645,-2.35783c4.22117,-3.04583 10.6855,-8.33483 13.9535,-12.384c1.11083,-1.376 0.215,-3.04583 -1.29717,-2.52267c-3.8915,1.3545 -10.621,3.9775 -14.835,4.47917c8.43517,-5.58283 12.60617,-10.44183 16.1895,-15.83833c1.2255,-1.84183 -0.30817,-3.71233 -2.17867,-2.82367z"></path>
                              </g>
                            </g>
                          </svg></a>
                      </div>
                    </div>
                    <div class="flex pt-2  text-sm text-gray-400">
                      <div class="flex-1 inline-flex items-center hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                          <path d="M8 9a3 3 0 100-6 3 3 0 000 6zM8 11a6 6 0 016 6H2a6 6 0 016-6zM16 7a1 1 0 10-2 0v1h-1a1 1 0 100 2h1v1a1 1 0 102 0v-1h1a1 1 0 100-2h-1V7z">
                          </path>
                        </svg>
                        <p class="">1.2k Followers</p>
                      </div>
                      <div class="flex-1 inline-flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"></path>
                        </svg>
                        <p class="">
                          RUT: {{$user->rut}}
                        </p>
                      </div>
                    </div>
                  
                  </div>
                 
                </div>
                <div class="grid grid-cols-6 gap-2 mt-6">
                  @foreach ($user->especies_comercializas()->get() as $especie)
             
                    <div class="pr-4 bg-blue-500 p-2 rounded-lg text-center my-auto">
                      <p class="text-xl font-bold text-white">1/60</p>
                      <p class="text-sm text-white">Ranking {{$especie->name}}</p>
                    </div>
                  @endforeach
                 
                </div>
              </div>
            </div>
            <!---stats-->
            <div class="">
              
              {!! Form::model($user, ['route'=>['productor.users.update',$user],'method' => 'put', 'autocomplete'=>'off']) !!}    

                <div>
                

                </div>    
                <div class="grid grid-cols-2 gap-x-4">
                  <div class="form-group">
                      {!! Form::label('exportadora','Exportadora') !!}
                      {!! Form::text('exportadora', 'Greenex' , ['class'=>'mt-1 block w-full rounded-lg',  'readonly' => 'readonly' ,  'placeholder'=>'']) !!}
                      
                      @error('exportadora')
                          <span class="text-danger">{{$message}}</span>
                      @enderror
                  </div>
                  <div class="form-group">
                      {!! Form::label('name','Nombre razón social:') !!}
                      {!! Form::text('name', null , ['class'=>'mt-1 block w-full rounded-lg',  'readonly' => 'readonly' , 'placeholder'=>'']) !!}
                      
                      @error('name')
                          <span class="text-danger">{{$message}}</span>
                      @enderror
                  </div>
                  <div class="form-group mt-2">
                      {!! Form::label('csg','Csg') !!}
                      {!! Form::text('csg', null , ['class'=>'mt-1 block w-full rounded-lg',  'readonly' => 'readonly' , 'placeholder'=>'']) !!}
                      
                      @error('csg')
                          <span class="text-danger">{{$message}}</span>
                      @enderror
                  </div>
                
                  <div class="form-group mt-2">
                    {!! Form::label('predio','Nombre predio') !!}
                    {!! Form::text('predio', null , ['class'=>'mt-1 block w-full rounded-lg', 'placeholder'=>'']) !!}
                    
                    @error('predio')
                        <span class="text-danger">{{$message}}</span>
                    @enderror
                  </div>
                
                </div>
                <div class="form-group mt-2">
                  {!! Form::label('antiguedad','Temporadas en greenex:') !!}
                  {!! Form::text('antiguedad', null , ['class'=>'mt-1 block w-full rounded-lg', 'placeholder'=>'']) !!}
                  
                  @error('antiguedad')
                      <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>
                <div class="form-group mt-2">
                  {!! Form::label('comuna','Comuna:') !!}
                  {!! Form::text('comuna', null , ['class'=>'mt-1 block w-full rounded-lg', 'placeholder'=>'']) !!}
                  
                  @error('comuna')
                      <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>
                <div class="form-group mt-2">
                  {!! Form::label('provincia','Provincia:') !!}
                  {!! Form::text('provincia', null , ['class'=>'mt-1 block w-full rounded-lg', 'placeholder'=>'']) !!}
                  
                  @error('provincia')
                      <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>
                <div class="form-group mt-2">
                  {!! Form::label('direccion','Dirección:') !!}
                  {!! Form::text('direccion', null , ['class'=>'mt-1 block w-full rounded-lg', 'placeholder'=>'']) !!}
                  
                  @error('direccion')
                      <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>

                <div class="flex justify-end mt-4">
                  {!! Form::submit('Actualizar', ['class'=>'text-white font-bold mx-4 text-sm focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 mt-4 sm:mt-0 inline-flex items-start justify-start px-3 py-2 bg-gray-500 hover:bg-gray-500 focus:outline-none rounded']) !!}
                </div>
              {!! Form::close() !!}

              @php
                  $espec=[];
              @endphp
        
              <div class="form-group mt-2"  x-data="setup()">
                
                <section id="especies">  
                <h1 class="text-center">Especie:</h1>
                  <div class="grid grid-cols-6 gap-y-2 hidden">

                    @foreach ($user->especies_comercializas()->get() as $especie)
                      
                          <div class="flex justify-center">
                              <span class="cursor-pointer py-3 px-3 text-sm focus:outline-none leading-none text-gray-700 bg-gray-200 rounded">{{$especie->name}}</span>
                          </div>

                    @endforeach

                  </div>

                  <div class="grid grid-cols-6 gap-y-2 mt-2">
                    @php
                        $n=0;
                    @endphp
                    @foreach ($user->fichas()->get() as $ficha)
                        
                          <div class="flex justify-center" @click="activeTab = {{$n}}">
                              <span  class="cursor-pointer py-3 px-3 text-sm focus:outline-none leading-none rounded" :class="activeTab==={{$n}} ? ' @if(!IS_NULL($ficha->ano_plantacion) && !IS_NULL($ficha->cant_hectareas) && !IS_NULL($ficha->prod_hectareas) && !IS_NULL($ficha->total_produccion) && !IS_NULL($ficha->porcentaje_de_entrega)) text-white bg-green-700 @else text-white bg-gray-500 @endif' : ' @if(!IS_NULL($ficha->ano_plantacion) && !IS_NULL($ficha->cant_hectareas) && !IS_NULL($ficha->prod_hectareas) && !IS_NULL($ficha->total_produccion) && !IS_NULL($ficha->porcentaje_de_entrega)) text-gray-700 bg-green-200 @else text-gray-700 bg-yellow-200 @endif'" >{{$ficha->especie->name}}</span>
                          </div>

                          @php
                              $espec[]=$ficha->especie->name;
                              $n+=1;
                          @endphp

                    @endforeach

                  </div>
                </section>
                <ul class="flex justify-center items-center mb-6 mt-2 hidden">
                  <template x-for="(tab, index) in tabs" :key="index">
                     <li class="cursor-pointer py-3 px-4 rounded transition" :class="activeTab===index ? 'bg-red-500 text-white' : ' text-gray-500'" @click="activeTab = index"
                        x-text="tab"></li>
                  </template>
            
               </ul>
             
                
                @if ($user->fichas->count()>0)
                  @php
                      $m=0;
                  @endphp
                  @foreach ($user->fichas as $ficha)
                    <div x-show="activeTab==={{$m}}">
                      {!! Form::model($ficha, ['route'=>['fichas.update',$ficha],'method' => 'put', 'autocomplete'=>'off']) !!}    

                        
                          <div class="form-group mt-4">
                            {!! Form::label('ano_plantacion','Año de plantación:') !!}
                            {!! Form::text('ano_plantacion', null , ['class'=>'mt-1 block w-full rounded-lg', 'placeholder'=>'']) !!}
                            
                            @error('ano_plantacion')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>
                          {{-- comment  --}}
                          <div class="form-group mt-2">
                            {!! Form::label('cant_hectareas','Cantidad de hectareas:') !!}
                            {!! Form::text('cant_hectareas', null , ['class'=>'mt-1 block w-full rounded-lg', 'placeholder'=>'']) !!}
                            
                            @error('cant_hectareas')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>
                          
                          <div class="form-group mt-2">
                            {!! Form::label('prod_hectareas','Producción por hectareas en toneladas:') !!}
                            {!! Form::text('prod_hectareas', null , ['class'=>'mt-1 block w-full rounded-lg', 'placeholder'=>'']) !!}
                            
                            @error('prod_hectareas')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>
                          
                          <div class="form-group mt-2">
                            {!! Form::label('total_produccion','Campo total producción:') !!}
                            {!! Form::text('total_produccion', null , ['class'=>'mt-1 block w-full rounded-lg', 'placeholder'=>'']) !!}
                            
                            @error('total_produccion')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>
                          <div class="form-group mt-2">
                            {!! Form::label('porcentaje_de_entrega','Porcentaje de entrega a Greenex:') !!}
                            {!! Form::text('porcentaje_de_entrega', null , ['class'=>'mt-1 block w-full rounded-lg', 'placeholder'=>'']) !!}
                            
                            @error('porcentaje_de_entrega')
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                          </div>
                        
                          <div class="flex justify-end mt-4">
                            {!! Form::submit('update', ['class'=>'text-white font-bold mx-4 text-sm focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 mt-4 sm:mt-0 inline-flex items-start justify-start px-3 py-2 bg-gray-500 hover:bg-gray-500 focus:outline-none rounded']) !!}
                          </div>

                      {!! Form::close() !!}
                    </div>
                    @php
                        $m+=1;
                    @endphp
                  @endforeach

                @endif
                @php
                    $start=0;
                @endphp
                  @foreach ($user->fichas as $ficha)
                      @if (IS_NULL($ficha->ano_plantacion) || IS_NULL($ficha->cant_hectareas) || IS_NULL($ficha->prod_hectareas) || IS_NULL($ficha->total_produccion) || IS_NULL($ficha->porcentaje_de_entrega))
                          @break
                      @endif
                      @php
                          $start+=1;
                      @endphp
                  @endforeach

                  @if ($start==$user->fichas->count())
                     @php
                         $start=0;
                     @endphp 
                  @endif
                
                <script>
                  var espec = <?php echo json_encode($espec) ?>;
                  var start = <?php echo json_encode($start) ?>;
                     function setup() {
                        return {
                        activeTab: start,
                        tabs: espec
                        };
                  };
               </script>
              </div>

              <div class="flex justify-between mt-12">
                <div>
                  <h1 class="">
                    AGREGAR CUARTEL
                  </h1>
                
                </div>
                <div>

                
                </div>
              </div>
              <div class="grid grid-cols-2">
                <div class="form-group mt-2">
                  <div class="w-full max-w-xs">
                    <label for="numero" class="block text-sm font-medium text-gray-700">Selecciona un número del 1 al 7:</label>
                    <select id="numero" name="numero" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                      @for($i = 1; $i <= 7; $i++)
                        <option value="{{ $i }}">Cuartel {{ $i }}</option>
                      @endfor
                    </select>
                  </div>
                  
                  
                  @error('cuartel')
                      <span class="text-danger">{{$message}}</span>
                  @enderror
                </div>

                  <div class="w-full max-w-xs">
                    <label for="variedadadee" class="block text-sm font-medium text-gray-700">Selecciona un número del 1 al 7:</label>
                    <select id="variedadadee" name="variedadadee" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md">
                      @for($i = 1; $i <= 7; $i++)
                        <option value="{{ $i }}">Variedad {{ $i }}</option>
                      @endfor
                    </select>
                  </div>
              </div>

              <div class="flex justify-center mt-4">
                {!! Form::submit('Agregar Variedad', ['class'=>'text-white font-bold mx-4 text-sm focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 mt-4 sm:mt-0 inline-flex items-start justify-start px-3 py-2 bg-gray-500 hover:bg-gray-500 focus:outline-none rounded']) !!}
              </div>
              <div class="form-group mt-2">
                <h1 class="text-center">Variedades:</h1>
                 <div class="grid grid-cols-6 gap-y-2">
 
                   @foreach ($user->variedades_comercializas()->get() as $especie)
                       <div class="flex justify-center">
                           <button class="py-3 px-3 text-sm focus:outline-none leading-none text-green-700 bg-green-100 rounded">{{$especie->name}}</button>
                       </div>
                   @endforeach
 
                 </div>
                 
               </div>
              
             
           
             



           


             
            

              <div class="flex justify-center mt-4">
                {!! Form::submit('Actualizar', ['class'=>'text-white font-bold mx-4 text-sm focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 mt-4 sm:mt-0 inline-flex items-start justify-start px-3 py-2 bg-gray-500 hover:bg-gray-500 focus:outline-none rounded']) !!}
              </div>

            
            </div>
            <div class="grid grid-cols-12 gap-4 hidden">
              <div class="col-span-12 sm:col-span-4">
                <div class="p-4 relative  bg-gray-800 border border-gray-800 shadow-lg  rounded-2xl">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14  absolute bottom-4 right-3 text-green-400" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M2 10a8 8 0 018-8v8h8a8 8 0 11-16 0z" />
                    <path d="M12 2.252A8.014 8.014 0 0117.748 8H12V2.252z" />
                  </svg>
                  <div class="text-2xl text-gray-100 font-medium leading-8">0</div>
                  <div class="text-sm text-gray-500">Pendientes</div>
                </div>
              </div>
              <div class="col-span-12 sm:col-span-4">
                <div class="p-4 relative  bg-gray-800 border border-gray-800 shadow-lg  rounded-2xl">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14  absolute bottom-4 right-3 text-blue-500" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M2 11a1 1 0 011-1h2a1 1 0 011 1v5a1 1 0 01-1 1H3a1 1 0 01-1-1v-5zM8 7a1 1 0 011-1h2a1 1 0 011 1v9a1 1 0 01-1 1H9a1 1 0 01-1-1V7zM14 4a1 1 0 011-1h2a1 1 0 011 1v12a1 1 0 01-1 1h-2a1 1 0 01-1-1V4z" />
                  </svg>
                  <div class="text-2xl text-gray-100 font-medium leading-8">0</div>
                  <div class="text-sm text-gray-500">Completados</div>
                </div>
              </div>
              <div class="col-span-12 sm:col-span-4">
                <div class="p-4 relative  bg-gray-800 border border-gray-800 shadow-lg  rounded-2xl">
                  <svg xmlns="http://www.w3.org/2000/svg" class="h-14 w-14  absolute bottom-4 right-3 text-yellow-300" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 3a1 1 0 000 2v8a2 2 0 002 2h2.586l-1.293 1.293a1 1 0 101.414 1.414L10 15.414l2.293 2.293a1 1 0 001.414-1.414L12.414 15H15a2 2 0 002-2V5a1 1 0 100-2H3zm11.707 4.707a1 1 0 00-1.414-1.414L10 9.586 8.707 8.293a1 1 0 00-1.414 0l-2 2a1 1 0 101.414 1.414L8 10.414l1.293 1.293a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                  </svg>
                  <div class="text-2xl text-gray-100 font-medium leading-8">0</div>
                  <div class="text-sm text-gray-500 mr-12"> 
                    
                  
                    Productores asignados
                 </div>
                </div>
              </div>
            </div>

            <div class="grid gap-4 grid-cols-1 md:grid-cols-1">
      
              <!--confirm modal-->
              <div class="flex flex-col p-4 relative items-center justify-center bg-gray-800 border border-gray-800 shadow-lg  rounded-2xl hidden">
                <div class="">
                  <div class="text-center p-5 flex-auto justify-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 -m-1 flex items-center text-blue-400 mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 flex items-center text-gray-600 mx-auto" viewBox="0 0 20 20" fill="currentColor">
                      <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                    <h2 class="text-xl font-bold py-4 text-gray-200">Are you sure?</h3>
                      <p class="text-sm text-gray-500 px-8">Do you really want to delete your account?
                        This process cannot be undone</p>
                  </div>
                  <div class="p-3  mt-2 text-center space-x-4 md:block">
                    <button class="mb-2 md:mb-0 bg-gray-700 px-5 py-2 text-sm shadow-sm font-medium tracking-wider border-2 border-gray-600 hover:border-gray-700 text-gray-300 rounded-full hover:shadow-lg hover:bg-gray-800 transition ease-in duration-300">
                      Cancel
                    </button>
                    <button class="bg-green-400 hover:bg-green-500 px-5 ml-4 py-2 text-sm shadow-sm hover:shadow-lg font-medium tracking-wider border-2 border-green-300 hover:border-green-500 text-white rounded-full transition ease-in duration-300">Confirm</button>
                  </div>
                </div>
              </div>

            

            
              
            </div>
             
          </div>
         
        </div>
     

            
    </div>



 
             
            
</x-app-layout>
