<style>
    .highcharts-figure, .highcharts-data-table table {
        min-width: 320px;
        max-width: 800px;
        margin: 1em auto;
    }

    .highcharts-data-table table {
        font-family: Verdana, sans-serif;
        border-collapse: collapse;
        border: 1px solid #EBEBEB;
        margin: 10px auto;
        text-align: center;
        width: 100%;
        max-width: 500px;
    }
    .highcharts-data-table caption {
        padding: 1em 0;
        font-size: 1.2em;
        color: #555;
    }
    .highcharts-data-table th {
        font-weight: 600;
        padding: 0.5em;
    }
    .highcharts-data-table td, .highcharts-data-table th, .highcharts-data-table caption {
        padding: 0.5em;
    }
    .highcharts-data-table thead tr, .highcharts-data-table tr:nth-child(even) {
        background: #f8f8f8;
    }
    .highcharts-data-table tr:hover {
        background: #f1f7ff;
    }


    input[type="number"] {
        min-width: 50px;
    }
</style>

<div id="app">
    Fecha Inicio: <input type="date" v-model="f1">Fecha Final: <input type="date" v-model="f2"><button class="btn btn-primary btn-sm" type="button" @click="click"> <i class="fa fa-save"></i> Verificar</button>
<!--    {{ message }}-->
    <figure class="highcharts-figure">

        <div id="container"></div>
        <div id="container2"></div>
        <div id="container3"></div>
<!--        <p class="highcharts-description">-->
<!--            Pie charts are very popular for showing a compact overview of a-->
<!--            composition or comparison. While they can be harder to read than-->
<!--            column charts, they remain a popular choice for small datasets.-->
<!--        </p>-->
    </figure>
    <h4>Reportes por edad</h4>
    <table id="example1" class="display" style="width:100%">
        <thead>
        <tr>
            <th>N</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Edad</th>
            <th>Fecha hora</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <h4>Reportes por tratamiento</h4>
    <table id="example2" class="display" style="width:100%">
        <thead>
        <tr>
            <th>N</th>
            <th>Tratamiento</th>
            <th>Nombres</th>
            <th>Apellidos</th>
            <th>Fecha hora</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <h4>Reportes por zona</h4>
    <table id="example3" class="display" style="width:100%">
        <thead>
        <tr>
            <th>N</th>
            <th>Zona</th>
            <th>Nombres</th>
            <th>Apellidos</th>

            <th>Fecha hora</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>

</div>



