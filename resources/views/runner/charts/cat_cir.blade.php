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
                    <h3 class="box-title">Categorías VS Circuitos</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    </div><!-- /.box-tools -->
                </div><!-- /.box-header -->
                <div class="box-body">
                    <canvas id="catCirChart" width="200" height="200"></canvas>
                </div><!-- /.box-body -->
            </div><!-- /.box -->
        </div>

    </div>

    </body>
    </html>
    <script>




        var data = {

            labels: [  @foreach ($circuitoArray as $c)
                    "{{$c['labels']}}",
                @endforeach
                ],
            datasets: [
                {
                    label: "Discapacitados",

                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1,
                    data: [ @foreach ($categoriaArray as $c)
                            "{{$c['cantidad']}}",
                        @endforeach],
                }

            ]

        };


        var ctx = document.getElementById("catCirChart");
        var myBarChart = new Chart(ctx, {
            type: 'bar',
            data: data,

            options: {
                scales: {
                    xAxes: [{
                        stacked: true
                    }],
                    yAxes: [{
                        stacked: true
                    }]
                },
                responsive: true,
                hover: {
                    // Overrides the global setting
                    mode: 'label'
                },
                responsiveAnimationDuration: 1000,
            }

        });








    </script>

@endsection