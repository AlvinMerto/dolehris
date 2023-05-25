            var SITEURL = "{{ url('/') }}";

            var calendar = $('#calendar').fullCalendar({
                    editable: true,
                    events: SITEURL + "/fullcalender",
                    displayEventTime: false,
                    editable: true,
                    eventRender: function (event, element, view) {
                        if (event.allDay === 'true') {
                                event.allDay = true;
                        } else {
                                event.allDay = false;
                        }
                    },

                    selectable: true,
                    selectHelper: true,
                    select: function (start, end, allDay) {
                        callleavewindow();
                        // var title = prompt('Event Title:');

                        // calendar.fullCalendar('renderEvent',
                        //                 {
                        //                     id: 11,
                        //                     title: title,
                        //                     start: start,
                        //                     end: end,
                        //                     allDay: allDay
                        //                 },true);

                        // if (title) {
                        //     var start = $.fullCalendar.formatDate(start, "Y-MM-DD");
                        //     var end = $.fullCalendar.formatDate(end, "Y-MM-DD");

                        //     calendar.fullCalendar('renderEvent',
                        //                 {
                        //                     id: '1',
                        //                     title: title,
                        //                     start: start,
                        //                     end: end,
                        //                     allDay: allDay
                        //                 },true);

                        //     $.ajax({
                        //         url: SITEURL + "/fullcalenderAjax",
                        //         data: {
                        //             title: title,
                        //             start: start,
                        //             end: end,
                        //             type: 'add'
                        //         },
                        //         type: "POST",
                        //         success: function (data) {
                        //             displayMessage("Event Created Successfully");
  
                        //             calendar.fullCalendar('renderEvent',
                        //                 {
                        //                     id: data.id,
                        //                     title: title,
                        //                     start: start,
                        //                     end: end,
                        //                     allDay: allDay
                        //                 },true);
  
                        //             calendar.fullCalendar('unselect');
                        //         }
                        //     });
                        // }
                    },
                    eventDrop: function (event, delta) {
                        var start = $.fullCalendar.formatDate(event.start, "Y-MM-DD");
                        var end = $.fullCalendar.formatDate(event.end, "Y-MM-DD");
  
                        $.ajax({
                            url: SITEURL + '/fullcalenderAjax',
                            data: {
                                title: event.title,
                                start: start,
                                end: end,
                                id: event.id,
                                type: 'update'
                            },
                            type: "POST",
                            success: function (response) {
                                displayMessage("Event Updated Successfully");
                            }
                        });
                    },
                    eventClick: function (event) {
                        var deleteMsg = confirm("Do you really want to delete?");
                        if (deleteMsg) {
                            $.ajax({
                                type: "POST",
                                url: SITEURL + '/fullcalenderAjax',
                                data: {
                                        id: event.id,
                                        type: 'delete'
                                },
                                success: function (response) {
                                    calendar.fullCalendar('removeEvents', event.id);
                                    displayMessage("Event Deleted Successfully");
                                }
                            });
                        }
                    }
 
                });

function callleavewindow() {
    $("#themodal").modal("show");

    $.ajax({
        url      : url+"/leavewindowparent",
        type     : "get",
        dataType : "html",
        success  : function(data){
            $(document).find("#showwindowhere").html(data);
        }, error : function() {
            alert("An error occured in calling leavewindowparent route");
        }
    })
}