<x-app-layout>
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


        <div>
            <div class="flex justify-center">
                <div class="row">
                    <div class="col-md-12">
                        <form method="POST" action="#">
                            @csrf
                            <div class="container">
                                <div>
                                    <label for="encarpado">Seleccione Recepción:</label>
                                    <select id="recepcion" name="id_rececion">
                                        @foreach ($recepciones as $recepcion)
                                            <option value="{{ $recepcion->id }}">{{ $recepcion->n_emisor }} -
                                                {{ $recepcion->numero_g_recepcion }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <h2>Recepción</h2>
                                <div>
                                    <label for="n_variedad">Variedad:</label>
                                    <input type="text" id="n_variedad" name="recepcion[n_variedad]" value="SANTINA">
                                </div>
                                <div>
                                    <label for="cantidad">Cantidad:</label>
                                    <input type="number" id="cantidad" name="recepcion[cantidad]" value="672">
                                </div>
                                <div>
                                    <label for="peso_neto">Peso Neto (kg):</label>
                                    <input type="number" id="peso_neto" name="recepcion[peso_neto]" value="5407">
                                </div>

                                <!-- Campos para calidad -->
                                <h2>Calidad</h2>
                                <div>
                                    <label for="t_camion">Tipo de Camión:</label>
                                    <input type="text" id="t_camion" name="calidad[t_camion]" value="Termo">
                                </div>
                                <div>
                                    <label for="encarpado">Encarpado:</label>
                                    <select id="encarpado" name="calidad[encarpado]">
                                        <option value="SI" {{ 'NO' == 'SI' ? 'selected' : '' }}>SI</option>
                                        <option value="NO" {{ 'NO' == 'NO' ? 'selected' : '' }}>NO</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="seteo_termo">Seteo del Termo (°C):</label>
                                    <input type="number" id="seteo_termo" name="calidad[seteo_termo]" value="10">
                                </div>
                                <div>
                                    <label for="condicion">Condición:</label>
                                    <input type="text" id="condicion" name="calidad[condicion]" value="Limpio">
                                </div>
                                <div>
                                    <label for="materia_vegetal">Materia Vegetal:</label>
                                    <select id="materia_vegetal" name="calidad[materia_vegetal]">
                                        <option value="SI" {{ 'SI' == 'SI' ? 'selected' : '' }}>SI</option>
                                        <option value="NO" {{ 'SI' == 'NO' ? 'selected' : '' }}>NO</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="piedras">Piedras:</label>
                                    <select id="piedras" name="calidad[piedras]">
                                        <option value="SI" {{ 'NO' == 'SI' ? 'selected' : '' }}>SI</option>
                                        <option value="NO" {{ 'NO' == 'NO' ? 'selected' : '' }}>NO</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="barro">Barro:</label>
                                    <select id="barro" name="calidad[barro]">
                                        <option value="SI" {{ 'NO' == 'SI' ? 'selected' : '' }}>SI</option>
                                        <option value="NO" {{ 'NO' == 'NO' ? 'selected' : '' }}>NO</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="pedicelo_largo">Pedicelo Largo:</label>
                                    <select id="pedicelo_largo" name="calidad[pedicelo_largo]">
                                        <option value="SI" {{ 'NO' == 'SI' ? 'selected' : '' }}>SI</option>
                                        <option value="NO" {{ 'NO' == 'NO' ? 'selected' : '' }}>NO</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="racimo">Racimo:</label>
                                    <select id="racimo" name="calidad[racimo]">
                                        <option value="SI" {{ 'SI' == 'SI' ? 'selected' : '' }}>SI</option>
                                        <option value="NO" {{ 'SI' == 'NO' ? 'selected' : '' }}>NO</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="esponjas">Esponjas:</label>
                                    <select id="esponjas" name="calidad[esponjas]">
                                        <option value="SI" {{ 'SI' == 'SI' ? 'selected' : '' }}>SI</option>
                                        <option value="NO" {{ 'SI' == 'NO' ? 'selected' : '' }}>NO</option>
                                    </select>
                                </div>
                                <div>
                                    <label for="h_esponjas">Estado de Esponjas:</label>
                                    <input type="text" id="h_esponjas" name="calidad[h_esponjas]"
                                        value="Regular">
                                </div>
                                <div>
                                    <label for="h_racimo">Estado del Racimo:</label>
                                    <input type="text" id="h_racimo" name="calidad[h_racimo]" value="Correcto">
                                </div>
                                @foreach ($lstDetalle as $index => $detalle)
                                    <div class="card">
                                        <div class="card-header">
                                            <strong>{{ $detalle['tipo_item'] }}</strong> -
                                            {{ $detalle['detalle_item'] ?? 'Sin detalle' }}
                                        </div>
                                        <div class="card-body">
                                            <div class="row form-group">
                                                <label class="col-form-label"
                                                    for="cantidad_{{ $index }}">Cantidad</label>
                                                <div class="form-control">
                                                    <input type="number" step="any"
                                                        name="detalles[{{ $index }}][cantidad]"
                                                        id="cantidad_{{ $index }}" class="form-control"
                                                        value="{{ $detalle['cantidad'] }}">
                                                </div>
                                            </div>
                                            <div class="mb-8 row">
                                                <label class="col-form-label"
                                                    for="porcentaje_muestra_{{ $index }}">Porcentaje
                                                    Muestra</label>
                                                <div class="form-control">
                                                    <input type="number" step="any"
                                                        name="detalles[{{ $index }}][porcentaje_muestra]"
                                                        id="porcentaje_muestra_{{ $index }}"
                                                        class="form-control"
                                                        value="{{ $detalle['porcentaje_muestra'] }}">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label class="col-form-label"
                                                    for="tipo_detalle_{{ $index }}">Tipo Detalle</label>
                                                <div class="form-control">
                                                    <input type="text"
                                                        name="detalles[{{ $index }}][tipo_detalle]"
                                                        id="tipo_detalle_{{ $index }}" class="form-control"
                                                        value="{{ $detalle['tipo_detalle'] }}">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <label class="col-form-label"
                                                    for="estado_{{ $index }}">Estado</label>
                                                <div class="form-control">
                                                    <select name="detalles[{{ $index }}][estado]"
                                                        id="estado_{{ $index }}" class="form-control">
                                                        <option value="1"
                                                            {{ $detalle['estado'] == 1 ? 'selected' : '' }}>Activo
                                                        </option>
                                                        <option value="0"
                                                            {{ $detalle['estado'] == 0 ? 'selected' : '' }}>
                                                            Inactivo</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>



                </div>
            </div>
            <div class="px-4 py-4 mt-6 bg-white md:py-7 md:px-8 xl:px-10">
            </div>
        </div>
    </div>
    </div>

</x-app-layout>
