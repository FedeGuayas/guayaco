@extends('layouts.admin')
@section('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Perfil: {{ $usuario -> nombre  }}</h3>
			@include('alert.request')
        </div>
    </div>

    {!! Form::model($usuario,['method'=>'PUT','route'=>['runner.profile.updateProfile',$usuario->id],'file'=>'true'])!!}
    {{Form::token()}}
    {!! Form::hidden('rols_id',$usuario->rols_id) !!}
    {!! Form::hidden('escenario_id',$usuario->escenario_id) !!}
    <div class="container">
    <div class="row">
        <div class="hidden" disabled>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('User:') !!}
                {!! Form::text('name',"{$usuario -> name}",['class'=>'form-control']) !!}
            </div>
        </div>
        </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="col-lg-4">
                {!! Form::label('Nombre:') !!}
                {!! Form::text('nombre',"{$usuario->nombre}",['class'=>'form-control']) !!}
            </div>

            <div class="col-lg-4">
                <div class="form-group">
                    {!! Form::label('Correo:') !!}
                    {!! Form::email('email',"{$usuario->email}",['class'=>'form-control']) !!}
                </div>
            </div>
            <div class="col-lg-4">
                <div class="form-group">
                    {!! Form::label('Contraseña:') !!}
                    {!! Form::password('password',['class'=>'form-control','value'=>"{$usuario-> password}"]) !!}
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
        {{--<div class="col-lg-4">--}}
            {{--<div class="form-group">--}}
                {{--{!! Form::label('Escenario:') !!}--}}
                {{--<select name="escenario_id" class="form-control hidden" disabled>--}}
                    {{--@foreach ($escenario as $esc)--}}
                        {{--@if  ($esc->id==$usuario->escenario_id)--}}
                            {{--<option value="{{$esc->id}}" selected>{{$esc->escenario}}</option>--}}
                        {{--@else--}}
                            {{--<option value="{{$esc->id}}" >{{$esc->escenario}}</option>--}}
                        {{--@endif--}}
                    {{--@endforeach--}}
                {{--</select>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="col-lg-4">--}}
            {{--<div class="form-group">--}}
                {{--{!! Form::label('Rol:') !!}--}}
                {{--<select name="rols_id" class="form-control hidden" disabled>--}}
                    {{--@foreach ($rol as $rol)--}}
                        {{--@if ( $rol->id==$usuario->rols_id )--}}
                            {{--<option value="{{$rol->id}}" selected>{{$rol->rol}}</option>--}}
                        {{--@else--}}
                            {{--<option value="{{$rol->id}}">{{$rol->rol}}</option>--}}
                        {{--@endif--}}
                    {{--@endforeach--}}
                {{--</select>--}}
            {{--</div>--}}
        {{--</div>--}}
            <div class="hidden" disabled>
                <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
                <div class="form-group">
                {!! Form::label('Estado:') !!}
                {{  Form::select('estado', array('1' => 'Activo', '0' => 'Inactivo'),"{$usuario->estado}") }}
                </div>
                </div>
            </div>

        <div class="col-lg-4">
            <div class="form-group">
                {!! Form::label('Avatar:') !!}
                {!!  Form::file('avatar',['class' => 'form-control'])!!}
                @if (($usuario->avatar)!="")
                    <img src="{{ asset('dist/img/users/'.$usuario->avatar)}}" height="300px" width="300px" class="img-thumbnail">
                @endif
            </div>
        </div>
            </div>
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::submit('Guardar',['class'=>'btn btn-primary']) !!}
                {!! Form::reset('Cancelar',['class'=>'btn btn-danger']) !!}
                <a href="{{ url('/home') }}">
                    {!! Form::button('Inicio',['class'=>'btn btn-warning']) !!}
                </a>
            </div>
        </div>
    </div>
    </div>
    {!! Form::close() !!}
@endsection