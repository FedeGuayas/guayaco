@extends('layouts.admin')
@section('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Rol</h3>
			@include('alert.request')
			{!! Form::open (array('url' => 'runner/roles','method' => 'POST',
					'autocomplete'=> 'off'))!!}
				{{Form::token()}}
				<div class="form-group">
					<label for="nomb_esc">Roles:</label>
					<input type="text" class="form-control" name="rol" placeholder="Rol">
				</div>
				
				<div class="form-group">
					<button type="submit" class="btn btn-primary">Guardar</button>
					<button type="reset" class="btn btn-danger">Cancelar</button>
					<a href="{{ url('runner/roles') }}"><button type="button" class="btn btn-warning">Regresar</button></a>
				</div>
			{!! Form::close() !!}

		</div>
	</div>  
@endsection