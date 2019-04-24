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
            'idtratamiento':idusuario
        }
        $.ajax({
            url:'Tratamientos/datos',
            type:'POST',
            data:datos,
            success:function (e) {
                var datos=JSON.parse(e)[0];
                console.log(e);
                $('#idtratamiento2').val(datos.idtratamiento)
                $('#nombre2').val(datos.nombre);
                $('#idtipotratamiento2').val(datos.idtipotratamiento);
                $('#caracteristica2').val(datos.caracteristica);
                $('#sesiones2').val(datos.sesiones);
                $('#costo2').val(datos.costo);
                $('#tiempo2').val(datos.tiempo);
                $('#tipo2').val(datos.tipo);
                $('#reposicion2').val(datos.reposicion);
            }
        })
    })
});