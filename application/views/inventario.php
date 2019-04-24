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
        padding: 0px;
        margin: 0px;
    }
    label::first-letter {
        text-transform: uppercase;
    }
</style>
<!-- Button trigger modal -->
<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target=".bs-example-modal-lg">
    <i class="fa fa-battery-0"></i> Registrar Reactivo
</button>
<div class="mt-1"></div>
<table id="example" class="display nowrap" style="width:100%">
    <thead>
    <tr>
        <th>Nombre</th>
        <th>Cantidad</th>
        <th>Presentacion</th>
        <th>Opciones</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $query=$this->db->query("SELECT * FROM `reactivo` ORDER BY `reactivo`.`nombre` DESC ");
    foreach ($query->result() as $row){
        echo "
        <tr>
            <td>".$row->nombre."</td>
            <td>".$row->cantidad."</td>
            <td>".$row->presentacion."</td>
            <td> 
            <button  class='btn btn-sm btn-warning text-white sinespaciotexto' data-idusuario='$row->idreactivo' data-toggle=\"modal\" data-target=\"#modificar\" ><i class='fa fa-pencil'></i> Actualizar</button>
            <a href='".base_url()."Inventario/delete/$row->idreactivo' class='btn btn-sm btn-danger sinespaciotexto eli' ><i class='fa fa-trash-o'></i> Eliminar</a>
            </td>
        </tr>";
    }
    ?>
    </tbody>
</table>
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
<!-- Modal -->

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?=base_url()?>Inventario/insert" style="padding: 0px;margin: 0px;border: 0px">
                    <div class="form-row" style="padding: 0px;margin: 0px;border: 0px">
                        <div class="form-group col-md-12" style="padding: 0px;margin: 0px;border: 0px" >
                            <label for="nombre" style="padding: 0px;margin: 0px;border: 0px">nombre</label>
                            <input type="text" style="text-transform: uppercase;padding: 0px;margin: 0px" class="form-control" id="nombre" placeholder="nombre" name="nombre" required>
                        </div>
                        <div class="form-group col-md-12" style="padding: 0px;margin: 0px;border: 0px" >
                            <label for="cantidad" style="padding: 0px;margin: 0px;border: 0px">cantidad</label>
                            <input type="text" style="text-transform: uppercase;padding: 0px;margin: 0px" class="form-control" id="cantidad" value="0" placeholder="cantidad" name="cantidad" required>
                        </div>
                        <div class="form-group col-md-12" style="padding: 0px;margin: 0px;border: 0px" >
                            <label for="presentacion" style="padding: 0px;margin: 0px;border: 0px">presentacion</label>
                            <input type="text" style="text-transform: uppercase;padding: 0px;margin: 0px" class="form-control" id="presentacion" value="0" placeholder="presentacion" name="presentacion" required>
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




<div class="modal fade" id="modificar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modificar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?=base_url()?>Inventario/update" style="padding: 0px;margin: 0px;border: 0px">
                    <div class="form-row" style="padding: 0px;margin: 0px;border: 0px">
                        <div class="form-group col-md-12" style="padding: 0px;margin: 0px;border: 0px" >

                            <label for="nombre2" style="padding: 0px;margin: 0px;border: 0px">Nombre</label>
                            <input type="text" id="idreactivo2" name="idreactivo">
                            <input type="text" style="text-transform: uppercase;padding: 0px;margin: 0px" class="form-control" id="nombre2" placeholder="nombre" name="nombre" required>
                        </div>
                        <div class="form-group col-md-12" style="padding: 0px;margin: 0px;border: 0px" >
                            <label for="cantidad2" style="padding: 0px;margin: 0px;border: 0px">Cantidad</label>
                            <input type="text" style="text-transform: uppercase;padding: 0px;margin: 0px" class="form-control" id="cantidad2" value="0" placeholder="cantidad" name="cantidad" required>
                        </div>
                        <div class="form-group col-md-12" style="padding: 0px;margin: 0px;border: 0px" >
                            <label for="presentacion2" style="padding: 0px;margin: 0px;border: 0px">Presentacion</label>
                            <input type="text" style="text-transform: uppercase;padding: 0px;margin: 0px" class="form-control" id="presentacion2" value="0" placeholder="presentacion" name="presentacion" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-warning">Modificar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>