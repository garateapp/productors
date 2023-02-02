<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Inicio') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="sm:px-6 w-full">
            <!--- more free and premium Tailwind CSS components at https://tailwinduikit.com/ --->
                      
                        <div class="bg-white py-4 md:py-7 px-4 md:px-8 xl:px-10">
                            <div class="sm:flex items-center justify-between">
                                <p class="text-sm font-medium leading-none text-gray-800">Productores:</p>
                                <a href="{{route('productor.refresh')}}">
                                    <button  class="focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 mt-4 sm:mt-0 inline-flex items-start justify-start px-6 py-3 bg-gray-500 hover:bg-gray-500 focus:outline-none rounded">
                                        <p class="text-sm font-medium leading-none text-white">FX IMPORT</p>
                                    </button>
                                </a>
                            </div>

                            <div class="mt-7 overflow-x-auto">
                         
                                <table class="w-full whitespace-nowrap">
                                    <thead>
                                        <th>ID</th>
                                        <th>Empresa</th>
                                        <th>GRUPO</th>
                                        <th>CELULAR</th>
                                        <th>EMAIL</th>
                                        <th>RUT Empresa</th>
                                        <th>Estado</th>
                                    </thead>
                                    <tbody>
                                        @php
                                            $n=1;
                                        @endphp
                                                        @foreach ($users as $user)
                                                            @php
                                                                    $m=1;
                                                                @endphp
                                                                @foreach ($user as $item)
                                                               {{-- comment {{$m}}) {{$item}}<br>
                                                             --}}
                                                                @php
                                                                    $m+=1;
                                                                @endphp
                                                            @endforeach
                                                           
                                            
                                            <tr tabindex="0" class="focus:outline-none h-16 border border-gray-100 rounded">
                                                <td class="text-center">
                                                    {{$n}}
                                                @php
                                                    $n+=1;
                                                @endphp
                                                </td>
                                                <td class="">
                                                    <div class="flex items-center pl-5">
                                                        <p class="text-base font-medium leading-none text-gray-700 mr-2">

                                                            @php
                                                                $m=1;
                                                            @endphp
                                                            {{-- NOMBRE --}}
                                                            @foreach ($user as $item)
                                                                @if ($m==4)
                                                                    {{$item}}<br>
                                                                @endif
                                                               
                                                                @php
                                                                    $m+=1;
                                                                @endphp
                                                            @endforeach
                                                           
                                                            
                                                        </p>
                                                    
                                                    </div>
                                                </td>
                                                <td class="pl-10">
                                                    <div class="flex items-center">
                                                    <select  class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500">
                                                        <option>76034369</option>
                                                        <option>50172360</option>
                                                        <option>3930230</option>
                                                        <option>76775537</option>
                                                    </select>
                                                    </div>
                                                </td>
                                                <td class="pl-5">
                                                    <div class="flex items-center">
                                                    
                                                        <p class="text-sm leading-none text-gray-600 ml-2">992192597</p>
                                                    </div>
                                                </td>
                                                <td class="pl-5">
                                                    <div class="flex items-center">
                                                    
                                                        <p class="text-sm leading-none text-gray-600 ml-2">manete@gmail.com</p>
                                                    </div>
                                                </td>
                                                <td class="pl-5">
                                                    <div class="flex items-center">
                                                        
                                                        <p class="text-sm leading-none text-gray-600 ml-2">
                                                            @php
                                                            $m=1;
                                                        @endphp
                                                        {{-- RUT --}}
                                                        @foreach ($user as $item)
                                                            @if ($m==29)
                                                                {{$item}}<br>
                                                            @endif
                                                           
                                                            @php
                                                                $m+=1;
                                                            @endphp
                                                        @endforeach
                                                        </p>
                                                    </div>
                                                </td>
                                                <td class="pl-5">
                                                    <button class="py-3 px-3 text-sm focus:outline-none leading-none text-red-700 bg-red-100 rounded">Usuario ya creado</button>
                                                </td>
                                                <td class="pl-4">
                                                    <button class="focus:ring-2 focus:ring-offset-2 focus:ring-red-300 text-sm leading-none text-gray-600 py-3 px-5 bg-gray-100 rounded hover:bg-gray-200 focus:outline-none">Ver</button>
                                                </td>
                                                <td>
                                                    <div class="relative px-5 pt-2">
                                                        <button class="focus:ring-2 rounded-md focus:outline-none" onclick="dropdownFunction(this)" role="button" aria-label="option">
                                                            <svg class="dropbtn" onclick="dropdownFunction(this)" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
                                                                <path d="M4.16667 10.8332C4.62691 10.8332 5 10.4601 5 9.99984C5 9.5396 4.62691 9.1665 4.16667 9.1665C3.70643 9.1665 3.33334 9.5396 3.33334 9.99984C3.33334 10.4601 3.70643 10.8332 4.16667 10.8332Z" stroke="#9CA3AF" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M10 10.8332C10.4602 10.8332 10.8333 10.4601 10.8333 9.99984C10.8333 9.5396 10.4602 9.1665 10 9.1665C9.53976 9.1665 9.16666 9.5396 9.16666 9.99984C9.16666 10.4601 9.53976 10.8332 10 10.8332Z" stroke="#9CA3AF" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
                                                                <path d="M15.8333 10.8332C16.2936 10.8332 16.6667 10.4601 16.6667 9.99984C16.6667 9.5396 16.2936 9.1665 15.8333 9.1665C15.3731 9.1665 15 9.5396 15 9.99984C15 10.4601 15.3731 10.8332 15.8333 10.8332Z" stroke="#9CA3AF" stroke-width="1.25" stroke-linecap="round" stroke-linejoin="round"></path>
                                                            </svg>
                                                        </button>
                                                        <div class="dropdown-content bg-white shadow w-24 absolute z-30 right-0 mr-6 hidden">
                                                            <div tabindex="0" class="focus:outline-none focus:text-indigo-600 text-xs w-full hover:bg-indigo-700 py-4 px-4 cursor-pointer hover:text-white">
                                                                <p>Edit</p>
                                                            </div>
                                                            <div tabindex="0" class="focus:outline-none focus:text-indigo-600 text-xs w-full hover:bg-indigo-700 py-4 px-4 cursor-pointer hover:text-white">
                                                                <p>Delete</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                       
                                      
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

               </div>
               
             
                        
               <script>
               function dropdownFunction(element) {
                var dropdowns = document.getElementsByClassName("dropdown-content");
                var i;
                let list = element.parentElement.parentElement.getElementsByClassName("dropdown-content")[0];
                list.classList.add("target");
                for (i = 0; i < dropdowns.length; i++) {
                    if (!dropdowns[i].classList.contains("target")) {
                        dropdowns[i].classList.add("hidden");
                    }
                }
                list.classList.toggle("hidden");
            }</script>

</x-app-layout>
