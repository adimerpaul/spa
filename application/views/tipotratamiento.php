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
    <i class="fa fa-battery-0"></i> Registrar Tipo Tratamiento
</button>
<div class="mt-1"></div>
<table id="example" class="display nowrap" style="width:100%">
    <thead>
    <tr>

        <th>Id tipo</th>
        <th>Nombre</th>
        <th >descripcion</th>
        <th>Costo</th>
        <th>Opciones</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $query=$this->db->query("SELECT * FROM tipotratamiento");
    foreach ($query->result() as $row){
        echo "
        <tr>
        <td>".$row->idtipotratamiento."</td>
            <td> <div style='width:150px;white-space: pre-wrap;'>".$row->nombre."</div></td>
            <td> <div style='font-size: 8px;width:250px;white-space: pre-wrap;'>".$row->descripcion."</div></td>
            <td> <div style='font-size: 8px;width:250px;white-space: pre-wrap;'>".$row->costo."</div></td>
            <td> 
            <!--button  class='btn btn-sm btn-warning text-white sinespaciotexto' data-idusuario='$row->idtipotratamiento' data-toggle=\"modal\" data-target=\"#modificar\" ><i class='fa fa-pencil'></i> Actualizar</button>
            <br-->
            <a href='".base_url()."Tipotratamiento/delete/$row->idtipotratamiento' class='btn btn-sm btn-danger sinespaciotexto eli' ><i class='fa fa-trash-o'></i> Eliminar</a>
            <br>
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
    window.onload=function (e) {

    }

</script>
<!-- Modal -->

<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
    <div class="modal-dialog">
        <div class="modal-content mo">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Tratamiento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?=base_url()?>Tipotratamiento/insert" style="padding: 0px;margin: 0px;border: 0px">
                    <div class="form-row" style="padding: 0px;margin: 0px;border: 0px">
                        <div class="form-group col-md-12" style="padding: 0px;margin: 0px;border: 0px" >
                            <label for="nombre" style="padding: 0px;margin: 0px;border: 0px">nombre</label>
                            <input type="text" style="text-transform: uppercase;padding: 0px;margin: 0px" class="form-control" id="nombre" placeholder="nombre" name="nombre" required>
                        </div>
                        <div class="form-group col-md-12" style="padding: 0px;margin: 0px;border: 0px" >
                            <label for="descripcion" style="padding: 0px;margin: 0px;border: 0px">descripcion</label>
                            <input type="text" style="text-transform: uppercase;padding: 0px;margin: 0px" class="form-control" id="descripcion" placeholder="descripcion" name="descripcion" required>
                        </div>
                        <div class="form-group col-md-12" style="padding: 0px;margin: 0px;border: 0px" >
                            <label for="costo" style="padding: 0px;margin: 0px;border: 0px">costo</label>
                            <input type="text" style="text-transform: uppercase;padding: 0px;margin: 0px" class="form-control" id="costo" placeholder="costo" name="costo" required>
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
                <h5 class="modal-title" id="exampleModalLabel">Modificar Tratamiento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?=base_url()?>Tratamientos/update" style="padding: 0px;margin: 0px;border: 0px">
                    <div class="form-row" style="padding: 0px;margin: 0px;border: 0px">
                        <div class="form-group col-md-12" style="padding: 0px;margin: 0px;border: 0px" >
                            <label for="nombre2" style="padding: 0px;margin: 0px;border: 0px">nombre</label>
                            <input type="text" style="text-transform: uppercase;padding: 0px;margin: 0px" class="form-control" id="nombre2" placeholder="nombre" name="nombre" required>
                        </div>
                        <div class="form-group col-md-12" style="padding: 0px;margin: 0px;border: 0px" >
                            <label for="descripcion2" style="padding: 0px;margin: 0px;border: 0px">descripcion</label>
                            <input type="text" style="text-transform: uppercase;padding: 0px;margin: 0px" class="form-control" id="descripcion2" placeholder="descripcion" name="descripcion" required>
                        </div>
                        <div class="form-group col-md-12" style="padding: 0px;margin: 0px;border: 0px" >
                            <label for="costo2" style="padding: 0px;margin: 0px;border: 0px">costo</label>
                            <input type="text" style="text-transform: uppercase;padding: 0px;margin: 0px" class="form-control" id="costo2" placeholder="costo" name="costo" required>
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