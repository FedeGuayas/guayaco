@extends('layouts.admin')
@section('contenido')

    <div class="row">
        <div class="col-xs-12 col-sm-6 col-md-6">
            @include('alert.success')
        </div>
    </div>

    <div class="row">

        <div class="col-xs-12 col-sm-6 col-md-6">
            <div class="box box-warning">
                <div class="box-header with-border">
                    <h3 class="box-title text-yellow">
                       <i class="fa fa-warning"></i> Cierres
                    </h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div><!-- /.box-header -->
                {!! Form::open(['route' => 'runner.config.cierre'],['method' => 'get']) !!}
                <div class="box-body">
                    <p>El cierre se debe realizar despues de finalizada la temporada y antes del fin de año actual.</p>
                    <p>Al realizar el mismo se respaldará la información de la tabla de inscripciones, asi como se truncarán las tablas de los chips, comprobantes e inscripciones</p>
                    <div class="col-sm-6">
                    <div class="form-group">
                    {!! Form::label('year','Año:',['class'=>'col-lg-4 col-sm-4 control-label']) !!}
                    {!! Form::number('year',null,['class'=>' form-control','placeholder'=>'2016', 'onKeyPress'=>'if(this.value.length==4) return false;']) !!}
                    </div>
                        </div>
                </div>
                <div class="box-footer">
                    <div class="col-xs-12 col-sm-6 col-md-6 ">
                        {!! Form::button('<i class="fa fa-check-circle-o" aria-hidden="true"></i>',['class'=>'btn btn-warning', 'data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>'Proceder','type'=>'submit','step' => '1','min' => '2016']) !!}
                    </div>
                </div><!-- box-footer -->
                {!! Form::close() !!}
            </div>
        </div>

    </div>






@endsection