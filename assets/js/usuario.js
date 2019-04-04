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
            'idusuario':idusuario
        }
        $.ajax({
            url:'Usuarios/datos',
            type:'POST',
            data:datos,
            success:function (e) {
                var datos=JSON.parse(e)[0];
                //console.log(datos.idusuario);
                $('#idusuario2').val(datos.idusuario)
                $('#nombre2').val(datos.nombre);
                $('#email2').val(datos.email);
                $('#tipo2').val(datos.tipo);
                $('#password2').val(datos.password);
                $('#estado2').val(datos.estado);

            }
        })
    })
});