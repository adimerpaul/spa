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
    <i class="fa fa-battery-0"></i> Registrar Producto
</button>
<div class="mt-1"></div>
<table id="example" class="display nowrap" style="width:100%">
    <thead>
    <tr>
        <th>Idtratamiento</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Stock</th>
        <th>Opciones</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $query=$this->db->query("SELECT * FROM producto
");
    foreach ($query->result() as $row){

        echo "
        <tr>
            <td>".$row->idproducto."</td>
            <td>".$row->nombre."</td>
            <td>".$row->precio."</td>
            <td>".$row->stock."</td>
            <td> 
            <button  class='btn btn-sm btn-warning text-white sinespaciotexto' data-idusuario='$row->idproducto' data-toggle=\"modal\" data-target=\"#modificar\" ><i class='fa fa-pencil'></i> Actualizar</button>
            <a href='".base_url()."Productos/delete/$row->idproducto' class='btn btn-sm btn-danger sinespaciotexto eli' ><i class='fa fa-trash-o'></i> Eliminar</a>
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
                <form method="post" action="<?=base_url()?>Productos/insert" style="padding: 0px;margin: 0px;border: 0px">
                    <div class="form-row" style="padding: 0px;margin: 0px;border: 0px">
                        <div class="form-group col-md-12" style="padding: 0px;margin: 0px;border: 0px" >
                            <label for="nombre" style="padding: 0px;margin: 0px;border: 0px">nombre</label>
                            <input type="text" style="text-transform: uppercase;padding: 0px;margin: 0px" class="form-control" id="nombre" placeholder="nombre" name="nombre" required>
                        </div>
                        <div class="form-group col-md-12" style="padding: 0px;margin: 0px;border: 0px" >
                            <label for="precio" style="padding: 0px;margin: 0px;border: 0px">precio</label>
                            <input type="text" style="text-transform: uppercase;padding: 0px;margin: 0px" class="form-control" id="precio" value="0" placeholder="precio" name="precio" required>
                        </div>
                        <div class="form-group col-md-12" style="padding: 0px;margin: 0px;border: 0px" >
                            <label for="stock" style="padding: 0px;margin: 0px;border: 0px">stock</label>
                            <input type="text" style="text-transform: uppercase;padding: 0px;margin: 0px" class="form-control" id="stock" value="0" placeholder="stock" name="stock" required>
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
                <form method="post" action="<?=base_url()?>Productos/update" style="padding: 0px;margin: 0px;border: 0px">
                    <div class="form-row" style="padding: 0px;margin: 0px;border: 0px">
                        <div class="form-group col-md-12" style="padding: 0px;margin: 0px;border: 0px" >

                            <label for="nombre2" style="padding: 0px;margin: 0px;border: 0px">Nombre</label>
                            <input type="text" id="idproducto2" name="idproducto">
                            <input type="text" style="text-transform: uppercase;padding: 0px;margin: 0px" class="form-control" id="nombre2" placeholder="nombre" name="nombre" required>
                        </div>
                        <div class="form-group col-md-12" style="padding: 0px;margin: 0px;border: 0px" >
                            <label for="precio2" style="padding: 0px;margin: 0px;border: 0px">Precio</label>
                            <input type="text" style="text-transform: uppercase;padding: 0px;margin: 0px" class="form-control" id="precio2" value="0" placeholder="precio" name="precio" required>
                        </div>
                        <div class="form-group col-md-12" style="padding: 0px;margin: 0px;border: 0px" >
                            <label for="stock2" style="padding: 0px;margin: 0px;border: 0px">Stock</label>
                            <input type="text" style="text-transform: uppercase;padding: 0px;margin: 0px" class="form-control" id="stock2" value="0" placeholder="stock" name="stock" required>
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