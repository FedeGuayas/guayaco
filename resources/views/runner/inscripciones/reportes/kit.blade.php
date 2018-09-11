@extends('layouts.admin')
@section('contenido')

    <div class="row">
        <div class="col-lg-6 col-md-8 col-sm-8 col-xs-12">
            @include('alert.success')
            {{--@include('runner.inscripciones.searchKit')--}}
        </div>
    </div>
    <div class="box-tools pull-right">
        <div class="has-feedback">
            {!! Form::open (array('route' => 'runner.inscripciones.kit','method' => 'GET',	'autocomplete'=> 'off',
                                  'role' => 'search' ))!!}
            <input type="text" class="form-control input-sm" name="searchText" placeholder="Apellidos o CI..."
                   value="{{$searchText}}">
            <span class="glyphicon glyphicon-search form-control-feedback"></span>
            {!! Form::close() !!}

        </div><!-- /.box-tools -->
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Entrega de KITS</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div><!-- /.box-header -->

                <div class="box-body">
                    <!--Contenido-->
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-condensed table-hover">
                            <thead>
                            <th>Número</th>
                            <th>DNI</th>
                            <th>Apellidos</th>
                            <th>Nombres</th>
                            <th>Circuito</th>
                            <th>Categoría</th>
                            <th>Talla</th>
                            <th>Kit</th>
                            <th>Acción</th>
                            </thead>
                            @foreach ($inscripciones as $ins)
                                <tr>
                                    <td>{{ sprintf("%'.04d",$ins->num_corredor) }}</td>
                                    <td>{{ $ins->num_doc }}</td>
                                    <td>{{ $ins->apellidos}}</td>
                                    <td>{{ $ins->nombres }}</td>
                                    <td>{{ $ins->circuito }}</td>
                                    <td>{{ $ins->categoria }}</td>
                                    <td>{{ $ins->talla }}
                                        @if ($ins->color=='N')
                                            - (Negra)
                                        @elseif($ins->color=='B')
                                            - (Blanca)
                                        @endif
                                    </td>
                                    <td>
                                        @if ( $ins->kit == '1' )
                                            <span class="label label-warning">Por entregar</span>
                                        @else
                                            <span class="label label-danger">Entregado</span>
                                    @endif
                                    <td>
                                        @if ( $ins->kit == '1' )
                                            <a href="{{ route('runner.inscripciones.entregarKit',$ins->id ) }}">
                                                {!! Form::button('Entregar',['class'=>'btn btn-sm btn-success pull-right']) !!}
                                            </a>
                                        @endif
                                        {{--@if (Auth::user()->rols_id==1)--}}
                                        {{--<a href="" data-target="#modal-delete-{{ $ins->id }}" data-toggle="modal">--}}
                                        {{--{!! Form::button('Eliminar',['class'=>'btn btn-danger']) !!}--}}
                                        {{--</a>--}}
                                        {{--@endif--}}
                                    </td>
                                </tr>
                                {{--@include ('runner.inscripciones.modal')--}}
                            @endforeach
                        </table><!--end table-responsive-->
                    </div><!-- end div ./table-responsive-->
                    {{ $inscripciones->appends(['searchText'=>$searchText])->links() }}
                </div><!--end div ./box-->
            </div><!--end div ./box-body-->
        </div><!--end div ./col-->
    </div><!--end div ./row-->




@endsection