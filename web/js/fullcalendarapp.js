$(document).ready(function() {
    $('#calendar').fullCalendar({
        weekends: true,
        defaultView: 'basicWeek',
        header: {
            left: 'month, basicWeek, listDay',
            center: 'title',
            right: 'today, prev, next, prevYear, nextYear'
        },
        // events: {
        // url: Routing.generate('asiel_task_calendar_data', { }, true),
        // error: function() {
        //     alert('there was an error while fetching events!');
        // }
        // },
        eventSources: [
            Routing.generate('backend_calendar_data', { }, true),
            Routing.generate('backend_calendaritem_data', { }, true),
        ],
        eventClick: function(calEvent, jsEvent, view) {
            if (calEvent.animalname) {
                window.location.replace(Routing.generate('backend_animal_task_edit', { id: calEvent.animalid, taskid: calEvent.id }, true));
            } else {
                window.location.replace(Routing.generate('backend_calendaritem_edit', { itemid: calEvent.id }, true));
            }
        },
        eventRender: function(event, element) {
            var content = "";
            if (event.createdBy) {
                content += "Door: "+event.createdBy+"<br />";
            }
            if (event.animalname) {
                content += "Dier: "+event.animalname+ "<br />";
            }
            element.qtip({
                content: content +
                         "Titel: "+event.title+"<hr>"+
                          event.description.substring(0,70),
                style: {classes: 'qtip-bootstrap'}
            });
            if (event.animalname) {
                element.find('.fc-title').before("Dier: " + event.animalname + "<br />");
            }
            element.css('cursor', 'pointer');
            if (event.createdBy == 'Systeem') {
                element.css('background-color', 'grey')
            }
            var now = new Date();
            now.setHours(0,0,0,0);
            if (event.start < now && event.isComplete == false) {
                element.css('background-color', 'red')
            }
            if (event.isComplete == true) {
                element.css('background-color', 'green')
            }
        }
    });
});
