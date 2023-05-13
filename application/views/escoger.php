
<?php

$query=$this->db->query("SELECT * FROM historial WHERE idpaciente='$idpaciente'");
foreach ($query->result() as $row){
    echo "Fecha: <a href='paciente/historialver/".$row->idhistorial."/".$row->idpaciente."'>". $row->fecha."</a> 
    idhistorial: ".$row->idhistorial." 
    <a href='".base_url()."Paciente/cotizacion/".$idpaciente."/".$row->idhistorial."' class='btn btn-sm btn-info sinespaciotexto' ><i class='fa fa-ambulance'></i> Tratamientos</a>
     <a href='".base_url()."Paciente/elihistorial/".$idpaciente."/".$row->idhistorial."' class='btn btn-sm btn-danger sinespaciotexto eli' ><i class='fa fa-trash'></i> Eliminar</a><br>";
}
?>
<script !src="">
    window.onload=function(e){
        $('.eli').click(function (e) {
            if (!confirm("Seguro de elminar?")){
                e.preventDefault();
            }
        });
    }
</script>
