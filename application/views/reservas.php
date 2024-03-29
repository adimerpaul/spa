<style>

    body {
        margin: 40px 10px;
        padding: 0;
        font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
        font-size: 14px;
    }



</style>

<div id='calendar'></div>
<script>

    document.addEventListener('DOMContentLoaded', function() {
        var elimina;
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
            header: {
                left: 'prev,next today custom1 actualizar',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
            },
            minTime: "08:00:00",
            maxTime: "22:00:00",
            slotDuration: "00:15:00",
            locale:'es',
            defaultView:'timeGridWeek',
            selectable: true,
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            events: "Reserva/reservas",
            eventClick: function(info) {
                //console.log(moment(info.event.end).format('LT'))
                /*alert('Event: ' + info.event.title);
                alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
                alert('View: ' + info.view.type);
                // change the border color just for fun
                info.el.style.borderColor = 'red';
                */

                $('#calendarModal').modal();
                //console.log(info.event);
                var idpaciente=(info.event._def.extendedProps.idpaciente);
                $.ajax({
                    url:'Reserva/datos',
                    data:'id='+idpaciente,
                    type:'POST',
                    success:function (e) {
                        var datos= JSON.parse(e)[0];
                        //console.log(datos);
                        $('#num').html('Enviar mensaje por Whatsapp <a target="blank" href="https://wa.me/591'+datos.celular+'?text=">'+datos.celular+'</a>');
                    }
                });
                var descripcion=(info.event._def.extendedProps.descripcion);
                var start=(info.event.start);
                var end=(info.event.end);
                $('#idpaciente2').prop('value',idpaciente);
                $('#descripcion2').prop('value',descripcion);
                $('#start2').val(moment(start).format('YYYY-MM-DDTHH:mm'));
                $('#end2').val(moment(end).format('YYYY-MM-DDTHH:mm'));
                $('#id2').val(info.event.id);
                //$('#id3').val(info.event);
                elimina=info.event;


                /*if (confirm('delete event?')) {
                    info.event.remove()
                }*/
            },
            select: function(info) {
                //alert('selected ' + info.startStr + ' to ' + info.endStr);
                //console.log(info.startStr);
                $('#registrar').modal();
                $('#start').val(moment(info.startStr).format('YYYY-MM-DDTHH:mm'));
                $('#end').val(moment(info.endStr).add('minute',15).format('YYYY-MM-DDTHH:mm'));

            },customButtons: {
                custom1: {
                    text: 'Registrar reserva',
                    click: function() {
                        $('#registrar').modal();
                    }
                },
                actualizar:{
                    text: 'Actualizar',
                    click: function() {
                        location.reload();
                    }
                }
            }
        });

        calendar.render();


        $('#start2').change(function (e) {
            //console.log($('#start2').val());
            var hora =moment($('#start2').val()).add(30, 'minutes').format('YYYY-MM-DDTHH:mm');
            $('#end2').val(hora);
        });
        $('#start').change(function (e) {
            //console.log($('#start').val());
            var hora =moment($('#start').val()).add(30, 'minutes').format('YYYY-MM-DDTHH:mm');
            $('#end').val(hora);
        });

        $('#eliminar').on('click', function(e){
            // We don't want this to act as a link so cancel the link action
            e.preventDefault();
            doDelete();
        });

        $("#formulario").submit(function(e){
            var idpaciente=$('#idpaciente').val();
            //var title = $('#title').val();
            var start= $('#start').val();
            var end = $('#end').val();
            var descripcion = $('#descripcion').val();
            var datos={
                'idpaciente':idpaciente,
                'start':start,
                'end':end,
                'descripcion':descripcion,
                'nombres':$('#nombres').val(),
                'apellidos':$('#apellidos').val()
            }
            //console.log(idpaciente);

            $.ajax({
                url: 'Reserva/insert',
                data: datos,
                type: "POST",
                success: function(json) {
                    console.log(json);
                    console.log(json.id);
                    calendar.addEvent({
                        title: json.title,
                        id: json.id,
                        start: start,
                        end: end,
                        idpaciente:idpaciente,
                        descripcion:descripcion
                    })
                    calendar.unselect()
                    $("#registrar").modal('hide');
                }
            });
            return false;
        });

        function doDelete(){
            if (confirm('Seguro de eliminar?')) {

                $("#calendarModal").modal('hide');
                var eventID = $('#id2').val();
                $.ajax({
                    url: 'Reserva/delete',
                    data: 'id='+eventID,
                    type: "POST",
                    success: function(json) {
                        if(json == 1){
                            //$("#calendar").fullCalendar('removeEvents',eventID);
                            //console.log(eventID);
                            //$('#calendar').fullCalendar('removeEvents');
                            //$("#calendar").destroy(eventID);

                            elimina.remove()

                        }else
                            return false;
                    }
                });
            }
        }
        $('#idindicaciones2').change(function (e) {
            $('#print').show();
            $('#print').prop('href',window.location.href+'/imprimir/'+$('#idindicaciones2').val()+'/'+$('#idpaciente2').val()+'/'+$('#start2').val());
        });
        $('#print').hide();
    });

