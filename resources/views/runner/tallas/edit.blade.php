@extends('layouts.admin')
@section('contenido')
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Editar Talla: {{ $talla -> talla }}</h3>

            @include('alert.request')

            {!! Form::model($talla,['method'=>'PATCH','route'=>['runner.tallas.update',$talla->id]])!!}
            {{Form::token()}}

            <div class="row">
                <div class="col-lg-2">
                    <div class="form-group">
                        {!! Form::label('talla','Talla',['class'=>'label-control']) !!}
                        {!! Form::text('talla',null,['class'=>'form-control']) !!}
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        <label for="color">Color:</label>
                        {{Form::select('color',['N'=>'Negra','B'=>'Blanca'],null,['class'=>'form-control','id'=>'color', 'required']) }}
                    </div>
                </div>
                <div class="col-lg-2">
                    <div class="form-group">
                        {!! Form::label('stock','Stock',['class'=>'label-control']) !!}
                        {!! Form::number('stock',null,['class'=>'form-control','step'=>'1','min'=>'0']) !!}
                    </div>
                </div>
            </div>
            <div class="form-group">
                {!! Form::button('<i class="fa fa-2x fa-save" aria-hidden="true"></i>',['class'=>'btn btn-sm btn-primary', 'data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>'Guardar','type'=>'submit']) !!}
                {!! Form::button('<i class="fa fa-2x fa-eraser"></i>',['class'=>'btn btn-sm btn-danger','data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>'Cancelar','type'=>'reset']) !!}
                <a href="{{ route('runner.tallas.index') }}" data-toggle="tooltip" data-placement="top" title="Regresar">
                    {!! Form::button('<i class="fa fa-2x fa-chevron-circle-left"></i>',['class'=>'btn btn-sm btn-warning','data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>'Regresar']) !!}
                </a>
            </div>
            {!! Form::close() !!}

        </div>
    </div>
@endsection