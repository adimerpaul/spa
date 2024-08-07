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
alineado ala derecha
<div style="float: right">
    <input type="text" id="search" class="form-control" placeholder="Buscar" style="width: 300px">
<!--    <button class="btn btn-primary" id="buscar" ><i class="fa fa-search"></i></button>-->
</div>
<table class="display nowrap" style="width:100%">
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
    <tbody id="contenido">
<!--    --><?php
//    $query=$this->db->query("SELECT * FROM paciente WHERE idpaciente!=8");
//    foreach ($query->result() as $row){
//        $cumpleanos = new DateTime($row->fechanac);
//        $hoy = new DateTime();
//        $annos = $hoy->diff($cumpleanos);
//        $btnEliminar="";
//        //si es el usuario 8  habilitar eliminar
//        if ($_SESSION['idusuario']==8){
//            $btnEliminar="<a  class='btn btn-danger sinespaciotexto eli' href='".base_url()."Paciente/delete/$row->idpaciente'>|
//                <i class='fa fa-trash'></i> Eliminar
//            </a>";
//        }
//        echo "
//        <tr>
//            <td>".$row->idpaciente."</td>
//            <td>".$row->nombres." ".$row->apellidos."</td>
//            <td>".$row->direccion."</td>
//            <td>".$annos->y."</td>
//            <td><a target='_blank' href='https://wa.me/591".$row->celular."?text='>".$row->celular."</a></td>
//            <td>
//            <a href='".base_url()."Paciente/reghistorial/".$row->idpaciente."' class='btn btn-sm btn-success text-white sinespaciotexto' ><i class='fa fa-file-archive-o'></i> Reg. Historial</a> <br>
//            <a type='button'  class='btn btn-warning btn-sm sinespaciotexto' href='".base_url()."Paciente/escoger/".$row->idpaciente."' > <i class=\"fa fa-align-justify\"></i>Historiales</a> <br>
//            <button type='button' class='btn btn-warning sinespaciotexto' data-idpaciente='$row->idpaciente' data-toggle='modal' data-target='#modificar'>
//                <i class='fa fa-pencil'></i> Modificar
//            </button> <br>
//            <a  class='btn btn-info sinespaciotexto' href='".base_url()."photo/index/$row->idpaciente'>
//                <i class='fa fa-photo'></i> Subir fotografia
//            </a>
//            </button> <br>
//            $btnEliminar
//             </td>
//        </tr>";
//    }
//    ?>
    </tbody>
</table>

<!-- Modal -->
<div class="modal fade" id="modificar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modificar cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="post" action="<?=base_url()?>paciente/update" style="padding: 0px;margin: 0px;border: 0px">
                    <div class="form-row" style="padding: 0px;margin: 0px;border: 0px">
                        <div class="form-group col-md-2" style="padding: 0px;margin: 0px;border: 0px">
                            <input type="text" name="idpaciente" id="idpaciente2" hidden>
                            <label for="apellidos2" style="padding: 0px;margin: 0px;border: 0px">apellidos</label>
                            <input type="text" style="text-transform: uppercase;padding: 0px;margin: 0px" class="form-control" id="apellidos2" placeholder="apellidos" name="apellidos" required>
                        </div>
                        <div class="form-group col-md-2" style="padding: 0px;margin: 0px;border: 0px" >
                            <label for="nombres2" style="padding: 0px;margin: 0px;border: 0px">nombres</label>
                            <input type="text" style="text-transform: uppercase;padding: 0px;margin: 0px" class="form-control" id="nombres2" placeholder="nombres" name="nombres" >
                        </div>
                        <div class="form-group col-md-3" style="padding: 0px;margin: 0px;border: 0px">
                            <label for="ci2">ci</label>
                            <input type="text" style="padding: 0px;margin: 0px" class="form-control" id="ci2" placeholder="ci" name="ci">
                        </div>
                        <div class="form-group col-md-2" style="padding: 0px;margin: 0px;border: 0px">
                            <label for="zona2">zona</label>
                            <input type="text" style="padding: 0px;margin: 0px" class="form-control" id="zona2" placeholder="zona" name="zona">
                        </div>
                        <div class="form-group col-md-3" style="padding: 0px;margin: 0px;border: 0px">
                            <label for="direccion2">direccion</label>
                            <input type="text" style="padding: 0px;margin: 0px"  class="form-control" id="direccion2" placeholder="1234 Main St" name="direccion">
                        </div>
                    </div>
                    <div class="form-row" style="padding: 0px;margin: 0px;border: 0px">
                        <div class="form-group col-md-3" style="padding: 0px;margin: 0px;border: 0px">
                            <label for="fechanac2">fechanac</label>
                            <input type="text" style="padding: 0px;margin: 0px" class="form-control" id="fechanac2" placeholder="fechanac" name="fechanac" value="<?=date("Y-m-d")?>" required>
                        </div>
                        <div class="form-group col-md-3" style="padding: 0px;margin: 0px;border: 0px">
                            <label for="celular2">celular</label>
                            <input type="number" style="padding: 0px;margin: 0px" class="form-control" id="celular2" placeholder="celular" name="celular" >
                        </div>
                        <div class="form-group col-md-3" style="padding: 0px;margin: 0px;border: 0px">
                            <label for="telefono2">telefono</label>
                            <input type="number" style="padding: 0px;margin: 0px" class="form-control" id="telefono2" placeholder="telefono" name="telefono">
                        </div>
                        <div class="form-group col-md-3" style="padding: 0px;margin: 0px;border: 0px">
                            <label for="referencia2">referencia</label>
                            <select name="referencia" id="referencia2"  style="padding: 0px;margin: 0px" class="form-control">
                                <option value="">Seleccionar..</option>
                                <option value="Facebook">Facebook</option>
                                <option value="Periódico">Periódico</option>
                                <option value="Referido">Referido</option>
                                <option value="Antiguo">Antiguo</option>
                                <option value="Televisión">Televisión</option>
                                <option value="Familiar">Familiar</option>
                                <option value="Instagram">Instagram</option>
                                <option value="Amigos">Amigos</option>
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
                        <div class="form-group col-md-2" style="padding: 0px;margin: 0px;border: 0px">
                            <label for="apellidos" style="padding: 0px;margin: 0px;border: 0px">apellidos</label>
                            <input type="text" style="text-transform: uppercase;padding: 0px;margin: 0px" class="form-control" id="apellidos" placeholder="apellidos" name="apellidos" required>
                        </div>
                        <div class="form-group col-md-2" style="padding: 0px;margin: 0px;border: 0px" >
                            <label for="nombres" style="padding: 0px;margin: 0px;border: 0px">nombres</label>
                            <input type="text" style="text-transform: uppercase;padding: 0px;margin: 0px" class="form-control" id="nombres" placeholder="nombres" name="nombres" >
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
                            <input type="text" style="padding: 0px;margin: 0px" class="form-control" id="fechanac" placeholder="fechanac" name="fechanac" value="<?=date("Y-m-d")?>" required>
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
                                <option value="Instagram">Instagram</option>
                                <option value="Amigos">Amigos</option>
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

