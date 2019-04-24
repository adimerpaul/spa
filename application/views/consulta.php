<?php
$dias = array("domingo","lunes","martes","mi&eacute;rcoles","jueves","viernes","s&aacute;bado");
$sm=0;
$st=0;
?>
<form class="form-inline">
    <div class="form-group mb-2">
        <label for="staticEmail2" class="sr-only">Email</label>
        <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="Fecha">
    </div>
    <div class="form-group mx-sm-3 mb-2">
        <label for="fecha" class="sr-only">Password</label>
        <input type="date" class="form-control" id="fecha" value="<?=$fecha?>" >
    </div>
    <button type="submit" class="btn btn-success mb-2 btn-sm"> <i class="fa fa-check"></i> Consultar </button>
    <button type="submit" class="btn btn-info mb-2 btn-sm"> <i class="fa fa-print"></i> Imprimir </button>
    <a href="" class="btn btn-warning mb-2 btn-sm"> <i class="fa fa-rebel"></i> Actualizar </a>

</form>
<div class="row" style="font-weight:bold ">
    <div class="col-sm-3">Dia: <?=$dias[date('w')]?></div>
    <div class="col-sm-6"><center>INFORME DIARIO</center></div>
    <div class="col-sm-3">FECHA: <?=date("d/m/Y")?></div>
    <div class="col-sm-12"><center>CONSULTA MEDICA</center></div>
