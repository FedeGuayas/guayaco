@extends('layouts.admin')
@section('contenido')

    <div class="row">
        <div class="col-lg-4 col-md-8 col-sm-10 col-xs-12">
            @include('alert.success')
            <h3>Listado de Usuarios
                <a href="usuarios/create" class="btn btn-success" data-toggle="tooltip" data-placement="top" title="Nuevo">
                    <i class="fa fa-plus"></i>
                </a>
                <a href="{{route('runner.usuarios.getrestore')}}" class="btn btn-warning" data-toggle="tooltip" data-placement="top" title="Restaurar">
                    <i class="fa fa-recycle"></i>
                </a>
            </h3>
            @include('runner.usuarios.search')
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-condensed table-hover">
                    <thead>
                    <th>Id</th>
                    <th>User name</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Escenario</th>
                    <th>Rol</th>
                    <th>Avatar</th>
                    <th>Opciones</th>
                    </thead>
                    @foreach ($usuarios as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->nombre }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->escenario }}</td>
                            <td>{{ $user->rol }}</td>
                            <td>
                                <img src="{{ asset('dist/img/users/'.$user->avatar)}}" alt="{{$user->name}}" height="100px" width="100px" class="img-thumbnail">
                            </td>
                            <td>
                                <a href="{{ URL::action('UsuarioController@edit', $user->id ) }}" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Editar"><i class="fa fa-edit" aria-hidden="true"></i>
                                </a>
                                <a href="#!" data-target="#modal-delete-{{ $user->id }}" data-toggle="modal" data-placement="top" title="Eliminar" class="btn btn-xs btn-danger">
                                    <i class="fa fa-trash" aria-hidden="true"></i>
                                </a>
                            </td>
                        </tr>
                        @include ('runner.usuarios.modal')
                    @endforeach
                </table><!--end table-responsive-->
            </div><!-- end div ./table-responsive-->
            {{ $usuarios->appends(['searchText'=>$searchText])->links() }}
            {{--{{ $usuarios->render() }}--}}
        </div><!--end div ./col-lg-12. etc-->
    </div><!--end div ./row-->

@endsection