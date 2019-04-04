
<?php

$query=$this->db->query("SELECT * FROM historial WHERE idpaciente='$idpaciente'");
foreach ($query->result() as $row){
    echo "Fecha: <a href='paciente/historialver/".$row->idhistorial."/".$row->idpaciente."'>". substr($row->fecha,0,10)."</a> idhistorial: ".$row->idhistorial." <a href='".base_url()."Paciente/cotizacion/".$idpaciente."/".$row->idhistorial."' class='btn btn-sm btn-info sinespaciotexto' ><i class='fa fa-ambulance'></i> Tratamientos</a><br>";
}