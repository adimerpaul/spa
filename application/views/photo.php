<!-- Button trigger modal -->
<h4><?=$this->User->consulta('nombres','paciente','idpaciente',$idpaciente)?> <?=$this->User->consulta('apellidos','paciente','idpaciente',$idpaciente)?>  Idpaciente= <?=$idpaciente?></h4>

<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal">
    <i class="fa fa-picture-o"></i> Subir fotografia
</button>
<div class="mt-1"></div>
<table id="example" class="display nowrap" style="width:100%">
    <thead>
    <tr>
        <th>Idfotografia</th>
        <th>Fotografia</th>
        <th>fecha y hora</th>
        <!--th>Edad</th>
        <th>Telefono</th>
        <th>Opciones</th-->
    </tr>
    </thead>
    <tbody>
    <?php

    $nombre=$this->User->consulta('nombres','paciente','idpaciente',$idpaciente).' '.$this->User->consulta('apellidos','paciente','idpaciente',$idpaciente);
    $mi_archivo = 'foto';
    $carpeta = 'assets/img/'.$idpaciente.' '.$nombre;
    $query=$this->db->query("SELECT * FROM photo WHERE idpaciente='$idpaciente'");
    foreach ($query->result() as $row){
        echo "
        <tr>
            <td>".$row->idphoto."</td>
            <td> <a href='".base_url()."$carpeta/".$row->idphoto.".jpg'> <img src='".base_url()."$carpeta/".$row->idphoto.".jpg' alt='".$row->idphoto."' width='40'></a></td>
            <td>".$row->fecha."</td>
       </tr>";
    }
    ?>
    </tbody>
</table>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Subir fotografia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?=base_url()?>Photo/insertfoto" enctype="multipart/form-data" >
                    <div class="form-group">
                        <label for="foto">Seleccionar fotografia</label>
                        <input type="text" name="idpaciente" value="<?=$idpaciente?>" hidden>
                        <input type="file" class="form-control" id="foto" placeholder="foto" name="foto" required>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-success">Subir</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>