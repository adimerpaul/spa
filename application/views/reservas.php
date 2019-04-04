<style>

    body {
        margin: 40px 10px;
        padding: 0;
        font-family: Arial, Helvetica Neue, Helvetica, sans-serif;
        font-size: 14px;
    }

    #calendar {
        max-width: 900px;
        margin: 0 auto;
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
                console.log(moment(info.event.end).format('LT'))
                /*alert('Event: ' + info.event.title);
                alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
                alert('View: ' + info.view.type);

                // change the border color just for fun
                info.el.style.borderColor = 'red';
                */
                $('#calendarModal').modal();
            },
            select: function(info) {
                //alert('selected ' + info.startStr + ' to ' + info.endStr);
                console.log(info.startStr);
                $('#registrar').modal();
                $('#start').val(moment(info.startStr).format('YYYY-MM-DDTHH:mm'));
                $('#end').val(moment(info.endStr).format('YYYY-MM-DDTHH:mm'));

            },customButtons: {
                custom1: {
                    text: 'Registrar reserva',
                    click: function() {
                        //alert('clicked custom button 1!');
                        $('#registrar').modal();
                    }
                }
            }
        });

        calendar.render();
    });

</script>

<!-- Modal -->
<div class="modal fade" id="calendarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Guardar</button>
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
                <form>
                    <div class="form-group row">
                        <label for="paciente" class="col-sm-3 col-form-label">Paciente</label>
                        <div class="col-sm-9">
                            <select name="paciente" id="paciente" class="form-control" required>
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
                        <label for="start" class="col-sm-3 col-form-label">Inicio</label>
                        <div class="col-sm-9">
                        <input type="datetime-local" class="form-control" id="start" name="start">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="end" class="col-sm-3 col-form-label">Fin</label>
                        <div class="col-sm-9">
                        <input type="datetime-local" class="form-control" id="end" name="end">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-success">Save changes</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>