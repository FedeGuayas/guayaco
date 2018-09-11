{{--<!DOCTYPE html>--}}
{{--<html>--}}
{{--<head>--}}
    {{--<meta charset="utf-8">--}}
    {{--<meta http-equiv="X-UA-Compatible" content="IE=edge">--}}
    {{--<title>FDGuayas | Guayaco Runner 2016</title>--}}
    {{--<!-- Tell the browser to be responsive to screen width -->--}}
    {{--<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">--}}
    {{--<!-- Bootstrap 3.3.5 -->--}}
    {{--<link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">--}}
    {{--<!-- Font Awesome -->--}}
    {{--<link rel="stylesheet" href="{{asset('bootstrap/css/font-awesome.css')}}">--}}
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">--}}
    {{--<!-- Ionicons -->--}}
    {{--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">--}}
    {{--<!-- Datatable style -->--}}
    {{--<link rel="stylesheet" href="{{asset('plugins/datatables/dataTables.bootstrap.css')}}">--}}
{{--    <link rel="stylesheet" href="{{asset('plugins/datatables/jquery.dataTables.css')}}">--}}
    {{--<!-- Theme style -->--}}
    {{--<link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">--}}

    {{--<!-- AdminLTE Skins. Choose a skin from the css/skins--}}
    {{--folder instead of downloading all of them to reduce the load. -->--}}
    {{--<link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">--}}
    {{--<link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}">--}}
    {{--<link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">--}}

{{--</head>--}}
{{--<body class="hold-transition">--}}
{{--<div class="wrapper">--}}
    {{--<div class="content-wrapper">--}}
        {{--<div class="row">--}}
                {{--<div class="col-lg-10 col-lg-offset-1 col-md-12 col-sm-12 col-xs-12">--}}
                {{--<!-- Main content -->--}}
                {{--<section class="content">--}}

                    {{--<div class="box box-solid box-primary">--}}
                        {{--<div class="box-header with-border">--}}
                            {{--<h2 class="box-title">Resultados Guayaco Runner <span class="label label-info">2016</span></h2>--}}

                            {{--<div class="box-tools pull-right">--}}
                                {{--<!-- Buttons, labels, and many other things can be placed here! -->--}}
                                {{--<!-- Here is a label for example -->--}}

                                {{--<button href="{{url('/home')}}" class="btn bg-navy"><i class="fa fa-home"></i> Inicio</button>--}}
                                {{--<!-- This will cause the box to be removed when clicked -->--}}
                                {{--<button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>--}}
                                {{--<!-- This will cause the box to collapse when clicked -->--}}
                                {{--<button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>--}}
                            {{--</div><!-- /.box-tools -->--}}


                        {{--</div><!-- /.box-header -->--}}

                        {{--<div class="box-body">--}}

                            {{--<table id="result_table" class="table table-striped table-bordered" cellspacing="0" width="100%" data-order='[[ 0, "asc" ]]'>--}}
                                {{--<thead>--}}
                                {{--<tr>--}}
                                    {{--<th>Nombre</th>--}}
                                    {{--<th>Primer Apellido</th>--}}
                                    {{--<th>Segundo Apellido</th>--}}
                                    {{--<th>Sexo</th>--}}
                                    {{--<th>Categoria</th>--}}
                                    {{--<th>Circuito</th>--}}
                                    {{--<th>Lugar</th>--}}
                                    {{--<th>Tiempo</th>--}}
                                    {{--<th>Diploma</th>--}}
                                {{--</tr>--}}
                                {{--</thead>--}}
                                {{--<tfoot>--}}
                                {{--<tr>--}}
                                    {{--<th>Nombre</th>--}}
                                    {{--<th>Primer Apellido</th>--}}
                                    {{--<th>Segundo Apellido</th>--}}
                                    {{--<th>Sexo</th>--}}
                                    {{--<th>Categoria</th>--}}
                                    {{--<th>Circuito</th>--}}
                                    {{--<th>Lugar</th>--}}
                                    {{--<th>Tiempo</th>--}}
                                    {{--<th>Diploma</th>--}}
                                {{--</tr>--}}
                                {{--</tfoot>--}}
                            {{--</table>--}}

                        {{--</div><!-- /.box-body -->--}}

                        {{--<div class="box-footer">--}}
                            {{--The footer of the box--}}
                        {{--</div><!-- box-footer -->--}}
                    {{--</div><!-- /.box -->--}}
                {{--</section>--}}
                {{--</div><!-- /.content-wrapper -->--}}

        {{--</div><!-- /.row -->--}}
    {{--</div><!--/.content-wrapper-->--}}
{{--</div><!-- /.wrapper  -->--}}




    {{--<!-- jQuery 2.1.4 -->--}}
    {{--<script src="{{asset('plugins/jQuery/jquery-2.2.3.min.js')}}"></script>--}}
    {{--<!-- Bootstrap 3.3.5 -->--}}
    {{--<script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>--}}
    {{--<!-- Datatable -->--}}
    {{--<script src="{{asset('plugins/datatables/jquery.dataTables.js')}}"></script>--}}
    {{--<script src="{{asset('plugins/datatables/dataTables.bootstrap.js')}}"></script>--}}

    {{--<!-- AdminLTE App -->--}}
    {{--<script src="{{asset('dist/js/app.min.js')}}"></script>--}}
    {{--<!-- Mis Script -->--}}
    {{--<script src="{{asset('dist/js/scripts.js')}}"></script>--}}



{{--<script type="text/javascript">--}}
    {{--$(document).ready( function () {--}}

            {{--$('#result_table').DataTable({--}}
            {{--lengthMenu: [[2, 5, 10, 25], [ 2, 5, 10, 25]],--}}
            {{--processing: true,--}}
            {{--serverSide: false,--}}
            {{--ajax: '{!! route('result.data') !!}',--}}
            {{--"columns":[--}}
                {{--{data:'first_name'},--}}
                {{--{data:'second_name'},--}}
                {{--{data:'last_name'},--}}
                {{--{data:'sex'},--}}
                {{--{data:'category'},--}}
                {{--{data:'circuit'},--}}
                {{--{data:'place'},--}}
                {{--{data:'time'},--}}
                {{--{data: 'action', name: 'action', orderable: false, searchable: false}--}}
            {{--],--}}
{{--//                initComplete: function () {--}}
{{--//                    this.api().columns().every(function () {--}}
{{--//                        var column = this;--}}
{{--//                        var input = document.createElement("input");--}}
{{--//                        $(input).appendTo($(column.footer()).empty())--}}
{{--//                                .on('change', function () {--}}
{{--//                                    column.search($(this).val(), false, false, true).draw();--}}
{{--//                                });--}}
{{--//                    });--}}
{{--//                },--}}

           {{--language:{--}}
               {{--"decimal":        "",--}}
               {{--"emptyTable":     "No se encontraron datos en la tabla",--}}
               {{--"info":           "Mostrando _START_ a _END_ de _TOTAL_ registros",--}}
               {{--"infoEmpty":      "Mostrando 0 a 0 de 0 registros",--}}
               {{--"infoFiltered":   "(filtrados de un total _MAX_ registros)",--}}
               {{--"infoPostFix":    "",--}}
               {{--"thousands":      ",",--}}
               {{--"lengthMenu":     "Mostrar _MENU_ registros",--}}
               {{--"loadingRecords": "Cargando...",--}}
               {{--"processing":     "Procesando...",--}}
               {{--"search":         "Buscar:",--}}
               {{--"zeroRecords":    "No se encrontraron coincidencias",--}}
               {{--"paginate": {--}}
                   {{--"first":      "Primero",--}}
                   {{--"last":       "Ultimo",--}}
                   {{--"next":       "Siguiente",--}}
                   {{--"previous":   "Anterior"--}}
               {{--},--}}
               {{--"aria": {--}}
                   {{--"sortAscending":  ": Activar para ordenar ascendentemente",--}}
                   {{--"sortDescending": ": Activar para ordenar descendentemente"--}}
               {{--}--}}
           {{--}--}}
       {{--});--}}

        {{--$(function () {--}}
            {{--$('[data-toggle="tooltip"]').tooltip()--}}
        {{--});--}}

    {{--} );--}}
{{--</script>--}}




{{--</body>--}}
{{--</html>--}}