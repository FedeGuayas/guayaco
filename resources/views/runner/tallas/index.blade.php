@extends('layouts.admin')
@section('contenido')

    <div class="row">
        <div class="col-md-6 col-sm-8 col-xs-12">
            @include('alert.success')
            <h3>Listado de Tallas
                <a href="{{route('runner.tallas.create') }}" class="btn btn-success" data-toggle="tooltip"
                   data-placement="top"
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

                    <th>Talla</th>
                    <th>Stock</th>
                    <th>Color</th>
                    <th>Estado</th>
                    <th></th>
                    </thead>
                    @foreach ($tallas as $t)
                        <tr>
                            <td>{{ $t->talla }}</td>
                            <td>{{$t->stock}}</td>
                            <td>{{$t->color=='N' ? 'Negra' : 'Blanca'}}</td>
                            <td>
                                @if($t->status==\App\Talla::TALLA_DISPONIBLE)
                                    <span class="label label-success">DISPONIBLE</span>
                                @else
                                    <span class="label label-danger">AGOTADA</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('runner.tallas.edit', $t->id ) }}"
                                   class="btn btn-xs btn-success" data-toggle="tooltip" data-placement="top"
                                   title="Editar">
                                    <i class="fa fa-edit"></i>
                                    Editar
                                </a>
                                <a href="#!" data-target="#modal-delete-{{ $t->id }}" data-toggle="modal" title="Eliminar"
                                   class="btn btn-xs btn-danger">
                                    <i class="fa fa-trash-o" aria-hidden="true"></i>
                                    Eliminar
                                </a>
                                {{--<a href="" data-target="#modal-delete-{{ $cat->id }}" data-toggle="modal"><button type="button" class="btn btn-danger">Eliminar</button></a>--}}
                            </td>
                        </tr>
                        @include ('runner.tallas.modal')
                    @endforeach
                </table>
            </div>
            {{--{{ $categorias->render() }}--}}
        </div>
    </div>

@endsection