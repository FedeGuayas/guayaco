@extends('layouts.admin')
@section('contenido')
 	
 	<div class="row">
 		<div class="col-lg-4 col-md-6 col-sm-8 col-xs-12">
			@include('alert.success')
			<h3>Listado de Escenarios
				<a href="escenarios/create" class="btn btn-success" data-toggle="tooltip" data-placement="top"
				   title="Nuevo">
					<i class="fa fa-plus"></i>
				</a>
			</h3>
 			 @include('runner.escenarios.search')
 		</div>
 	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Id</th>
						<th>Escenario</th>
						<th>Opciones</th>
					</thead>
					@foreach ($escenarios as $esc)
					<tr>
						<td>{{ $esc->id }}</td>
						<td>{{ $esc->escenario }}</td>
						<td>
							<a href="{{ route('runner.escenarios.edit', $esc->id ) }}" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Editar">
								<i class="fa fa-edit"></i>
							</a>
							<a href="#!" data-target="#modal-delete-{{ $esc->id }}" data-toggle="modal" data-placement="top" title="Eliminar" class="btn btn-xs btn-danger">
								<i class="fa fa-trash" aria-hidden="true"></i>
							</a>
						</td>
					</tr>
					@include ('runner.escenarios.modal')
					@endforeach
				</table>
			</div>
			{{ $escenarios->render() }}
		</div>
	</div>

@endsection