<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="modal-confirm-submit">
    {!! Form::open (['url' => 'runner/comprobantes/excel','method' => 'GET','autocomplete'=> 'off',	'role' => 'search','id'=>'export'])!!}
    <div class="hidden">
        {!! Form::date('fecha',$fecha,['class'=>'form-control', 'placeholder'=>'Selecione la fecha']) !!}
        {!! Form::select('usuario',$usuarioSelect,$usuario,['class'=>'form-control'])  !!}
        {!! Form::select('escenario',$escenarioSelect,$escenario,['class'=>'form-control'])  !!}
        {!! Form::submit('Filtrar',['class'=>'btn btn-primary']) !!}
    </div>

    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hiden="true">x</span>
                </button>
                <h4 class="modal-title">Exportar Facturación</h4>
            </div>
            <div class="modal-body">
                <p>Todos los números de cédula incorrectos o pasaportes  será convertidos a consumidor final
                    Confirme para continua</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-primary">Confirmar</button>
            </div>
        </div>
    </div>
    {{Form::Close()}}
</div>




{{--<div class="col-lg-2 col-sm-6 col-xs-12">--}}
    {{--{!! Form::label('export','Exportar',['class'=>'label-control']) !!}--}}
    {{--<div class="form-group">--}}
        {{--{!! Form::button('Facturación <i class="fa fa-file"></i>',['class'=>'btn  btn-success','type'=>'submit', 'id'=>'facturar']) !!}--}}
    {{--</div>--}}
{{--</div>--}}

{{--{!! Form::close() !!}--}}