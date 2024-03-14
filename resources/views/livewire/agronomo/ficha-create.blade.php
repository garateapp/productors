<div>
   

    {!! Form::open(['route'=>'fichas.store','files'=>true , 'autocomplete'=>'off', 'method'=> 'POST']) !!}
    {!! Form::hidden('user_id', $user->id) !!}

    <div class="form-group mt-4">
        {!! Form::label('cuartel','Cuartel Nro:') !!}
        {!! Form::text('cuartel', null , ['class'=>'mt-1 block w-full rounded-lg', 'placeholder'=>'']) !!}
        @error('cuartel')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>

    <div class="form-group mt-4">
        {!! Form::label('especie','Especie') !!}
        <select wire:model="selectedespecie" class="mt-1 block w-full rounded-lg">
            <option value="">Selecciona una opción</option>
            @foreach ($especies as $especie)
    
                <option value="{{$especie->id}}">{{$especie->name}}</option>
                
            @endforeach
        </select>
    </div>

    <div class="form-group mt-4">
        {!! Form::label('variedad','Variedad') !!}
        <select wire:model="selectedvariedad" class="mt-1 block w-full rounded-lg">
            <option value="">Selecciona una opción</option>
            @if (!IS_NULL($variedades))
                @foreach ($variedades as $variedad)
    
                    <option value="{{$variedad->id}}">{{$variedad->name}}</option>
                    
                @endforeach
            @endif
        </select>
    
    </div>
   

    {!! Form::hidden('especie_id', $especieid) !!}
    {!! Form::hidden('variedad_id', $selectedvariedad) !!}
    


    
    <div class="form-group mt-4">
        {!! Form::label('ano_plantacion','Año de plantación:') !!}
        {!! Form::text('ano_plantacion', null , ['class'=>'mt-1 block w-full rounded-lg', 'placeholder'=>'']) !!}
        @error('ano_plantacion')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    
    <div class="form-group mt-2">
        {!! Form::label('cant_hectareas','Cantidad de hectáreas:') !!}
        {!! Form::text('cant_hectareas', null , ['class'=>'mt-1 block w-full rounded-lg', 'placeholder'=>'', 'id'=>'cant_hectareas']) !!}
        @error('cant_hectareas')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    
    <div class="form-group mt-2">
        {!! Form::label('prod_hectareas','Producción por hectáreas en toneladas:') !!}
        {!! Form::text('prod_hectareas', null , ['class'=>'mt-1 block w-full rounded-lg', 'placeholder'=>'', 'id'=>'prod_hectareas']) !!}
        @error('prod_hectareas')
            <span class="text-danger">{{$message}}</span>
        @enderror
    </div>
    
    <div class="form-group mt-2">
        {!! Form::label('total_produccion','Campo total producción:') !!}
        {!! Form::text('total_produccion', null , ['class'=>'mt-1 block w-full rounded-lg', 'placeholder'=>'', 'readonly', 'id'=>'total_produccion']) !!}
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

    <div class="form-group mt-2">
      {!! Form::label('porcentaje_de_entrega','Total Kilos Entregable') !!}
      {!! Form::text('porcentaje_de_entrega', null , ['class'=>'mt-1 block w-full rounded-lg', 'placeholder'=>'']) !!}
      @error('porcentaje_de_entrega')
          <span class="text-danger">{{$message}}</span>
          @enderror
    </div>

    <div class="form-group mt-2">
      {!! Form::label('porcentaje_de_entrega','Nro de Cajas: (5kgs)') !!}
      {!! Form::text('porcentaje_de_entrega', null , ['class'=>'mt-1 block w-full rounded-lg', 'placeholder'=>'']) !!}
      @error('porcentaje_de_entrega')
          <span class="text-danger">{{$message}}</span>
      @enderror
    </div>

    <div class="flex justify-end mt-4">
        {!! Form::submit('Agregar', ['class'=>'text-white font-bold mx-4 text-sm focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 mt-4 sm:mt-0 inline-flex items-start justify-start px-3 py-2 bg-gray-500 hover:bg-gray-500 focus:outline-none rounded']) !!}
    </div>

  {!! Form::close() !!}

</div>
