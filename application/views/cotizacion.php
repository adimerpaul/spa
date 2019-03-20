<style>
    .sin{
        padding: 0px;
        margin: 0px;
        border: 0px;
    }
    .sint{
        padding: 1px;
        margin: 0px;
        height: 20px;
    }
</style>
<h4><?=$this->User->consulta('nombres','paciente','idpaciente',$idpaciente)?> <?=$this->User->consulta('apellidos','paciente','idpaciente',$idpaciente)?>  Idpaciente= <?=$idpaciente?></h4>
<!-- Button trigger modal -->
<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal">
    <i class="fa fa-circle-o"></i> Realizar cotizacion
</button>
<div class="mt-1"></div>
<table id="example" class="display nowrap" style="width:100%">
    <thead>
    <tr>
        <th>Idcotizacion</th>
        <th>Fecha y hora</th>
        <th style="width: 150px">Tratamientos </th>
        <th>Consentimientos</th>
        <th>Opciones</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $query=$this->db->query("SELECT c.idcotizacion,c.fecha,p.nombres,p.apellidos,count(*) as cantidad FROM paciente p INNER JOIN cotizacion c ON p.idpaciente=c.idpaciente
 INNER JOIN cotizaciontratamiento ct ON ct.idcotizacion=c.idcotizacion WHERE p.idpaciente='$idpaciente' GROUP BY c.idcotizacion");
    foreach ($query->result() as $row){
        $query2=$this->db->query("SELECT * FROM cotizaciontratamiento c INNER JOIN tratamiento t ON c.idtratamiento=t.idtratamiento 
WHERE c.idcotizacion='".$row->idcotizacion."'");
        $tratamientos="";
        $suma=0;
        foreach ($query2->result() as $row2){
            $tratamientos=$tratamientos.$row2->nombre.' n:'.$row2->n.' t:'.$row2->tiempo.' cost:'.$row2->costo.'<br>';
            $suma=$suma+$row2->costo;
        }
        $tratamientos=$tratamientos.'<b>Total '.$suma.'</b>';
        $query2=$this->db->query("SELECT * FROM cotizacionconsetimeinto c INNER JOIN consentimiento con ON c.idconsetimiento=con.idconsentimiento 
WHERE c.idcotizacion='".$row->idcotizacion."'");
        $consentimientos="";
        foreach ($query2->result() as $row2){
            $consentimientos=$consentimientos.$row2->nombre."<br>";
        }
        /*$query2=$this->db->query("SELECT * FROM cotizacionlaboratorio c INNER JOIN laboratorio con ON c.idlaboratorio=con.idlaboratorio
WHERE c.idcotizacion='".$row->idcotizacion."'");
        $laboratorios="";
        foreach ($query2->result() as $row2){
            $laboratorios=$laboratorios.$row2->nombre."<br>";
        }*/
        echo "
        <tr>
            <td>".$row->idcotizacion."</td>
            <td style='font-size: 7px'>".$row->fecha."</td>
            <td style='border: 0;padding: 0;margin: 0;font-size: 10px'>".$tratamientos."</td>
            <td style='border: 0;padding: 0;margin: 0;font-size: 7px'>$consentimientos</td>

            <td> 
            <a href='".base_url()."Paciente/fotografia/".$row->idcotizacion."'  class='btn btn-sm btn-warning btn-sm text-white sin'><i class='fa fa-photo'></i> Fotografias</a>
            <br>
            <a href='".base_url()."Paciente/receta/".$row->idcotizacion."'  class='btn btn-sm btn-primary btn-sm sin'><i class='fa fa-coffee'></i> Recetas</a>
             
             <br>
             <button data-toggle=\"modal\" data-target=\"#consentimiento\"
               data-idcotizacion='$row->idcotizacion'
               data-idpaciente='$idpaciente'
               class='btn btn-sm btn-info btn-sm sin text-white'>
               <i class='fa fa-file-powerpoint-o'></i> Consetimientos
             </button>
             <br>
             <button data-toggle='modal' data-target='#laboratorios'
               data-idcotizacion='$row->idcotizacion'
               data-idpaciente='$idpaciente'
               class='btn btn-sm btn-success btn-sm sin text-white'>
               <i class='fa fa-language'></i> Laboratorios
             </button>
            </td>
        </tr>";
    }
    ?>
    </tbody>
</table>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Paciente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?=base_url()?>paciente/insertcotizacion">
                    <input type="text" value="<?=$idpaciente?>" hidden name="idpaciente">
                    <div class="form-group">
                        <table class="table">
                            <thead style='border: 0;padding: 0;margin: 0'>
                                <tr style='border: 0;padding: 0;margin: 0'>
                                    <th class='sin' >Tratamientos</th>
                                    <th class='sin'>Selecionar</th>
                                    <th class='sin'>N</th>
                                    <th class='sin'>Tiempo</th>
                                    <th class='sin'>Costo/Sesion</th>
                                </tr>
                            </thead>
                            <tboby>
                                <?php
                                    $query=$this->db->query("SELECT * FROM tratamiento");
                                    foreach ($query->result() as $row){
                                        echo "<tr style='border: 0;padding: 0;margin: 0'>
                                                    <td style='border: 0;padding: 0;margin: 0'>".$row->nombre."</td>
                                                    <td style='border: 0;padding: 0;margin: 0'><input style='border: 0;padding: 0;margin: 0' type='checkbox' name='t".$row->idtratamiento."' id=''> Seleccionar</td>
                                                    <td style='border: 0;padding: 0;margin: 0'><input style='padding: 0;margin: 0;width: 50px' type='text' name='n".$row->idtratamiento."' id=''> </td>
                                                    <td style='border: 0;padding: 0;margin: 0'><input style='padding: 0;margin: 0;width: 50px' type='text' name='ti".$row->idtratamiento."' id=''> </td>
                                                    <td style='border: 0;padding: 0;margin: 0'><input style='padding: 0;margin: 0;width: 50px' type='text' name='c".$row->idtratamiento."' id=''> </td>
                                                </tr>";
                                    }
                                ?>

                            </tboby>
                            
                        </table>
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

<!-- Modal -->
<div class="modal fade" id="consentimiento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Imprimir consentimientos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?=base_url()?>Paciente/consentimientoinsert" method="post">
                    <div class="form-group">
                        <label for="idconsetimiento">Consentimiento</label>
                        <input type="text" name="idcotizacion" id="uidcotizacion" hidden>
                        <input type="text" name="idpaciente" id="uidpaciente" hidden>
                        <select style="padding: 0px;margin: 0px" required name="idconsentimiento" id="idconsetimiento" class="form-control">
                            <option style="padding: 0px;margin: 0px" value=''>Seleccionar..</option>
                            <?php
                            $query=$this->db->query("SELECT * FROM consentimiento");
                            foreach ($query->result() as $row){
                                echo "<option value='".$row->idconsentimiento."'>".$row->nombre."</option>";
                            }
                            ?>
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Imprimir</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="laboratorios" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Imprimir consentimientos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?=base_url()?>Paciente/laboratorioinsert" method="post">
                    <div class="form-group row">
                        <label  class="col-sm-5">Diagnostico Presuntivo:</label>
                        <div class="col-sm-7">
                            <input type="text" name="diagnostico"  class="form-control sint">
                        </div>

                    </div>
                    <div class="form-group">

                        <input type="text" name="idcotizacion" id="uidcotizacion2" hidden>
                        <input type="text" name="idpaciente" id="uidpaciente2" hidden>
                        <?php
                        $query=$this->db->query("SELECT * FROM tipolaboratorio");
                        foreach ($query->result() as $row){
                            echo "<h6 class='text-center sin' >".$row->nombre."</h6>";
                            $query2=$this->db->query("SELECT * FROM laboratorio where idtipolaboratorio='".$row->idtipolaboratorio."'");
                            foreach ($query2->result() as $row2){
                                echo "<input class='sin' type='checkbox' name='l".$row2->idlaboratorio."' > ".$row2->nombre.'<br>';
                            }
                        }
                        ?>
                    </div>

                    <div class="form-group row">
                        <label  class="col-sm-4">Otros examenes:</label>
                        <div class="col-sm-8">
                            <input type="text" name="otros"  class="form-control sint">
                        </div>

                    </div>
                    <div class="form-group row">
                        <label  class="col-sm-4">Indicaciones especiales:</label>
                        <div class="col-sm-8">
                            <input type="text" name="indicaciones"  class="form-control sint">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




