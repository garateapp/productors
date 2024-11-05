<div>
    <div class="pb-12">
        <div class="w-full sm:px-6">
            <!--- more free and premium Tailwind CSS components at https://tailwinduikit.com/ --->

            <div class="px-6 py-4">
                <input wire:keydown="limpiar_page" wire:model="search"
                    class="flex-1 w-full h-10 px-5 pr-16 bg-white border-2 border-gray-300 rounded-lg shadow-sm form-input focus:outline-none"
                    placeholder="Ingrese el nombre, rut o csg del productor" autocomplete="off">
            </div>





            <div class="items-center justify-between my-2 sm:flex">


                <div class="p-4 mx-12 my-4 bg-white rounded-lg shadow max-w-7xl sm:p-6 xl:p-8">
                    <div class="flex items-center justify-center">
                        <div class="flex-shrink-0 text-center">
                            <span
                                class="text-2xl font-bold leading-none text-gray-900 sm:text-3xl">{{ number_format($allusers->count()) }}</span>
                            <h3 class="text-base font-normal text-gray-500">Productores</h3>
                        </div>

                    </div>
                </div>
                @if ($sync)
                    <h1 class="mx-6 my-4 text-sm text-center"><b>Ultima Sincronizacion:</b>
                        {{ date('d M Y g:i a', strtotime($sync->fecha)) }} <b>Tipo:</b> {{ $sync->tipo }}
                        <b>Cantidad:</b> {{ $sync->cantidad }}
                    </h1>
                @endif
                <div class="flex items-center content-center justify-center mb-2">
                    <a href="{{ route('productor.refresh') }}">
                        <button
                            class="items-center px-6 py-3 bg-gray-500 rounded focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 hover:bg-gray-500 focus:outline-none">
                            <p class="text-sm font-medium leading-none text-white">FX IMPORT</p>
                        </button>
                    </a>
                    <a href="{{ route('consolidado.refresh') }}">
                        <button
                            class="items-center px-6 py-3 ml-2 bg-gray-500 rounded focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 hover:bg-gray-500 focus:outline-none">
                            <p class="text-sm font-medium leading-none text-white">CONSOLIDADO UP</p>
                        </button>
                    </a>
                    <select wire:model="ctd"
                        class="max-w-xl px-6 py-3 mx-2 text-gray-700 bg-gray-200 border border-gray-200 rounded focus:outline-none focus:bg-white focus:border-gray-500">
                        <option value="25" class="px-10 text-left">25 </option>
                        <option value="50" class="px-10 text-left">50 </option>
                        <option value="100" class="px-10 text-left">100 </option>
                        <option value="500" class="px-10 text-left">500 </option>

                    </select>
                </div>
            </div>

            <div class="px-4 py-4 bg-white md:py-7 md:px-8 xl:px-10">
                @if (session('info'))
                    <div x-data="{ open: true }">
                        <div x-show="open"
                            class="relative px-4 py-3 text-gray-700 bg-white border border-gray-400 rounded"
                            role="alert">
                            <strong class="font-bold">Felicidades!</strong>
                            <span class="block sm:inline">{{ session('info') }}</span>
                            <span x-on:click="open=false" class="absolute top-0 bottom-0 right-0 px-4 py-3">
                                <svg class="w-6 h-6 text-gray-500 fill-current" role="button"
                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <title>Close</title>
                                    <path
                                        d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                                </svg>
                            </span>
                        </div>
                    </div>
                @endif




                <x-table-responsive>
                    <table class="min-w-full pb-20 mb-20 divide-y divide-gray-200">

                        <thead class="bg-gray-50">
                            <th>ID</th>
                            <th>Empresa</th>
                            <th>RUT Empresa</th>
                            <th class="text-center">CSG</th>
                            <th class="text-center">Usuario</th>
                            <th class="text-center">Pass</th>
                            <th>CELULAR</th>
                            <th>AGRÓNOMO</th>
                            <th>EMAIL</th>
                            <th>ACTUALIZAR</th>
                            <th>LOGO</th>
                            <th>ULTIMA <br>MODIFICACIÓN</th>
                            <th>ESPECIES</th>
                            <th>KILOS</th>
                            <th>EXPORT</th>
                            <th>MI</th>
                            <th>DESECHO</th>
                            <th>MERMA</th>
                            <th>Accion</th>


                        </thead>
                        <tbody>
                            @php
                                $n = 1;
                            @endphp

                            @foreach ($users as $user)
                                @php
                                    $m = 1;
                                @endphp
                                @foreach ($user as $item)
                                    {{-- comment        {{$m}}) {{$item}}<br>
                                                    --}}
                                    @php
                                        $m += 1;
                                    @endphp
                                @endforeach

                                @if ($user->especies_comercializas()->count() > 0)
                                    <tr tabindex="0"
                                        class="h-16 bg-green-200 border border-gray-100 rounded focus:outline-none">
                                    @else
                                    <tr tabindex="0" class="h-16 border border-gray-100 rounded focus:outline-none">
                                @endif


                                <td class="text-center">
                                    <a href="{{ route('dashboard.productor', $user->id) }}">
                                        <p class="mr-2 text-base font-medium leading-none text-gray-700">



                                            @if ($user->idprod)
                                                {{ $user->idprod }}
                                            @endif


                                        </p>
                                    </a>
                                </td>
                                <td class="">
                                    <a href="{{ route('dashboard.productor', $user->id) }}">

                                        <div class="flex items-center pl-5">
                                            <p class="mr-2 text-base font-medium leading-none text-gray-700">


                                                @if ($user->name)
                                                    {{ $user->name }}
                                                @endif


                                            </p>

                                        </div>
                                    </a>
                                </td>
                                <td class="pl-5">
                                    <div class="flex items-center text-center whitespace-nowrap">
                                        <a href="{{ route('dashboard.productor', $user->id) }}">
                                            <p class="ml-2 text-sm leading-none text-gray-600 whitespace-nowrap">

                                                @if ($user->rut)
                                                    {{ $user->rut }}
                                                @endif
                                            </p>
                                        </a>
                                    </div>
                                </td>
                                <td class="pl-5 text-center">
                                    <a href="{{ route('dashboard.productor', $user->id) }}">
                                        <p class="mr-2 text-base font-medium leading-none text-center text-gray-700">


                                            @if ($user->csg)
                                                {{ $user->csg }}
                                            @endif

                                        </p>
                                    </a>
                                </td>
                                <td class="pl-5 whitespace-nowrap">
                                    <a href="{{ route('dashboard.productor', $user->id) }}">
                                        <p
                                            class="flex mr-2 text-base font-medium leading-none text-gray-700 whitespace-nowrap">
                                            @if ($user->user)
                                                {{ $user->user }}
                                            @endif
                                        </p>
                                    </a>
                                </td>

                                <td class="pl-5">


                                    <form action="{{ route('recuperar.contrasena', $user) }}" method="POST">
                                        @csrf

                                        <button
                                            class="inline-flex items-start justify-start px-6 py-3 mx-4 mt-4 bg-gray-500 rounded focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 hover:bg-gray-500 focus:outline-none">

                                            <h1 style="font-size: 1rem;white-space: nowrap;"
                                                class="inline w-full font-bold text-center text-white">gre1234</h1>
                                        </button>
                                    </form>







                                </td>

                                <td class="pl-5">
                                    @if ($user->id == $cellid)
                                        <button wire:click="cellid_clean"
                                            class="inline-flex items-start justify-start px-6 py-3 mx-4 mt-4 bg-green-500 rounded focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 hover:bg-green-500 focus:outline-none">

                                            <h1 style="font-size: 1rem;white-space: nowrap;"
                                                class="inline w-full font-bold text-center text-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    fill="currentColor" class="w-5 h-5">
                                                    <path fill-rule="evenodd"
                                                        d="M2 3.5A1.5 1.5 0 013.5 2h1.148a1.5 1.5 0 011.465 1.175l.716 3.223a1.5 1.5 0 01-1.052 1.767l-.933.267c-.41.117-.643.555-.48.95a11.542 11.542 0 006.254 6.254c.395.163.833-.07.95-.48l.267-.933a1.5 1.5 0 011.767-1.052l3.223.716A1.5 1.5 0 0118 15.352V16.5a1.5 1.5 0 01-1.5 1.5H15c-1.149 0-2.263-.15-3.326-.43A13.022 13.022 0 012.43 8.326 13.019 13.019 0 012 5V3.5z"
                                                        clip-rule="evenodd" />
                                                </svg>

                                            </h1>
                                        </button>
                                    @else
                                        @if ($user->telefonos->count())
                                            <button wire:click="set_iduser({{ $user->id }})"
                                                class="inline-flex items-start justify-start px-6 py-3 mx-4 mt-4 bg-green-500 rounded focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 hover:bg-green-500 focus:outline-none">

                                                <h1 style="font-size: 1rem;white-space: nowrap;"
                                                    class="inline w-full font-bold text-center text-white">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                        fill="currentColor" class="w-5 h-5">
                                                        <path fill-rule="evenodd"
                                                            d="M2 3.5A1.5 1.5 0 013.5 2h1.148a1.5 1.5 0 011.465 1.175l.716 3.223a1.5 1.5 0 01-1.052 1.767l-.933.267c-.41.117-.643.555-.48.95a11.542 11.542 0 006.254 6.254c.395.163.833-.07.95-.48l.267-.933a1.5 1.5 0 011.767-1.052l3.223.716A1.5 1.5 0 0118 15.352V16.5a1.5 1.5 0 01-1.5 1.5H15c-1.149 0-2.263-.15-3.326-.43A13.022 13.022 0 012.43 8.326 13.019 13.019 0 012 5V3.5z"
                                                            clip-rule="evenodd" />
                                                    </svg>

                                                </h1>
                                            </button>
                                        @else
                                            <button wire:click="set_iduser({{ $user->id }})"
                                                class="inline-flex items-start justify-start px-6 py-3 mx-4 mt-4 bg-gray-500 rounded focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 hover:bg-gray-500 focus:outline-none">

                                                <h1 style="font-size: 1rem;white-space: nowrap;"
                                                    class="inline w-full font-bold text-center text-white">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                        fill="currentColor" class="w-5 h-5">
                                                        <path fill-rule="evenodd"
                                                            d="M2 3.5A1.5 1.5 0 013.5 2h1.148a1.5 1.5 0 011.465 1.175l.716 3.223a1.5 1.5 0 01-1.052 1.767l-.933.267c-.41.117-.643.555-.48.95a11.542 11.542 0 006.254 6.254c.395.163.833-.07.95-.48l.267-.933a1.5 1.5 0 011.767-1.052l3.223.716A1.5 1.5 0 0118 15.352V16.5a1.5 1.5 0 01-1.5 1.5H15c-1.149 0-2.263-.15-3.326-.43A13.022 13.022 0 012.43 8.326 13.019 13.019 0 012 5V3.5z"
                                                            clip-rule="evenodd" />
                                                    </svg>

                                                </h1>
                                            </button>
                                        @endif
                                    @endif

                                </td>
                                <td class="pl-5">
                                    @if ($user->id == $agronomoid)
                                        <button wire:click="cellid_clean"
                                            class="inline-flex items-start justify-start px-6 py-3 mx-4 mt-4 bg-green-500 rounded focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 hover:bg-green-500 focus:outline-none">

                                            <h1 style="font-size: 1rem;white-space: nowrap;"
                                                class="inline w-full font-bold text-center text-white">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="w-5 h-5">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                                </svg>


                                            </h1>
                                        </button>
                                    @else
                                        @if ($user->agronomos->count() > 0)
                                            <button wire:click="set_idagronomo({{ $user->id }})"
                                                class="inline-flex items-start justify-start px-6 py-3 mx-4 mt-4 bg-green-500 rounded focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 hover:bg-green-500 focus:outline-none">
                                                <h1 style="font-size: 1rem;white-space: nowrap;"
                                                    class="inline w-full font-bold text-center text-white">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                                    </svg>
                                                </h1>
                                            </button>
                                        @else
                                            <button wire:click="set_idagronomo({{ $user->id }})"
                                                class="inline-flex items-start justify-start px-6 py-3 mx-4 mt-4 bg-gray-500 rounded focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 hover:bg-gray-500 focus:outline-none">

                                                <h1 style="font-size: 1rem;white-space: nowrap;"
                                                    class="inline w-full font-bold text-center text-white">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="w-5 h-5">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                                                    </svg>


                                                </h1>
                                            </button>
                                        @endif
                                    @endif

                                </td>
                                <td class="flex w-full">




                                    {!! Form::model($user, [
                                        'route' => ['productor.users.update', $user],
                                        'method' => 'put',
                                        'autocomplete' => 'off',
                                    ]) !!}
                                    {!! Form::email('email', null, ['class' => 'mt-1 block w-full']) !!}

                                    @if ($user->emnotification == true)
                                        <div class="flex items-center justify-center mt-1">
                                            <p class="mr-2 text-xd">Notificaciones </p><input type="checkbox"
                                                wire:click="toggleEmailNotification({{ $user->id }})" checked>
                                        </div>
                                    @else
                                        <div class="flex items-center justify-center mt-1">
                                            <p class="mr-2 text-xd">Notificaciones </p> <input type="checkbox"
                                                wire:click="toggleEmailNotification({{ $user->id }})">
                                        </div>
                                    @endif




                                </td>
                                <td class="pl-5 text-white ">
                                    {!! Form::submit('Actualizar', [
                                        'class' =>
                                            'mx-4 text-sm focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 mt-4 sm:mt-0 inline-flex items-start justify-start px-3 py-2 bg-gray-500 hover:bg-gray-500 focus:outline-none rounded',
                                    ]) !!}
                                    {!! Form::close() !!}
                                </td>
                                <td class="pl-5 text-white ">
                                    @if ($user->profile_photo_path)
                                        <a href="{{ route('create.logo', $user) }}"
                                            class="inline-flex items-start justify-start px-3 py-2 mx-4 mt-2 text-xs bg-red-500 rounded whitespace-nowrap focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 hover:bg-red-600 focus:outline-none">Ver
                                            Logo</a>
                                    @else
                                        <a href="{{ route('create.logo', $user) }}"
                                            class="inline-flex items-start justify-start px-3 py-2 mx-4 mt-2 text-xs bg-gray-500 rounded whitespace-nowrap focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 hover:bg-gray-600 focus:outline-none">Agregar
                                            Logo</a>
                                    @endif

                                </td>
                                <td class="pl-5">
                                    <div class="flex items-center">

                                        <p class="mr-2 text-base leading-none text-gray-700">
                                            @if ($user->updated_at != $user->created_at)
                                                {{ date('d M Y g:i a', strtotime($user->updated_at)) }}
                                            @else
                                                -
                                            @endif
                                        </p>
                                    </div>
                                </td>

                                <td class="py-2 pl-5">

                                    <div class="flex items-center">
                                        <div class="items-center">

                                            @foreach ($user->especies_comercializas()->get() as $especie)
                                                <div class="flex justify-center">

                                                    <button asd
                                                        class="px-3 py-3 text-sm leading-none text-green-700 bg-green-100 rounded focus:outline-none">{{ $especie->name }}</button>
                                                </div>
                                            @endforeach
                                        </div>
                                        <div class="items-center hidden">

                                            @if ($user->fichas)
                                                @foreach ($user->fichas as $ficha)
                                                    <div class="flex justify-center">
                                                        <button
                                                            class="px-3 py-3 text-sm leading-none text-green-700 bg-green-100 rounded focus:outline-none">{{ $ficha->especie->name }}</button>
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>


                                </td>

                                <td class="pl-5 text-center">
                                    <a href="{{ route('dashboard.productor', $user->id) }}">
                                        <p class="mr-2 text-base font-medium leading-none text-center text-gray-700">


                                            @if (number_format($user->kilos_netos) > 0)
                                                {{ number_format($user->kilos_netos) }}
                                            @else
                                                N/A
                                            @endif

                                        </p>
                                    </a>
                                </td>
                                <td class="pl-5 text-center">
                                    <a href="{{ route('dashboard.productor', $user->id) }}">
                                        <p class="mr-2 text-base font-medium leading-none text-center text-gray-700">


                                            @if ($user->exp > 0)
                                                {{ number_format($user->exp) }}
                                            @else
                                                N/A
                                            @endif

                                        </p>
                                    </a>
                                </td>
                                <td class="pl-5 text-center">
                                    <a href="{{ route('dashboard.productor', $user->id) }}">
                                        <p class="mr-2 text-base font-medium leading-none text-center text-gray-700">


                                            @if ($user->comercial > 0)
                                                {{ number_format($user->comercial) }}
                                            @else
                                                N/A
                                            @endif

                                        </p>
                                    </a>
                                </td>
                                <td class="pl-5 text-center">
                                    <a href="{{ route('dashboard.productor', $user->id) }}">
                                        <p class="mr-2 text-base font-medium leading-none text-center text-gray-700">


                                            @if ($user->desecho > 0)
                                                {{ number_format($user->desecho) }}
                                            @else
                                                N/A
                                            @endif

                                        </p>
                                    </a>
                                </td>
                                <td class="pl-5 text-center">
                                    <a href="{{ route('dashboard.productor', $user->id) }}">
                                        <p class="mr-2 text-base font-medium leading-none text-center text-gray-700">


                                            @if ($user->merma > 0)
                                                {{ number_format($user->merma) }}
                                            @else
                                                N/A
                                            @endif

                                        </p>
                                    </a>
                                </td>
                                <td class="pl-5 text-center">

                                    <a href="{{ Route('download.proceso.user', $user) }}">
                                        <button
                                            class="items-center px-2 py-3 mx-2 my-2 bg-gray-500 rounded focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 hover:bg-gray-600 focus:outline-none">
                                            <p class="text-sm font-medium leading-none text-white whitespace-nowrap">
                                                Descargar Excel de procesos</p>
                                        </button>
                                    </a>

                                    <a href="{{ Route('download.procesosallzip.user', $user) }}" target="_blank"
                                        class="my-4">
                                        <button
                                            class="items-center px-2 py-3 mx-2 bg-gray-500 rounded focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 sm:mt-0 hover:bg-gray-600 focus:outline-none">
                                            <p class="text-sm font-medium leading-none text-white whitespace-nowrap">
                                                Descargar PDF's de procesos</p>
                                        </button>
                                    </a>

                                    <button wire:click="export({{ $user->id }})"
                                        class="items-center px-2 py-3 mx-2 my-2 mt-2 bg-gray-500 rounded focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 hover:bg-gray-600 focus:outline-none">
                                        <p class="text-sm font-medium leading-none text-white whitespace-nowrap">
                                            Descargar Reporte de Calidad</p>
                                    </button>


                                </td>


                                </tr>

                                @if ($cellid == $user->id)
                                    <tr tabindex="0" class="h-16 border border-gray-100 rounded focus:outline-none">
                                        <td class="text-center">
                                            <p class="mr-2 text-base font-medium leading-none text-gray-700">




                                            </p>

                                        </td>
                                        <td class="">
                                            <div class="flex items-center pl-5">
                                                <p class="mr-2 text-base font-medium leading-none text-gray-700">



                                                </p>

                                            </div>
                                        </td>
                                        <td class="pl-5">
                                            <div class="flex items-center text-center whitespace-nowrap">

                                                <p class="ml-2 text-sm leading-none text-gray-600 whitespace-nowrap">

                                                </p>
                                            </div>
                                        </td>
                                        <td class="pl-5">
                                            <p class="mr-2 text-base font-medium leading-none text-gray-700">



                                            </p>



                                        <td class="pl-5">
                                        </td>
                                        <td class="items-center content-center pl-5 text-center">

                                            @if ($user->telefonos)
                                                @foreach ($user->telefonos as $telefono)
                                                    <div
                                                        class="flex items-center content-center justify-center text-center">
                                                        <b>{{ $telefono->numero }} </b>
                                                        <p wire:click="phone_destroy({{ $telefono }})"
                                                            class="ml-1 text-red-500 cursor-pointer"> (X)</p>

                                                    </div>
                                                    <br>
                                                @endforeach
                                            @endif




                                        </td>
                                        <td class="pl-5">
                                            <div class="flex items-center">


                                                <div class="flex items-center">
                                                    <label class="w-32 mx-2"><strong>Agregar:</strong></label>
                                                    <input wire:model="phone"
                                                        class="w-full h-10 text-sm bg-white border-2 border-gray-300 rounded-lg form-input focus:outline-none">
                                                </div>

                                                @error('name')
                                                    <span class="text-sm text-red-500">{{ $message }}</span>
                                                @enderror


                                                <button wire:click="storephone"
                                                    class="inline-flex items-start justify-start px-6 py-3 mx-4 mt-4 bg-green-500 rounded focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:mt-0 hover:bg-green-500 focus:outline-none">

                                                    <h1 style="font-size: 1rem;white-space: nowrap;"
                                                        class="inline w-full font-bold text-center text-white">
                                                        +

                                                    </h1>
                                                </button>
                                            </div>
                                        </td>
                                        <td class="pl-5">
                                            <div class="flex items-center">

                                                <p class="mr-2 text-base font-medium leading-none text-gray-700">


                                                </p>
                                            </div>
                                        </td>
                                        </td>
                                        <td class="pl-5 whitespace-nowrap">
                                            <p
                                                class="flex mr-2 text-base font-medium leading-none text-gray-700 whitespace-nowrap">
                                            </p>
                                        </td>

                                        <td class="pl-5">

                                        </td>
                                        <td class="pl-4">

                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                @endif
                                @if ($agronomoid == $user->id)
                                    <tr tabindex="0" class="h-16 border border-gray-100 rounded focus:outline-none">
                                        <td class="text-center">
                                            <p class="mr-2 text-base font-medium leading-none text-gray-700">




                                            </p>

                                        </td>

                                        <td class="pl-5">
                                            <p class="mr-2 text-base font-medium leading-none text-gray-700">



                                            </p>



                                        <td class="pl-5">
                                        </td>
                                        <td class="items-center content-center pl-5 text-center">

                                            @if ($user->agronomos)
                                                @foreach ($user->agronomos as $item)
                                                    <div
                                                        class="flex items-center content-center justify-center text-center">
                                                        <b>{{ $item->agronomo->name }} </b>
                                                        <p wire:click="agronomodelete({{ $item }})"
                                                            class="ml-1 text-red-500 cursor-pointer"> (X)</p>

                                                    </div>
                                                    <br>
                                                @endforeach
                                            @endif




                                        </td>
                                        <td class="w-full pl-5">
                                            <!-- Utilizando la clase 'w-1/6' para especificar un ancho del 1/6 del contenedor -->
                                            <div class="flex items-center">
                                                @livewire('agronomo.asignacion-rol', ['type' => 'Productor', 'user_id' => $user->id])
                                            </div>
                                        </td>
                                        <td class="pl-5">
                                            <div class="flex items-center">

                                                <p class="mr-2 text-base font-medium leading-none text-gray-700">


                                                </p>
                                            </div>
                                        </td>
                                        </td>
                                        <td class="pl-5 whitespace-nowrap">
                                            <p
                                                class="flex mr-2 text-base font-medium leading-none text-gray-700 whitespace-nowrap">
                                            </p>
                                        </td>

                                        <td class="pl-5">

                                        </td>
                                        <td class="pl-4">

                                        </td>
                                        <td>

                                        </td>
                                    </tr>
                                @endif


                            @endforeach


                        </tbody>
                    </table>
                </x-table-responsive>
                @if ($users->count())
                    <div class="">
                        {{ $users->links() }}
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>
