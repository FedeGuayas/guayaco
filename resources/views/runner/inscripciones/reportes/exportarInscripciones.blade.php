{!! Form::open (['url' => 'runner/inscripciones/excel',	'method' => 'GET', 'autocomplete'=> 'off', 'role' => 'search' ])!!}
        <div class="hidden">
            {!! Form::date('fecha',$fecha,['class'=>'form-control', 'placeholder'=>'Seleccione la fecha', 'hidden']) !!}
            {{Form::select('usuario',$usuarioSelect,$usuario,['class'=>'form-control']) }}
            {{Form::select('escenario',$escenarioSelect,$escenario,['class'=>'form-control']) }}
        </div>

{!! Form::button('Inscripciones <i class="fa fa-file-excel-o" aria-hidden="true"></i>',['class'=>'btn  btn-success','type'=>'submit','data-toggle'=>'tooltip','data-placement'=>'top','title'=>'Exportar Inscripciones']) !!}

{!! Form::close() !!}