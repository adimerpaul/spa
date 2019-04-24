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
            'idreactivo':idusuario
        }
        $.ajax({
            url:'Inventario/datos',
            type:'POST',
            data:datos,
            success:function (e) {
                var datos=JSON.parse(e)[0];
                //console.log(e);
                $('#idreactivo2').val(datos.idreactivo)
                $('#nombre2').val(datos.nombre);
                $('#cantidad2').val(datos.cantidad);
                $('#presentacion2').val(datos.presentacion);
            }
        })
    })
});