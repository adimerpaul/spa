<div class="row">
    <div class="col-sm-6">
        <form method="post" id="vender" action="<?=base_url()?>Venta/imprimir" target="_blank">
            <div class="form-group row">
                <label for="ci" class="col-sm-3 col-form-label">CI/NIT</label>
                <div class="col-sm-9">
                    <input type="text" id="ci" name="ci" class="form-control" placeholder="CI/NIT" required>
                </div>
            </div>
            <div class="form-group row" id="r">
                <label for="razon" class="col-sm-2 col-form-label">Razon Social</label>
                <div class="col-sm-4">
                    <input type="text" id="razon" name="razon"  class="form-control" placeholder="Nombre razon" required>
                </div>
                <label for="razon" class="col-sm-3 col-form-label">Gastado Mes</label>
                <div class="col-sm-3">
                    <div class="m-2" id="gastado"></div>
                </div>
            </div>
            <div class="form-group">
                <!-- <input type="checkbox" name="tipo" checked data-toggle="toggle" data-size="small" data-onstyle="success" data-offstyle="warning" data-on="F" data-off="O"> -->
                <table class="table">
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Detalle del Producto</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Descuento %</th>
                        <th scope="col">Subtotal</th>
                    </tr>
                    </thead>
                    <tbody id="detalle"></tbody>
                    <tfoot class="thead-dark">
                    <th scope="col" colspan="4">TOTAL: </th>
                    <th scope="col" colspan="2">Bs.<span id="to">0</span>
                        <input type="text" id="total" name="total" hidden>
                    </th>
                    </tfoot>
                </table>
            </div>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text border-success" style="background-color: #B3F4B0;">Pagado Bs.</span>
                </div>
                <input type="text" step="0.10" class="form-control border-success" placeholder="0" name="pagado" id="pagado" required>
                <div class="input-group-prepend">
                    <span class="input-group-text border-danger" style="background-color: #F5C6CB;">Descuento Bs.</span>
                </div>
                <input type="number" step="0.10" class="form-control border-danger" value="0" placeholder="0" name="descuentototal" id="descuentototal">
            </div>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                    <span class="input-group-text border-warning" style="background-color: #FFDF7D;">Devolución Bs.</span>
                </div>
                <input type="number" class="form-control border-warning" placeholder="0" name="devolucion" id="devolucion" disabled>
            </div>
            <div class="text-right">
                <button type="submit" class="btn btn-lg btn-primary mr-1"><i class="fa fa-dollar"> Terminar Venta</i></button>
                <a href="" class="btn btn-lg btn-secondary"> <i class="fa fa-recycle"></i> Reiniciar </a>
            </div>
        </form>
    </div>
    <div class="col-sm-6">
        <table id="productos" class="display" style="width:100%">
            <thead>
            <tr>
                <th>Producto</th>
                <th>Disponible</th>
                <th>Precio</th>
                <th>Agregar</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $query=$this->db->query("SELECT * FROM producto WHERE cantidad>=1 AND estado='ACTIVO'");
            foreach ($query->result() as $row){
                if ($row->cantidad<10)
                    echo '<tr class="table-danger">';
                else
                    echo '<tr>';
                echo '<td>'.$row->nombrecomercial.' '.$row->nombre.'</td>
                          <td>'.$row->cantidad.'</td>
                          <td>'.$row->precio.'</td>
                            <td>
                                <button type="button" class="btn btn-success btn-sm" data-idproducto="'.$row->idproducto.'" data-precio='.$row->precio.' data-cantidad='.$row->cantidad.' data-nombre="'.$row->nombre.'" data-farmacologica="'.$row->farmacologica.'" data-toggle="modal" data-target="#exampleModal">
                                    <i class="fa fa-plus"></i> Agregar
                            </td>
                        </tr>';
            }
            ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Button trigger modal -->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Cantidad de productos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formulario">
                    <div class="input-group mb-3">
                        <label for="precio" class="col-sm-3 col-form-label">Precio</label>
                        <input type="number" id="precio" name="precio" step="0.01" class="form-control is-valid" required>
                        <input type="number" id="descuento" name="descuento" min="0" max="100" value="0" class="form-control is-invalid" placeholder="Descuento" required>
                        <div class="input-group-append">
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
                    <input type="hidden" id="cantidadMax">
                    <div class="form-group row">
                        <label for="cantidad" class="col-sm-3 col-form-label">Cantidad</label>
                        <div class="col-sm-9">
                            <input type="number" id="cantidad" name="cantidad" min="1" value="1" class="form-control" required>
                            <span class="alert alert-danger" id="mensajecantidad" hidden><b>NO</b> tienes esa cantidad de productos en stock</span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="subtotal" class="col-sm-3 col-form-label"><b>SUBTOTAL</b></label>
                        <div class="col-sm-9">
                            <input type="number" id="subtotal" name="subtotal" step="0.01" value="0" class="form-control" disabled>
                        </div>
                    </div>
                    <div id="farmacologica" class="card-footer text-muted"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal"> <i class="fa fa-close"></i> Cerrar</button>
                        <button type="submit" class="btn btn-success" id="botonventa"> <i class="fa fa-check"></i> Agregar</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <div class="alert alert-warning" id="messageCtrlProduct">
                    El producto ya fue agregado para vender,
                    <b>puede aumentar o reducir la cantidad en los productos a vender</b>
                </div>
            </div>
        </div>
    </div>