<script>
    window.onload=function (){
        var app = new Vue({
            el: '#app',
            data: {
                datatable:null,
                datatable2:null,
                datatable3:null,
                message: 'Hola Vue!',
                chart: null,
                chart2: null,
                chart3: null,
                datos:[],
                f1:moment().format('YYYY-MM-DD'),
                f2:moment().format('YYYY-MM-DD'),
            },
            methods:{
                click(){
                    // console.log('a');
                    this.misdatos();
                },
                misdatos(){
                    axios.get('Filtros/dedad/'+this.f1+'/'+this.f2).then(res=>{
                        this.datos=res.data;
                        this.datatable.clear().draw();
                        let cont=0;
                        this.datos.forEach(r=>{
                            // console.log(r);
                            cont++;
                            this.datatable.row.add([
                                cont,
                                r.nombres,
                                r.apellidos,
                                r.edad,
                                r.fecha,
                            ]).draw(false)
                        })
                    });
                    axios.get('Filtros/dtratamientos/'+this.f1+'/'+this.f2).then(res=>{
                        this.datos=res.data;
                        this.datatable2.clear().draw();
                        let cont=0;
                        this.datos.forEach(r=>{
                            // console.log(r);
                            cont++;
                            this.datatable2.row.add([
                                cont,
                                r.nombre,
                                r.nombres,
                                r.apellidos,

                                r.fecha,
                            ]).draw(false)
                        })
                    });
                    axios.get('Filtros/dzonas/'+this.f1+'/'+this.f2).then(res=>{
                        this.datos=res.data;
                        this.datatable3.clear().draw();
                        let cont=0;
                        this.datos.forEach(r=>{
                            // console.log(r);
                            cont++;
                            this.datatable3.row.add([
                                cont,
                                r.zona,
                                r.nombres,
                                r.apellidos,
                                r.fecha,
                            ]).draw(false)
                        })
                    });

                    axios.get('Filtros/datos/'+this.f1+'/'+this.f2+'').then(res=>{
                        this.datos=[];
                        res.data.forEach(r=>{
                            this.datos.push({name:'Edad: '+r.name,y:parseFloat(r.y)})
                        })
                        this.chart.series[0].update({
                            data:this.datos
                        },false);
                        this.chart.redraw();

                    });

                    axios.get('Filtros/tratamientos/'+this.f1+'/'+this.f2+'').then(res=>{
                        this.datos=[]
                        res.data.forEach(r=>{
                            this.datos.push({name:'Tratamiento: '+r.name,y:parseFloat(r.y)})
                        })
                        this.chart2.series[0].update({
                            data:this.datos
                        },false);
                        this.chart2.redraw();

                    });

                    axios.get('Filtros/zonas/'+this.f1+'/'+this.f2+'').then(res=>{
                        this.datos=[];
                        res.data.forEach(r=>{
                            this.datos.push({name:'Zona: '+r.name,y:parseFloat(r.y)})
                        })
                        this.chart3.series[0].update({
                            data:this.datos
                        },false);
                        this.chart3.redraw();

                    });
                }
            },
            mounted:function (){
                this.datatable = $('#example1').DataTable({
                    "order": [[ 0, "desc" ]],
                    "language": {
                        "sProcessing":     "Procesando...",
                        "sLengthMenu":     "Mostrar _MENU_ registros",
                        "sZeroRecords":    "No se encontraron resultados",
                        "sEmptyTable":     "Ningún dato disponible en esta tabla",
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
                    },
                    dom: 'Bfrtip',
                    buttons: [
                        'copy', 'csv','excel', 'pdf', 'print'
                    ]
                });

                this.datatable2 = $('#example2').DataTable({
                    "order": [[ 0, "desc" ]],
                    "language": {
                        "sProcessing":     "Procesando...",
                        "sLengthMenu":     "Mostrar _MENU_ registros",
                        "sZeroRecords":    "No se encontraron resultados",
                        "sEmptyTable":     "Ningún dato disponible en esta tabla",
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
                    },
                    dom: 'Bfrtip',
                    buttons: [
                        'copy', 'csv','excel', 'pdf', 'print'
                    ]
                });

                this.datatable3 = $('#example3').DataTable({
                    "order": [[ 0, "desc" ]],
                    "language": {
                        "sProcessing":     "Procesando...",
                        "sLengthMenu":     "Mostrar _MENU_ registros",
                        "sZeroRecords":    "No se encontraron resultados",
                        "sEmptyTable":     "Ningún dato disponible en esta tabla",
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
                    },
                    dom: 'Bfrtip',
                    buttons: [
                        'copy', 'csv','excel', 'pdf', 'print'
                    ]
                });
                // console.log(this.f1)
                this.chart=Highcharts.chart('container', {
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie'
                    },
                    title: {
                        text: 'Consultas por edad'
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                    },
                    accessibility: {
                        point: {
                            valueSuffix: '%'
                        }
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: true,
                                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                            }
                        }
                    },
                    series: [
                        {
                            name: 'Brands',
                            colorByPoint: true,
                            data: []
                        }]
                });

                this.chart2=Highcharts.chart('container2', {
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie'
                    },
                    title: {
                        text: 'Consultas por tratamiento'
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                    },
                    accessibility: {
                        point: {
                            valueSuffix: '%'
                        }
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: true,
                                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                            }
                        }
                    },
                    series: [
                        {
                            name: 'Brands',
                            colorByPoint: true,
                            data: []
                        }]
                });

                this.chart3=Highcharts.chart('container3', {
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie'
                    },
                    title: {
                        text: 'Consultas por zona'
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                    },
                    accessibility: {
                        point: {
                            valueSuffix: '%'
                        }
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: true,
                                format: '<b>{point.name}</b>: {point.percentage:.1f} %'
                            }
                        }
                    },
                    series: [
                        {
                            name: 'Brands',
                            colorByPoint: true,
                            data: []
                        }]
                });

                this.misdatos();
            }
        })

    }

</script>
