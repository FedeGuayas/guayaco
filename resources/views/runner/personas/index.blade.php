@extends('layouts.admin')
@section('contenido')

    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-8 col-xs-12">
            @include('alert.success')
            <h3>Listado de Personas
                <a href="personas/create" class="btn btn-success" data-toggle="tooltip" data-placement="top"
                   title="Nuevo">
                    <i class="fa fa-plus"></i>
                </a>
            </h3>
            @include('runner.personas.search')
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover ">
                    <thead>
                    {{--<th>Id</th>--}}
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Tipo Documento</th>
                    <th>Numero Documento</th>
                    <th>Genero</th>
                    <th>Fecha Nacimiento</th>
                    <th>Email</th>
                    <th>Direccion</th>
                    <th>Telefono</th>
                    <th colspan="3">Opciones</th>
                    </thead>
                    @foreach ($personas as $pers)
                        <tr>
                            {{--<td>{{ $pers->id }}</td>--}}
                            <td>{{ $pers->nombres }}</td>
                            <td>{{ $pers->apellidos }}</td>
                            <td>{{ $pers->tipo_doc }}</td>
                            <td>{{ $pers->num_doc }}</td>
                            <td>{{ $pers->genero }}</td>
                            <td>{{ $pers->fecha_nac }}</td>
                            <td>{{ $pers->email }}</td>
                            <td>{{ $pers->direccion }}</td>
                            <td>{{ $pers->telefono}}</td>

                            <td>
                                <a href="{{ URL::action('InscripcionController@create', $pers->id )}}"
                                   data-toggle="tooltip" data-placement="top" title="Inscribir">

                                    {!! Form::button(' <i class="fa fa-pencil" aria-hidden="true"></i> Inscribir',['class'=>'btn btn-xs btn-primary']) !!}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('runner.personas.edit', $pers->id ) }}" class="btn btn-xs btn-success"
                                   data-toggle="tooltip" data-placement="top" title="Editar">
                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                </a>
                            </td>
                            <td>
                                @if (Auth::user()->rols_id==1)
                                    <a href="#!" data-target="#modal-delete-{{ $pers->id }}" data-toggle="modal"
                                       data-placement="top" title="Eliminar" class="btn btn-xs btn-danger">
                                        <i class="fa fa-trash" aria-hidden="true"></i>
                                    </a>

                                    {{--<a href="" data-target="#modal-delete-{{ $pers->id }}" data-toggle="modal">--}}
                                    {{--{!! Form::button('Eliminar',['class'=>'btn btn-danger']) !!}--}}
                                    {{--</a>--}}
                                @endif
                            </td>

                        </tr>
                        @include ('runner.personas.modal')
                    @endforeach
                </table><!--end table-responsive-->
            </div><!-- end div ./table-responsive-->
            {{ $personas->appends(['searchText'=>$searchText])->links() }}
        </div><!--end div ./col-lg-12. etc-->
    </div><!--end div ./row-->

@endsection