@extends('layouts.admin')
@section('contenido')

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Importar Resultados</h3>
            @include('alert.request')
        </div>
    </div>
    {!! Form::open (array('route' => 'result.store', 'method'=>'POST','files'=>'true'))!!}
    {{Form::token()}}
    <div class="row">
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('Cargar Excel de Resultados:') !!}
                {{  Form::file('result',['class' => 'form-control']) }}
            </div>

            {!! Form::submit('Importar',['class'=>'btn btn-success','id'=>'import_result']) !!}
            {!! Form::reset('Cancelar',['class'=>'btn btn-warning']) !!}
            <a href="{{route('result.truncate')}}" >
                {!! Form::button('Truncate',['class'=>'btn btn-danger']) !!}
            </a>
        </div>

    </div>

    {!! Form::close() !!}


@endsection