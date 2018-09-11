
$(document).ready(function(){
//     $("#deportes").change(function(){
//         var precio = 6;
// //                var select= $('#categoria_id').val();
// //                if(select =="4")
//         $('#costo').val("1");
//
//
//     });

    $('#import_chip').on('click',function(){

        var progreso = 0;
        var idIterval = setInterval(function(){
            // Aumento en 10 el progeso
            progreso +=10;
            $('#progress_bar_chip').css('width', progreso + '%');

            //Si llegó a 100 elimino el interval
            if(progreso == 100){
                clearInterval(idIterval);
            }
        },1000);
        
    });


});
