@extends('layouts.admin')
@section('contenido')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-info">
                <div class="panel-heading">
                    {{Auth::user()->nombre}}
                </div>

                <div class="panel-body">
                    <h4>
                        Esta ha sido su labor en el sistema de inscripción de Guayaco Runner 2017
                    </h4>
                    <p>Inscripciones: <b>{{Auth::user()->inscripciones->count()}}</b></p>
                    <p>Valor Total: <b>{{'$'.sprintf("%'2d.00",Auth::user()->inscripciones->sum('costo'))}}</b></p>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
