{!! Form::open (['url' => 'runner/inscripciones/excelChip',	'method' => 'GET', 'autocomplete'=> 'off', 'role' => 'search' ])!!}
<div class="col-lg-5 col-sm-6 col-xs-12">
	<div class="form-group">
		<input type="text" class="form-control" name="searchDesde" placeholder="Número desde..." >
	</div>
</div>
<div class="col-lg-5 col-sm-6 col-xs-12">
	<div class="form-group">
		<input type="text" class="form-control" name="searchHata" placeholder="Número hasta..." >
	</div>
</div>
<div class="col-lg-2 col-sm-6 col-xs-12">
	<div class="form-group">
		{!! Form::button('<i class="fa fa-file-excel-o" aria-hidden="true"></i>',['class'=>'btn btn-success','type'=>'submit','data-toggle'=>'tooltip','data-placement'=>'top','title'=>'Exportar Chips']) !!}
	</div>
</div>
{!! Form::close() !!}