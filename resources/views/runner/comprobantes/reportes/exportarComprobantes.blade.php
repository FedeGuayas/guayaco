
{!! Form::open (['url' => 'runner/comprobantes/excel','method' => 'GET','autocomplete'=> 'off',	'role' => 'search','id'=>'export'])!!}
        <div class="hidden">
            {!! Form::date('fecha',$fecha,['class'=>'form-control', 'placeholder'=>'Selecione la fecha']) !!}
            {!! Form::select('usuario',$usuarioSelect,$usuario,['class'=>'form-control'])  !!}
            {!! Form::select('escenario',$escenarioSelect,$escenario,['class'=>'form-control'])  !!}
            {!! Form::submit('Filtrar',['class'=>'btn btn-primary']) !!}
        </div>
<div class="col-lg-2 col-sm-6 col-xs-12">
    {!! Form::label('export','Exportar',['class'=>'label-control']) !!}
    <div class="form-group">
        {!! Form::button('Facturación <i class="fa fa-file"></i>',['class'=>'btn  btn-success','type'=>'submit', 'id'=>'facturar']) !!}
    </div>
</div>

{!! Form::close() !!}
