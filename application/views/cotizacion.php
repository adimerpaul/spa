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
        <th>Monto pagado</th>
        <th>Fecha</th>
        <th style="width: 150px">Tratamientos </th>
        <th>Consentimientos</th>
        <th>Opciones</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $query=$this->db->query("SELECT *
    FROM cotizacion
    WHERE idhistorial='$idhistorial'");


    foreach ($query->result() as $row){

        $query2=$this->db->query("SELECT * FROM cotizaciontratamiento c 
INNER JOIN tratamiento t ON c.idtratamiento=t.idtratamiento 
WHERE c.idcotizacion='".$row->idcotizacion."'");
        $tratamientos="";
        $suma=0;
        //echo $query2->num_rows();

        foreach ($query2->result() as $row2){
            $tratamientos=$tratamientos.$row2->nombre.' n:'.$row2->n.' t:'.$row2->tiempo.' cost:'.$row2->costo.'<br>';
            //$suma=$suma+$row2->costo;
        }

        $query2=$this->db->query("SELECT * FROM montos 
WHERE idcotizacion='".$row->idcotizacion."'");
        $montos="";
        foreach ($query2->result() as $row2){
            $montos=$montos."<b>Monto:</b> ".$row2->monto." <b>Bs.  Fecha:</b> ".substr($row2->fecha,0,10);

        }

        //$tratamientos=$tratamientos.'<b>Total '.$suma.'</b>';
        $query2=$this->db->query("SELECT * FROM cotizacionconsetimeinto c 
INNER JOIN consentimiento con ON c.idconsetimiento=con.idconsentimiento 
WHERE c.idcotizacion='".$row->idcotizacion."'");
        $consentimientos="";
        $cont=0;
        foreach ($query2->result() as $row2){
            $cont++;
            $consentimientos=$consentimientos."<b>$cont.-</b> ".$row2->nombre."<a href='".base_url()."Paciente/eliconcentimiento/$row2->idconsetimiento/".$row->idcotizacion."/$idpaciente/$idhistorial' class='btn btn-danger btn-sm sint eli'> <i class='fa fa-close'></i></a><br>";
        }
        /*$query2=$this->db->query("SELECT * FROM cotizacionlaboratorio c INNER JOIN laboratorio con ON c.idlaboratorio=con.idlaboratorio
WHERE c.idcotizacion='".$row->idcotizacion."'");
        $laboratorios="";
        foreach ($query2->result() as $row2){
            $laboratorios=$laboratorios.$row2->nombre."<br>";
        }*/
        echo "
        <tr>
            <td>".$montos."</td>
            <td>".substr($row->fecha,0,10)."</td>
            <td style='border: 0;padding: 0;margin: 0;font-size: 12px'>".$tratamientos."</td>
            <td style='border: 0;padding: 0;margin: 0;font-size: 10px;white-space: pre-wrap;width: 200px;'>$consentimientos </td>
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
             </button><br>
             <a href='".base_url()."Soap/index/$row->idcotizacion'
               data-idcotizacion='$row->idcotizacion'
               data-idpaciente='$idpaciente'
               class='btn btn-sm btn-success btn-sm sin text-white'>
               <i class='fa fa-history'></i> SOAP
             </a>
             <br>
             
             <button type='button' class='btn btn-primary btn-sm sin' data-toggle='modal' data-target='#medidas' 
             data-idcotizacion='".$row->idcotizacion."'> <i class='fa fa-medium'></i> Medias</button>
             <br>
             <a type='button' href='".base_url()."Paciente/regtratamiento/$idpaciente/$idhistorial/$row->idcotizacion' class='btn btn-success btn-sm sin'
             data-idcotizacion='".$row->idcotizacion."'> <i class='fa fa-map-marker'></i> Agregar tratamiento</a>
             <br>
             <a href='".base_url()."Imprimir/index/$row->idcotizacion/$idpaciente/$idhistorial'
               class='btn btn-sm btn-primary btn-sm sin text-white'>
               <i class='fa fa-print'></i> Imprimir
             </a>
             <br>
             <a href='".base_url()."paciente/elicotizacion/$row->idcotizacion/$idpaciente/$idhistorial'
               data-idcotizacion='$row->idcotizacion'
               data-idpaciente='$idpaciente'
               class=' eli btn btn-sm btn-danger btn-sm sin text-white'>
               <i class='fa fa-history'></i> Eliminar
             </a>
            </td>
        </tr>";
    }
    ?>
    </tbody>
</table>
<script !src="">
    var eli=document.getElementsByClassName('eli');
    for (var i=0;i<eli.length;i++){
        eli[i].addEventListener('click',function (e) {
            if(!confirm('Seguro de eliminar?')){
                e.preventDefault();
            }
        })
    }

</script>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Tratamientos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <form method="post" action="<?=base_url()?>paciente/insertcotizacion">
                    <input type="text" value="<?=$idpaciente?>" hidden name="idpaciente">
                    <input type="text" value="<?=$idhistorial?>" hidden name="idhistorial">
                    <div class="form-group">
                        <center>
                        <table  >
                            <thead style='border: 0;padding: 0;margin: 0'>
                                <tr style='border: 0;padding: 0;margin: 0'>
                                    <th class='sin' >Tratamientos</th>
                                    <!--th class='sin'>Selecionar</th-->
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
                                                    <td style='border-bottom: solid black 1px;padding: 0;margin: 0'>".$row->nombre."</td>
                                                    <!--td style='border: 0;padding: 0;margin: 0'><input style='border: 0;padding: 0;margin: 0' type='checkbox' name='t".$row->idtratamiento."' id=''> Seleccionar</td-->
                                                    <td style='border: 0;padding: 0;margin: 0'><input style='padding: 0;margin: 0;width: 50px' type='text' name='n".$row->idtratamiento."' id=''> </td>
                                                    <td style='border: 0;padding: 0;margin: 0'><input style='padding: 0;margin: 0;width: 50px' type='text' name='ti".$row->idtratamiento."' id=''> </td>
                                                    <td style='border: 0;padding: 0;margin: 0'><input type='number' class='sum' value='0' style='padding: 0;margin: 0;width: 50px' type='text' name='c".$row->idtratamiento."' id=''> </td>
                                                </tr>";
                                    }
                                ?>

                            </tboby>
                            <!--h2>TOTAL <span id="total">0</span></h2-->

                        </table>
                        </center>

                    </div>
                    <div class="form-group row">
                        <label for="diagnostico" class="col-sm-3 col-form-label">Diagnosticos</label>
                        <div class="col-sm-9">
                            <input type="text" name="diagnostico" style="width: 100%" id="diagnostico" >
                        </div>
                    </div>
                        <label for="programa" class="col-form-label">PROGRAMA DE TRATAMIENTOS Y % APROXIMADOS DE MEJORA</label>
                        <div class="">
                            <textarea style="width: 100%" name="programa"   id="programa" ></textarea>
                        </div>
                    <div class="form-group row">
                        <label for="adelanto" class="col-sm-4 col-form-label">Costo/Adelanto</label>
                        <div class="col-sm-8">
                            <input type="number" name="adelanto" style="width: 100%" value="100" id="adelanto" required >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="motivo" class="col-sm-4 col-form-label">Motivo/DX</label>
                        <div class="col-sm-8">
                            <input type="text" name="motivo" style="width: 100%" id="motivo"  >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cot" class="col-sm-4 col-form-label">COT/SUG TX</label>
                        <div class="col-sm-8">
                            <input type="text" name="cot" style="width: 100%"  id="cot"  >
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="ref" class="col-sm-4 col-form-label">Referencia</label>
                        <div class="col-sm-8">
                            <input type="text" name="ref" style="width: 100%"  id="ref"  >
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


<div class="modal fade" id="medidas" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar medidas</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?=base_url()?>Paciente/medidas">
                    <div class="sin form-group row">
                        <label for="papada" class=" col-sm-4 col-form-label">Papada</label>
                        <div class=" col-sm-8">
                            <input type="text" id="uidcotizacion3" name="idcotizacion" hidden >
                            <input type="text" class=" form-control" name="papada" id="papada" placeholder="papada">
                        </div>
                    </div>
                    <div class="sin form-group row">
                        <label for="brazosd1" class=" col-sm-4 col-form-label">Brazos d-1</label>
                        <div class=" col-sm-8">
                            <input type="text" class=" form-control" name="brazosd1" id="brazosd1" placeholder="brazosd1">
                        </div>
                    </div>
                    <div class="sin form-group row">
                        <label for="espaldaalta" class="col-sm-4 col-form-label">Espalda alta</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="espaldaalta" id="espaldaalta" placeholder="espaldaalta">
                        </div>
                    </div>
                    <div class="sin form-group row">
                        <label for="espaldabaja" class="col-sm-4 col-form-label">Espalda baja</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="espaldabaja" id="espaldabaja" placeholder="espaldabaja">
                        </div>
                    </div>
                    <div class="sin form-group row">
                        <label for="cintura" class="col-sm-4 col-form-label">Cintura</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="cintura" id="cintura" placeholder="cintura">
                        </div>
                    </div>
                    <div class="sin form-group row">
                        <label for="ombligo" class="col-sm-4 col-form-label">Ombligo</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="ombligo" id="ombligo" placeholder="ombligo">
                        </div>
                    </div>
                    <div class="sin form-group row">
                        <label for="cm2" class="col-sm-4 col-form-label">A 2 cm del ombligo</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="cm2" id="cm2" placeholder="cm2">
                        </div>
                    </div>
                    <div class="sin form-group row">
                        <label for="cm4" class="col-sm-4 col-form-label">A 4 cm del ombligo</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="cm4" id="cm4" placeholder="cm4">
                        </div>
                    </div>
                    <div class="sin form-group row">
                        <label for="cadera" class="col-sm-4 col-form-label">Cadera</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="cadera" id="cadera" placeholder="cadera">
                        </div>
                    </div>
                    <div class="sin form-group row">
                        <label for="muslo" class="col-sm-4 col-form-label">Muslo</label>
                        <div class="col-sm-8">
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

<div class="modal fade" id="agregar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar tratamiento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?=base_url()?>Paciente/agregartratamiento">
                    <div class="sin form-group row">
                        <label for="idtratamiento" class=" col-sm-4 col-form-label">Tratamiento</label>
                        <div class=" col-sm-8">
                            <input type="text" id="uidcotizacion4" name="idcotizacion" hidden >
                            <input type="text" value="<?=$idpaciente?>" hidden name="idpaciente">
                            <input type="text" value="<?=$idhistorial?>" hidden name="idhistorial">
                            <select name="idtratamiento" id="idtratamiento" >
                                <option value=''>Seleccionar..</option>
                                <?php
                                $query=$this->db->query("SELECT * FROM tratamiento");
                                foreach ($query->result() as $row){
                                    echo "<option value='".$row->idtratamiento."'>$row->nombre</option>";
                                }

                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="sin form-group row">
                        <label for="n" class=" col-sm-4 col-form-label">N</label>
                        <div class=" col-sm-8">
                            <input type="text" class=" form-control" name="n" id="n" placeholder="sessiones">
                        </div>
                    </div>
                    <div class="sin form-group row">
                        <label for="tiempo" class="col-sm-4 col-form-label">Tiempo</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="tiempo" id="tiempo" placeholder="tiempo">
                        </div>
                    </div>
                    <div class="sin form-group row">
                        <label for="costo" class="col-sm-4 col-form-label">Costo</label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="costo" id="costo" placeholder="costo">
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





