<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>FDGuayas | Guayaco Runner 2016</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('bootstrap/css/font-awesome.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('dist/css/skins/_all-skins.min.css')}}">
    <link rel="apple-touch-icon" href="{{asset('img/apple-touch-icon.png')}}">
    <link rel="shortcut icon" href="{{asset('img/favicon.ico')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
</head>
<body class="hold-transition skin-blue ">
<div class="wrapper">
    <div class="row">
        <div class="col-lg-3"></div>
        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">

            {{--<div class="content-wrapper">--}}
                <!-- Main content -->
                <section class="content">
                    <div class="row">
                        <div class="col-lg-6 col-md-12 col-sm-12 col-xs-12">
                            <div class="box">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Formulario pre-inscripción Guayaco Runner 2016</h3>
                                    @include('alert.request')
                                    @include('alert.success')
                                </div><!-- /.box-header -->
                                <div class="box-body">

                                    {!! Form::open (array('url' => '/online','method' => 'POST','autocomplete'=> 'off'))!!}
                                    {{Form::token()}}
                                    <div class="form-group">
                                        {!! Form::label('Nombres:*') !!}
                                        {!! Form::text('nombres',null,['class'=>'form-control','placeholder'=>'Nombres...','required']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('Apellidos:*') !!}
                                        {!! Form::text('apellidos',null,['class'=>'form-control','placeholder'=>'Apellidos...','required']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('Tipo documento:*') !!}
                                        {{  Form::select('tipo_doc', array('CEDULA' => 'Cedula', 'PASAPORTE' => 'Pasaporte', 'NoDoc' => 'NoDoc'),'CEDULA') }}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('Número del documento:*') !!}
                                        {!! Form::text('num_doc',null,['class'=>'form-control','placeholder'=>'CI...','required']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('Género:*') !!}
                                        {{  Form::select('genero', array('Masculino' => 'Masculino', 'Femenino' => 'Femenino')) }}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('Fecha de Nacimiento:*') !!}
                                        {{  Form::date('fecha_nac',null,['required']) }}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('Correo:') !!}
                                        {!! Form::email('email',null,['class'=>'form-control','placeholder'=>'Email...','required']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('Dirección:') !!}
                                        {!! Form::text('direccion',null,['class'=>'form-control','placeholder'=>'Dirección...','required']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('Teléfono:') !!}
                                        {!! Form::text('telefono',null,['class'=>'form-control','placeholder'=>'Telefono...','required']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::submit('Guardar',['class'=>'btn btn-primary']) !!}
                                        {!! Form::reset('Cancelar',['class'=>'btn btn-danger']) !!}
                                        <a href="{{ url('http://www.fedeguayas.com.ec/') }}">
                                            {!! Form::button('Inicio',['class'=>'btn btn-warning']) !!}
                                        </a>
                                    </div>
                                    {!! Form::close() !!}
                                </div><!-- /.body -->
                            </div><!-- /.box -->
                        </div><!-- /.col-12 -->
                    </div><!-- /.row -->
                </section>
            </div><!-- /.content-wrapper -->
        </div><!-- /.col-6 -->
    </div><!-- /.row -->
</div><!-- /.wrapper  -->


    <!-- jQuery 2.1.4 -->
    <script src="{{asset('plugins/jQuery/jquery-2.2.3.min.js')}}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('dist/js/app.min.js')}}"></script>
    <!-- Mis Script -->
    <script src="{{asset('dist/js/scripts.js')}}"></script>
</div>
</body>
</html>