</div>
<div class="row">
    <div class="col-sm-12">
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">HORA</th>
            <th scope="col">PACIENTE</th>
            <th scope="col">COT/SUG TX</th>
            <th scope="col">REF</th>
            <th scope="col">COSTO/ADEL</th>
            <th scope="col">TELEFONO</th>
            <th scope="col">MEDICO</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $query=$this->db->query("SELECT * FROM `montos` WHERE date(`fecha`)=date('$fecha') AND `idtratamiento` is NULL");
        foreach ($query->result() as $row){
                $hora=date('Y-m-d');
                $idhistorial=$this->User->consulta('idhistorial','cotizacion','idcotizacion',$row->idcotizacion);
                $idpaciente=$this->User->consulta('idpaciente','historial','idhistorial',$idhistorial);
            $consulta=$this->User->consulta('consulta','historial','idhistorial',$idhistorial);
                $nombres=$this->User->consulta('nombres','paciente','idpaciente',$idpaciente);
                $apellidos=$this->User->consulta('apellidos','paciente','idpaciente',$idpaciente);
                $celular=$this->User->consulta('celular','paciente','idpaciente',$idpaciente);
                $referencia=$this->User->consulta('referencia','paciente','idpaciente',$idpaciente);
                $nombre=$this->User->consulta('nombre','usuario','idusuario',$row->idusuario);
            $mediodia = strtotime("12:00:00");
            $horaactual = strtotime(date("H:j:s",strtotime(substr($row->fecha,10,6))));
            if($horaactual<$mediodia){
                $t="M";
                $sm=$sm+$row->monto;
            }else{
                $t="T";
                $st=$st+$row->monto;
            }
                echo "<tr>
                <th scope='col'>$t".substr($row->fecha,10,6)."</th>
                <th scope='col'>$apellidos $nombres</th>
                <th scope='col'>$consulta</th>
                <th scope='col'>$referencia</th>
                <th scope='col'>$row->monto</th>
                <th scope='col'>$celular</th>
                <th scope='col'>$nombre</th>
            </tr>";
        }
        ?>
        </tbody>
    </table>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <center><h8>TX FACIALES: IPL-MESO-PEELING-PRP-TOX-RELLENO-HILOS-MASC-ELECTRO-RF-INJERTOS</h8></center>
    </div>
    <div class="col-sm-12">
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">HORA</th>
                <th scope="col">PACIENTE</th>
                <th scope="col">TRATAMIENTO</th>
                <th scope="col">OBS/RES</th>
                <th scope="col">CUB/SES</th>
                <th scope="col">CELULAR</th>
                <th scope="col">COSTO</th>
                <th scope="col">MEDICO</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $query=$this->db->query("
            SELECT nombres,apellidos,obs,cub,celular,t.nombre as nombret,monto,u.nombre as nombreu,m.fecha
            FROM montos m 
            INNER JOIN tratamiento t ON m.idtratamiento=t.idtratamiento
            INNER JOIN cotizacion c ON c.idcotizacion=m.idcotizacion
            INNER JOIN historial h ON h.idhistorial=c.idhistorial
            INNER JOIN paciente p ON p.idpaciente=h.idpaciente
            INNER JOIN usuario u ON u.idusuario=m.idusuario
            WHERE date(m.fecha)=date('$fecha')
            AND t.tipo='FACIAL'
            ");
            foreach ($query->result() as $row){
                $mediodia = strtotime("12:00:00");
                $horaactual = strtotime(date("H:j:s",strtotime(substr($row->fecha,10,6))));
                if($horaactual<$mediodia){
                    $t="M";
                    $sm=$sm+$row->monto;
                }else{
                    $t="T";
                    $st=$st+$row->monto;
                }
                echo "<tr>
                    <th scope='col' style='width: 72px'>$t".substr($row->fecha,10,6)."</th>
                    <th scope='col'>$row->nombres $row->apellidos</th>
                    <th scope='col'>$row->nombret</th>
                    <th scope='col'>$row->obs</th>
                    <th scope='col'>$row->cub</th>
                    <th scope='col'>$row->celular</th>
                    <th scope='col'>$row->monto</th>
                    <th scope='col'>$row->nombreu</th>
                </tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <center><h8>TX CORP: UCV-VACCUM-RF-ELECTRO-LIPO-HIDRO-MESO-VIT C-CAPILAR-ARTICULAR-HILOS-MELA</h8></center>
    </div>
    <div class="col-sm-12">
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">HORA</th>
                <th scope="col">PACIENTE</th>
                <th scope="col">TRATAMIENTO</th>
                <th scope="col">OBS/RES</th>
                <th scope="col">CUB/SES</th>
                <th scope="col">CELULAR</th>
                <th scope="col">COSTO</th>
                <th scope="col">MEDICO</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $query=$this->db->query("
            SELECT nombres,apellidos,obs,cub,celular,t.nombre as nombret,monto,u.nombre as nombreu,m.fecha
            FROM montos m 
            INNER JOIN tratamiento t ON m.idtratamiento=t.idtratamiento
            INNER JOIN cotizacion c ON c.idcotizacion=m.idcotizacion
            INNER JOIN historial h ON h.idhistorial=c.idhistorial
            INNER JOIN paciente p ON p.idpaciente=h.idpaciente
            INNER JOIN usuario u ON u.idusuario=m.idusuario
            WHERE date(m.fecha)=date('$fecha')
            AND t.tipo='CORPORAL'
            ");
            foreach ($query->result() as $row){
                $mediodia = strtotime("12:00:00");
                $horaactual = strtotime(date("H:j:s",strtotime(substr($row->fecha,10,6))));
                if($horaactual<$mediodia){
                    $t="M";
                    $sm=$sm+$row->monto;
                }else{
                    $t="T";
                    $st=$st+$row->monto;
                }
                echo "<tr>
                    <th scope='col' style='width: 72px'>$t".substr($row->fecha,10,6)."</th>
                    <th scope='col'>$row->nombres $row->apellidos</th>
                    <th scope='col'>$row->nombret</th>
                    <th scope='col'>$row->obs</th>
                    <th scope='col'>$row->cub</th>
                    <th scope='col'>$row->celular</th>
                    <th scope='col'>$row->monto</th>
                    <th scope='col'>$row->nombreu</th>
                </tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <center><h8>PRODUCTOS VENDIDOS</h8></center>
    </div>
    <div class="col-sm-12">
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">HORA</th>
                <th scope="col">COMPRADOR</th>
                <th scope="col">DETALLE DEL PRODUCTO</th>
                <th scope="col">CELULAR</th>
                <th scope="col">COSTO</th>
                <th scope="col">VENDEDOR</th>
            </tr>
            </thead>
            <tbody>

            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <center><h8>ADELANTOS/PAGO DE DEUDAS</h8></center>
    </div>
    <div class="col-sm-12">
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">HORA</th>
                <th scope="col">COMPRADOR</th>
                <th scope="col">DETALLE</th>
                <th scope="col">CELULAR</th>
                <th scope="col">MONTO</th>
                <th scope="col">VENDEDOR</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<div class="row">

    <div class="col-sm-6">
        <center><h8>INGRESOS</h8></center><div class="col-sm-12">
            <table class="table">
                <tr>
                    <th class="thead-dark">Mañana:</th>
                    <td ><?=$sm?></td>
                </tr>
                <tr>
                    <th class="thead-dark">Tarde:</th>
                    <td ><?=$st?></td>
                </tr>
                <tr>
                    <th class="thead-dark">Total:</th>
                    <td ><?=($sm+$st)?></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="col-sm-6">
        <center><h8>EGRESOS</h8></center><div class="col-sm-12">
            <table class="table">
                <tr>
                    <th class="thead-dark">Mañana:</th>
                    <td >1800</td>
                </tr>
                <tr>
                    <th class="thead-dark">Tarde:</th>
                    <td >1800</td>
                </tr>
                <tr>
                    <th class="thead-dark">Total:</th>
                    <td >1800</td>
                </tr>
            </table>
        </div>
    </div>

</div>