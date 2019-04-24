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
    <i class="fa fa-key"></i> Registrar Dosificacion
</button>
<div class="mt-1"></div>
<table id="example" class="display nowrap" style="width:100%">
    <thead>
    <tr>
        <th>Desde</th>
        <th>Hasta</th>
        <th>Nro Tramite</th>
        <th>Nro autorizacion</th>
        <th>Factura inicial</th>

        <th>estado</th>
        <th>Opciones</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $query=$this->db->query("SELECT * FROM dosificacion
");
    foreach ($query->result() as $row){
        if ($row->estado=="ACTIVO"){
            $t="<span class='btn-success'>ACTIVO</span>";
        }else{
            $t="<span class='btn-warning'>INACTIVO</span>";
        }

        echo "
        <tr>
            <td>".$row->desde."</td>
            <td>".$row->hasta."</td>
            <td>".$row->nrotramite."</td>
            <td>".$row->nroautorizacion."</td>
            <td>".$row->nrofactura."</td>

            <td> ".$t."</td>
            <td> 
            <button  class='btn btn-sm btn-warning text-white sinespaciotexto' data-idusuario='$row->iddosificacion' data-toggle=\"modal\" data-target=\"#modificar\" ><i class='fa fa-pencil'></i> Actualizar</button>
            <a href='".base_url()."Dosificacion/delete/$row->iddosificacion' class='btn btn-sm btn-danger sinespaciotexto eli' ><i class='fa fa-trash-o'></i> Eliminar</a>
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
                <form method="post" action="<?=base_url()?>Dosificacion/insert" style="padding: 0px;margin: 0px;border: 0px">
                    <div class="form-row" style="padding: 0px;margin: 0px;border: 0px">
                        <div class="form-group col-md-12" style="padding: 0px;margin: 0px;border: 0px" >
                            <label for="desde" style="padding: 0px;margin: 0px;border: 0px">Desde</label>
                            <input type="date" style="text-transform: uppercase;padding: 0px;margin: 0px" class="form-control" id="desde" placeholder="desde" name="desde" required value="<?=date('Y-m-d')?>">
                        </div>
                        <div class="form-group col-md-12" style="padding: 0px;margin: 0px;border: 0px" >
                            <label for="hasta" style="padding: 0px;margin: 0px;border: 0px">Hasta</label>
                            <input type="date" style="text-transform: uppercase;padding: 0px;margin: 0px" class="form-control" id="hasta" placeholder="hasta" name="hasta" required value="<?=date('Y-m-d')?>">
                        </div>
                        <div class="form-group col-md-12" style="padding: 0px;margin: 0px;border: 0px" >
                            <label for="nrotramite" style="padding: 0px;margin: 0px;border: 0px">Numero de tramite</label>
                            <input type="number" style="text-transform: uppercase;padding: 0px;margin: 0px" class="form-control" id="nrotramite" placeholder="0" name="nrotramite" required>
                        </div>
                        <div class="form-group col-md-12" style="padding: 0px;margin: 0px;border: 0px" >
                            <label for="nroautorizacion" style="padding: 0px;margin: 0px;border: 0px">Numero de autorizacion</label>
                            <input type="number" style="text-transform: uppercase;padding: 0px;margin: 0px" class="form-control" id="nroautorizacion"  placeholder="0" name="nroautorizacion" required>
                        </div>
                        <div class="form-group col-md-12" style="padding: 0px;margin: 0px;border: 0px" >
                            <label for="nrofactura" style="padding: 0px;margin: 0px;border: 0px">Factura inicial</label>
                            <input type="number" style="text-transform: uppercase;padding: 0px;margin: 0px" class="form-control" id="nrofactura" value="1" placeholder="0" name="nrofactura" required>
                        </div>
                        <div class="form-group col-md-12" style="padding: 0px;margin: 0px;border: 0px" >
                            <label for="llave" style="padding: 0px;margin: 0px;border: 0px">Llave de dosificacion</label>
                            <input type="text" style="padding: 0px;margin: 0px" class="form-control" id="llave" placeholder="LLave de dosificacion" name="llave" required>
                        </div>
                        <div class="form-group col-md-12" style="padding: 0px;margin: 0px;border: 0px" >
                            <label for="leyenda" style="padding: 0px;margin: 0px;border: 0px">Leyenda</label>
                            <input type="text" style="padding: 0px;margin: 0px" class="form-control" id="leyenda"  placeholder="Texto de leyenda" name="leyenda" required>
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
                <form method="post" action="<?=base_url()?>Dosificacion/update" style="padding: 0px;margin: 0px;border: 0px">
                    <div class="form-row" style="padding: 0px;margin: 0px;border: 0px">
                        <div class="form-group col-md-12" style="padding: 0px;margin: 0px;border: 0px" >
                            <label for="desde2" style="padding: 0px;margin: 0px;border: 0px">Desde</label>
                            <input type="text" name="iddosificacion" id="iddosificacion2" hidden>
                            <input type="date" style="text-transform: uppercase;padding: 0px;margin: 0px" class="form-control" id="desde2" placeholder="desde" name="desde" required value="<?=date('Y-m-d')?>">
                        </div>
                        <div class="form-group col-md-12" style="padding: 0px;margin: 0px;border: 0px" >
                            <label for="hasta2" style="padding: 0px;margin: 0px;border: 0px">Hasta</label>
                            <input type="date" style="text-transform: uppercase;padding: 0px;margin: 0px" class="form-control" id="hasta2" placeholder="hasta" name="hasta" required value="<?=date('Y-m-d')?>">
                        </div>
                        <div class="form-group col-md-12" style="padding: 0px;margin: 0px;border: 0px" >
                            <label for="nrotramite2" style="padding: 0px;margin: 0px;border: 0px">Numero de tramite</label>
                            <input type="number" style="text-transform: uppercase;padding: 0px;margin: 0px" class="form-control" id="nrotramite2" placeholder="0" name="nrotramite" required>
                        </div>
                        <div class="form-group col-md-12" style="padding: 0px;margin: 0px;border: 0px" >
                            <label for="nroautorizacion2" style="padding: 0px;margin: 0px;border: 0px">Numero de autorizacion</label>
                            <input type="number" style="text-transform: uppercase;padding: 0px;margin: 0px" class="form-control" id="nroautorizacion2"  placeholder="0" name="nroautorizacion" required>
                        </div>
                        <div class="form-group col-md-12" style="padding: 0px;margin: 0px;border: 0px" >
                            <label for="nrofactura2" style="padding: 0px;margin: 0px;border: 0px">Factura inicial</label>
                            <input type="number" style="text-transform: uppercase;padding: 0px;margin: 0px" class="form-control" id="nrofactura2" value="1" placeholder="0" name="nrofactura" required>
                        </div>
                        <div class="form-group col-md-12" style="padding: 0px;margin: 0px;border: 0px" >
                            <label for="llave2" style="padding: 0px;margin: 0px;border: 0px">Llave de dosificacion</label>
                            <input type="text" style=";padding: 0px;margin: 0px" class="form-control" id="llave2" placeholder="LLave de dosificacion" name="llave" required>
                        </div>
                        <div class="form-group col-md-12" style="padding: 0px;margin: 0px;border: 0px" >
                            <label for="leyenda2" style="padding: 0px;margin: 0px;border: 0px">Leyenda</label>
                            <input type="text" style="padding: 0px;margin: 0px" class="form-control" id="leyenda2"  placeholder="Texto de leyenda" name="leyenda" required>
                        </div>
                        <div class="form-group col-md-12" style="padding: 0px;margin: 0px;border: 0px" >
                            <label for="estado2" style="padding: 0px;margin: 0px;border: 0px">ESTADO</label>
                            <select name="estado" id="estado2" required class="form-control">
                                <option value="">Selecionar..</option>
                                <option value="ACTIVO">ACTIVO</option>
                                <option value="INACTIVO">INACTIVO</option>
                            </select>

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