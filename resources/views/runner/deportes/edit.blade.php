@extends('layouts.admin')
@section('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar Deporte: {{ $deporte ->deporte }}</h3>
			
			@include('alert.request')

			{!! Form::model($deporte,['method'=>'PATCH','route'=>['runner.deportes.update',$deporte->id]])!!}
				{{Form::token()}}
				<div class="form-group">
					<label for="nombres">Deporte:</label>
					<input type="text" class="form-control" name="deporte" value="{{ $deporte->deporte }}" placeholder="Deporte...">
				</div>
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Guardar</button>
					<button type="reset" class="btn btn-danger">Cancelar</button>
					<a href="{{ url('runner/deportes') }}"><button type="button" class="btn btn-warning">Regresar</button></a>
				</div>
			{!! Form::close() !!}

		</div>
	</div>  
@endsection