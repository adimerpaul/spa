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
<!-- Button trigger modal -->
<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target=".bs-example-modal-lg">
    <i class="fa fa-file"></i> Registrar SOAP
</button>
<a href="<?=base_url()?>Soap/imprimir/<?=$idcotizacion?>" class="btn btn-warning btn-sm " >
    <i class="fa fa-print"></i> Imprimir SOAP
</a>
<div class="mt-1"></div>
<table id="example" class="display nowrap" style="width:100%">
    <thead>
    <tr>
        <th>Fecha</th>
        <th>Subjetivo</th>
        <th>Objetivo</th>
        <th>Analisis</th>
        <th>Plan</th>
        <th>Doctor</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $query=$this->db->query("SELECT * FROM soap WHERE idcotizacion='$idcotizacion'");
    foreach ($query->result() as $row){
        echo "
        <tr>
            <td>".substr($row->fecha,0,10)."</td>
            <td > <div style='width: 140px;white-space: pre-wrap;'>".$row->subjetivo."</div></td>
            <td><div style='width: 140px;white-space: pre-wrap;'>".$row->objetivo."</div></td>
            <td><div style='width: 140px;white-space: pre-wrap;'>".$row->analisis."</div></td>
            <td><div style='width: 140px;white-space: pre-wrap;'>".$row->plan."</div></td>
            <td>".$this->User->consulta('nombre','usuario','idusuario',$row->idusuario)."</td>
        </tr>";
    }
    ?>
    </tbody>
</table>
<!-- Modal -->

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?=base_url()?>soap/insert" style="padding: 0px;margin: 0px;border: 0px">
                    <div class="form-row" style="padding: 0px;margin: 0px;border: 0px">
                        <div class="form-group col-md-12" style="padding: 0px;margin: 0px;border: 0px" >
                            <label for="subjetivo" style="padding: 0px;margin: 0px;border: 0px">subjetivo</label>
                            <input type="text" name="idcotizacion" value="<?=$idcotizacion?>" hidden>
                            <input type="text" style="text-transform: uppercase;padding: 0px;margin: 0px" class="form-control" id="subjetivo" placeholder="subjetivo" name="subjetivo" required>
                        </div>
                        <div class="form-group col-md-12" style="padding: 0px;margin: 0px;border: 0px" >
                            <label for="objetivo" style="padding: 0px;margin: 0px;border: 0px">objetivo</label>
                            <input type="text" style="text-transform: uppercase;padding: 0px;margin: 0px" class="form-control" id="objetivo" placeholder="objetivo" name="objetivo" >
                        </div>
                        <div class="form-group col-md-12" style="padding: 0px;margin: 0px;border: 0px" >
                            <label for="analisis" style="padding: 0px;margin: 0px;border: 0px">analisis</label>
                            <input type="text" style="text-transform: uppercase;padding: 0px;margin: 0px" class="form-control" id="analisis" placeholder="analisis" name="analisis" >
                        </div>
                        <div class="form-group col-md-12" style="padding: 0px;margin: 0px;border: 0px" >
                            <label for="plan" style="padding: 0px;margin: 0px;border: 0px">plan</label>
                            <input type="text" style="text-transform: uppercase;padding: 0px;margin: 0px" class="form-control" id="plan" placeholder="plan" name="plan" >
                        </div>
                        <div class="form-group col-md-3" style="padding: 0px;margin: 0px;border: 0px" >
                            <label for="monto" style="padding: 0px;margin: 0px;border: 0px">Monto Adelanto</label>
                            <input type="number" style="text-transform: uppercase;padding: 0px;margin: 0px" class="form-control" placeholder="0" id="monto" value="0" name="monto" required>
                        </div>
                        <div class="form-group col-md-3" style="padding: 0px;margin: 0px;border: 0px" >
                            <label for="idtratamiento" style="padding: 0px;margin: 0px;border: 0px">Tratamiento</label>
                            <select  style="text-transform: uppercase;padding: 0px;margin: 0px" class="form-control" id="idtratamiento"  name="idtratamiento" required>
                                <option value="">Seleccionar</option>
                                <?php
                                $query=$this->db->query("SELECT * FROM cotizaciontratamiento c
INNER JOIN tratamiento t ON c.idtratamiento=t.idtratamiento
 WHERE idcotizacion='$idcotizacion' ");
                                foreach ($query->result() as $row ){
                                    echo "<option value='$row->idtratamiento'>$row->nombre</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-3" style="padding: 0px;margin: 0px;border: 0px" >
                            <label for="obs" style="padding: 0px;margin: 0px;border: 0px">OBS/RES</label>
                            <input type="text" style="text-transform: uppercase;padding: 0px;margin: 0px" class="form-control" placeholder="" id="obs" name="obs" >
                        </div>
                        <div class="form-group col-md-3" style="padding: 0px;margin: 0px;border: 0px" >
                            <label for="cub" style="padding: 0px;margin: 0px;border: 0px">CUB/SES</label>
                            <input type="text" style="text-transform: uppercase;padding: 0px;margin: 0px" class="form-control" placeholder="" id="cub" name="cub" >
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


