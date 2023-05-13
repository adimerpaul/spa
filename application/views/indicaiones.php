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
    <i class="fa fa-apple"></i> Registrar indicaiones
</button>
<div class="mt-1"></div>
<table id="example" class="display nowrap" style="width:100%">
    <thead>
    <tr>
        <th>Idindicacion</th>
        <th>Nombre</th>
        <th>Opciones</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $query=$this->db->query("SELECT * FROM indicaciones");
    foreach ($query->result() as $row){
        echo "
        <tr>
            <td>".$row->idindicaciones."</td>
            <td> <div style='width:  white:200px; white-space: pre-wrap;'>".$row->titulo."</div></td>
            <td> 
            <button  class='btn btn-sm btn-warning text-white sinespaciotexto'
             data-toggle=\"modal\" data-target=\"#exampleModal\"
             data-id='$row->idindicaciones'
             data-nombre='$row->titulo'
             ><i class='fa fa-pencil'></i> Actualizar</button>
            <!--a href='' class='btn btn-sm btn-info sinespaciotexto' ><i class='fa fa-ambulance'></i> Tratamientos</a-->
            <a href='".base_url()."Indicaciones/delete/".$row->idindicaciones."' class='btn btn-danger sinespaciotexto btn-sm eli'>
                <i class='fa fa-trash-o '></i> Eliminar
            </a>
            <a href='".base_url()."Indicaciones/ver/".$row->idindicaciones."' class='btn btn-info sinespaciotexto btn-sm '>
                <i class='fa fa-eye '></i> Ejemplo
            </a>
            </td>
        </tr>";
    }
    ?>
    </tbody>
</table>

<script !src="">

    var eli=document.getElementsByClassName("eli");
    for (var i=0;i<eli.length;i++){
        eli[i].addEventListener("click",function (e) {
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
                <h5 class="modal-title" id="exampleModalLabel">Registrar Indicaion</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?=base_url()?>Indicaciones/insert" style="padding: 0px;margin: 0px;border: 0px">
                    <div class="form-group">
                        <label for="nombre">Titulo del consentimiento</label>
                        <input type="text" class="form-control" id="nombre" name="nombre"  required placeholder="Titulo del consentimiento">
                    </div>
                    <div class="form-group">
                        <label for="nombre">Descripcion</label><br>
                        <textarea   name="contenido" style="width: 100%"  rows="10" required ></textarea>
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

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modificar Consentimiento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?=base_url()?>Indicaciones/update" style="padding: 0px;margin: 0px;border: 0px">
                    <div class="form-group">
                        <input type="text" name="id" id="id" hidden>
                        <label for="nombre2">Titulo del consentimiento</label>
                        <input type="text" class="form-control" id="nombre2" name="nombre"  required placeholder="Titulo del consentimiento">
                    </div>
                    <div class="form-group">
                        <label for="summernote2">Descripcion</label>
                        <textarea id="contenido2"  name="contenido" style="width: 100%"  rows="10" required ></textarea>
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

