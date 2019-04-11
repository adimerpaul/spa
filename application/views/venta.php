<form method="post" action="<?=base_url()?>Venta/imprimir">
    <div class="form-group">
        <label for="exampleInputEmail1">COMPRADOR</label>
        <select name="idpaciente" id="idpaciente" class="form-control" required>
            <option value="">Selecionar...</option>
            <?php
            $query=$this->db->query("SELECT * FROM paciente");
            foreach ($query->result() as $row){
                echo "<option value='$row->idpaciente'>$row->nombres $row->apellidos</option>";
            }

            ?>
        </select>
    </div>
    <div class="form-group">
        <label for="exampleInputPassword1">PRODUCTOS
            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal">
                <i class="fa fa-plus"></i> Agregar
            </button>
            <a href="" class="btn btn-warning"> <i class="fa fa-recycle"></i> Reiniciar </a>
        </label>
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Comprador</th>
                <th scope="col">Detalle del Producto</th>
                <th scope="col">Precio</th>
                <th scope="col">Cantidad</th>
                <th scope="col">subtotal</th>
            </tr>
            </thead>
            <tbody id="detalle">
            </tbody>
            <tfoot class="thead-dark">
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col">TOTAL : <span id="total">0</span></th>
            </tfoot>
        </table>
    </div>
    <button type="submit" class="btn btn-primary"> <i class="fa fa-dollar"></i> Terminar venta</button>
</form>

<!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar productos</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formulario">
                    <div class="form-group row">
                        <label for="idproducto" class="col-sm-3 col-form-label">Producto</label>
                        <div class="col-sm-9">
                            <select name="idproducto" id="idproducto" class="form-control" required>
                                <option value="">Seleccionar...</option>
                                <?php
                                $query=$this->db->query("SELECT * FROM producto WHERE stock >0");
                                foreach ($query->result() as $row){
                                    echo "<option value='$row->idproducto'>$row->nombre / $row->stock</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="precio" class="col-sm-3 col-form-label">Precio</label>
                        <div class="col-sm-9">
                            <input type="text" id="precio" name="precio" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="cantidad" class="col-sm-3 col-form-label">Cantidad</label>
                        <div class="col-sm-9">
                            <input type="text" id="cantidad" name="cantidad" value="1" class="form-control">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="subtotal" class="col-sm-3 col-form-label"><b>SUBTOTAL</b></label>
                        <div class="col-sm-9">
                            <input type="text" id="subtotal" name="subtotal" value="0" class="form-control">
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