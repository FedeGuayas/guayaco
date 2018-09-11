
@extends('layouts.admin')
@section('contenido')
{{--    {!! Form::open (['route' => 'runner.importar.personas.store'],['method' => 'POST','autocomplete'=> 'off', 'class'=>'inline'])!!}--}}
{{--    {{Form::token()}}--}}
{{--    {!! Form::hidden('personas', $personas) !!}--}}
    {{--{!! Form::hidden('persona_id', $persona->id) !!}--}}

    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
{{--            @include('alert.success')--}}
     <h3>Listado de Personas A IMPORTAR </h3>
{{--            {!! Form::submit('importar',['class'=>'btn btn-primary']) !!}--}}

            <a href="{{ URL::action('ImportarPersonasController@index')}}">
            {!! Form::button('Import',['class'=>'btn btn-warning']) !!}
            </a>


{{--            @include('runner.personas.search')--}}
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover ">
                    <thead>
                    <th>ID</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Numero Documento</th>
                    <th>Genero</th>
                    <th>Fecha Nacimiento</th>
                    <th>Email</th>
                    <th>Direccion</th>
                    <th>Telefono</th>
                    <th>Opciones</th>
                    </thead>
                    @foreach ($personas as $pers)
                        <tr>
                            <td>{{ $pers->id }}</td>
                            <td>{{ $pers->nombres }}</td>
                            <td>{{ $pers->apellidos }}</td>
                            <td>{{ $pers->ci }}</td>
                            <td>{{ $pers->sexo }}</td>
                            <td>{{ $pers->fecha_nac }}</td>
                            <td>{{ $pers->email }}</td>
                            <td>{{ $pers->direccion }}</td>
                            <td>{{ $pers->telefono}}</td>
                            <td>

                                {{--<a href="{{ URL::action('InscripcionController@create', $pers->id )}}">--}}
                                    {{--{!! Form::button('Inscribir',['class'=>'btn btn-warning']) !!}--}}
                                {{--</a>--}}

                            </td>
                        </tr>
{{--                        @include ('runner.personas.modal')--}}
                    @endforeach
                </table><!--end table-responsive-->
            </div><!-- end div ./table-responsive-->
            {{ $personas->render() }}
        </div><!--end div ./col-lg-12. etc-->
    </div><!--end div ./row-->

    {!! Form::close() !!}
@endsection