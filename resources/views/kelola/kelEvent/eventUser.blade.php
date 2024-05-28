@extends('layout.mainUser')
@section('container')
    <style>
        /* .containerCalender {
            padding-top: 50px;
        } */

        .content-staff {
            background-image: linear-gradient(rgba(255, 255, 255, 0.805), rgba(224, 224, 224, 0.856)), url("/img/bg-pl.jpg");
            
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            position: relative;
            /* margin-bottom: -120px;
            padding-bottom: 50px;
            margin-top: 30px; */
        }

        .content-staff h2 {
            text-align: center;
        }
        #calendar {
            max-height: 600px;
            overflow: hidden;
            padding: 10px;
        }
        .row {
            background-color: rgb(242, 242, 239);
            box-shadow: 0 4px 8px 0 rgba(0,0,0,1.2);
            transition: 0.3s;
        }
       
    </style>
    
    <div class="content-staff">
        <div class="container">
            <br>
            <h2>Kalender Diklat</h2>
            <br>
            <div class="row">
                <div class="col-12 mt-3">
                    <div id='calendar'></div>
                </div>
            </div>
        </div>

        <div id="modal-action" class="modal" tabindex="-1">
            
    </div>
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.11/index.global.min.js'></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.7/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/bootstrap5@6.1.7/index.global.min.js'></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/izitoast/1.4.0/js/iziToast.min.js" integrity="sha512-Zq9o+E00xhhR/7vJ49mxFNJ0KQw1E1TMWkPTxrWcnpfEFDEXgUiwJHIKit93EW/XxE31HSI5GEOW06G6BF1AtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        const modal = $('#modal-action')
        const csrfToken = $('meta[name=csrf_token]').attr('content')

        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            themeSystem: 'bootstrap5',
            events: `{{ route('events.list') }}`,
            });
            calendar.render();
        });

    </script>
@endsection
