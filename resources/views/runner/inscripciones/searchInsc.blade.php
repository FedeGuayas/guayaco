{!! Form::open (array('route' => 'runner.inscripciones.index','method' => 'GET','autocomplete'=> 'off','role' => 'search' ))!!}
<div class="form-inline">
    <div class="input-group">
        <input type="text" class="form-control" name="searchText" placeholder="CI, Nombres, Apellidos">
			<span class="input-group-btn">
				{!! Form::button('<i class="fa fa-search" aria-hidden="true"></i>',['class'=>'btn btn-info','type'=>'submit','data-toggle'=>'tooltip','data-placement'=>'top','title'=>'Buscar']) !!}
			</span>
    </div>
</div>
{!! Form::close() !!}