</script>

<!-- Modal -->
<div class="modal fade" id="calendarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modificar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form  method="post" action="<?=base_url()?>Reserva/update">
                    <div class="form-group row">
                        <label for="idpaciente2" class="col-sm-3 col-form-label">Paciente</label>
                        <div class="col-sm-9">
                            <input type="text" id="id2" name="id" hidden>
                            <select name="idpaciente" id="idpaciente2" class="form-control" required>
                                <option value="">Seleccionar...</option>
                                <?php
                                $query=$this->db->query("SELECT * FROM paciente");
                                foreach ($query->result() as $row){
                                    echo "<option value='$row->idpaciente'>$row->apellidos $row->nombres</option>";
                                }
                                ?>
                            </select>
                            <div id="num"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="start2" class="col-sm-3 col-form-label">Inicio</label>
                        <div class="col-sm-9">
                            <input type="datetime-local" class="form-control" id="start2"  required name="start">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="end2" class="col-sm-3 col-form-label">Fin</label>
                        <div class="col-sm-9">
                            <input type="datetime-local" class="form-control" id="end2" required name="end">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="descripcion2" class="col-sm-3 col-form-label">Descripcion</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="descripcion2" name="descripcion">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="idindicaciones2" class="col-sm-3 col-form-label">Indicaciones</label>
                        <div class="col-sm-6">
                            <select name="idindicaciones" id="idindicaciones2" class="form-control" required>
                                <option value="">Seleccionar...</option>
                                <?php
                                $query=$this->db->query("SELECT * FROM indicaciones");
                                foreach ($query->result() as $row){
                                    echo "<option value='$row->idindicaciones'>$row->titulo</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-sm-3">
                            <a href="" id="print" class="btn btn-info"><i class="fa fa-print"></i> Print</a>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button id="eliminar" type="button" class="btn btn-danger" > <i class="fa fa-trash-o"></i> Eliminar</button>
                        <button type="submit" class="btn btn-warning"> <i class="fa fa-pencil"></i> Modificar</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


<!-- Modal -->
<div class="modal fade" id="registrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Registrar reserva</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formulario" method="post" action2="<?=base_url()?>Reserva/insert">
                    <div class="form-group row">
                        <label for="idpaciente" class="col-sm-2 col-form-label" style="font-size: 13px">Paciente</label>
                        <div class="col-sm-8">
                            <select name="idpaciente" id="idpaciente" class="form-control" >
                                <option value="">Seleccionar...</option>
                                <?php
                                $query=$this->db->query("SELECT * FROM paciente ORDER BY apellidos");
                                foreach ($query->result() as $row){
                                    echo "<option value='$row->idpaciente'>$row->apellidos $row->nombres</option>";
                                }
                                ?>
                            </select>
                            <div class="row" id="datos">
                                <div class="col-6">
                                    <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Apellidos">
                                </div>
                                <div class="col-6">
                                    <input type="text" class="form-control" name="nombres" id="nombres" placeholder="Nombres">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <input type="checkbox" id="nuevo" checked data-toggle="toggle" data-on="A" data-off="N" data-onstyle="success" data-offstyle="info">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="start" class="col-sm-3 col-form-label">Inicio</label>
                        <div class="col-sm-9">
                            <input type="datetime-local" class="form-control" id="start"  required name="start">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="end" class="col-sm-3 col-form-label">Fin</label>
                        <div class="col-sm-9">
                            <input type="datetime-local" class="form-control" id="end" required name="end">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="descripcion" class="col-sm-3 col-form-label">Descripcion</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="descripcion" name="descripcion">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
<script !src="">
    window.onload=function (e) {
        $('#datos').hide();
        $('#nuevo').change(function (e) {
            var nuevo=( $('#nuevo:checked').val());
            if (nuevo=='on'){
                //console.log('antiguo');
                $('#datos').hide();
                $('#idpaciente').show();
            }else{
                //console.log('nuevo');
                $('#datos').show();
                $('#idpaciente').hide();
                $('#idpaciente').val('');
            }
        });
    }
</script>