<script>
    window.onload=function (e) {
        function debounce(func, wait) {
            let timeout;
            return function(...args) {
                const context = this;
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(context, args), wait);
            };
        }
        const debouncedPacientesGet = debounce(pacientesGet, 300); // 300 ms de espera

        $('#search').keyup(function (e) {
            debouncedPacientesGet();
        });
        pacientesGet();
        $('#buscar').click(function (e) {
            pacientesGet();
        });

        function pacientesGet() {
            $.ajax({
                url:'Paciente/pacientes',
                data: {
                    search: $('#search').val()
                },
                type:'POST',
                success:function (e) {
                    console.log(e);
                    var datos=JSON.parse(e);
                    var html="";
                    datos.forEach(function (dato) {
                       var cumpleanos = new Date(dato.fechanac);
                       var hoy = new Date();
                       var annos = hoy.getFullYear() - cumpleanos.getFullYear();
                       var m = hoy.getMonth() - cumpleanos.getMonth();
                       if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
                           annos--;
                       }
                        var btnEliminar="";
                        //si es el usuario 8  habilitar eliminar
                        if (<?= $_SESSION['idusuario']?>==8){
                            btnEliminar="<a  class='btn btn-danger sinespaciotexto eli' href='<?=base_url()?>Paciente/delete/"+dato.idpaciente+"'>|<i class='fa fa-trash'></i> Eliminar</a>";
                        }
                        html+="<tr>\n" +
                            "            <td>"+dato.idpaciente+"</td>\n" +
                            "            <td>"+dato.nombres+" "+dato.apellidos+"</td>\n" +
                            "            <td>"+dato.direccion+"</td>\n" +
                            "            <td>"+annos+"</td>\n" +
                            "            <td><a target='_blank' href='https://wa.me/591"+dato.celular+"?text='>"+dato.celular+"</a></td>\n" +
                            "            <td>\n" +
                            "            <a href='<?=base_url()?>Paciente/reghistorial/"+dato.idpaciente+"' class='btn btn-sm btn-success text-white sinespaciotexto' ><i class='fa fa-file-archive-o'></i> Reg. Historial</a> <br>\n" +
                            "            <a type='button'  class='btn btn-warning btn-sm sinespaciotexto' href='<?=base_url()?>Paciente/escoger/"+dato.idpaciente+"' > <i class=\"fa fa-align-justify\"></i>Historiales</a> <br>\n" +
                            "            <button type='button' class='btn btn-warning sinespaciotexto' data-idpaciente='"+dato.idpaciente+"' data-toggle='modal' data-target='#modificar'>\n" +
                            "                <i class='fa fa-pencil'></i> Modificar\n" +
                            "            </button> <br>\n" +
                            "            <a  class='btn btn-info sinespaciotexto' href='<?=base_url()?>photo/index/"+dato.idpaciente+"'>\n" +
                            "                <i class='fa fa-photo'></i> Subir fotografia\n" +
                            "            </a>\n" +
                            "            </button> <br>\n" +
                            "            "+btnEliminar+"\n" +
                            "             </td>\n" +
                            "        </tr>";
                    });
                    $('#contenido').html(html);
                }
            });
        }

        $('.eli').click(function (e) {
            if (!confirm("Seguro de eliminar")){
                e.preventDefault();
            }
        });
        $('#example1').DataTable();

        $('#modificar').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var idpaciente = button.data('idpaciente');
            $.ajax({
                url:'Paciente/datospaciente',
                type:'POST',
                data:'idpaciente='+idpaciente,
                success:function (e) {
                    var dato=JSON.parse(e)[0];
                    //console.log(dato);
                    $('#apellidos2').val(dato.apellidos);
                    $('#nombres2').val(dato.nombres);
                    $('#ci2').val(dato.ci);
                    $('#zona2').val(dato.zona);
                    $('#direccion2').val(dato.direccion);
                    $('#fechanac2').val(dato.fechanac);
                    $('#celular2').val(dato.celular);
                    $('#telefono2').val(dato.telefono);
                    $('#referencia2').val(dato.referencia);
                    $('#idpaciente2').val(dato.idpaciente);

                }
            });
        })
    }
</script>
