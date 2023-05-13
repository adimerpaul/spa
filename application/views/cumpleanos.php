<style>
    label,div,input,form{
        padding: 0px;
        margin: 0px;
        border: 0px;
    }
    .sinespacio{
        padding: 0px;
        margin: 0px;
        border: 0px;
    }
    .sinespaciotexto{
        padding: 2px;
        margin: 2px;
    }
    label::first-letter {
        text-transform: uppercase;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-6">
            <select id="mount" class="form-control">
                <option value="1">Enero</option>
                <option value="2">Febrero</option>
                <option value="3">Marzo</option>
                <option value="4">Abril</option>
                <option value="5">Mayo</option>
                <option value="6">Junio</option>
                <option value="7">Julio</option>
                <option value="8">Agosto</option>
                <option value="9">Septiembre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
            </select>
        </div>
        <div class="col-6">
            <button class="btn btn-primary" id="btnBuscar">Buscar</button>
        </div>
    </div>
</div>
<div class="mt-1"></div>
<table id="example1" class="display nowrap" style="width:100%">
    <thead>
    <tr>
        <th>Idpaciente</th>
        <th>Nombre</th>
        <th>Fecha Nacimiento</th>
        <th>Dias</th>
        <th>Telefono</th>
<!--        <th>Opciones</th>-->
    </tr>
    </thead>
    <tbody>
<!--    --><?php
//    $query=$this->db->query("SELECT * FROM paciente WHERE idpaciente!=8");
//    foreach ($query->result() as $row){
//        $cumpleanos = new DateTime($row->fechanac);
//        $hoy = new DateTime();
//        $annos = $hoy->diff($cumpleanos);
//        echo "
//        <tr>
//            <td>".$row->idpaciente."</td>
//            <td>".$row->nombres." ".$row->apellidos."</td>
//            <td>".$row->direccion."</td>
//            <td>".$annos->y."</td>
//            <td><a target='_blank' href='https://wa.me/591".$row->celular."?text='>".$row->celular."</a></td>
//            <td>
//            <a href='".base_url()."Paciente/reghistorial/".$row->idpaciente."' class='btn btn-sm btn-success text-white sinespaciotexto' ><i class='fa fa-file-archive-o'></i> Reg. Historial</a> <br>
//            <a type='button'  class='btn btn-warning btn-sm sinespaciotexto' href='".base_url()."Paciente/escoger/".$row->idpaciente."' > <i class=\"fa fa-align-justify\"></i>Historiales</a> <br>
//            <button type='button' class='btn btn-warning sinespaciotexto' data-idpaciente='$row->idpaciente' data-toggle='modal' data-target='#modificar'>
//                <i class='fa fa-pencil'></i> Modificar
//            </button> <br>
//            <a  class='btn btn-info sinespaciotexto' href='".base_url()."photo/index/$row->idpaciente'>
//                <i class='fa fa-photo'></i> Subir fotografia
//            </a>
//            </button> <br>
//            <a  class='btn btn-danger sinespaciotexto eli' href='".base_url()."Paciente/delete/$row->idpaciente'>
//                <i class='fa fa-trash'></i> Eliminar
//            </a>
//             </td>
//        </tr>";
//    }
//    ?>
    </tbody>
</table>

<script !src="">
    window.onload=function (e) {
        let pacientes=[];
        let mount =moment().format('M');
        let year =moment().format('YYYY');
        $('#mount').val(mount);
        pacientesGet(mount);
        $('#btnBuscar').click(function (e) {
            mount=$('#mount').val();
            pacientesGet(mount);
        });
        function pacientesGet(mount) {
            $.ajax({
                url:'Cumpleanos/pacientesGet',
                type:'POST',
                data:'mount='+mount,
                success:function (e) {
                    // console.error(e)
                    pacientes=JSON.parse(e).data;
                    console.log(pacientes);
                    pacientes.forEach(paciente=>{
                        paciente.fechanacformat=moment(paciente.fechanac).format(year+'-MM-DD');
                        paciente.diasParaCumpleanos=moment(paciente.fechanacformat).diff(moment(),'days');
                        paciente.diasParaCumpleanos=`<span class="badge badge-${paciente.diasParaCumpleanos<0?'danger':'success'}">${paciente.diasParaCumpleanos}</span> dias`;
                    })
                    $('#example1').DataTable({
                        "order": [[ 0, "desc" ]],
                        "language": {
                            "sProcessing":     "Procesando...",
                            "sLengthMenu":     "Mostrar _MENU_ registros",
                            "sZeroRecords":    "No se encontraron resultados",
                            "sEmptyTable":     "Ningún dato disponible en esta tabla",
                            "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                            "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                            "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                            "sInfoPostFix":    "",
                            "sSearch":         "Buscar:",
                            "sUrl":            "",
                            "sInfoThousands":  ",",
                            "sLoadingRecords": "Cargando...",
                            "oPaginate": {
                                "sFirst":    "Primero",
                                "sLast":     "Último",
                                "sNext":     "Siguiente",
                                "sPrevious": "Anterior"
                            },
                            "oAria": {
                                "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                                "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                            },
                            "buttons": {
                                "copy": "Copiar",
                                "colvis": "Visibilidad"
                            }
                        },
                        dom: 'Bfrtip',
                        buttons: [
                            'copy', 'csv','excel', 'pdf', 'print'
                        ],
                        data:pacientes,
                        destroy:true,
                        columns:[
                            {data:'idpaciente'},
                            {data:'nombres'},
                            {data:'fechanacformat'},
                            {data:'diasParaCumpleanos'},
                            {data:'celular'},
                            // {data:'opciones'},
                        ]
                    });
                }
            });
        }
        // $.ajax({
        //     url:'Paciente/pacientesGet',
        // })
        // $('.eli').click(function (e) {
        //     if (!confirm("Seguro de eliminar")){
        //         e.preventDefault();
        //     }
        // });
        // $('#example1').DataTable();

        // $('#modificar').on('show.bs.modal', function (event) {
        //     var button = $(event.relatedTarget);
        //     var idpaciente = button.data('idpaciente');
        //     $.ajax({
        //         url:'Paciente/datospaciente',
        //         type:'POST',
        //         data:'idpaciente='+idpaciente,
        //         success:function (e) {
        //             var dato=JSON.parse(e)[0];
        //             //console.log(dato);
        //             $('#apellidos2').val(dato.apellidos);
        //             $('#nombres2').val(dato.nombres);
        //             $('#ci2').val(dato.ci);
        //             $('#zona2').val(dato.zona);
        //             $('#direccion2').val(dato.direccion);
        //             $('#fechanac2').val(dato.fechanac);
        //             $('#celular2').val(dato.celular);
        //             $('#telefono2').val(dato.telefono);
        //             $('#referencia2').val(dato.referencia);
        //             $('#idpaciente2').val(dato.idpaciente);
        //
        //         }
        //     });
        // })
    }
</script>