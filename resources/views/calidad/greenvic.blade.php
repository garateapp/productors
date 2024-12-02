<x-app-layout>
    <link rel="stylesheet" href="{{asset('css/estilo-interno.css')}}">
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Subir Recepciones Greenvic
        </h2>
    </x-slot>
    <div class="overflow-hidden bg-white rounded shadow-lg">

        @if (session('info'))
            <div class="flex justify-center">
                <div class="justify-center">
                    <div class="flex justify-center w-full px-4 py-3 text-green-700 bg-green-100 border border-green-400 rounded"
                        role="alert">
                        <strong class="mx-2 font-bold">Exito!</strong>
                        <span class="flex">{{ session('info') }}</span>
                        <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                            <svg class="w-6 h-6 text-red-500 fill-current" role="button"
                                xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <title>Cerrar</title>
                                <path
                                    d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
        @endif
        @if (session('fail'))
            <div x-data="{ open: true }">
                <div x-show="open"
                    class="relative flex px-4 py-3 text-red-700 bg-red-100 border border-red-400 rounded"
                    role="alert">
                    <strong class="items-center content-center my-auto font-bold">Error!</strong>
                    <span class="items-center content-center block my-auto ml-2 sm:inline">{{ session('fail') }}</span>
                    <span x-on:click="open=false" class="top-0 bottom-0 right-0 px-4 py-3 ">
                        <svg class="w-6 h-6 ml-4 text-gray-500 fill-current" role="button"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                            <title>Cerrar</title>
                            <path
                                d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z" />
                        </svg>
                    </span>
                </div>
            </div>
        @endif


        
        <div class="container">
            <div class="col-md-12">

                        
                        <form action="{{ route('danos.uploadAndReadExcelGreenvic') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="Guia">Número de Guía</label>
                                <input type="text" id="n_guia" class="form-control" name="n_guia" value=""/>
                            </div>
                            <div class="form-group">
                                <label for="codigo_sag">Código SAG</label>
                                <input type="text" id="codigo_sag" class="form-control" name="codigo_sag" value=""/>
                            </div>
                            <div class="form-group">
                                <label for="fecha">Fecha Recepción</label>
                                <input type="date" id="fecha" class="form-control" name="fecha" value=""/>
                            </div>
                            <label for="file">Selecciona un archivo Excel</label>
                            <input type="file" name="file" id="file" required>
                            <button type="submit">Subir Archivo</button>
                        </form>
                    </div>



                </div>
            
            <div class="px-4 py-4 mt-6 bg-white md:py-7 md:px-8 xl:px-10">
            </div>
        </div>
    </div>

</x-app-layout>
