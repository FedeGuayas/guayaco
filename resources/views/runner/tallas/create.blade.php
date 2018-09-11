@extends('layouts.admin')
@section('contenido')

    <div class="row">
        <div class="col-md-6">
            <h3>Nueva Talla</h3>
            @include('alert.request')
        </div>
    </div>

    {!! Form::open (['route' => 'runner.tallas.store','method' => 'POST','autocomplet'=> 'off'])!!}
    {{Form::token()}}
    <div class="row">
        <div class="col-lg-2">
            <div class="form-group">
                <label for="talla">Talla:</label>
                <input type="text" class="form-control" name="talla">
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <label for="color">Color:</label>
                {{Form::select('color',['N'=>'Negra','B'=>'Blanca'],'N',['class'=>'form-control','id'=>'color', 'required']) }}
            </div>
        </div>
        <div class="col-lg-2">
            <div class="form-group">
                <label for="stock">Stock:</label>
                <input type="number" class="form-control" name="stock" step="1" min="0">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Guardar</button>
                <button type="reset" class="btn btn-danger">Cancelar</button>
                <a href="{{ route('runner.tallas.index') }}">
                    <button type="button" class="btn btn-warning">Regresar</button>
                </a>
            </div>
        </div>

    </div>

    {!! Form::close() !!}


@endsection