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
                        <div class="form-group col-md-3" style="padding: 0px;margin: 0px;border: 0px" >
                            <label for="subjetivo" style="padding: 0px;margin: 0px;border: 0px">subjetivo</label>
                            <input type="text" name="idcotizacion" value="<?=$idcotizacion?>" hidden>
                            <input type="text" style="text-transform: uppercase;padding: 0px;margin: 0px" class="form-control" id="subjetivo" placeholder="subjetivo" name="subjetivo" required>
                        </div>
                        <div class="form-group col-md-3" style="padding: 0px;margin: 0px;border: 0px" >
                            <label for="objetivo" style="padding: 0px;margin: 0px;border: 0px">objetivo</label>
                            <input type="text" style="text-transform: uppercase;padding: 0px;margin: 0px" class="form-control" id="objetivo" placeholder="objetivo" name="objetivo" required>
                        </div>
                        <div class="form-group col-md-3" style="padding: 0px;margin: 0px;border: 0px" >
                            <label for="analisis" style="padding: 0px;margin: 0px;border: 0px">analisis</label>
                            <input type="text" style="text-transform: uppercase;padding: 0px;margin: 0px" class="form-control" id="analisis" placeholder="analisis" name="analisis" required>
                        </div>
                        <div class="form-group col-md-3" style="padding: 0px;margin: 0px;border: 0px" >
                            <label for="plan" style="padding: 0px;margin: 0px;border: 0px">plan</label>
                            <input type="text" style="text-transform: uppercase;padding: 0px;margin: 0px" class="form-control" id="plan" placeholder="plan" name="plan" required>
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


<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            ...
        </div>
    </div>
</div>

<div class="modal fade" id="medidas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar medidas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?=base_url()?>Paciente/medidas">
                    <div class="form-group row">
                        <label for="papada" class="col-sm-2 col-form-label">Papada</label>
                        <div class="col-sm-10">
                            <input type="text" id="idpacientem" name="idpaciente" hidden>
                            <input type="text" class="form-control" name="papada" id="papada" placeholder="papada">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="brazosd1" class="col-sm-2 col-form-label">Brazos d-1</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="brazosd1" id="brazosd1" placeholder="brazosd1">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="espaldaalta" class="col-sm-2 col-form-label">Espalda alta</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="espaldaalta" id="espaldaalta" placeholder="espaldaalta">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="espaldabaja" class="col-sm-2 col-form-label">Espalda baja</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="espaldabaja" id="espaldabaja" placeholder="espaldabaja">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cintura" class="col-sm-2 col-form-label">Cintura</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="cintura" id="cintura" placeholder="cintura">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ombligo" class="col-sm-2 col-form-label">Ombligo</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="ombligo" id="ombligo" placeholder="ombligo">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cm2" class="col-sm-2 col-form-label">A 2 cm del ombligo</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="cm2" id="cm2" placeholder="cm2">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cm4" class="col-sm-2 col-form-label">A 4 cm del ombligo</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="cm4" id="cm4" placeholder="cm4">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cadera" class="col-sm-2 col-form-label">Cadera</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="cadera" id="cadera" placeholder="cadera">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="muslo" class="col-sm-2 col-form-label">Muslo</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" name="muslo" id="muslo" placeholder="muslo">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->
<div class="modal fade" id="historial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">HIstorial</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="contenido"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

