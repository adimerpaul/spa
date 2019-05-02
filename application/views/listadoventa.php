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
<table id="example" class="display nowrap" style="width:100%">
    <thead>
    <tr>
        <th>Numero</th>
        <th>Nro factura</th>
        <th>Nro autorizacion</th>
        <th>Fecha</th>
        <th>Total</th>
        <th>Persona</th>
        <th>Opciones</th>
    </tr>
    </thead>
    <tbody>
    <?php
    $query=$this->db->query("SELECT * FROM factura f 
INNER JOIN paciente p ON f.idpaciente=p.idpaciente
INNER JOIN dosificacion d ON f.idpaciente=p.idpaciente
");
    foreach ($query->result() as $row){

        echo "
        <tr>
            <td>".$row->idfactura."</td>
            <td>".$row->nrofactura."</td>
            <td>".$row->nroautorizacion."</td>
            <td>".$row->fecha."</td>
            <td>".$row->total."</td>
            <td> ".$row->apellidos." ".$row->nombres."</td>
            <td> 
           <a href='".base_url()."Venta/printfactura/$row->idfactura' class='btn btn-sm btn-outline-info sinespaciotexto' ><i class='fa fa-print'></i> Imprimir</a>
            </td>
        </tr>";
    }
    ?>
    </tbody>
</table>