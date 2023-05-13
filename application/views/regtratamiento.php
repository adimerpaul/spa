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

<form method="POST" action="<?=base_url()?>Paciente/agregartratamiento">
    <div class="sin form-group row">
        <label for="idtratamiento" class=" col-sm-4 col-form-label">Tratamiento</label>
        <div class=" col-sm-8">
            <input type="text" id="uidcotizacion4" name="idcotizacion" hidden >
            <input type="text" value="<?=$idpaciente?>" hidden name="idpaciente">
            <input type="text" value="<?=$idhistorial?>" hidden name="idhistorial">
            <input type="text" value="<?=$idcotizacion?>" hidden name="idcotizacion">
            <select name="idtratamiento" id="idtratamiento" >
                <option value=''>Seleccionar..</option>
                <?php
                $query=$this->db->query("SELECT * FROM tratamiento ORDER BY nombre");
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
    <div class="sin form-group row">
        <label for="diagnostico" class="col-sm-4 col-form-label">Diagnostico</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" placeholder="diagnostico" name="diagnostico" id="diagnostico" value="<?=$this->User->consulta('diagnostico','cotizacion','idcotizacion',$idcotizacion)?>" >
        </div>
    </div>
    <div class="sin form-group row">
        <label for="programa" class="col-sm-4 col-form-label">PROGRAMA DE TRATAMIENTO Y % APROXIMADO DE MEJORIA</label>
        <div class="col-sm-8">
            <textarea type="text" class="form-control" name="programa" id="programa" placeholder="PROGRAMA DE TRATAMIENTO Y % APROXIMADO DE MEJORIA" ><?=$this->User->consulta('programa','cotizacion','idcotizacion',$idcotizacion)?></textarea>
        </div>
    </div>
    <div class="modal-footer">
        <a type="button" class="btn btn-danger" href="<?=base_url()?>Paciente/cotizacion/<?=$idpaciente?>/<?=$idhistorial?>">Close</a>
        <button type="submit" class="btn btn-success">Agregar</button>
    </div>
</form>