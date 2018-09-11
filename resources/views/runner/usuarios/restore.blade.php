@extends('layouts.admin')
@section('contenido')

    <div class="row">
        <div class="col-lg-4 col-md-6 col-sm-8 col-xs-12">
            @include('alert.success')
            <h3>Restaurar Usuarios</h3>
            {!! Form::open (['url' => 'runner/usuarios/restore','method' => 'GET', 'autocomplete'=> 'off', 'role' => 'search'])!!}
            <div class="form-group">
                <div class="input-group">
                    <input type="text" class="form-control" name="searchText" placeholder="Nombre" value="{{ $searchText }}">
                    <span class="input-group-btn">
				{!! Form::button('<i class="fa fa-search"></i>',['class'=>'btn btn-info', 'type'=>'submit', 'data-toggle'=>'tooltip', 'data-placement'=>'top','title'=>'Buscar']) !!}
			</span>
                </div>
            </div>
            {!! Form::close() !!}
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
                                <a href="{{ URL::action('UsuarioController@postRestore', $user->id ) }}" class="btn btn-sm btn-success" data-toggle="tooltip" data-placement="top" title="Restaurar">
                                    <i class="fa fa-recycle"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table><!--end table-responsive-->
            </div><!-- end div ./table-responsive-->
            {{ $usuarios->appends(['searchText'=>$searchText])->links() }}
        </div><!--end div ./col-lg-12. etc-->
    </div><!--end div ./row-->

@endsection