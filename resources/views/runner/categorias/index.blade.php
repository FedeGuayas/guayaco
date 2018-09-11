@extends('layouts.admin')
@section('contenido')
 	
 	<div class="row">
 		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			@include('alert.success')
			<h3>Listado de Categorías
				<a href="categorias/create" class="btn btn-success" data-toggle="tooltip" data-placement="top"
				   title="Nueva">
					<i class="fa fa-plus"></i>
				</a>
			</h3>
{{-- 			 @include('runner.categorias.search')--}}
 		</div>
 	</div>

	<div class="row">
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th>Id</th>
						<th>Categorías</th>
						<th>Estado</th>
						<th>Editar</th>
					</thead>
					@foreach ($categorias as $cat)
					<tr>
						<td>{{ $cat->id }}</td>
						<td>{{ $cat->categoria }}</td>
						<td>
							@if($cat->estado=='1')
								<span class="label label-success">Activo</span>
								<a href="#!" data-target="#modal-delete-{{ $cat->id }}" data-toggle="modal" class="btn btn-xs btn-success" >
									<i class="fa fa-check" aria-hidden="true"></i>
									Deshabilitar
								</a>
							@else
								<span class="label label-danger">Inactivo</span>
								<a href="#!" data-target="#modal-delete-{{ $cat->id }}" data-toggle="modal" class="btn btn-xs btn-danger">
									<i class="fa fa-square-o" aria-hidden="true"></i>
									Activar
								</a>
							@endif
						</td>
						<td>
							<a href="{{ route('runner.categorias.edit', $cat->id ) }}" class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top" title="Editar">
								<i class="fa fa-edit"></i>
							</a>
							{{--<a href="" data-target="#modal-delete-{{ $cat->id }}" data-toggle="modal"><button type="button" class="btn btn-danger">Eliminar</button></a>--}}
						</td>
					</tr>
					@include ('runner.categorias.modal')
					@endforeach
				</table>
			</div>
			{{ $categorias->render() }}
		</div>
	</div>

@endsection