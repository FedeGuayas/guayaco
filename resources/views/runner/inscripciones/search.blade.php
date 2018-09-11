{!! Form::open (array('route' => 'runner.inscripciones.index',	'method' => 'GET',	'autocomplete'=> 'off',	'role' => 'search' ))!!}
	<div class="col-lg-5 col-sm-6 col-xs-12">
		<div class="form-group">
			{!! Form::date('fecha',$fecha,['class'=>'form-control']) !!}
		</div>
	</div>
	<div class="col-lg-5 col-sm-6 col-xs-12">
		<div class="form-group">
			{{Form::select('escenario',$escenarioSelect,$escenario,['class'=>'form-control']) }}
		</div>
	</div>
	<div class="col-lg-2 col-sm-6 col-xs-12">
		<div class="form-group">
			{!! Form::button('<i class="fa fa-search"></i>',['class'=>'btn btn-info','type'=>'submit', 'data-toggle'=>'tooltip','data-placement'=>'top','title'=>'Filtrar']) !!}
		</div>
	</div>
{!! Form::close() !!}

