$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );


$('#summernote').summernote({
    placeholder: 'Describa el consentimiento',
    height: 450
});
$('#summernote2').summernote({
    placeholder: 'Describa el consentimiento',
    height: 450
});

$('#exampleModal').on('show.bs.modal', function (event) {
    //onsole.log('asdas');
    var button = $(event.relatedTarget) // Button that triggered the modal
    $('#nombre2').val(button.data('nombre'));  // Extract info from data-* attributes
    $('#id').val(button.data('id'));
    var datos={
        'id':button.data('id')
    };
    $.ajax({
        data:datos,
        url:'Indicaciones/datos',
        type:'POST',
        success:function (e) {
            //console.log(e)
            $('#contenido2').html(e);
        }

    });

})




