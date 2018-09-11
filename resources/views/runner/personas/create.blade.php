@extends('layouts.admin')
@section('contenido')

    {{--<div class="container">--}}
    <h3>Nueva Persona</h3>

    @include('alert.request')

    {!! Form::open (array('url' => 'runner/personas','method' => 'POST','autocomplete'=> 'off'))!!}
    {{Form::token()}}

    <div class="row">

        <div class="col-lg-6">
            <div class="col-lg-8 col-md-5 col-sm-6 col-xs-12">
                <div class="form-group" style="">
                    {!! Form::label('nombres','Nombres:*',['class'=>'label-control']) !!}
                    {!! Form::text('nombres',null,['class'=>'form-control','placeholder'=>'Nombres...','required', 'autofocus','style'=>'text-transform:uppercase']) !!}
                </div>
            </div>
            <div class="col-lg-8 col-md-5 col-sm-6 col-xs-12">
                <div class="form-group">
                    {!! Form::label('apellidos','Apellidos:*',['class'=>'label-control']) !!}
                    {!! Form::text('apellidos',null,['class'=>'form-control','placeholder'=>'Apellidos...','required','style'=>'text-transform:uppercase']) !!}
                </div>
            </div>
            <div class="col-lg-8 col-md-5 col-sm-6 col-xs-12">
                <div class="form-group">
                    {!! Form::label('email','Correo:',['class'=>'label-control']) !!}
                    {!! Form::email('email',null,['class'=>'form-control','placeholder'=>'Email...']) !!}
                </div>
            </div>
            <div class="col-lg-8 col-md-5 col-sm-6 col-xs-12">
                <div class="form-group">
                    {!! Form::label('telefono','Teléfono:',['class'=>'label-control']) !!}
                    {!! Form::text('telefono',null,['class'=>'form-control','placeholder'=>'Telefono...']) !!}
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="col-lg-4 col-md-5 col-sm-6 col-xs-12">
                <div class="form-group">
                    {!! Form::label('tipo_doc','Documento:*',['class'=>'label-control']) !!}
                    {{  Form::select('tipo_doc', ['CEDULA' => 'Cedula', 'PASAPORTE' => 'Pasaporte', 'NoDoc' => 'NoDoc'],'CEDULA',['class'=>'form-control','required']) }}
                </div>
            </div>
            <div class="col-lg-6 col-md-5 col-sm-6 col-xs-12">
                <div class="form-group">
                    {!! Form::label('num_doc','Número:*',['class'=>'label-control']) !!}
                    {!! Form::text('num_doc',null,['class'=>'form-control','placeholder'=>'Número del documento...','required']) !!}
                </div>
            </div>
            <div class="col-lg-4 col-sm-6 col-xs-12">
                <div class="form-group">
                    {!! Form::label('genero','Género:*',['class'=>'label-control']) !!}
                    {{  Form::select('genero', ['Masculino' => 'Masculino', 'Femenino' => 'Femenino'],'Masculino',['class'=>'form-control','required']) }}
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 col-xs-12">
                <div class="form-group">
                    {!! Form::label('fecha_nac','Fecha de Nacimiento:*',['class'=>'label-control']) !!}
                    {{  Form::date('fecha_nac',null,['class'=>'form-control','required']) }}
                </div>
            </div>
            <div class="col-lg-10 col-sm-6 col-xs-12">
                <div class="form-group">
                    {!! Form::label('direccion','Dirección:',['class'=>'label-control']) !!}
                    {!! Form::textarea('direccion',null,['class'=>'form-control','placeholder'=>'Dirección...', 'maxlength'=>'200','style'=>'text-transform:uppercase','rows'=>'4', 'cols'=>'50']) !!}
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-sm-12 col-md-6 col-xs-12">
            <div class="form-group">
                {!! Form::button('<i class="fa fa-2x fa-save" aria-hidden="true"></i>',['class'=>'btn btn-sm btn-primary', 'data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>'Guardar','type'=>'submit']) !!}
                {!! Form::button('<i class="fa fa-2x fa-eraser"></i>',['class'=>'btn btn-sm btn-danger','data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>'Cancelar','type'=>'reset']) !!}
                <a href="{{ url('runner/personas') }}" data-toggle="tooltip" data-placement="top" title="Regresar">
                    {!! Form::button('<i class="fa fa-2x fa-chevron-circle-left"></i>',['class'=>'btn btn-sm btn-warning']) !!}
                </a>
            </div>
        </div>
    </div>

    {!! Form::close() !!}
    {{--</div>--}}
@endsection


