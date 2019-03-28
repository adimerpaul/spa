$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        "order": [[ 0, "desc" ]]
    } );
} );


var s=0;
var sum=document.getElementsByClassName("sum");

$('#consentimiento').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    $('#uidcotizacion').val(button.data('idcotizacion'));
    $('#uidpaciente').val(button.data('idpaciente'));
})
$('#medidas').on('show.bs.modal', function (event) {

    var button = $(event.relatedTarget) // Button that triggered the modal

    //console.log(button.data('idcotizacion'));
    $('#uidcotizacion3').val(button.data('idcotizacion'));

})

$('#agregar').on('show.bs.modal', function (event) {
/*
    var button = $(event.relatedTarget); // Button that triggered the modal

    //console.log(button.data('idcotizacion'));
    $('#uidcotizacion4').val(button.data('idcotizacion'));

    var parametros = {
        "idcotizacion" : button.data('idcotizacion')
    };
    $.ajax({
        data:  parametros,
        url:   'datos',
        type:  'post',
        beforeSend: function () {
            //$("#resultado").html("Procesando, espere por favor...");
           // console.log('procesandfo');
        },
        success:  function (response) {
            //$("#resultado").html(response);
            console.log(response);
        }
    });
*/


})

$('#exampleModal').on('show.bs.modal', function (event) {
    for (var i=0;i<sum.length;i++){
        sum[i].value=0;
    }
    $('#total').html('0');
})



function sumar(){
    s=0;
    for (var i=0;i<sum.length;i++){
        s=Number(s)+Number(sum[i].value);
    }
}

$(".sum").on('keyup change', function (){
    sumar();
    $('#total').html(s);
});



