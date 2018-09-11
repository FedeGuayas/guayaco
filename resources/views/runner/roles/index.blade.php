@extends('layouts.admin')
@section('contenido')
 	
 	<div class="row">
 		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			@include('alert.success')
 			<h3>Listado de Roles <a href="roles/create"><button type="button" class="btn btn-success">Nuevo</button></a> </h3>
 			 @include('runner.roles.search')
 		</div>
 	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Id</th>
						<th>Roles</th>
						<th>Opciones</th>
					</thead>
					@foreach ($roles as $rol)
					<tr>
						<td>{{ $rol->id }}</td>
						<td>{{ $rol->rol }}</td>
						<td>
							<a href="{{ URL::action('RolesController@edit', $rol->id ) }}"><button type="button" class="btn btn-info">Editar</button></a>
							<a href="" data-target="#modal-delete-{{ $rol->id }}" data-toggle="modal"><button type="button" class="btn btn-danger">Eliminar</button></a>
						</td>
					</tr>
					@include ('runner.roles.modal')
					@endforeach
				</table>
			</div>
			{{ $roles->render() }}
		</div>
	</div>

@endsection