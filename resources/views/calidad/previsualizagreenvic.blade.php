<x-app-layout>
    <link rel="stylesheet" href="{{asset('css/estilo-interno.css')}}">


    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            Subir Recepciones Greenvic
        </h2>
    </x-slot>
    

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
                        <form method="POST" action="{{ route('danos.previsualizagreenvic_store') }}">
                            @csrf
                    
                                <div class="form-group">
                                    <label for="recepcion">Recepción:</label>
                                    <input type="text" id="numero_g_recepcion" name="numero_g_recepcion" class="form-control" value="{{ $recepciones->id }}">
                                    <input type="text" id="n_emisor" name="n_emisor" class="form-control" value="{{ $recepciones->n_emisor }}">
                                    
                                    
                                </div>
                                <div class="card">
                                    <div class="card-header">
                                        Recepción
                                    </div>                                    
                                    <di class="card-body">
                                
                                    <div class="form-group">
                                        <label for="n_variedad">Variedad:</label>
                                        <input type="text" id="n_variedad" class="form-control" name="recepcion[n_variedad]" value="{{ $recepciones->n_variedad }}"/>
                                    </div>
                                    
                                
                                
                                    <div class="form-group">
                                    <label for="cantidad">Cantidad:</label>
                                    <input class="form-control" type="number" id="cantidad" name="recepcion[cantidad]" value="{{ $recepciones->cantidad }}">
                                    </div>
                                
                                
                                    <div class="form-group">
                                    <label for="peso_neto">Peso Neto (kg):</label>
                                    <input type="number" class="form-control" id="peso_neto" name="recepcion[peso_neto]" value="{{ $recepciones->peso_neto }}">
                                    </div>
                                
                                    </div>
                                </div>
                                <!-- Campos para calidad -->
                                <div class="card">
                                    <div class="card-header">
                                        Calidad
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label for="t_camion">Tipo de Camión:</label>
                                            <input type="text" id="t_camion" class="form-control" name="calidad[t_camion]" value="{{$calidad->t_camion}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="encarpado">Encarpado:</label>
                                            <select id="encarpado" name="calidad[encarpado]" class="form-control">
                                                <option value="SI" {{ 'NO' == 'SI' ? 'selected' : '' }}>SI</option>
                                                <option value="NO" {{ 'NO' == 'NO' ? 'selected' : '' }}>NO</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="seteo_termo">Seteo del Termo (°C):</label>
                                            <input type="number" id="seteo_termo" class="form-control" name="calidad[seteo_termo]" value="{{$calidad->seteo_termo}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="condicion">Condición:</label>
                                            <input type="text" id="condicion" class="form-control" name="calidad[condicion]" value="{{$calidad->condicion}}">
                                        </div>
                                    
                                        <div class="form-group">
                                            <label for="materia_vegetal">Materia Vegetal:</label>
                                            <select id="materia_vegetal" name="calidad[materia_vegetal]" class="form-control">
                                                <option value="SI" {{ 'SI' == $calidad->materia_vegetal ? 'selected' : '' }}>SI</option>
                                                <option value="NO" {{ $calidad->materia_vegetal == 'NO' ? 'selected' : '' }}>NO</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="piedras">Piedras:</label>
                                            <select id="piedras" name="calidad[piedras]" class="form-control">
                                                <option value="SI" {{ $calidad->piedras == 'SI' ? 'selected' : '' }}>SI</option>
                                                <option value="NO" {{ $calidad->piedras == 'NO' ? 'selected' : '' }}>NO</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="barro">Barro:</label>
                                            <select id="barro" name="calidad[barro]" class="form-control">
                                                <option value="SI" {{ $calidad->barro == 'SI' ? 'selected' : '' }}>SI</option>
                                                <option value="NO" {{ $calidad->barro == 'NO' ? 'selected' : '' }}>NO</option>
                                            </select>
                                        </div>
                                    
                                        <div class="form-group">
                                            <label for="pedicelo_largo">Pedicelo Largo:</label>
                                            <select id="pedicelo_largo" name="calidad[pedicelo_largo]" class="form-control">
                                                <option value="SI" {{ $calidad->pedicelo_largo == 'SI' ? 'selected' : '' }}>SI</option>
                                                <option value="NO" {{ $calidad->pedicelo_largo == 'NO' ? 'selected' : '' }}>NO</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="racimo">Racimo:</label>
                                            <select id="racimo" name="calidad[racimo]" class="form-control">
                                                <option value="SI" {{ $calidad->barro == 'SI' ? 'selected' : '' }}>SI</option>
                                                <option value="NO" {{ $calidad->barro == 'NO' ? 'selected' : '' }}>NO</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="esponjas">Esponjas:</label>
                                            <select id="esponjas" name="calidad[esponjas]" class="form-control">
                                                <option value="SI" {{ $calidad->esponjas == 'SI' ? 'selected' : '' }}>SI</option>
                                                <option value="NO" {{ $calidad->esponjas == 'NO' ? 'selected' : '' }}>NO</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="h_esponjas">Estado de Esponjas:</label>
                                            <input type="text" id="h_esponjas" name="calidad[h_esponjas]" class="form-control"
                                                value="{{ $calidad->h_esponjas }}">
                                        </div>
                                    
                                        <div class="form-group">
                                            <label for="h_racimo">Estado del Racimo:</label>
                                            <input type="text" id="h_racimo" name="calidad[h_racimo]" value="Correcto" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="llenado_tottes">Llenado de Tottes:</label>
                                            <input type="text" id="llenado_tottes" name="calidad[llenado_tottes]" value="{{ $calidad->llenado_tottes }}" class="form-control">
                                        </div>
                                    </div>
                                </div>
                    
                                @foreach ($lstDetalle as $index => $detalle)
                                    <div class="card">
                                        <div class="card-header">
                                            <strong>{{ $detalle['tipo_item'] }}</strong> -
                                            {{ $detalle['detalle_item'] ?? 'Sin detalle' }}
                                        </div>
                                        <div class="card-body">
                                            <div class="form-group">
                                                <input type="hidden" name="detalles[{{ $index }}][tipo_item]"
                                                    id="tipo_item_{{ $index }}" class="form-control"
                                                    value="{{ $detalle['tipo_item'] }}">
                                                <input type="hidden"
                                                    name="detalles[{{ $index }}][detalle_item]"
                                                    id="detalle_item_{{ $index }}" class="form-control"
                                                    value="{{ $detalle['detalle_item'] }}">
                                                <label
                                                    for="cantidad_{{ $index }}">Cantidad</label>
                                                <div class="form-control">
                                                    <input type="number" step="any"
                                                        name="detalles[{{ $index }}][cantidad]"
                                                        id="cantidad_{{ $index }}" class="form-control"
                                                        value="{{ $detalle['cantidad'] }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                
                                                <label
                                                    for="valor_ss_{{ $index }}">Valor SS</label>
                                                <div class="form-control">
                                                    <input type="number" step="any"
                                                        name="detalles[{{ $index }}][valor_ss]"
                                                        id="valor_ss_{{ $index }}" class="form-control"
                                                        value="{{ $detalle['valor_ss'] }}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label
                                                    for="porcentaje_muestra_{{ $index }}">Porcentaje
                                                    Muestra</label>
                                                <div class="form-control">
                                                    <input type="number" step="any"
                                                        name="detalles[{{ $index }}][porcentaje_muestra]"
                                                        id="porcentaje_muestra_{{ $index }}"
                                                        class="form-control"
                                                        value="{{ $detalle['porcentaje_muestra'] }}">
                                                </div>
                                                <input type="hidden"
                                                        name="detalles[{{ $index }}][tipo_detalle]"
                                                        id="tipo_detalle_{{ $index }}" class="form-control"
                                                        value="{{ $detalle['tipo_detalle'] }}">

                                                    <select name="detalles[{{ $index }}][estado]"
                                                        id="estado_{{ $index }}" class="form-control" style="display:none;">
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
                                @endforeach
                           
                            <div class="form-control">                            
                            <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        
                        </form>
                    </div>
                </div>
</x-app-layout>
