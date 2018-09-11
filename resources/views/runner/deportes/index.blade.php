@extends('layouts.admin')
@section('contenido')

    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-8 col-xs-12">
            @include('alert.success')
            <h3>Listado de Deportes
                <a href="deportes/create" class="btn btn-success" data-toggle="tooltip" data-placement="top"
                   title="Nuevo">
                    <i class="fa fa-plus"></i>
                </a>
            </h3>
            @include('runner.deportes.search')
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                    <th>Id</th>
                    <th>Deportes</th>
                    <th>Opciones</th>
                    </thead>
                    @foreach ($deportes as $dep)
                        <tr>
                            <td>{{ $dep->id }}</td>
                            <td>{{ $dep->deporte }}</td>
                            <td>
                                <a href="{{ route('runner.deportes.edit', $dep->id ) }}" class="btn btn-xs btn-success"
                                   data-toggle="tooltip" data-placement="top" title="Editar">
                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                </a>
                                <a href="" data-target="#modal-delete-{{ $dep->id }}" data-toggle="modal"
                                   class="btn btn-xs btn-danger">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                        @include ('runner.deportes.modal')
                    @endforeach
                </table>
            </div>
            {{ $deportes->render() }}
        </div>
    </div>

@endsection