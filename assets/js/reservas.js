/*
$(document).ready(function(){


    var calendar = $('#calendar').fullCalendar({
        header:{
            left: 'prev,next today',
            center: 'title',
            right: 'agendaWeek,agendaDay'
        },
        defaultView: 'agendaWeek',
        editable: true,
        selectable: true,
        allDaySlot: false,

        events: [
            {
                title: 'All Day Event',
                start: '2019-01-01'
            },
            {
                title: 'Long Event',
                start: '2019-01-07',
                end: '2019-01-10'
            },
            {
                id: 999,
                title: 'Repeating Event',
                start: '2019-01-09T16:00:00'
            },
            {
                id: 999,
                title: 'Repeating Event',
                start: '2019-01-16T16:00:00'
            },
            {
                title: 'Conference',
                start: '2019-01-11',
                end: '2019-01-13'
            },
            {
                title: 'Meeting',
                start: '2019-01-12T10:30:00',
                end: '2019-01-12T12:30:00'
            },
            {
                title: 'Lunch',
                start: '2019-01-12T12:00:00'
            },
            {
                title: 'Meeting',
                start: '2019-01-12T14:30:00'
            },
            {
                title: 'Happy Hour',
                start: '2019-01-12T17:30:00'
            },
            {
                title: 'Dinner',
                start: '2019-01-12T20:00:00'
            },
            {
                title: 'Birthday Party',
                start: '2019-01-13T07:00:00'
            },
            {
                title: 'Click for Google',
                url: 'http://google.com/',
                start: '2019-01-28'
            }
        ]
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
            url: 'index.php',
            data: 'action=delete&id='+eventID,
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
            url: 'index.php',
            data: 'action=add&title='+title+'&start='+startTime+'&end='+endTime,
            type: "POST",
            success: function(json) {
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
*/