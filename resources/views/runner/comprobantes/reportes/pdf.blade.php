<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>

    <link rel="stylesheet" href="dist/css/pdf-comprobante.css">
    <link href="bootstrap/css/bootstrap.css" rel="stylesheet">

</head>
<body>

<div class="header">

    <img src="dist/img/fdg-logo.png" class="empresa">

    <div class="descripcion"><h4>{{$cuenta->descripcion}}</h4></div>

    <img src="dist/img/LOGOGR2016.png" class="logo">

</div>

<div class="contenido">

    <div class="corredor">
        <table class="table striped">
            <caption>CORREDOR:</caption>
            <tr>
                <th>Nombres y Apellidos</th>
                <td>{{$persona->nombres.' '.$persona->apellidos}}</td>
            </tr>
            <tr>
                <th>Documento Identidad</th>
                <td>{{$persona->num_doc}}</td>
            </tr>
            <tr>
                <th>Fecha de Nacimiento</th>
                <td>{{$persona->fecha_nac}}</td>
            </tr>
            <tr>
                <th>Edad</th>
                <td>{{$inscripcion->edad}}</td>
            </tr>
            <tr>
                <th>Sexo</th>
                <td>{{$persona->genero}}</td>
            </tr>
            <tr>
                <th>Teléfono</th>
                <td>{{$persona->telefono}}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{$persona->email}}</td>
            </tr>
            <tr>
                <th>Fecha Inscripción</th>
                <td>{{$inscripcion->created_at}}</td>
            </tr>
        </table>
    </div>

    <div class="carrera">
        <table class="table striped">
            <caption>CARRERA:</caption>
            <tr>
                <th>Categoría</th>
                <td>{{$categoria->categoria}}</td>
            </tr>
            <tr>
                <th>Circuito</th>
                <td>{{$circuito->circuito}}</td>
            </tr>
            <tr>
                <th>Número</th>
                <td>{{sprintf("%'.04d",$inscripcion->num_corredor)}}</td>
            </tr>
            <tr>
                <th>Talla Camiseta</th>
                <td>
                    @if ($talla)
                        {{$talla->talla}}
                    @else
                        -
                    @endif
                </td>
            </tr>
            <tr>
                <th>Color Camiseta</th>
                <td>
                    @if ($talla)
                        {{$talla->color=='N' ? 'Negra': 'Blanca'}}
                    @else
                        -
                    @endif
                </td>
            </tr>
        </table>
    </div>


    <br><br><br>

    <div class="facturacion">
        <table class="table striped">
            <caption>FACTURACION:</caption>
            <thead style="background-color: #a3acb1">
            <tr>
                <th>Nombres y Apellidos</th>
                <th>CI Identidad</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Email</th>
                <th>Valor</th>
            </tr>

            </thead>
            <tbody>
            <tr>
                <td>{{$comprobante->nombres.' '.$comprobante->apellidos}}</td>
                <td>{{$comprobante->num_doc}}</td>
                <td>{{$comprobante->telefono}}</td>
                <td>{{$comprobante->direccion}}</td>
                <td>{{$comprobante->email}}</td>
                <td>$ {{$inscripcion->costo}}</td>

            </tr>
            </tbody>


        </table>
    </div>

    <br><br><br>

    <div class="cancelado">
        <table class="table">
            <caption>CANCELADO POR:</caption>
            <thead>
            <tr>
                <th>Usuario:</th>
                <th>Escenario:</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{$user->nombre}}</td>
                <td>{{$escenario->escenario}}</td>
            </tr>
            </tbody>
        </table>
    </div>

</div>

<div class="note">
    <p>
        NOTA: Las inscripciones son intransferibles y los valores no serán reembolsables por ningún motivo.
    </p>
</div>

<div class="footer">
    <strong><em>Oficina: José Mascote 1103 y Luque. Telfs: 2367856 - 2531488. fedeguayas.com.ec. email: fdg@telconet
            .net</em></strong><em><br>
        <strong> Casilla 836 Telegramas y Cables - FEDEGUAYAS. Guayaquil - Ecuador</strong></em><strong></strong>
</div>

</body>
</html>




