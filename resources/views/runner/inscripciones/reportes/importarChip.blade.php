@extends('layouts.admin')
@section('contenido')

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Importar Chip</h3>
            @include('alert.request')
        </div>
    </div>
    {!! Form::open (array('route' => 'chips.store', 'method'=>'POST','files'=>'true'))!!}
    {{Form::token()}}
    <div class="row">
        <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::label('Cargar Chip Excel:') !!}
                {{  Form::file('chip',['class' => 'form-control']) }}
            </div>
            <div class="progress">
                <div id="progress_bar_chip" class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width:0%">
                    <span class="sr-only">40% Complete (success)</span>
                </div>
            </div>
            {!! Form::submit('Importar',['class'=>'btn btn-success','id'=>'import_chip']) !!}
            {!! Form::reset('Cancelar',['class'=>'btn btn-warning']) !!}
            <a href="{{route('chips.truncate')}}" >
                {!! Form::button('Truncate',['class'=>'btn btn-danger']) !!}
            </a>
        </div>

    </div>

    {!! Form::close() !!}


@endsection