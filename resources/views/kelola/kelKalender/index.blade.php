@extends('layout.mainAdmin')
@section('container')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div id='calendar'></div>
            </div>
        </div>
    </div>

    
    
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>
    <script>

        document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            themeSystem:'bootstrap5',
            events:[
                {
                    id:1, 
                    title:'new event',
                    start : '2024-05-01'
                }
            ]
        });
        calendar.render();
        });

    </script>
@endsection
