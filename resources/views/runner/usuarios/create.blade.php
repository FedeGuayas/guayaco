@extends('layouts.admin')
@section('contenido')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Nuevo Usuario</h3>
            @include('alert.request')
        </div>
    </div>
    {!! Form::open (array('url' => 'runner/usuarios','method' => 'POST','autocomplete'=> 'off', 'files'=>'true'))!!}
    {{Form::token()}}
    <div class="row">
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('Nombre:') !!}
                {!! Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Nombre y Apellidos...', 'value'=>"{{old('nombre')}}"]) !!}
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('User:') !!}
                {!! Form::text('name',null,['class'=>'form-control','placeholder'=>'Nombre de usuario...']) !!}
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('Correo:') !!}
                {!! Form::email('email',null,['class'=>'form-control','placeholder'=>'Correo...']) !!}
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('Contraseña:') !!}
                {!! Form::password('password',['class'=>'form-control','placeholder'=>'Contraseña...']) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('Escenario:') !!}
                <select name="escenario_id" class="form-control">
                    @foreach ($escenarios as $esc)
                        <option value="{{$esc->id}}">{{$esc->escenario}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('Rol:') !!}
                <select name="rols_id" class="form-control">
                    @foreach ($roles as $rol)
                        <option value="{{$rol->id}}">{{$rol->rol}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('Estado:') !!}
                {{  Form::select('estado', array('1' => 'Activo', '0' => 'Inactivo'),'1') }}
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('Avatar:') !!}
                {{  Form::file('avatar',['class' => 'form-control']) }}
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::button('<i class="fa fa-2x fa-save" aria-hidden="true"></i>',['class'=>'btn btn-sm btn-primary', 'data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>'Guardar','type'=>'submit']) !!}
                {!! Form::button('<i class="fa fa-2x fa-eraser"></i>',['class'=>'btn btn-sm btn-danger','data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>'Cancelar','type'=>'reset']) !!}
                <a href="{{ url('runner/usuarios') }}" data-toggle="tooltip" data-placement="top" title="Regresar">
                    {!! Form::button('<i class="fa fa-2x fa-chevron-circle-left"></i>',['class'=>'btn btn-sm btn-warning','data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>'Regresar']) !!}
                </a>
            </div>
        </div>
    </div>

    {!! Form::close() !!}


@endsection