</div>
<script !src="">
    window.onload=function (e) {
        var producto="";
        var idproducto;
        $(document).ready(function() {
            $('#productos').DataTable({
                "language": {
                    "sProcessing":     "Procesando...",
                    "sLengthMenu":     "Mostrar _MENU_ registros",
                    "sZeroRecords":    "No se encontraron resultados",
                    "sEmptyTable":     "Ningún dato disponible en esta tabla =(",
                    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                    "sInfoPostFix":    "",
                    "sSearch":         "Buscar:",
                    "sUrl":            "",
                    "sInfoThousands":  ",",
                    "sLoadingRecords": "Cargando...",
                    "oPaginate": {
                        "sFirst":    "Primero",
                        "sLast":     "Último",
                        "sNext":     "Siguiente",
                        "sPrevious": "Anterior"
                    },
                    "oAria": {
                        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                    },
                    "buttons": {
                        "copy": "Copiar",
                        "colvis": "Visibilidad"
                    }
                }
            });
        } );
        var stock;
        var preciototal=0;
        $('#exampleModal').on('show.bs.modal', function (event) {
            $('#mensajecantidad').attr('hidden','');

            var button = $(event.relatedTarget) // Button that triggered the modal
            var nombre = button.data('nombre');
            var precio = button.data('precio');
            preciototal=precio;
            var cantidadMax = button.data('cantidad');

            stock = button.data('cantidad');
            idproducto = button.data('idproducto');
            $('#botonventa').show();
            $('#messageCtrlProduct').hide();
            if ($('#ca'+idproducto).length){
                // $('#exampleModal').modal('hide');
                $('#botonventa').hide();
                $('#messageCtrlProduct').show();
                // return false;
                // event.preventDefault();
            }else{
                $('#precio').val(precio);
                $('#cantidad').val(1);
                $('#subtotal').val(precio*1);
                $('#descuento').val(0);
                $('#cantidadMax').val(cantidadMax);

                $('#farmacologica').html(button.data('farmacologica'));
                var modal = $(this);
                modal.find('.modal-title').text(nombre);
                producto=nombre;
            }

            // modal.find('.modal-body input').val(recipient)
        })

        $('#idproducto').change(function (e) {
            var datos={
                'idproducto':$('#idproducto').val()
            };
            //console.log($('#idproducto').val());
            $.ajax({
                data:datos,
                type:'POST',
                url:'Venta/datosproducto',
                success:function (e) {
                    // console.log(e);
                    var dato=JSON.parse(e)[0];
                    $('#precio').val(dato.precio);
                    var precio=$('#precio').val();
                    var cantidad=$('#cantidad').val();
                    $('#subtotal').val(precio*cantidad);
                }
            });
        });
        function cambio(e){
            /*var precio=$('#precio').val();
            var cantidad=$('#cantidad').val();
            $('#subtotal').val(precio*cantidad);*/
            //console.log('aaa');
        }
        //$('#cantidad').change(cambio());
        $('#precio,#cantidad').keyup(function (e) {
            var precio=$('#precio').val();
            var cantidad=$('#cantidad').val();
            $('#subtotal').val(precio*cantidad);
        });
        var porcenta=function () {
            // console.log('aa');
            var descuento=$('#descuento').val();
            var cantidad=$('#cantidad').val();
            $('#precio').val(preciototal*(1.00-descuento/100));
            var precio=$('#precio').val();
            // $('#subtotal').val((precio*(1.00-descuento/100))*cantidad);
            $('#subtotal').val(precio*cantidad);
        }
        $('#descuento').change(porcenta);
        $('#descuento').keyup(porcenta);

        //valor 0 para descuento
        $('#descuentototal').keyup(function (e) {
            var descuento=$('#descuentototal').val();
            if (descuento=="")
                $('#descuentototal').val("0");
        });

        //calculo de descuento
        $('#pagado,#descuentototal').keyup(function (e) {
            var total = parseFloat($('#total').val());
            var pagado = parseFloat($('#pagado').val());
            var descuentototal = parseFloat($('#descuentototal').val());
            $('#devolucion').val(pagado-total+descuentototal);
        });

        $('#ci').keyup(function (e) {
            var datos={
                'ci':$('#ci').val()
            };
            $.ajax({
                data:datos,
                type: 'POST',
                url: 'Venta/cliente',
                success:function (e) {
                    // console.log(e);
                    var datos=JSON.parse(e);
                    let gastado=parseFloat(datos['total']);
                    if (gastado>0)
                        $('#gastado').html('Bs. '+gastado.toFixed(2));
                    else
                        $('#gastado').html('No esta registrado');
                    if (datos[0] !=null){
                        $('#razon').val(datos[0].apellidos);
                    }else{
                        $('#razon').val('');
                    }
                }
            });
        });
        var total=0;
        var con=0;
        function calcular_total() {
            importe_total = 0;
            // console.log('a');
            $(".subtotal").each(
                function(index, value) {
                    importe_total = importe_total + eval($(this).val());
                }
            );
            $('#to').html(importe_total);
            $('#total').val(importe_total);
        }
        var callback = function() {
            // console.log();
            if ($(this).val()<=stock){
                $('#mensajecantidad').attr('hidden','');
                $('#botonventa').show();
            }else {
                $('#mensajecantidad').removeAttr('hidden');
                $('#botonventa').hide();
            }
        };

        $("#cantidad").keyup(callback);
        $('#cantidad').change(callback);

        $('#formulario').submit(function (e) {
            var precio=$('#precio').val();
            var cantidad=$('#cantidad').val();
            var cantidadMax=$('#cantidadMax').val();
            var descuento=$('#descuento').val();
            var subtotal=$('#subtotal').val();
            //console.log(comprador);
            con++;
            // total=parseFloat(total)+ parseFloat(subtotal);
            $( "#detalle" ).append( "<tr class=''>" +
                "<th scope='row'>"+con+"</th>" +
                "<td>"+producto+"</td>" +
                "<td>"+precio+"<input name='p"+idproducto+"' value='"+precio+"' hidden></td>" +
                "<td> <span id='ca"+idproducto+"'>"+cantidad+"</span> <button class='btn btn-success p-1 aumentar' data-precio='"+precio+"' data-cantidadmax='"+cantidadMax+"' data-descuento='"+descuento+"' data-idproducto="+idproducto+" ><i class='fa fa-plus'></i></button> <button class='btn btn-danger p-1 quitar' data-precio='"+precio+"' data-descuento='"+descuento+"' data-idproducto="+idproducto+"><i class='fa fa-minus'></i></button><input id='cad"+idproducto+"' name='c"+idproducto+"' value='"+cantidad+"' hidden></td>" +
                "<td>"+descuento+"</td>" +
                "<td align='right'><span id='su"+idproducto+"'>"+subtotal+"</span><input id='sub"+idproducto+"' class='subtotal' name='s"+idproducto+"' value='"+subtotal+"' hidden> "+' <button class="btn btn-danger p-1 eliproducto"><i class="fa fa-trash"></i></button>'+"</td>" +
                "</tr>" );

            // $('#to').html(total);
            // $('#total').val(total);
            calcular_total();
            $('#exampleModal').modal('hide');
            return false;
        });

        $("#detalle").on("click",".eliproducto", function(e){
            e.preventDefault();
            $(this).closest('tr').remove();
        });

        $("#detalle").on("click",".aumentar", function(e){
            let idproducto= parseInt( $(this).data('idproducto'));
            let precio= parseFloat( $(this).data('precio'));

            let descuento = parseInt( $(this).data('descuento'));
            let cantidadMax = parseInt( $(this).data('cantidadmax'));

            let cantidad= parseInt( $('#ca'+idproducto).html());
            if (cantidad<cantidadMax){
                cantidad=cantidad+1;
                $('#ca'+idproducto).html(cantidad);
                $('#cad'+idproducto).val(cantidad);
                $('#su'+idproducto).html(cantidad*(precio*(1.00-descuento/100)));
                $('#sub'+idproducto).val(cantidad*(precio*(1.00-descuento/100)));

            }
            calcular_total();
            e.preventDefault();
        });
        $("#detalle").on("click",".quitar", function(e){

            let idproducto= parseInt( $(this).data('idproducto'));
            let precio= parseFloat( $(this).data('precio'));

            let descuento = parseInt( $(this).data('descuento'));

            let cantidad = parseInt( $('#ca'+idproducto).html());
            if (cantidad>1){
                cantidad=cantidad-1;
                $('#ca'+idproducto).html(cantidad);
                $('#cad'+idproducto).val(cantidad);
                $('#su'+idproducto).html(cantidad*(precio*(1.00-descuento/100)));
                $('#sub'+idproducto).val(cantidad*(precio*(1.00-descuento/100)));
            }
            calcular_total();
            e.preventDefault();
        });
        $('#vender').submit(function () {
            // console.log($('#detalle').html()=='');
            if ($('#detalle').html()==""){
                alert('Debe eleccionar productos para poder terminar la venta');
                return false;
            }

        });
    }
</script>