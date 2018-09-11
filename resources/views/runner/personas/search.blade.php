{!! Form::open (array('url' => 'runner/personas', 
					'method' => 'GET', 
					'autocomplete'=> 'off',
					'role' => 'search' ))!!}
	<div class="form-group">
		<div class="input-group">
			<input type="text" class="form-control" name="searchText" placeholder="Numero documento...Nombres...Apellidos..." value="{{ $searchText }}">
			<span class="input-group-btn">
				{!! Form::button('<i class="fa fa-search"></i>',['class'=>'btn btn-info', 'type'=>'submit', 'data-toggle'=>'tooltip', 'data-placement'=>'top','title'=>'Buscar']) !!}
			</span>
		</div>
	</div>
{!! Form::close() !!}