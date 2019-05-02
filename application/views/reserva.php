
<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8' />
    <link href='<?=base_url()?>assets/css/bootstrap.min.css' rel='stylesheet' />
    <link href='<?=base_url()?>assets/css/fullcalendar.min.css' rel='stylesheet' />
    <link href='<?=base_url()?>assets/css/fullcalendar.print.min.css' rel='stylesheet' media='print' />
    <script src='<?=base_url()?>assets/js/moment.min.js'></script>
    <script src='<?=base_url()?>assets/js/jquery.min.js'></script>
    <script src='<?=base_url()?>assets/js/bootstrap.min.js'></script>
    <script src='<?=base_url()?>assets/js/fullcalendar.min.js'></script>
    <script src='<?=base_url()?>assets/js/locale-all.js'></script>
    <script>
        $(document).ready(function(){
            var calendar = $('#calendar').fullCalendar({
                header:{
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                defaultView: 'month',
                editable: true,
                selectable: true,
                allDaySlot: false,
                locale:'es',
                events: "Reserva/reservas",
                eventClick:  function(event, jsEvent, view) {
                    endtime = $.fullCalendar.moment(event.end).format('h:mm');
                    starttime = $.fullCalendar.moment(event.start).format('dddd, MMMM Do YYYY, h:mm');
                    var mywhen = starttime + ' - ' + endtime;
                    $('#modalTitle').html(event.title);
                    $('#modalWhen').text(mywhen);
                    $('#eventID').val(event.id);
                    $('#calendarModal').modal();
                },

                //header and other values
                select: function(start, end, jsEvent) {
                    endtime = $.fullCalendar.moment(end).format('h:mm');
                    starttime = $.fullCalendar.moment(start).format('dddd, MMMM Do YYYY, h:mm');
                    var mywhen = starttime + ' - ' + endtime;
                    start = moment(start).format();
                    end = moment(end).format();
                    $('#createEventModal #startTime').val(start);
                    $('#createEventModal #endTime').val(end);
                    $('#createEventModal #when').text(mywhen);
                    $('#createEventModal').modal('toggle');
                },
                eventDrop: function(event, delta){
                    $.ajax({
                        url: 'index.php',
                        data: 'action=update&title='+event.title+'&start='+moment(event.start).format()+'&end='+moment(event.end).format()+'&id='+event.id ,
                        type: "POST",
                        success: function(json) {
                            //alert(json);
                        }
                    });
                },
                eventResize: function(event) {
                    $.ajax({
                        url: 'index.php',
                        data: 'action=update&title='+event.title+'&start='+moment(event.start).format()+'&end='+moment(event.end).format()+'&id='+event.id,
                        type: "POST",
                        success: function(json) {
                            //alert(json);
                        }
                    });
                }
            });

            $('#submitButton').on('click', function(e){
                // We don't want this to act as a link so cancel the link action
                e.preventDefault();
                doSubmit();
            });

            $('#deleteButton').on('click', function(e){
                // We don't want this to act as a link so cancel the link action
                e.preventDefault();
                doDelete();
            });

            function doDelete(){
                $("#calendarModal").modal('hide');
                var eventID = $('#eventID').val();
                $.ajax({
                    url: 'Reserva/delete',
                    data: 'id='+eventID,
                    type: "POST",
                    success: function(json) {
                        if(json == 1)
                            $("#calendar").fullCalendar('removeEvents',eventID);
                        else
                            return false;
                    }
                });
            }
            function doSubmit(){
                $("#createEventModal").modal('hide');
                var title = $('#title').val();
                var startTime = $('#startTime').val();
                var endTime = $('#endTime').val();

                $.ajax({
                    url: 'Reserva/insert',
                    data: '&title='+title+'&start='+startTime+'&end='+endTime,
                    type: "POST",
                    success: function() {
                        $("#calendar").fullCalendar('renderEvent',
                            {
                                id: json.id,
                                title: title,
                                start: startTime,
                                end: endTime,
                            },
                            true);
                    }
                });

            }
        });



    </script>
    <style>

        body {
            margin: 0;
            padding: 0;
            font-family: "Lucida Grande",Helvetica,Arial,Verdana,sans-serif;
            font-size: 14px;
        }

        #calendar {
            max-width: 900px;
            margin: 40px auto;
            padding: 0 10px;
        }

    </style>
</head>
<body>

<div id='calendar'></div>

</body>
</html>


<!-- Modal -->
<div id="createEventModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Event</h4>
            </div>
            <div class="modal-body">
                <div class="control-group">
                    <label class="control-label" for="inputPatient">Event:</label>
                    <div class="field desc">
                        <input class="form-control" id="title" name="title" placeholder="Event" type="text" value="">
                    </div>
                </div>

                <input type="hidden" id="startTime"/>
                <input type="hidden" id="endTime"/>



                <div class="control-group">
                    <label class="control-label" for="when">When:</label>
                    <div class="controls controls-row" id="when" style="margin-top:5px;">
                    </div>
                </div>

            </div>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                <button type="submit" class="btn btn-primary" id="submitButton">Save</button>
            </div>
        </div>

    </div>
</div>


<div id="calendarModal" class="modal fade">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Event Details</h4>
            </div>
            <div id="modalBody" class="modal-body">
                <h4 id="modalTitle" class="modal-title"></h4>
                <div id="modalWhen" style="margin-top:5px;"></div>
            </div>
            <input type="hidden" id="eventID"/>
            <div class="modal-footer">
                <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                <button type="submit" class="btn btn-danger" id="deleteButton">Delete</button>
            </div>
        </div>
    </div>
</div>
<!--Modal-->