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

<div class="mt-1"></div>
<form action="<?=base_url()?>Listaventa/index" method="post">
    <div class="form-group row">
        <label for="mes" class="col-sm-1 col-form-label">Mes:</label>
        <div class="col-sm-4">
            <select name="mes" id="mes" class="form-control" style="padding: 0">
                <option value="01">Enero</option >
                <option value="02">Febrero</option>
                <option value="03">Marzo</option>
                <option value="04">Abril</option>
                <option value="05">Mayo</option>
                <option value="06">Junio</option>
                <option value="07">Julio</option>
                <option value="08">Agosto</option>
                <option value="09">Septiembre</option>
                <option value="10">Octubre</option>
                <option value="11">Noviembre</option>
                <option value="12">Diciembre</option>
            </select>
        </div>
        <label for="anio" class="col-sm-1 col-form-label">Año:</label>
        <div class="col-sm-4">
            <input type="text" value="<?=$anio?>" class="form-control">
        </div>
        <div class="col-sm-2">
            <button type="submit" id="consultar" class="btn btn-success btn-block"> <i class="fa fa-check"></i> Consultar</button>
        </div>

    </div>
</form>
<table id="example" class="display nowrap" style="width:100%">
    <thead>
    <tr>
        <th>Nº</th>
        <th>FECHA DE LA FACTURA</th>
        <th>Nº DE LA FACTURA</th>
        <th>Nº AUTORIZACION</th>
        <th>ESTADO</th>
        <th>NIT/CI CLIENTE</th>
        <th>NOMBRE O RAZÓN SOCIAL</th>
        <th>IMPORTE TOTAL DE VENTA</th>
        <th>IMPORTE ICE/IEHD/     TASAS</th>
        <th>EXPORTACIONES OPERACIONES EXENTAS</th>
        <th>VENTAS GRAVADAS A TASA CERO</th>
        <th>SUB TOTAL</th>
        <th>DESCUENTOS BONIFICACIONES Y REBAJAS OTORGADAS</th>
        <th>IMPORTE BASE PARA DÉBITO FISCAL IVA</th>
        <th>DÉBITO FISCAL IVA</th>
        <th>CÓDIGO DE CONTROL</th>
        <th>Opciones</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $query=$this->db->query("SELECT f.idfactura,f.fecha,f.nrofactura,d.nroautorizacion,f.estado,p.ci,p.apellidos,p.nombres,f.total,f.codigocontrol FROM factura f 
INNER JOIN paciente p ON f.idpaciente=p.idpaciente
INNER JOIN dosificacion d ON f.idpaciente=p.idpaciente
WHERE MONTH(f.fecha)='$mes' AND YEAR(f.fecha)='$anio'
");
    $c=0;
    foreach ($query->result() as $row){
        $c++;
        if ($row->estado=="A"){
            $row->total=0;
        }
        //for ($i=0;$i<10000;$i++)
        echo "
        <tr>
            <td>$c</td>
            <td>$row->fecha</td>
            <td>$row->nrofactura</td>
            <td>$row->nroautorizacion</td>
            <td>$row->estado</td>
            <td>$row->ci</td>
            <td>$row->apellidos $row->nombres</td>
            <td>$row->total</td>
            <td>0</td>
            <td>0</td>
            <td>0</td>
            <td>$row->total</td>
            <td>0</td>
            <td>$row->total</td>
            <td>".number_format($row->total*0.13,2)."</td>
            <td>$row->codigocontrol</td>
            <td> 
           <a href='".base_url()."Venta/printfactura2/$row->idfactura' class='btn btn-sm btn-outline-info sinespaciotexto' ><i class='fa fa-print'></i> Imprimir</a>
           <a href='".base_url()."Listaventa/anular/$row->idfactura' class='btn btn-sm btn-outline-danger sinespaciotexto eli' ><i class='fa fa-trash-o'></i> Anular</a>
            </td>
        </tr>";
    }
    ?>
    </tbody>
</table>

<script !src="">
    document.addEventListener('DOMContentLoaded', function() {
        var eli=document.getElementsByClassName('eli');
        for (var i=0;i<eli.length;i++){
            eli[i].addEventListener('click',function (e) {
                if (!confirm('Seguro de anular')){
                    e.preventDefault();

                }
            })
        }
        $('#mes').prop('value',  '<?=$mes?>');
        $('#iva').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        } );
    });
</script>
