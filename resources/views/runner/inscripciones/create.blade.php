@extends('layouts.admin')
@section('contenido')

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <h1>Nueva Incripción</h1>

        {{--<div class="row">--}}

        @include('alert.request')
        @include('alert.success')
    </div>
    {!! Form::open (['route' => 'runner.inscripciones.store'],['method' => 'POST','autocomplete'=> 'off', 'class'=>'inline'])!!}
    {{Form::token()}}
    {!! Form::hidden('persona_id', $persona->id) !!}
    {!! Form::hidden('deuda', $deuda,['id'=>'deuda']) !!}
    {!! Form::hidden('chip_deuda', $chip_deuda,['id'=>'chip_deuda']) !!}
    {!! Form::hidden('user_id', Auth::user()->id) !!}
    {!! Form::hidden('escenario', Auth::user()->escenario->escenario) !!}

    <div class="row">
        {{--DATOS DE LA PERSONA--}}
        <div class="col-lg-12 col-md-6 col-sm-6 col-xs-12"
             style=" width: 80%;	border: 1px solid #ccc;	margin: 30px; padding: 5px;">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Datos del corredor</h3>
                    <div class="box-tools pull-right">
                        <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                    </div>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <!--Contenido-->
                    <div class="form-horizontal">
                        <div class="col-lg-6">
                            <div class="form-group">
                                {!! Form::label('nombres','Nombres:',['class'=>'col-lg-4 col-sm-4 control-label']) !!}
                                <div class="col-sm-4">
                                    {!!   Form::text('nombres',"$persona->nombres", ['class' => 'form-control','id'=>'nombres','readonly']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('apellidos','Apellidos:',['class'=>'col-lg-4 col-sm-4 control-label']) !!}
                                <div class="col-sm-4">
                                    {!!  Form::text('apellidos',"$persona->apellidos", ['class' => 'form-control','id'=>'apellidos','readonly']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('num_doc','Documento:',['class'=>'col-lg-4 col-sm-4 control-label']) !!}
                                <div class="col-sm-4">
                                    {!!   Form::text('num_doc',"$persona->num_doc", ['class' => 'form-control', 'id'=>'num_doc','readonly']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('tipo_doc','Tipo:',['class'=>'col-lg-4 col-sm-4 control-label']) !!}
                                <div class="col-sm-4">
                                    {!!   Form::text('tipo_doc',"$persona->tipo_doc", ['class' => 'form-control','readonly']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('genero','Género:',['class'=>'col-lg-4 col-sm-4 control-label']) !!}
                                <div class="col-sm-4">
                                    {!!   Form::text('genero',"$persona->genero", ['class' => 'form-control','readonly'])  !!}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                {!! Form::label('fecha_nac','F. nacimiento:',['class'=>'col-lg-4 col-sm-4 control-label']) !!}
                                <div class="col-sm-4 ">
                                    {!!   Form::date('fecha_nac',"$persona->fecha_nac",['class'=>'form-control','readonly'])  !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('email','Correo:',['class'=>'col-lg-4 col-sm-4 control-label']) !!}
                                <div class="col-sm-4 ">
                                    {!! Form::email('email',"$persona->email",['class'=>'form-control','id'=>'email','readonly']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('direccion','Dirección:',['class'=>'col-lg-4 col-sm-4 control-label']) !!}
                                <div class="col-sm-4">
                                    {!! Form::text('direccion',"$persona->direccion",['class'=>'form-control','id'=>'direccion','readonly']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('telefono','Teléfono:',['class'=>'col-lg-4 col-sm-4 control-label']) !!}
                                <div class="col-sm-4">
                                    {!! Form::text('telefono',"$persona->telefono",['class'=>'form-control', 'id'=>'telefono','readonly']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('edad','Edad:',['class'=>'col-lg-4 col-sm-4 control-label']) !!}
                                <div class="col-sm-4 col-lg-2">
                                    {!! Form::text('edad',"$edad",['class'=>'form-control','id'=>'edad','readonly']) !!}
                                </div>
                            </div>
                        </div>
                    </div>{{--/div  form-inline--}}
                </div>{{--/div  box-body--}}
            </div>{{--/div  box --}}
        </div>{{--/div  col-lg-12 col-md-6.... --}}


        {{--DATOS FACTURACION--}}
        <div class="col-lg-6 col-sm-12 col-md-12 col-xs-12">
            <div class="form-horizontal " style=" border: 1px solid #ccc;	margin: 5px; padding: 5px;">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">Datos para Facturación</h3>
                        <div class="box-tools pull-right">
                            <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div><!-- /.box-header -->
                    <div class="box-body">
                        <!--Contenido-->
                        <div class="form-horizontal ">
                            <div class="form-group">
                                {!! Form::label('comp_concepto','Descripción:',['class'=>'col-lg-2 col-sm-2 control-label']) !!}
                                <div class="col-sm-4 col-lg-8">
                                    {!!   Form::text('comp_concepto',$cuenta->descripcion,['class'=>'form-control','readonly'])  !!}
                                </div>
                                <div class="col-sm-4 col-lg-2">
                                    {!! Form::text('comp_cuenta',$cuenta->cuenta,['class'=>' form-control ','readonly',]) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="form-inline">
                                    {!! Form::label('comp_nombres','Nomb-Apll: *',['class'=>'col-lg-2 col-sm-2 control-label']) !!}
                                    <div class="col-sm-4 col-lg-10">
                                        {!! Form::text('comp_nombres',null,['class'=>' form-control','id'=>'comp_nombres','placeholder'=>'Nombres...','required']) !!}
                                        -
                                        {!! Form::text('comp_apellidos',null,['class'=>' form-control ','id'=>'comp_apellidos','placeholder'=>'Apellidos...',  'required']) !!}
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('comp_doc','Documento:*',['class'=>'col-lg-2 col-sm-2 control-label']) !!}
                                <div class="col-sm-4">
                                    {!! Form::text('comp_documento',null,['class'=>' form-control','id'=>'comp_documento','placeholder'=>'Documento...', 'required']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('comp_email','Email:*',['class'=>'col-lg-2 col-sm-2 control-label']) !!}
                                <div class="col-sm-4">
                                    {!! Form::text('comp_email',null,['class'=>' form-control','id'=>'comp_email','placeholder'=>'Email...','required']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('comp_direccion','Dirección:*',['class'=>'col-lg-2 col-sm-2 control-label']) !!}
                                <div class="col-sm-4">
                                    {!! Form::text('comp_direccion',null,['class'=>' form-control','id'=>'comp_direccion','placeholder'=>'Dirección...', 'required']) !!}
                                </div>
                            </div>
                            <div class="form-group">
                                {!! Form::label('comp_tel','Teléfono:*',['class'=>'col-lg-2 col-sm-2 control-label']) !!}
                                <div class="col-sm-4">
                                    {!! Form::text('comp_telefono',null,['class'=>' form-control','id'=>'comp_telefono','placeholder'=>'Teléfono...', 'required']) !!}
                                </div>
                            </div>
                        </div>{{--/div  form-horizontal --}}
                    <!--Fin Contenido-->
                    </div><!-- /.box-body -->
                </div><!-- /.box -->
            </div>{{--/div  form-horizontal --}}
        </div>{{--/div  col-lg-6 col-sm-12--}}


        {{--DATOS INSCRIPCION--}}
        <div class="col-lg-4 col-md-12 col-sm-12  col-xs-12">
            <div class="form-horizontal " style=" border: 1px solid #ccc;	margin: 5px; padding: 5px;">
                <div class="form-group">
                    {!! Form::label('fecha_insc','Fecha inscripción:',['class'=>'col-lg-4 col-sm-2 control-label']) !!}
                    <div class="col-sm-4 col-lg-6">
                        {!!   Form::datetime('fecha_insc',\Carbon\Carbon::now()->format('Y-m-d H:m:s'),['class'=>'form-control','id'=>'fecha_insc','readonly', 'hide'])  !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('categoria','Categoría:*',['class'=>'col-lg-4 col-sm-2 control-label']) !!}
                    <div class="col-sm-4 col-lg-6">
                        {{Form::select('categoria_id',$categoria,null,['class'=>'form-control','id'=>'categoria_id','required']) }}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('circuito','Circuito:*',['class'=>'col-lg-4 col-sm-2 control-label']) !!}
                    <div class="col-sm-4 col-lg-6">
                        {{Form::select('circuito_id',$circuito,null,['class'=>'form-control','id'=>'circuito_id', 'required']) }}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('deporte','Deporte:*',['class'=>'col-lg-4 col-sm-2 control-label']) !!}
                    <div class="col-lg-6 col-sm-4">
                        {{Form::select('deporte_id',$deporte,null,['class'=>'form-control','id'=>'deporte_id', 'disabled']) }}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('talla','Talla:',['class'=>'col-lg-4 col-sm-2 control-label']) !!}
                    <div class="col-sm-6">
                        <div class="input-group">
                            {{Form::select('talla',$talla,null,['class'=>'form-control','id'=>'talla', 'aria-describedby'=>'stock_cant', 'required']) }}
                            <span class="input-group-addon" id="stock_cant">00</span>
                        </div>
                    </div>
                </div>

                {{--<div class="form-group">--}}
                {{--{!! Form::label('recomendado','Recomendado:',['class'=>'col-lg-4 col-sm-2 control-label']) !!}--}}
                {{--<div class="col-sm-4">--}}
                {{--{!! Form::text('recomendado',null,['class'=>' form-control','placeholder'=>'Recomendado...']) !!}--}}
                {{--</div>--}}
                {{--</div>--}}
                <div class="form-group">
                    {!! Form::label('costo','Costo:*',['class'=>'col-lg-4 col-sm-2 control-label']) !!}
                    <div class="col-sm-4 col-lg-3">
                        {!! Form::text('costo',null,['class'=>'form-control','id'=>'costo','placeholder'=>'Costo...','readonly']) !!}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('form_pago','Forma de Pago:*',['class'=>'col-lg-4 col-sm-2 control-label']) !!}
                    <div class="col-sm-4">
                        {{  Form::select('form_pago',['EFECTIVO' => 'EFECTIVO', 'DEPOSITO' => 'DEPOSITO','TARJETA' => 'TARJETA'],null,['class'=>'form-control','id'=>'form_pago'])}}
                    </div>
                </div>
                <div class="form-group">
                    {!! Form::label('promo','Promo grupo:',['class'=>'col-lg-4 col-sm-2 control-label']) !!}
                    <div class="col-sm-4 col-lg-3">
                        {!! Form::checkbox('promo','si',false,['class'=>'promo', 'id'=>'promo','data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>'Solo para grupos mayores o igual a  10 personas, aplicar a cada uno',]) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-lg-10 col-sm-6">
                        {!! Form::button('<i class="fa fa-2x fa-save" aria-hidden="true"></i>',['class'=>'btn btn-sm btn-primary', 'data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>'Guardar','type'=>'submit']) !!}
                        {!! Form::button('<i class="fa fa-2x fa-eraser"></i>',['class'=>'btn btn-sm btn-danger','data-toggle'=>'tooltip', 'data-placement'=>'top', 'title'=>'Cancelar','type'=>'reset']) !!}
                        <a href="{{ url('runner/personas') }}" data-toggle="tooltip" data-placement="top"
                           title="Regresar">
                            {!! Form::button('<i class="fa fa-2x fa-chevron-circle-left"></i>',['class'=>'btn btn-sm btn-warning']) !!}
                        </a>
                    </div>
                </div>
            </div>{{--/div  form-horizontal --}}
        </div>{{--/div  col-lg-4 col-md-12--}}
    </div>{{--/div  row --}}

    @include ('runner.inscripciones.modal-deuda')



    {!! Form::close() !!}
    {{--</div>--}}


    <script src="{{asset('plugins/jQuery/jquery-2.2.3.min.js')}}"></script>

    <script type="text/javascript">

        //cargar en los input de facturacion los datos del corredor
        $(document).ready(function () {
            $("#comp_nombres").val($("#nombres").val());
            $("#comp_apellidos").val($("#apellidos").val());
            $("#comp_documento").val($("#num_doc").val());

            var email = $("#email").val();
            var consumidor_f = 'consumidor@final.com';
            if (email != '') {
                $("#comp_email").val(email);
            } else {
                $("#comp_email").val(consumidor_f);
            }

            $("#comp_direccion").val($("#direccion").val());
            $("#comp_telefono").val($("#telefono").val());
        });

        $(document).ready(function () {

            var hoy = $("#fecha_insc").val();
            var categoria_id = $("#categoria_id");
            var promo_grupo = $("#promo");
            var costo = $("#costo");
            var promo_hasta = "2017-10-16 00::00:01"//promosion hasta el 16 septiembre
            var deuda = parseInt($("#deuda").val());
            var valor = 0;

            if (deuda > 0) {
                $("#modal-deuda").modal("show");
            }

            if (hoy < promo_hasta) {
                valor = 8 + deuda;// hasta 15 octubre
                // $("#promo").prop("disabled",true);
            }
            else {
                valor = 10 + deuda;//a partir del 16
                $("#promo").prop("disabled", false);
            }

            promo_grupo.on('change', function () {
                if ($(this).is(':checked')) {
                    //console.log("Checkbox " + $(this).prop("id") +  " (" + $(this).val() + ") => Seleccionado");
                    costo.val(8);
                } else {
                    // console.log("Checkbox " + $(this).prop("id") +  " (" + $(this).val() + ") => Deseleccionado");
                    costo.val(10);
                }
            });

            categoria_id.on('change', function () {

                var categ = $("#categoria_id option:selected").text();//para seleccinar por el nombre del select no por el value
                var talla = $("#talla");
                var form_pago = $("#form_pago");
                var deporte_id = $("#deporte_id");
                var edad = $("#edad");


                if (categ === 'Deportista') {
                    costo.val(0);

                    deporte_id.prop('disabled', false);
                    form_pago.val(form_pago.find('option:first').val()).prop('disabled', true);
                    talla.val(talla.find('option:first').val()).prop('disabled', true);
                } else if (categ !== 'Deportista') {
                    deporte_id.val(deporte_id.find('option:first').val()).prop('disabled', true);
                    form_pago.prop('disabled', false);
                    talla.prop('disabled', false);

                    if (categ === 'Adulto Mayor [+65]') {
                        costo.val(Math.floor((valor * 0.5) * 100) / 100);//no redondea
                    } else if (categ === 'Discapacitado') {
                        $("#circuito_id option[value='2']").prop("disabled", true);//3km
                        costo.val(Math.floor((valor * 0.5) * 100) / 100);
                    } else if (categ === 'Auspiciante') {
                        costo.val(0);
                    }else{
                        costo.val(valor);
                    }
                }
            });
        });


        //Habilitar circuitos
        $(document).ready(function () {
            /*  Circuitos
             *   value='1' => 5km
             *   value='2' => 3km
             *   value='3' => 2km
             *   value='4' => 1km
             * */

            var edad = $("#edad");

            //Pininos y niños solo en 1Km
            if (edad.val() <= 12) {
                $("#circuito_id option[value='1']").prop("disabled", true);//5km
                $("#circuito_id option[value='2']").prop("disabled", true);//3km
                $("#circuito_id option[value='3']").prop("disabled", true);//2km
            }
            //categoria abierta todos los circuitos
            else if ((edad.val() >= 13) && (edad.val() <= 64)) {
                $("#circuito_id option[value='1']").prop("disabled", false);//5km
                $("#circuito_id option[value='2']").prop("disabled", false);//3km
                $("#circuito_id option[value='3']").prop("disabled", false);//2km
                $("#circuito_id option[value='4']").prop("disabled", false);//1km
            }
            //adulto mayor solo en 1 y 5 K
            else if (edad.val() >= 65) {
                //deshabilito los circuitos diferentes de 1 y 5 k
                $("#circuito_id option[value='2']").prop("disabled", true);//3km
                $("#circuito_id option[value='3']").prop("disabled", true);//2km

            }

        });


        //  Habilitar categorias
        $(document).ready(function () {

            /*  Categorias
             *   value='2' => Discapacitado
             *   value='3' => >65 Adulto mayor
             *   value='4' => 4-6 Niños I
             *   value='5' => 7-12 Niños II
             *   value='6' => 13-64 Abierta
             *   value='7' => <3 Pininos
             *   value='8' => 4-12 Niños
             * */

            if ($("#edad").val() <= 3) {
                //categoria niños Pininos <3
                $("#categoria_id option[value='3']").prop("disabled", true);// adulto mayor >65
                $("#categoria_id option[value='4']").prop("disabled", true);// niños I 4-6
                $("#categoria_id option[value='5']").prop("disabled", true);// niños II 7-12
                $("#categoria_id option[value='6']").prop("disabled", true);// abierta 13-65
                $("#categoria_id option[value='8']").prop("disabled", true);// niños 4-12
            }

            else if (($("#edad").val() >= 4 && $("#edad").val() <= 6)) {
                //categoria niños 4-6
                $("#categoria_id option[value='3']").prop("disabled", true);// adulto mayor >65
                $("#categoria_id option[value='6']").prop("disabled", true);// abierta 13-65
                $("#categoria_id option[value='5']").prop("disabled", true);// niños II 7-12
                $("#categoria_id option[value='7']").prop("disabled", true);// Pininos II 1-3
            }
            else if (($("#edad").val() >= 7) && ($("#edad").val() <= 12)) {
                //categoria niños 7-12
                $("#categoria_id option[value='3']").prop("disabled", true);// adulto mayor >65
                $("#categoria_id option[value='4']").prop("disabled", true);// niños I 4-6
                $("#categoria_id option[value='6']").prop("disabled", true);// abierta 13-65
                $("#categoria_id option[value='7']").prop("disabled", true);// Pininos II 1-3
            }
            else if (($("#edad").val() >= 13) && ($("#edad").val() <= 64)) {
                //categoria abierta 13-65
                $("#categoria_id option[value='3']").prop("disabled", true);// adulto mayor >65
                $("#categoria_id option[value='4']").prop("disabled", true);// niños I 4-6
                $("#categoria_id option[value='5']").prop("disabled", true);// niños II 7-12
                $("#categoria_id option[value='7']").prop("disabled", true);// Pininos II 1-3
                $("#categoria_id option[value='8']").prop("disabled", true);// niños 4-12
            }
            //categoria adulto mayor >65
            else if ($("#edad").val() >= 65) {
                //categoria adulto mayor
                $("#categoria_id option[value='4']").prop("disabled", true);// 4-6
                $("#categoria_id option[value='5']").prop("disabled", true);// 7-12
                $("#categoria_id option[value='6']").prop("disabled", true);// 13-65
                $("#categoria_id option[value='7']").prop("disabled", true);// Pininos II 1-3
                $("#categoria_id option[value='8']").prop("disabled", true);// niños 4-12
            }

        });

        $(document).ready(function () {

            $("#talla").change(function () {
                var id = this.value;
                var stock_cant = $("#stock_cant");
                var token = $("input[name=_token]").val();
                var route = "{{route('runner.tallas.getStock')}}";
                var data = {
                    id: id
                };
                $.ajax({
                    url: route,
                    type: "GET",
                    headers: {'X-CSRF-TOKEN': token},
//               contentType: 'application/x-www-form-urlencoded',
                    dataType: 'json',
                    data: data,
                    success: function (response) {
                        stock_cant.html('<strong>' + response.data + '</strong>');
                        console.log(response.data);
                    },
                    error: function (errors) {
                        console.log(errors);
                    }
                });
            });


        });

        //        //discapacitados
        //        $(document).ready(function () {
        //
        //            var categoria_id = $("#categoria_id");
        //
        //            categoria_id.on('click', function () {
        //
        //                var categ = $("#categoria_id option:selected").text();//para seleccinar por el nombre del select no por el value
        //
        //                if (categ === 'Discapacitado') {
        //                    //deshabilito los circuitos diferentes de 1 y 5 k
        //                    $("#circuito_id option[value='2']").prop("disabled", true);//3km
        //                    $("#circuito_id option[value='3']").prop("disabled", true);//2km
        //
        //                }
        //
        //            });
        //        });


    </script>



@endsection






