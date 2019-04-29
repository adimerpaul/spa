<?php
$dias = array("domingo","lunes","martes","mi&eacute;rcoles","jueves","viernes","s&aacute;bado");
$sm=0;
$st=0;
?>
<form class="form-inline" method="post" ACTION="<?=base_url()?>Consulta/index">
    <div class="form-group mb-2">
        <label for="staticEmail2" class="sr-only">Email</label>
        <input type="text" readonly class="form-control-plaintext" id="staticEmail2" value="Fecha">
    </div>
    <div class="form-group mx-sm-3 mb-2">
        <label for="fecha" class="sr-only">Password</label>
        <input type="date" class="form-control" id="fecha" name="fecha" value="<?=$fecha?>" >
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
                <td scope='col'>$t".substr($row->fecha,10,6)."</td>
                <td scope='col'>$apellidos $nombres</td>
                <td scope='col'>$consulta</td>
                <td scope='col'>$referencia</td>
                <td scope='col'>$row->monto</td>
                <td scope='col'>$celular</td>
                <td scope='col'>$nombre</td>
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
                    <td scope='col' style='width: 72px'>$t".substr($row->fecha,10,6)."</td>
                    <td scope='col'>$row->nombres $row->apellidos</td>
                    <td scope='col'>$row->nombret</td>
                    <td scope='col'>$row->obs</td>
                    <td scope='col'>$row->cub</td>
                    <td scope='col'>$row->celular</td>
                    <td scope='col'>$row->monto</td>
                    <td scope='col'>$row->nombreu</td>
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
                    <td scope='col' style='width: 72px'>$t".substr($row->fecha,10,6)."</td>
                    <td scope='col'>$row->nombres $row->apellidos</td>
                    <td scope='col'>$row->nombret</td>
                    <td scope='col'>$row->obs</td>
                    <td scope='col'>$row->cub</td>
                    <td scope='col'>$row->celular</td>
                    <td scope='col'>$row->monto</td>
                    <td scope='col'>$row->nombreu</td>
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
                <th scope="col">CANTIDAD</th>

                <th scope="col">CELULAR</th>
                <th scope="col">COSTO</th>
                <th scope="col">VENDEDOR</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $query=$this->db->query("SELECT f.fecha,nombres,apellidos,pr.nombre,cantidad,celular,subtotal,u.nombre as usuarionombre
 FROM factura f
            INNER JOIN paciente p ON p.idpaciente=f.idpaciente
            INNER JOIN detallefactura d ON d.idfactura=f.idfactura
            INNER JOIN producto pr ON pr.idproducto=d.idproducto
            INNER JOIN usuario u ON u.idusuario=f.idusuario
            WHERE date(f.fecha)=date('$fecha')");
            foreach ($query->result() as $row){
                $mediodia = strtotime("12:00:00");
                $horaactual = strtotime(date("H:j:s",strtotime(substr($row->fecha,10,6))));
                if($horaactual<$mediodia){
                    $t="M";
                    $sm=$sm+$row->subtotal;
                }else{
                    $t="T";
                    $st=$st+$row->subtotal;
                }

                echo "<tr>
                <td scope='col'>$t".substr($row->fecha,10,6)."</td>
                <td scope='col'>$row->apellidos $row->nombres</td>
                <td scope='col'>$row->nombre</td>
                <td scope='col'>$row->cantidad</td>
                <td scope='col'>$row->celular</td>
                <td scope='col'>$row->subtotal</td>
                <td scope='col'>$row->usuarionombre</td>
            </tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <center>
            <h8>ADELANTOS/PAGO DE DEUDAS </h8>
            <button  type="button" style="padding: 2px" class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-plus"></i>
            </button>
        </center>
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
            <?php
            $query=$this->db->query("SELECT d.fecha,d.comprador,d.detalle,d.celular,u.nombre,d.tipo,d.monto
 FROM deudas d
 INNER JOIN usuario u ON d.idusuario=u.idusuario
            WHERE date(d.fecha)=date('$fecha')");
            foreach ($query->result() as $row){
                $mediodia = strtotime("12:00:00");
                $horaactual = strtotime(date("H:j:s",strtotime(substr($row->fecha,10,6))));

                $tipo=$row->tipo;
                if ($tipo=="ADELANTO"){
                    $te="<span class='btn-success' style='padding: 2px'>$row->monto</span>";
                    if($horaactual<$mediodia){
                        $t="M";
                        $sm=$sm+$row->monto;
                    }else{
                        $t="T";
                        $st=$st+$row->monto;
                    }
                }else{
                    $te="<span class='btn-danger' style='padding: 2px'>$row->monto</span>";
                    if($horaactual<$mediodia){
                        $t="M";
                        $sm=$sm-$row->monto;
                    }else{
                        $t="T";
                        $st=$st-$row->monto;
                    }
                }

                echo "<tr>
                        <td scope='col'>$t".substr($row->fecha,10,6)."</td>
                        <td scope='col'>$row->comprador</td>
                        <td scope='col'>$row->detalle</td>
                        <td scope='col'>$row->celular</td>
                        <td scope='col'>$te </td>
                        <td scope='col'>$row->nombre</td>
                    </tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</div>
<div class="row">

    <div class="col-sm-6">
        <center><h8>INGRESOS</h8></center><div class="col-sm-12">
            <table border="1" style="width: 100%">
                <tr>
                    <th colspan="2" class="thead-dark">Mañana:</th>
                    <td ><?=$sm?></td>
                </tr>
                <tr>
                    <th colspan="2" class="thead-dark">Tarde:</th>
                    <td ><?=$st?></td>
                </tr>
                <tr>
                    <th colspan="2" class="thead-dark">Total:</th>
                    <td ><?=($sm+$st)?></td>
                </tr>
                <tr>
                    <td> <b> Mañana</b></td>
                    <td>Ingreso</td>
                    <td>Salida</td>
                </tr>
                <tr>
                    <td><b>Tarde</b></td>
                    <td>Ingreso</td>
                    <td>Salida</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="col-sm-6">
        <center><h8>EGRESOS</h8></center><div class="col-sm-12">
            <table border="1" style="width: 100%">
                <tr>
                    <td>1</td>
                    <td>2</td>
                    <td>3</td>
                    <td>4</td>
                    <td>5</td>
                </tr>
                <tr>
                    <td>6</td>
                    <td>7</td>
                </tr>

            </table>
        </div>
    </div>

</div>




<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Adelanto/Pago de Deudas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?=base_url()?>Consulta/insertdeudas" method="post">
                    <div class="form-group row">
                        <label for="comprador" class="col-form-label col-sm-4">Comprador</label>
                        <div class="col-sm-8">
                            <input type="text" name="comprador" class="form-control" id="comprador" placeholder="comprador" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="detalle" class="col-form-label col-sm-4">Detalle</label>
                        <div class="col-sm-8">
                            <input type="text" name="detalle" class="form-control" id="detalle" placeholder="detalle">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="celular" class="col-form-label col-sm-4">Celular</label>
                        <div class="col-sm-8">
                            <input type="text" name="celular" class="form-control" id="celular" placeholder="celular">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="monto" class="col-form-label col-sm-4">Monto</label>
                        <div class="col-sm-8">
                            <input type="number" name="monto" class="form-control" id="monto" placeholder="monto" required>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="tipo" class="col-form-label col-sm-4">Tipo</label>
                        <div class="col-sm-8">
                            <input name="tipo" data-width="100" data-height="35" data-size="sm" type="checkbox" checked data-toggle="toggle" data-on="Adelanto" data-off="Pago" data-onstyle="success" data-offstyle="danger">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>