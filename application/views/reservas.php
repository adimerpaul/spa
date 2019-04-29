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
        var calendarEl = document.getElementById('calendar');

        var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: [ 'interaction', 'dayGrid', 'timeGrid', 'list' ],
            header: {
                left: 'prev,next today custom1',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
            },
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
                var idpaciente=(info.event._def.extendedProps.idpaciente);
                var descripcion=(info.event._def.extendedProps.descripcion);
                var start=(info.event.start);
                var end=(info.event.end);
                $('#idpaciente2').prop('value',idpaciente);
                $('#descripcion2').prop('value',descripcion);
                $('#start2').val(moment(start).format('YYYY-MM-DDTHH:mm'));
                $('#end2').val(moment(end).format('YYYY-MM-DDTHH:mm'));
                $('#id2').val(info.event.id);
            },
            select: function(info) {
                //alert('selected ' + info.startStr + ' to ' + info.endStr);
                //console.log(info.startStr);
                $('#registrar').modal();
                $('#start').val(moment(info.startStr).format('YYYY-MM-DDTHH:mm'));
                $('#end').val(moment(info.endStr).format('YYYY-MM-DDTHH:mm'));

            },customButtons: {
                custom1: {
                    text: 'Registrar reserva',
                    click: function() {
                        $('#registrar').modal();
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
                <form method="post" action="<?=base_url()?>Reserva/update">
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
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" > <i class="fa fa-trash-o"></i> Eliminar</button>
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
                <form method="post" action="<?=base_url()?>Reserva/insert">
                    <div class="form-group row">
                        <label for="paciente" class="col-sm-3 col-form-label">Paciente</label>
                        <div class="col-sm-9">
                            <select name="idpaciente" id="paciente" class="form-control" required>
                                <option value="">Seleccionar...</option>
                                <?php
                                $query=$this->db->query("SELECT * FROM paciente ORDER BY apellidos");
                                foreach ($query->result() as $row){
                                    echo "<option value='$row->idpaciente'>$row->apellidos $row->nombres</option>";
                                }
                                ?>
                            </select>
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