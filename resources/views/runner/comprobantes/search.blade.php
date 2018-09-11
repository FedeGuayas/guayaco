{!! Form::open (['route' => 'runner.pagos.index','method' => 'GET','autocomplete'=> 'off','role' => 'search' ])!!}
<div class="col-lg-3 col-sm-6 col-xs-12">
    {!! Form::label('fecha','Fecha Insc',['class'=>'label-control']) !!}
    <div class="form-group">
        {!! Form::date('fecha',$fecha,['class'=>'form-control']) !!}
    </div>
</div>
<div class="col-lg-3 col-sm-6 col-xs-12">
    {!! Form::label('escenario','Escenario',['class'=>'label-control']) !!}
    <div class="form-group">
        {{Form::select('escenario',$escenarioSelect,$escenario,['class'=>'form-control']) }}
    </div>
</div>
{{--<div class="col-lg-3 col-sm-6 col-xs-12">--}}
    {{--{!! Form::label('usuario','Usuario',['class'=>'label-control']) !!}--}}
    {{--<div class="form-group">--}}
        {{--{{Form::select('usuario',$usuarioSelect,$usuario,['class'=>'form-control']) }}--}}
    {{--</div>--}}
{{--</div>--}}
<div class="col-lg-2 col-sm-6 col-xs-12">
    {!! Form::label('searchText','Cedula',['class'=>'label-control']) !!}
    <div class="form-group">
        <input type="text" class="form-control" name="searchText" placeholder="Cédula ..." value="{{ $query }}">
    </div>
</div>
<div class="col-lg-1 col-sm-6 col-xs-12">
    <div class="form-group">
        {!! Form::button('<i class="fa fa-search"></i>',['class'=>'btn btn-info','type'=>'submit', 'data-toggle'=>'tooltip','data-placement'=>'top','title'=>'Filtrar']) !!}
    </div>
</div>

{!! Form::close() !!}
