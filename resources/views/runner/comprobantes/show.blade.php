@extends('layouts.admin')
@section('contenido')
<div class="col-lg-10 col-sm-12 col-md-12 col-xs-12">
    <div class="form-horizontal " style=" border: 1px solid #ccc;	margin: 5px; padding: 5px;">
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">Datos para Facturación</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div><!-- /.box-header -->
            <div class="box-body">
                <!--Contenido-->
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <h3>Editar Comprobante: </h3>
                        @include('alert.request')
                    </div>
                </div>
                {!! Form::model($comprobante,['method'=>'PATCH','route'=>['runner.pagos.update',$comprobante->id]])!!}
                {{Form::token()}}
                <div class="form-horizontal ">
                    <div class="form-group">
                        {!! Form::label('comp_concepto','Descripción:',['class'=>'col-lg-2 col-sm-2 control-label']) !!}
                        <div class="col-sm-4 col-lg-7">
                            {!!   Form::text('comp_concepto',$cuenta->descripcion,['class'=>'form-control','readonly'])  !!}
                        </div>
                        <div class="col-sm-4 col-lg-2">
                            {!! Form::text('comp_cuenta',$cuenta->cuenta,['class'=>' form-control ','readonly',]) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-inline">
                            {!! Form::label('comp_nombres','Nomb y Apell:',['class'=>'col-lg-2 col-sm-2 control-label']) !!}
                            <div class="col-sm-4 col-lg-8">
                                {!! Form::text('comp_nombres',$comprobante->nombres,['class'=>' form-control comp_nombres','placeholder'=>'Nombres...']) !!}-
                                {!! Form::text('comp_apellidos',$comprobante->apellidos,['class'=>' form-control comp_apellidos','placeholder'=>'Apellidos...']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('comp_doc','Documento:',['class'=>'col-lg-2 col-sm-2 control-label']) !!}
                        <div class="col-sm-4">
                            {!! Form::text('comp_documento',$comprobante->num_doc,['class'=>' form-control comp_documento','placeholder'=>'Documento...']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('comp_email','Email:',['class'=>'col-lg-2 col-sm-2 control-label']) !!}
                        <div class="col-sm-4">
                            {!! Form::text('comp_email',$comprobante->email,['class'=>' form-control comp_email','placeholder'=>'Email...']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('comp_direccion','Dirección:',['class'=>'col-lg-2 col-sm-2 control-label']) !!}
                        <div class="col-sm-4">
                            {!! Form::text('comp_direccion',$comprobante->direccion,['class'=>' form-control comp_email','placeholder'=>'Dirección...']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('comp_tel','Teléfono:',['class'=>'col-lg-2 col-sm-2 control-label']) !!}
                        <div class="col-sm-4">
                            {!! Form::text('comp_telefono',$comprobante->telefono,['class'=>' form-control comp_telefono','placeholder'=>'Teléfono...']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-lg-10 col-sm-6">
                            {!! Form::button('<i class="fa fa-2x fa-save" aria-hidden="true"></i>',['class'=>'btn btn-sm btn-primary', 'data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>'Guardar','type'=>'submit']) !!}
                            {!! Form::button('<i class="fa fa-2x fa-eraser"></i>',['class'=>'btn btn-sm btn-danger','data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>'Cancelar','type'=>'reset']) !!}
                            <a href="{{ url('runner/pagos') }}" data-toggle="tooltip" data-placement="top"
                               title="Regresar">
                                {!! Form::button('<i class="fa fa-2x fa-chevron-circle-left"></i>',['class'=>'btn btn-sm btn-warning']) !!}
                            </a>
                        </div>
                    </div>

                </div>

                {!! Form::close() !!}

                <!--Fin Contenido-->
            </div><!-- /.box-body -->
        </div><!-- /.box -->



    </div>
</div>
@endsection