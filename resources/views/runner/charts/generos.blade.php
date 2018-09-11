@extends('layouts.front')
@section('contenido')

    <html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf8"/>


    </head>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.2/Chart.min.js"></script>
    <body>

    <div class="row">
        {{--Por Categorias--}}
        <div class="col-md-6">
            <div class="box box-solid box-success">
                <div class="box-header with-border">
                    <h3 class="box-title">Gráfica géneros</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                    <canvas id="generosChart" width="200" height="200"></canvas>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>


    <div class="col-md-6">

        <div class="box box-solid box-success">
            <div class="box-header with-border">
                <h3 class="box-title">Tabla inscripciones por géneros</h3>
                <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                </div><!-- /.box-tools -->
            </div><!-- /.box-header -->
            <div class="box-body">

                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-condensed table-hover">
                        <thead>
                        <th>Géneros</th>
                        <th>Inscripciones</th>
                        </thead>
                            <tr>
                                <td>Masculinos</td>
                                <td>{{$masculinos}}</td>
                            </tr>
                        <tr>
                            <td>Femeninos</td>
                            <td>{{$femeninos}}</td>
                        </tr>
                        <tr>
                            <td class="text-bold text-primary">Total</td>
                            <td>
                                <span class="bg-blue-active badge"> {{ $total}}</span>
                            </td>
                        </tr>
                    </table><!--end table-responsive-->
                </div><!-- end div ./table-responsive-->

            </div><!-- /.box-body -->
        </div><!-- /.box -->

    </div>
    </div>

    </body>
    </html>
    <script>
                {{--Categorias--}}
        var ctx = document.getElementById("generosChart");
        var myChart = new Chart(ctx, {
            type: 'doughnut',
            data: {

                labels: ["Masculinos","Femeninos"],

                datasets: [{
                    label: 'Generos',
                    data: ["{{$masculinos}}","{{$femeninos}}"],
                    backgroundColor: [
                        'rgba(244, 74, 94, 0.4)',
                        'rgba(54, 162, 235, 0.4)',
                        'rgba(255, 206, 86, 0.4)',
                        'rgba(92, 245, 110, 0.4)',
                        'rgba(153, 102, 255, 0.4)',
                        'rgba(255, 159, 64, 0.4)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]

            },
            options: {
//            scales: {
//                yAxes: [{
//                    ticks: {
//                        beginAtZero:true
//                    }
//                }]
//            },
                responsive: true,
                responsiveAnimationDuration: 1000

            }
        });

    </script>

@endsection