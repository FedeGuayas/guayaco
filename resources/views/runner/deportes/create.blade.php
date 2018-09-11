@extends('layouts.admin')
@section('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Deporte</h3>
			
			@include('alert.request')

			{!! Form::open (array('url' => 'runner/deportes','method' => 'POST',
					'autocomplet'=> 'off'))!!}
				{{Form::token()}}
				<div class="form-group">
					<label for="nomb_cat">Deporte:</label>
					<input type="text" class="form-control" name="deporte" placeholder="Deporte...">
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