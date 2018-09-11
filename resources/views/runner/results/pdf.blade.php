<!doctype html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <link rel="stylesheet" href="bootstrap/css/font-awesome.css">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="dist/css/pdf.css">

<title>Diploma</title>
</head>
<body>



<div class="container">
    <div class="row">
        <div class="container">

                <img  class="header_diploma" src="dist/img/diploma/banner-02.jpg" >

        </div>

        {{--<div class="navbar-header">--}}
            {{--<img src="dist/img/diploma/banner-02.jpg" class="header_diploma" >--}}
        {{--</div>--}}
    </div>
    <div class="row">
        <div class="col-lg-12">
            <table id="tabla_contenido" align="center">
                <tr>
                    <td ><h1><strong>NOMBRE</strong></h1></td>
                    <td ><h1>{{$result->first_name}} {{$result->second_name}} {{$result->last_name}}</h1></td>
                </tr>
                <tr>
                    <td ><h1><strong>CATEGORíA</strong></h1></td>
                    <td ><h1>{{$result->category}}</h1></td>
                </tr>
                <tr>
                    <td ><h1><strong>CIRCUITO</strong></h1></td>
                    <td ><h1>{{$result->circuit}}</h1></td>
                </tr>
                <tr>
                    <td ><h1><strong>LUGAR</strong></h1></td>
                    <td ><h1>{{$result->place}}</h1></td>
                </tr>
                <tr>
                    <td ><h1><strong>TIEMPO</strong></h1></td>
                    <td ><h1>{{$result->time}}</h1></td>
                </tr>


            </table>
        </div>
    </div>

    <div class="row">

        <div class="container">
            <div class="pie">
                <img class="pie_diploma" src="dist/img/diploma/fedeguayas_pie.png">
                <div> <p class="pie">WWW.FEDEGUAYAS.COM.EC</p></div>
            </div>

        </div>



        </div>
    </div>
</div>

<script src="bootstrap/js/bootstrap.min.js"></script>

</body>
</html>




