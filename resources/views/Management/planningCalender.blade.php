@extends('Management.layouts.app')


@section('mainContent')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                @if (Session::has('success'))
                    <h6 class="alert alert-success text-white">{{ Session::get('success') }}</h6>
                @endif
                <div class="card mb-4">
                    <div class="card-body">
                        <!-- Calendar Container -->
                        <div id="calendar"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Appointment Details Modal -->
        <div id="appointmentModal" class="modal fade" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Set Appointment</h5>
                    </div>
                    <div class="modal-body">
                        <form id="appointmentForm" method="POST" action="{{ route('store.planing') }}">
                            @csrf
                            <input type="hidden" name="patient_id" value="{{ $patientDetails->id }}">

                            <div class="form-group">
                                <label for="patientName">Patient Name</label>
                                <input type="text" id="patientName" class="form-control"
                                    value="{{ $patientDetails->patient_name }}" readonly>
                            </div>

                            <div class="form-group">
                                <label for="appointmentDate">Date</label>
                                <input type="date" id="appointmentDate" name="date" class="form-control" readonly>
                            </div>

                            <input type="hidden" name="day" id="appointmentDay">
                            <input type="hidden" name="month" id="appointmentMonth">

                            <div class="form-group">
                                <label for="appointmentTime">Time</label>
                                <input type="time" name="appointmentTime" id="appointmentTime" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="appointmentDetails">Details / Description</label>
                                <textarea id="appointmentDetails" name="description" class="form-control" required></textarea>
                            </div>

                            <div class="form-group">
                                <label>Status</label> <br>
                                <input type="radio" id="statusActive" name="status" value="Active"
                                    class="form-check-input" checked>
                                <label for="statusActive" class="form-check-label">Active</label>

                                <input type="radio" id="statusInactive" name="status" value="Inactive"
                                    class="form-check-input">
                                <label for="statusInactive" class="form-check-label">Inactive</label>
                            </div>

                            <div class="form-group">
                                <label>Frequency</label>
                                <select name="frequency" class="form-control">
                                    <option value="once">Once</option>
                                </select>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" id="cancelAppointment">Cancel</button>
                                <button type="submit" class="btn btn-primary">Save Appointment</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>
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

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                selectable: true,
                headerToolbar: {
                    left: 'backButton prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                customButtons: {
                    backButton: {
                        text: 'Back',
                        click: function() {
                            window.location.href =
                                "{{ route('index.planing') }}"; // Replace with your actual route
                        }
                    }
                },
                events: sessionEvents.map(session => ({
                    id: session.id,
                    title: session.description,
                    start: session.date + (session.time ? 'T' + session.time :
                        '')
                })),
                dateClick: function(info) {
                    let selectedDate = new Date(info.dateStr);

                    $('#appointmentDate').val(info.dateStr);
                    $('#appointmentDay').val(selectedDate.toLocaleString('en-US', {
                        weekday: 'long'
                    }));
                    $('#appointmentMonth').val(selectedDate.toLocaleString('en-US', {
                        month: 'long'
                    }));

                    $('#appointmentModal').modal('show');
                },
                eventClick: function(info) {
                    if (confirm("Are you sure you want to delete this appointment?")) {
                        let appointmentId = info.event.id; // Get the event's id

                        $.ajax({
                            url: "{{ route('delete.planing', '') }}/" + appointmentId,
                            type: 'DELETE',
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                if (response.success) {
                                    info.event
                                .remove(); // Remove the event from the calendar
                                    alert("Appointment deleted successfully");
                                }
                            },
                            error: function(xhr) {
                                alert("Error deleting appointment");
                            }
                        });
                    }
                }
            });

            calendar.render();

            // Handle Save Appointment
            $('#saveAppointment').click(function() {
                var date = $('#appointmentDate').val();
                var time = $('#appointmentTime').val();
                var details = $('#appointmentDetails').val();

                if (date && time) {
                    calendar.addEvent({
                        title: details || 'New Appointment',
                        start: date + 'T' + time
                    });
                    $('#appointmentModal').modal('hide');
                } else {
                    alert("Please fill in all fields");
                }
            });

            // Handle Cancel Button Click
            $('#cancelAppointment').click(function() {
                $('#appointmentModal').modal('hide'); // Close the modal
                $('#appointmentForm')[0].reset(); // Clear form fields
            });
        });
    </script>
@endsection
