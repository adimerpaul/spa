$(document).ready(function() {
    $('#example').DataTable({
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    });

    $('#modificar').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget) // Button that triggered the modal
        var idusuario = button.data('idusuario') // Extract info from data-* attributes
        // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
        // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
        //console.log(idusuario);
        var datos={
            'idproducto':idusuario
        }
        $.ajax({
            url:'Dosificacion/datos',
            type:'POST',
            data:datos,
            success:function (e) {
                var datos=JSON.parse(e)[0];
                console.log(e);
                $('#iddosificacion2').val(datos.iddosificacion);
                $('#desde2').val(datos.desde);
                $('#hasta2').val(datos.hasta);
                $('#nrotramite2').val(datos.nrotramite);
                $('#nroautorizacion2').val(datos.nroautorizacion);
                $('#nrofactura2').val(datos.nrofacturai);
                $('#llave2').val(datos.llave);
                $('#leyenda2').val(datos.leyenda);
                $('#estado2').val(datos.estado);
            }
        })
    })
});