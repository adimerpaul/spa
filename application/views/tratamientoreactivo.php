<form method="post" action="<?=base_url()?>Tratamientos/insertreactivo">
    <div class="form-group">
        <label for="exampleInputPassword1"> <h4>Tratamiento= <?=$this->User->Consulta('nombre','tratamiento','idtratamiento',$idtratamiento)?></h4>
            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-plus"></i> Agregar cantidad de reactivos que utiliza
            </button>
        </label>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Reactivo</th>
                <th scope="col">Cantidad</th>
                <th scope="col">Opciones</th>
            </tr>
            </thead>
            <tbody id="detalle">
            <?php
            $query=$this->db->query("SELECT r.nombre,t.cantidad,r.idreactivo FROM tratamientoreactivo t
 INNER JOIN  reactivo r ON r.idreactivo=t.idreactivo WHERE idtratamiento='$idtratamiento'");
            $c=0;
            foreach ($query->result() as $row){
                $c++;
                echo "<tr>
                        <th scope=\"col\">$c</th>
                        <th scope=\"col\">$row->nombre</th>
                        <th scope=\"col\">$row->cantidad</th>
                        <th scope=\"col\">
                            <a href='".base_url()."Tratamientos/eliminarreactivo/$idtratamiento/$row->idreactivo' class='btn btn-sm btn-danger eli'> <i class='fa fa-recycle'></i> Eliminar</a>
                        </th>
                    </tr>";
            }
            ?>
            </tbody>
        </table>
    </div>
</form>
<script >
    var eli=document.getElementsByClassName("eli");
    for (var i=0;i<eli.length;i++){
        eli[i].addEventListener('click',function (e) {
            if (!confirm("Seguro de eliminar?")){
                e.preventDefault();
            }
        })
    }

</script>

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar reactivo</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formulario" method="post" action="<?=base_url()?>Tratamientos/insertreactivo">
                    <div class="form-group row">
                        <label for="idreactivo" class="col-sm-3 col-form-label">Reactivo</label>
                        <div class="col-sm-9">
                            <input type="text" name="idtratamiento" value="<?=$idtratamiento?>" hidden>
                            <select name="idreactivo" id="idreactivo" class="form-control" required>
                                <option value="">Seleccionar...</option>
                                <?php
                                $query=$this->db->query("SELECT * FROM reactivo WHERE cantidad >0 ORDER BY nombre");
                                foreach ($query->result() as $row){
                                    echo "<option value='$row->idreactivo'>$row->nombre / $row->stock</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cantidad" class="col-sm-3 col-form-label">Cantidad</label>
                        <div class="col-sm-9">
                            <input type="text" id="cantidad" name="cantidad" value="1" class="form-control">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-close"></i> Cerrar</button>
                        <button type="submit" class="btn btn-success"> <i class="fa fa-check"></i> Agregar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>