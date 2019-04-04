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
    <i class="fa fa-users"></i> Registrar Usuario
</button>
<div class="mt-1"></div>
<table id="example" class="display nowrap" style="width:100%">
    <thead>
    <tr>
        <th>Idusuario</th>
        <th>Nombre</th>
        <th>Email</th>
        <th>Tipo</th>
        <th>Estado</th>
        <th>Opciones</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $query=$this->db->query("SELECT * FROM usuario");
    foreach ($query->result() as $row){
        if ($row->estado=="ACTIVO"){
            $estado="<span class='sinespacio  btn-success'>ACTIVO</span>";
        }else{
            $estado="<span class='sinespacio  btn-danger'>INACTIVO</span>";
        }
        echo "
        <tr>
            <td>".$row->idusuario."</td>
            <td>".$row->nombre."</td>
            <td>".$row->email."</td>
            <td>".$row->tipo."</td>
            <td>$estado</td>
            <td> 
            <button  class='btn btn-sm btn-warning text-white sinespaciotexto' data-idusuario='$row->idusuario' data-toggle=\"modal\" data-target=\"#modificar\" ><i class='fa fa-pencil'></i> Actualizar</button>
            <a href='".base_url()."Usuarios/delete/$row->idusuario' class='btn btn-sm btn-danger sinespaciotexto eli' ><i class='fa fa-trash-o'></i> Eliminar</a>
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
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar Historia clinica</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?=base_url()?>usuarios/insert" style="padding: 0px;margin: 0px;border: 0px">
                    <div class="form-row" style="padding: 0px;margin: 0px;border: 0px">
                        <div class="form-group col-md-3" style="padding: 0px;margin: 0px;border: 0px" >
                            <label for="nombre" style="padding: 0px;margin: 0px;border: 0px">nombre</label>
                            <input type="text" style="text-transform: uppercase;padding: 0px;margin: 0px" class="form-control" id="nombre" placeholder="nombre" name="nombre" required>
                        </div>
                        <div class="form-group col-md-3" style="padding: 0px;margin: 0px;border: 0px">
                            <label for="email" style="padding: 0px;margin: 0px;border: 0px">email</label>
                            <input type="email" style="padding: 0px;margin: 0px" class="form-control" id="email" placeholder="email" name="email" required>
                        </div>

                        <div class="form-group col-md-3" style="padding: 0px;margin: 0px;border: 0px">
                            <label for="tipo">tipo</label> <br>
                            <select required name="tipo" id="tipo" style="padding: 0px;margin: 0px;w">
                                <option value="">Seleccionar...</option>
                                <option value="ADMIN">ADMIN</option>
                                <option value="DOCTOR">DOCTOR</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3" style="padding: 0px;margin: 0px;border: 0px">
                            <label for="password">password</label>
                            <input type="password" style="padding: 0px;margin: 0px" class="form-control" id="password" placeholder="password" name="password">
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
                <h5 class="modal-title" id="exampleModalLabel">Modificar usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?=base_url()?>usuarios/update" style="padding: 0px;margin: 0px;border: 0px">
                    <div class="form-row" style="padding: 0px;margin: 0px;border: 0px">
                        <div class="form-group col-md-3" style="padding: 0px;margin: 0px;border: 0px" >
                            <input type="text" name="idusuario" id="idusuario2" hidden>
                            <label for="nombre2" style="padding: 0px;margin: 0px;border: 0px">nombre</label>
                            <input type="text" style="text-transform: uppercase;padding: 0px;margin: 0px" class="form-control" id="nombre2" placeholder="nombre" name="nombre" required>
                        </div>
                        <div class="form-group col-md-3" style="padding: 0px;margin: 0px;border: 0px">
                            <label for="email2" style="padding: 0px;margin: 0px;border: 0px">email</label>
                            <input type="email" style="padding: 0px;margin: 0px" class="form-control" id="email2" placeholder="email" name="email" required>
                        </div>

                        <div class="form-group col-md-2" style="padding: 0px;margin: 0px;border: 0px">
                            <label for="tip2">tipo</label> <br>
                            <select required name="tipo" id="tipo2" style="padding: 0px;margin: 0px;w">
                                <option value="">Seleccionar...</option>
                                <option value="ADMIN">ADMIN</option>
                                <option value="DOCTOR">DOCTOR</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2" style="padding: 0px;margin: 0px;border: 0px">
                            <label for="password2">password</label>
                            <input type="password" style="padding: 0px;margin: 0px" class="form-control" id="password2" placeholder="password" name="password">
                        </div>
                        <div class="form-group col-md-2" style="padding: 0px;margin: 0px;border: 0px">
                            <label for="estado2">Estado</label>
                            <select required name="estado" id="estado2" style="padding: 0px;margin: 0px;w">
                                <option value="">Seleccionar...</option>
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