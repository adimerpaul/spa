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
    <i class="fa fa-file"></i> Registrar Paciente
</button>
<div class="mt-1"></div>
<table id="example" class="display nowrap" style="width:100%">
    <thead>
    <tr>
        <th>Idpaciente</th>
        <th>Nombre</th>
        <th>Direccion</th>
        <th>Edad</th>
        <th>Telefono</th>
        <th>Opciones</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $query=$this->db->query("SELECT * FROM paciente");
    foreach ($query->result() as $row){
        $cumpleanos = new DateTime($row->fechanac);
        $hoy = new DateTime();
        $annos = $hoy->diff($cumpleanos);
        echo "
        <tr>
            <td>".$row->idpaciente."</td>
            <td>".$row->nombres." ".$row->apellidos."</td>
            <td>".$row->direccion."</td>
            <td>".$annos->y."</td>
            <td>".$row->celular."</td>
            <td> 
            <a href='".base_url()."Paciente/reghistorial/".$row->idpaciente."' class='btn btn-sm btn-success text-white sinespaciotexto' ><i class='fa fa-file-archive-o'></i> Reg. Historial</a>
            <a type='button' class='btn btn-warning text-white btn-sm sinespaciotexto' href='".base_url()."Paciente/escoger/".$row->idpaciente."' > <i class=\"fa fa-align-justify\"></i>Historiales</a>
             </td>
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
                <h5 class="modal-title" id="exampleModalLabel">Registrar Historia clinica</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?=base_url()?>paciente/insert" style="padding: 0px;margin: 0px;border: 0px">
                    <div class="form-row" style="padding: 0px;margin: 0px;border: 0px">
                        <div class="form-group col-md-2" style="padding: 0px;margin: 0px;border: 0px" >
                            <label for="nombres" style="padding: 0px;margin: 0px;border: 0px">nombres</label>
                            <input type="text" style="text-transform: uppercase;padding: 0px;margin: 0px" class="form-control" id="nombres" placeholder="nombres" name="nombres" >
                        </div>
                        <div class="form-group col-md-2" style="padding: 0px;margin: 0px;border: 0px">
                            <label for="apellidos" style="padding: 0px;margin: 0px;border: 0px">apellidos</label>
                            <input type="text" style="text-transform: uppercase;padding: 0px;margin: 0px" class="form-control" id="apellidos" placeholder="apellidos" name="apellidos" required>
                        </div>
                        <div class="form-group col-md-3" style="padding: 0px;margin: 0px;border: 0px">
                            <label for="ci">ci</label>
                            <input type="text" style="padding: 0px;margin: 0px" class="form-control" id="ci" placeholder="ci" name="ci">
                        </div>
                        <div class="form-group col-md-2" style="padding: 0px;margin: 0px;border: 0px">
                            <label for="zona">zona</label>
                            <input type="text" style="padding: 0px;margin: 0px" class="form-control" id="zona" placeholder="zona" name="zona">
                        </div>
                        <div class="form-group col-md-3" style="padding: 0px;margin: 0px;border: 0px">
                            <label for="direccion">direccion</label>
                            <input type="text" style="padding: 0px;margin: 0px"  class="form-control" id="direccion" placeholder="1234 Main St" name="direccion">
                        </div>
                    </div>
                    <div class="form-row" style="padding: 0px;margin: 0px;border: 0px">
                        <div class="form-group col-md-3" style="padding: 0px;margin: 0px;border: 0px">
                            <label for="fechanac">fechanac</label>
                            <input type="date" style="padding: 0px;margin: 0px" class="form-control" id="fechanac" placeholder="fechanac" name="fechanac" value="<?=date("Y-m-d")?>" required>
                        </div>
                        <div class="form-group col-md-3" style="padding: 0px;margin: 0px;border: 0px">
                            <label for="celular">celular</label>
                            <input type="number" style="padding: 0px;margin: 0px" class="form-control" id="celular" placeholder="celular" name="celular" >
                        </div>
                        <div class="form-group col-md-3" style="padding: 0px;margin: 0px;border: 0px">
                            <label for="telefono">telefono</label>
                            <input type="number" style="padding: 0px;margin: 0px" class="form-control" id="telefono" placeholder="telefono" name="telefono">
                        </div>
                        <div class="form-group col-md-3" style="padding: 0px;margin: 0px;border: 0px">
                            <label for="referencia">referencia</label>
                            <select name="referencia" id="referencia"  style="padding: 0px;margin: 0px" class="form-control">
                                <option value="">Seleccionar..</option>
                                <option value="Facebook">Facebook</option>
                                <option value="Periódico">Periódico</option>
                                <option value="Referido">Referido</option>
                                <option value="Antiguo">Antiguo</option>
                                <option value="Televisión">Televisión</option>
                                <option value="Familiar">Familiar</option>
                            </select>
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
                <h5 class="modal-title" id="exampleModalLabel">Historial</h5>
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

