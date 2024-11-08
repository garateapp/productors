<div>

    <div class="px-4 mx-auto max-w-7xl ">

        <div class="py-12 overflow-hidden bg-white rounded shadow-lg">
            <div class="flex justify-center">
                <img class="w-16 my-4"
                    src="https://static.vecteezy.com/system/resources/previews/005/165/267/non_2x/file-upload-concept-in-flat-style-file-with-arrow-vector.jpg"
                    alt="">
            </div>
            <h1 class="text-2xl text-center">Cargar Archivos</h1>

            @if ($productors)
                <div class="flex justify-center">
                    <div class="justify-center max-w-xs my-3 ml-3 text-sm text-white bg-green-500 rounded-md shadow-lg"
                        role="alert">
                        <div class="flex p-4">
                            {{ $productors->count() }} Productores que comercializan {{ $especie->name }}


                        </div>
                    </div>
                </div>
            @endif

            <div class="mx-12 mt-4">
                <div class="grid max-w-4xl grid-cols-2 mx-auto mt-4 gap-x-4">
                    <div>
                        {!! Form::open(['route' => 'mensajes.store', 'files' => true, 'autocomplete' => 'off', 'method' => 'POST']) !!}

                        {!! Form::label('especie', 'Especie', ['class' => ' font-bold']) !!}
                        {!! Form::select('especie', $especies, null, ['class' => 'form-input block w-full mt-1']) !!}
                    </div>
                    <div>

                        <p class="font-bold">Tipo de archivo: </p>




                        {!! Form::select(
                            'tipo',
                            [
                                'ASOEX' => 'ASOEX',
                                'Boletin Técnico' => 'Boletin Técnico',
                                'Programa Fitosanitario' => 'Programa Fitosanitario',
                                'Documento General' => 'Documento General',
                                'Instructivo' => 'Instructivo',
                            ],
                            'excel',
                            [
                                'class' =>
                                    'block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500',
                            ],
                        ) !!}

                        @error('detalle')
                            <span class="text-sm text-red-500">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-2 mt-4 text-center" wire:ignore>







                        {!! Form::label('observacion', 'Mensaje', ['class' => 'font-bold text-center']) !!}
                        {!! Form::textarea('observacion', null, ['class' => 'form-input block w-full mt-1 h-max']) !!}


                    </div>
                </div>
            </div>
            <div>
                @isset($tipo)
                    <h1 class="mt-4 text-center">Selecciona un archivo {{ $tipo }}</h1>
                @endisset

            </div>
            <div class="grid grid-cols-1 mt-4 sm:grid-cols-3 w-max-7xl ">
                <div>

                </div>
                {!! Form::label('file', 'Archivo', ['class' => 'font-bold text-center hidden']) !!}

                {!! Form::file('file', [
                    'class' => 'form-input w-full' . ($errors->has('file') ? ' border-red-600' : ''),
                    'id' => 'file',
                    'accept' => 'file/*',
                ]) !!}
            </div>
            <div class="flex justify-center mt-4">

                <div class="flex justify-end">
                    {!! Form::submit('ENVIAR', [
                        'class' =>
                            'text-center text-white font-bold inline w-full mx-4 focus:ring-2 focus:ring-offset-2 focus:ring-green-500 mt-4 sm:mt-0 inline-flex items-start justify-start px-6 py-3 bg-green-500 hover:bg-green-500 focus:outline-none rounded cursor-pointer',
                    ]) !!}
                </div>

                {!! Form::close() !!}
            </div>
            <h1 class="mt-6 text-2xl font-bold text-center">Historial de envios</h1>
            <section class="flex justify-center w-8/12 h-full pt-3 mx-auto overflow-y-scroll bg-gray-50">


                <ul class="w-full mt-6">
                    @foreach ($mensajes as $item)
                        @if ($mensaje)
                            @if ($mensaje->id == $item->id)
                                <li class="px-3 py-5 text-white bg-indigo-600 border-b">
                                    <a href="{{ route('mensaje_hists.edit', $item) }}"
                                        class="flex items-center justify-between">
                                        <h3 class="text-lg font-semibold">{{ $item->tipo }} Para Productores De
                                            {{ $item->especie }}</h3>
                                        <p class="text-md">23m ago</p>
                                    </a>
                                    <div class="text-md">You have been invited!</div>
                                </li>
                            @else
                                <li class="px-3 py-5 transition border-b hover:bg-indigo-100">
                                    <a href="{{ route('mensaje_hists.edit', $item) }}"
                                        class="flex items-center justify-between">
                                        <h3 class="text-lg font-semibold">{{ $item->tipo }} Para Productores De
                                            {{ $item->especie }}</h3>
                                        <p class="text-gray-400 text-md">{{ $item->created_at->format('d/m/Y') }}</p>
                                    </a>
                                    <div class="italic text-gray-400 text-md">You have been invited!</div>
                                </li>
                            @endif
                        @else
                            <li class="px-3 py-5 transition border-b hover:bg-indigo-100">
                                <a href="{{ route('mensaje_hists.edit', $item) }}"
                                    class="flex items-center justify-between">
                                    <h3 class="text-lg font-semibold">{{ $item->tipo }} Para Productores De
                                        {{ $item->especie }}</h3>
                                    <p class="text-gray-400 text-md">{{ $item->created_at->format('d/m/Y') }}</p>
                                </a>
                                <div class="italic text-gray-400 text-md">
                                    @foreach ($users as $user)
                                        @if ($user->id == $item->emisor_id)
                                            Enviado por {{ $user->name }}
                                        @endif
                                    @endforeach
                                </div>
                            </li>
                        @endif
                    @endforeach


                </ul>
            </section>
        </div>
    </div>

    <x-slot name="js">



    </x-slot>


</div>
