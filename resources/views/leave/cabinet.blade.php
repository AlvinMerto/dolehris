<x-app-layout>
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"> -->
<!--     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" /> -->

    <button id='todaybtn'> Today </button>
    <button id='nextbtn'> Next </button>
    <button id='prevbtn'> Prev </button>

    <button> Apply Leave Application </button>
    <div class='pd-30'>
        <div id='calendar' style='height:1000px;'></div>
    </div>

<!--     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
     -->
    <link rel="stylesheet" href="https://uicdn.toast.com/calendar/latest/toastui-calendar.min.css" />
    <script src="https://uicdn.toast.com/calendar/latest/toastui-calendar.min.js"></script>

    <!-- <script src="{{ asset('/dolejs/leavecalendar.procs.js') }}"></script> -->

    <script>
        const Calendar = tui.Calendar;
        const container = document.getElementById('calendar');
        const options = {
          seFormPopup: true,
          useDetailPopup: true,
          defaultView: 'month',
          usageStatistics: false
        };

        const calendar = new Calendar(container, options);

        calendar.on('clickEvent', ({ event }) => {
          const el = document.getElementById('clicked-event');
          el.innerText = event.title;
        });

        calendar.on("selectDateTime", function(){
            alert("clicking");
        })

        let prevbtn = document.getElementById("prevbtn");
            prevbtn.addEventListener("click", function(){
                calendar.prev();
            });

        let nextbtn = document.getElementById("nextbtn");
            nextbtn.addEventListener("click",function(){
                calendar.next();
            });

        let todaybtn = document.getElementById("todaybtn");
            todaybtn.addEventListener("click",function(){
                calendar.today();
            });
    </script>
</x-app-layout>