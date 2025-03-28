@extends('Management.layouts.app')

@section('mainContent')
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">


            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <a href="{{ route('manage.ClickPatients') }}">
                            <div class="row">
                                <div class="col-8">

                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold"></p>
                                        <h5 class="font-weight-bolder">
                                            Assess
                                        </h5>
                                        <p class="mb-0">
                                            <span class="text-success text-sm font-weight-bolder">Click Here</span>
                                        </p>
                                    </div>

                                </div>

                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                        <i class="fas fa-users text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <a href="{{ route('manage.bookApp') }}">
                            <div class="row">
                                <div class="col-8">

                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold"></p>
                                        <h5 class="font-weight-bolder">
                                            Appt's.
                                        </h5>
                                        <p class="mb-0">
                                            <span class="text-success text-sm font-weight-bolder">Click Here</span>
                                        </p>
                                    </div>

                                </div>

                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                        <i class="fas fa-calendar-check text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <a href="{{ route('manage.patientsList') }}">
                            <div class="row">
                                <div class="col-8">

                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold"></p>
                                        <h5 class="font-weight-bolder">
                                            Registered
                                        </h5>
                                        <p class="mb-0">
                                            <span class="text-success text-sm font-weight-bolder">Click Here</span>
                                        </p>
                                    </div>

                                </div>

                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                        <i class="fas fa-user-injured text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>


            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <a href="{{ route('manage.doctorList') }}">
                            <div class="row">
                                <div class="col-8">

                                    <div class="numbers">
                                        <p class="text-sm mb-0 text-uppercase font-weight-bold"></p>
                                        <h5 class="font-weight-bolder">
                                            Doctor's
                                        </h5>
                                        <p class="mb-0">
                                            <span class="text-success text-sm font-weight-bolder">Click Here</span>

                                        </p>
                                    </div>

                                </div>
                                <div class="col-4 text-end">
                                    <div
                                        class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                        <i class="fas fa-user-md text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>


        </div>

        <div class="row mt-4">
            <div class="col-lg-7 mb-lg-0 mb-4">
                <div class="card z-index-2 h-100">
                    <div class="card-header pb-0 pt-3 bg-transparent">
                        <h6 class="text-capitalize">Sales overview</h6>
                        <p class="text-sm mb-0">
                            <i class="fa fa-arrow-up text-success"></i>
                            <span class="font-weight-bold">4% more</span> in 2021
                        </p>
                    </div>
                    <div class="card-body p-3">
                        <div class="chart">
                            <canvas id="chart-line" class="chart-canvas" height="300" width="571"
                                style="display: block; box-sizing: border-box; height: 300px; width: 571.1px;"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Scheduled Sessions</h6>
                    </div>
                    <div class="card-body p-3">
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Latest Data</h6>
                    </div>
                    <div class="card-body p-3">
                        <ul class="list-group">
                            @foreach ($latestNotifications as $notification)
                                @php
                                    // Decode the JSON data
                                    $data = json_decode($notification->data, true);
                                    $appointmentDate = \Carbon\Carbon::parse($data['app_date']);
                                @endphp
                                <li
                                    class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">
                                    <div class="d-flex align-items-center">
                                        <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">
                                            <i class="text-white  opacity-10">
                                                @if ($data['session_no'] == 0)
                                                    A
                                                @elseif ($data['session_no'] == -1)
                                                    Cons
                                                @else
                                                    {{ $data['session_no'] }}
                                                @endif
                                            </i>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <h6 class="mb-1 text-dark text-sm">{{ $data['name'] }}</h6>
                                            <span class="text-xs">CR0000{{ $data['patient_id'] }}</span></span>
                                        </div>
                                    </div>
                                    <div class="d-flex text-sm my-auto">
                                        Dr. @foreach ($user as $use)
                                            {{ $use->id == $notification->notifiable_id ? $use->name : '' }}
                                        @endforeach

                                    </div>
                                </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 mb-lg-0 mb-4">
                <div class="card ">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-2">Today</h6>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-items-center ">
                            <tbody>
                                @foreach ($notifications as $notification)
                                    @php
                                        // Decode the JSON data
                                        $data = json_decode($notification->data, true);
                                        $appointmentDate = \Carbon\Carbon::parse($data['app_date']);
                                    @endphp
                                    @if ($appointmentDate->isToday())
                                        <tr>
                                            <td class="w-30">
                                                <div class="d-flex px-2 py-1 align-items-center">
                                                    <div class="ms-4">
                                                        <h6 class="text-sm mb-0">{{ $data['name'] }}</h6>
                                                        <p class="text-xs font-weight-bold mb-0">
                                                            CR0000{{ $data['patient_id'] }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <p class="text-xs font-weight-bold mb-0">Session no:</p>
                                                    <h6 class="text-sm mb-0">
                                                        {{ $data['session_no'] == 0 ? 'Assessment' : ($data['session_no'] == -1 ? 'Consultation' : $data['session_no']) }}
                                                    </h6>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="text-center">
                                                    <p class="text-xs font-weight-bold mb-0">App Date:</p>
                                                    <h6 class="text-sm mb-0">
                                                        {{ \Carbon\Carbon::parse($data['app_date'])->format('F j, Y, g:i a') }}
                                                    </h6>
                                                </div>
                                            </td>
                                            <td class="align-middle text-sm">
                                                <div class="col text-center">
                                                    <p class="text-xs font-weight-bold mb-0">Doctor Name:</p>
                                                    <h6 class="text-sm mb-0">
                                                        @foreach ($user as $use)
                                                            {{ $use->id == $notification->notifiable_id ? $use->name : '' }}
                                                        @endforeach
                                                    </h6>
                                                </div>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--<div class="col-lg-5">-->
            <!--    <div class="card">-->
            <!--        <div class="card-header pb-0 p-3">-->
            <!--            <h6 class="mb-0">Latest Data</h6>-->
            <!--        </div>-->
            <!--        <div class="card-body p-3">-->
            <!--            <ul class="list-group">-->
            <!--                @foreach ($latestNotifications as $notification)
    -->
            <!--                    @php-->
                            <!--                        // Decode the JSON data-->
                            <!--                        $data = json_decode($notification->data, true);-->
                            <!--                        $appointmentDate = \Carbon\Carbon::parse($data['app_date']);-->
                        <!--                    @endphp ?>-->
            <!--                    <li-->
            <!--                        class="list-group-item border-0 d-flex justify-content-between ps-0 mb-2 border-radius-lg">-->
            <!--                        <div class="d-flex align-items-center">-->
            <!--                            <div class="icon icon-shape icon-sm me-3 bg-gradient-dark shadow text-center">-->
            <!--                                <i class="text-white  opacity-10">-->
            <!--                                    @if ($data['session_no'] == 0)
    -->
            <!--                                        A-->
            <!--
@elseif ($data['session_no'] == -1)
    -->
            <!--                                        Cons-->
        <!--                                    @else-->
            <!--                                        {{ $data['session_no'] }}-->
            <!--
    @endif-->
            <!--                                </i>-->
            <!--                            </div>-->
            <!--                            <div class="d-flex flex-column">-->
            <!--                                <h6 class="mb-1 text-dark text-sm">{{ $data['name'] }}</h6>-->
            <!--                                <span class="text-xs">CR0000{{ $data['patient_id'] }}</span></span>-->
            <!--                            </div>-->
            <!--                        </div>-->
            <!--                        <div class="d-flex text-sm my-auto">-->
            <!--                            Dr. @foreach ($user as $use)
    -->
            <!--                                {{ $use->id == $notification->notifiable_id ? $use->name : '' }}-->
            <!--
    @endforeach-->

            <!--                        </div>-->
            <!--                    </li>-->
            <!--
    @endforeach-->

            <!--            </ul>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->
        </div>


        <footer class="footer pt-4">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6 mb-lg-0 mb-4">
                        <div class="copyright text-center text-sm text-muted text-lg-start">
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>,
                            made with <i class="fa fa-heart"></i> by
                            <a href="https://www.cardiorescue.in" class="font-weight-bold" target="_blank">Cardio Rescue
                                Team</a>

                        </div>
                    </div>

                </div>
            </div>
        </footer>
    </div>
    </main>
@endsection

@section('scriptsCustom')
    <!-- FullCalendar CSS -->
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>

    <!-- jQuery and Bootstrap (for modal) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        var sessionEvents = @json($sessions);

        document.addEventListener("DOMContentLoaded", function() {
            var calendarEl = document.getElementById('calendar');
            if (!calendarEl) {
                console.error("Calendar element not found!");
                return;
            }

            var today = new Date().toISOString().split('T')[0]; // Get today's date in YYYY-MM-DD format

            var todayEvents = sessionEvents.filter(session => session.date === today); // Filter today's sessions

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridDay', // Show only today's view
                selectable: true,
                headerToolbar: {
                    left: 'prev,next',
                    right: 'today'
                },
                events: todayEvents.map(session => ({
                    title: (session.patient ? session.patient.patient_name : 'Unknown') +
                        ' - ' + session.description,
                    start: session.date + (session.time ? 'T' + session.time : '')
                })),
                dateClick: function(info) {
                    let selectedDate = new Date(info.dateStr);
                    $('#appointmentDate').val(info.dateStr);
                    $('#appointmentModal').modal('show');
                },
            });

            calendar.render();
            // Handle Cancel Button Click
            $('#cancelAppointment').click(function() {
                $('#appointmentModal').modal('hide'); // Close the modal
                $('#appointmentForm')[0].reset(); // Clear form fields
            });
        });
    </script>
@endsection
