$(document).ready(function() {
    $('#example').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );


$('#consentimiento').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    $('#uidcotizacion').val(button.data('idcotizacion'));
    $('#uidpaciente').val(button.data('idpaciente'));

})
$('#laboratorios').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget) // Button that triggered the modal
    $('#uidcotizacion2').val(button.data('idcotizacion'));
    $('#uidpaciente2').val(button.data('idpaciente'));

})
$('#medidas').on('show.bs.modal', function (event) {
    console.log('asda');
    var button = $(event.relatedTarget) // Button that triggered the modal
    $('#idpacientem').val(button.data('idpaciente'));

})