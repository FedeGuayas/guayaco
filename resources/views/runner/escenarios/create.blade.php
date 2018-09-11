@extends('layouts.admin')
@section('contenido')
	<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nuevo Escenario</h3>
			@include('alert.request')
			{!! Form::open (array('url' => 'runner/escenarios','method' => 'POST',
					'autocomplete'=> 'off'))!!}
				{{Form::token()}}
				<div class="form-group">
					<label for="nomb_esc">Escenario:</label>
					<input type="text" class="form-control" name="escenario" placeholder="Escenario">
				</div>
				
				<div class="form-group">
					{!! Form::button('<i class="fa fa-2x fa-save" aria-hidden="true"></i>',['class'=>'btn btn-sm btn-primary', 'data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>'Guardar','type'=>'submit']) !!}
					{!! Form::button('<i class="fa fa-2x fa-eraser"></i>',['class'=>'btn btn-sm btn-danger','data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>'Cancelar','type'=>'reset']) !!}
					<a href="{{ url('runner/escenarios') }}" data-toggle="tooltip" data-placement="top" title="Regresar">
						{!! Form::button('<i class="fa fa-2x fa-chevron-circle-left"></i>',['class'=>'btn btn-sm btn-warning','data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>'Regresar']) !!}
					</a>
				</div>
			{!! Form::close() !!}

		</div>
	</div>  
@endsection