<div class="grid grid-cols-1 md:grid-cols-2">
    <div>
            <div class="form-group flex justify-center">
                <div class="block">
                    {!! Form::label('name', 'Nombre:',['class'=>'text-center']) !!}<br>
                    {!! Form::text('name', null , ['class' => 'form-control mb-4'.($errors->has('name') ? ' is-invalid' : ''),'placeholder'=>'Escriba un nombre']) !!}
                    @error('name')
                        <span class="invalid-feedback">
                            <strong>{{$message}}</strong>

                        </span>
                    @enderror
                </div>
            </div>
    </div>
    <div>
    <strong class="flex justify-center">Permisos</strong>
    <br>
    @error('permissions')
            <small class="text-danger">
                <strong>{{$message}}</strong>

            </small>
    @enderror

    @foreach($permissions as $permission)
        <div class="">
            <label class="">
                {!! Form::checkbox('permissions[]', $permission->id ,null, ['class' => 'mr-1']) !!}
                {{$permission->name}}
            </label>
        </div>
    @endforeach
    </div>
</div>