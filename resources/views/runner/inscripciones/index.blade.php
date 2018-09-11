@extends('layouts.admin')
@section('contenido')

    <div class="row">
        <div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
            @include('alert.success')
            <h3>Listado de Inscripciones
                <a href="personas/create" class="btn btn-success" data-toggle="tooltip" data-placement="top"
                   title="Nuevo Corredor">
                    <i class="fa fa-plus"></i> <i class="fa fa-male"></i>
                </a>
            </h3>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="box box-default collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title">Filtro por fecha y escenario</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    @include('runner.inscripciones.search')
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-6">
            <div class="box box-default collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title">Exportar Inscripciones</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    @include('runner.inscripciones.reportes.exportarInscripciones')
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="box box-default collapsed-box">
                <div class="box-header with-border">
                    <h3 class="box-title">Exportar Chips</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    @if (Auth::user()->rols_id==1)
                        @include('runner.inscripciones.reportes.exportarChip')
                    @endif
                </div>
            </div>
        </div>

    </div>

    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        {{--Filtra por numero de corredor --}}
        @include('runner.inscripciones.searchInsc')
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                    <th>Número</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Num Doc</th>
                    <th>Categoría</th>
                    <th>Circuito</th>
                    <th>Género</th>
                    <th>Fecha Insc</th>
                    <th>Inscribe</th>
                    <th>Escenario</th>
                    <th>Valor</th>
                    <th>recomendado</th>
                    <th colspan="2">Opciones</th>
                    </thead>
                    @foreach ($inscripcion as $ins)

                        <tr>
                            <td>{{ sprintf("%'.04d",$ins->num_corredor) }}</td>
                            <td>{{ $ins->nombres }}</td>
                            <td>{{ $ins->apellidos}}</td>
                            <td>{{ $ins->num_doc }}</td>
                            <td>{{ $ins->categoria }}</td>
                            <td>{{ $ins->circuito }}</td>
                            <td>{{ $ins->genero }}</td>
                            <td>{{ $ins->created_at }}</td>
                            <td>{{ $ins->user }}</td>
                            <td>{{ $ins->esc }}</td>
                            <td>{{ $ins->costo }}</td>
                            <td>{{ $ins->recomendado }}</td>
                            <td>
                                @if((Auth::user()->id==$ins->user_id) || (Auth::user()->rols_id==1) )
                                    <a href="{{ URL::action('InscripcionController@edit', $ins->id) }}"
                                       data-toggle="tooltip" data-placement="top" title="Editar">
                                        {!! Form::button(' <i class="fa fa-pencil" aria-hidden="true"></i>',['class'=>'btn btn-xs btn-success']) !!}
                                    </a>
                                @endif
                            </td>
                            <td>
                                @if((Auth::user()->id==$ins->user_id) || (Auth::user()->rols_id==1) )
                                    <a href="" data-target="#modal-delete-{{ $ins->id }}" data-toggle="modal"
                                       data-placement="top" title="Eliminar" class="btn btn-xs btn-danger">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </a>
                                @endif
                            </td>
                        </tr>
                        @include ('runner.inscripciones.modal')
                    @endforeach
                </table><!--end table-responsive-->
            </div><!-- end div ./table-responsive-->
            {{ $inscripcion->appends(['usuario'=>$usuario, 'escenario'=>$escenario, 'fecha'=>$fecha])->links() }}
            <div class="text-bold text-primary">Total: <span
                        class="bg-blue-active badge"> {{ $inscripcion->total()}}</span></div>
        </div><!--end div ./col-lg-12. etc-->
    </div><!--end div ./row-->

@endsection