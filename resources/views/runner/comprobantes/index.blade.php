@extends('layouts.admin')
@section('contenido')

    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            @include('alert.success')
            <h3>
                Lista de comprobantes de pago
            </h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-9">
            <div class="box box-default collapsed-box bg-aqua-gradient">
                <div class="box-header with-border">
                    <h3 class="box-title text-navy">Expandir para filtrar y facturar</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body text-navy">
                    @include('runner.comprobantes.search')
                    <div class="col-lg-2 col-sm-6 col-xs-12">
                        {!! Form::label('export','Exportar',['class'=>'label-control']) !!}
                        <div class="form-group">
                            {!! Form::button('Facturación <i class="fa fa-file"></i>',['class'=>'btn  btn-success','type'=>'submit', 'id'=>'b','data-toggle'=>'modal','data-target'=>'#modal-confirm-submit']) !!}
                        </div>
                    </div>
                    {{--@include('runner.comprobantes.reportes.exportarComprobantes')--}}
                    @include ('runner.comprobantes.modal-confirm-submit')
                </div>
            </div>
        </div>
    </div>

    <div class="row">

    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                    <th>Número</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Documento</th>
                    <th>Correo</th>
                    <th>Telefono</th>
                    <th>Dirección</th>
                    <th>Fecha Insc</th>
                    <th>Forma de Pago</th>
                    <th>Valor</th>
                    <th>Escenario</th>
                    <th>Usuario</th>
                    <th colspan="2">Opciones</th>
                    </thead>
                    @foreach ($pagos as $pago )
                        <tr>
                            <td>{{ sprintf("%'.04d",$pago->numero) }}</td>
                            <td>{{ $pago->nombres }}</td>
                            <td>{{ $pago->apellidos }}</td>
                            <td>{{ $pago->num_doc }}</td>
                            <td>{{ $pago->email }}</td>
                            <td>{{ $pago->telefono }}</td>
                            <td>{{ $pago->direccion }}</td>
                            <td>{{ $pago->fecha }}</td>
                            <td>{{ $pago->form_pago }}</td>
                            <td>{{ $pago->costo }}</td>
                            <td>{{ $pago->escenario }}</td>
                            <td>{{ $pago->usuario }}</td>
                            <td>
                                @if((Auth::user()->rols_id==1) )
                                    <a href="{{ URL::action('ComprobanteController@show', $pago->comp_id ) }}"
                                       data-toggle="tooltip" data-placement="top" title="Editar">
                                        {!! Form::button('<i class="fa fa-pencil" aria-hidden="true"></i>',['class'=>'btn btn-xs btn-success']) !!}
                                    </a>
                                @endif
                            </td>
                            <td>
                                <a href="{{ URL::action('ComprobanteController@pagoPDF',$pago->comp_id ) }}"
                                   data-toggle="tooltip" data-placement="top" title="PDF">
                                    {!! Form::button('<i class="fa fa-file-pdf-o" aria-hidden="true"></i>',['class'=>'btn btn-xs btn-danger']) !!}
                                </a>
                            </td>
                        </tr>
                        @include ('runner.comprobantes.modal')
                    @endforeach
                </table><!--end table-responsive-->
            </div><!-- end div ./table-responsive-->
            {{ $pagos->appends(['searchText'=>$query, 'escenario'=>$escenario, 'fecha'=>$fecha])->links() }}
            <div class="text-bold text-primary">Total: <span class="bg-blue-active badge"> {{ $pagos->total()}}</span>
            </div>
        </div><!--end div ./col-lg-12. etc-->
    </div><!--end div ./row-->

    <script src="{{asset('plugins/jQuery/jquery-2.2.3.min.js')}}"></script>

    <script type="text/javascript">
        $(document).ready(function (e) {

            $('#facturar').on('click',function() {

                var c = confirm("Click OK to continue?");
                return c;
            });
        });
    </script>

@endsection

