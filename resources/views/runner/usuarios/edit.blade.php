@extends('layouts.admin')
@section('contenido')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Editar Usuario: {{ $usuario -> nombre  }}</h3>
            @include('alert.request')
        </div>
    </div>

    {!! Form::model($usuario,['method'=>'PATCH','route'=>['runner.usuarios.update',$usuario->id],'file'=>'true'])!!}
    {{Form::token()}}
    <div class="row">
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('User:') !!}
                {!! Form::text('name',"{$usuario -> name}",['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('Nombre:') !!}
                {!! Form::text('nombre',"{$usuario->nombre}",['class'=>'form-control']) !!}
            </div>
        </div>

        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('Correo:') !!}
                {!! Form::email('email',"{$usuario->email}",['class'=>'form-control']) !!}
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('Contraseña:') !!}
                {!! Form::password('password',['class'=>'form-control','value'=>"{$usuario-> password}"]) !!}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('Escenario:') !!}
                <select name="escenario_id" class="form-control">
                    @foreach ($escenario as $esc)
                        @if  ($esc->id==$usuario->escenario_id)
                            <option value="{{$esc->id}}" selected>{{$esc->escenario}}</option>
                        @else
                            <option value="{{$esc->id}}">{{$esc->escenario}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('Rol:') !!}
                <select name="rols_id" class="form-control">
                    @foreach ($rol as $rol)
                        @if ( $rol->id==$usuario->rols_id )
                            <option value="{{$rol->id}}" selected>{{$rol->rol}}</option>
                        @else
                            <option value="{{$rol->id}}">{{$rol->rol}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('Estado:') !!}
                {{  Form::select('estado', array('1' => 'Activo', '0' => 'Inactivo'),"{$usuario->estado}") }}
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('Avatar:') !!}
                {!!  Form::file('avatar',['class' => 'form-control'])!!}
                @if (($usuario->avatar)!="")
                    <img src="{{ asset('dist/img/users/'.$usuario->avatar)}}" height="300px" width="300px"
                         class="img-thumbnail">
                @endif
            </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::button('<i class="fa fa-2x fa-save" aria-hidden="true"></i>',['class'=>'btn btn-sm btn-primary', 'data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>'Guardar','type'=>'submit']) !!}
                {!! Form::button('<i class="fa fa-2x fa-eraser"></i>',['class'=>'btn btn-sm btn-danger','data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>'Cancelar','type'=>'reset']) !!}
                <a href="{{ url('runner/usuarios') }}"  data-toggle="tooltip" data-placement="top" title="Regresar">
                    {!! Form::button('<i class="fa fa-2x fa-chevron-circle-left"></i>',['class'=>'btn btn-sm btn-warning','data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>'Regresar']) !!}
                </a>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection