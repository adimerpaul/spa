$(document).ready(function() {
$('#idproducto').change(function (e) {
    var datos={
        'idproducto':$('#idproducto').val()
    };
    //console.log($('#idproducto').val());
    $.ajax({
        data:datos,
        type:'POST',
        url:'Venta/datosproducto',
        success:function (e) {
            //console.log(e);
            var dato=JSON.parse(e)[0];
            $('#precio').val(dato.precio);
            var precio=$('#precio').val();
            var cantidad=$('#cantidad').val();
            $('#subtotal').val(precio*cantidad);
        }
    });
});
function cambio(e){
    /*var precio=$('#precio').val();
    var cantidad=$('#cantidad').val();
    $('#subtotal').val(precio*cantidad);*/
    //console.log('aaa');
}
//$('#cantidad').change(cambio());
$('#cantidad').keyup(function (e) {
    var precio=$('#precio').val();
    var cantidad=$('#cantidad').val();
    $('#subtotal').val(precio*cantidad);
});
$('#precio').keyup(function (e) {
    var precio=$('#precio').val();
    var cantidad=$('#cantidad').val();
    $('#subtotal').val(precio*cantidad);
});
var total=0;
var con=0;
$('#formulario').submit(function (e) {
    if ($('#idpaciente').val()=="") {
    alert('Debe seleccionar un comprador');
    }else{
    var comprador =$('#idpaciente option:selected').text();
    var producto =$('#idproducto option:selected').text();
    var idproducto =$('#idproducto').val();
    var precio=$('#precio').val();
    var cantidad=$('#cantidad').val();
    var subtotal=$('#subtotal').val();
    //console.log(comprador);
    con++;
    total=parseInt(total)+ parseInt(subtotal);
    $( "#detalle" ).append( "<tr>" +
                "                <th scope='row'>"+con+"</th>" +
                "                <td>"+comprador+"</td>" +
                "                <td>"+producto+"</td>" +
                "                <td>"+precio+"<input name='p"+idproducto+"' value='"+precio+"' hidden></td>" +
                "                <td>"+cantidad+"<input name='c"+idproducto+"' value='"+cantidad+"' hidden></td>" +
                "                <td>"+subtotal+"<input name='s"+idproducto+"' value='"+subtotal+"' hidden></td>" +
                "            </tr>" );
    }
    $('#to').html(total);
    $('#total').val(total);
    $('#exampleModal').modal('hide');
    return false;
});
});