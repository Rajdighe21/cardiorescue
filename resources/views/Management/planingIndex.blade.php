@extends('Management.layouts.app')

@section('mainContent')
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                @if (Session::has('success'))
                    <h6 class="alert alert-success text-white">{{ Session::get('success') }}</h6>
                @endif
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center flex-wrap">
                        <h6 class="m-0">
                            <a href="{{ route('manage.dashboard') }}" class="opacity-9 text-seconday">Back </a>
                        </h6>
                        <div class="d-flex align-items-center flex-wrap">

                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Patient ID</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Status</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Location</th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Contact
                                                </th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Registration Date
                                                </th>
                                                <th
                                                    class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Assign Session
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($patientLists as $patient)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2 py-1">
                                                            <div class="d-flex flex-column justify-content-center">
                                                                <h6 class="mb-0 text-xs">{{ $patient->patient_name }}</h6>
                                                                <p class="text-xs text-secondary mb-0">CR{{ $patient->id }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <p class="text-xs font-weight-bold mb-0">{{ $patient->status }}</p>
                                                    </td>
                                                    <td class="align-middle text-center text-sm">
                                                        <span
                                                            class="text-secondary text-xs font-weight-normal">{{ $patient->location }}</span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span
                                                            class="text-secondary text-xs font-weight-normal">{{ $patient->contact }}</span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <span
                                                            class="text-secondary text-xs font-weight-normal">{{ $patient->created_at->format('d/m/Y') }}</span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <button type="button" class="btn btn-sm btn-primary p-2"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#assignSessionModal-{{ $patient->id }}">
                                                            Assign Session
                                                        </button>
                                                    </td>
                                                </tr>
                                            @endforeach


                                            @foreach ($patientLists as $patient)
                                                <!-- Modal -->
                                                <div class="modal fade" id="assignSessionModal-{{ $patient->id }}"
                                                    tabindex="-1" aria-labelledby="assignSessionLabel-{{ $patient->id }}"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">

                                                            <!-- Modal Header -->
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Session Planning for
                                                                    {{ $patient->patient_name }}</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>

                                                            <!-- Modal Body -->
                                                            <div class="modal-body">
                                                                <form action="#" method="POST">
                                                                    @csrf
                                                                    <input type="hidden" name="patient_id"
                                                                        value="{{ $patient->id }}">

                                                                    <div id="calendar"></div>

                                                                    <!-- Modal for Adding Event -->
                                                                    <div id="eventModal" style="display:none;">
                                                                        <label>Description:</label>
                                                                        <input type="text" id="eventDescription">

                                                                        <label>Frequency:</label>
                                                                        <select id="eventFrequency">
                                                                            <option value="once">Once</option>
                                                                            <option value="twice">Twice a day</option>
                                                                        </select>

                                                                        <button id="saveEvent">Save Event</button>
                                                                    </div>


                                                                    <!-- Month Selection -->
                                                                    {{-- <div class="mb-3">
                                                                        <label class="form-label">Select Month</label>
                                                                        <div class="row">
                                                                            @foreach (range(1, 12) as $month)
                                                                                <div class="col-4">
                                                                                    <div class="form-check">
                                                                                        <input class="form-check-input"
                                                                                            type="checkbox"
                                                                                            name="session_months[]"
                                                                                            value="{{ $month }}">
                                                                                        <label class="form-check-label">
                                                                                            {{ date('F', mktime(0, 0, 0, $month, 1)) }}
                                                                                        </label>
                                                                                    </div>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="total_session" class="form-label">Total
                                                                            Sessions</label>
                                                                        <input type="number" class="form-control"
                                                                            name="total_session" id="total_session"
                                                                            min="1"
                                                                            placeholder="Enter total sessions" required>
                                                                    </div> --}}


                                                                    <!-- Weekday Selection -->
                                                                    {{-- <div class="mb-3">
                                                                        <label class="form-label">Select Weekdays</label>
                                                                        <div class="d-flex flex-wrap">
                                                                            @foreach (['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'] as $day)
                                                                                <div class="form-check me-3">
                                                                                    <input class="form-check-input"
                                                                                        type="checkbox"
                                                                                        name="session_weekday[]"
                                                                                        value="{{ $day }}"
                                                                                        id="weekday-{{ $day }}">
                                                                                    <label class="form-check-label"
                                                                                        for="weekday-{{ $day }}">{{ $day }}</label>
                                                                                </div>
                                                                            @endforeach
                                                                        </div>
                                                                    </div> --}}

                                                                    <!-- Session Frequency Selection -->
                                                                    {{-- <div class="mb-3">
                                                                        <label for="session_frequency"
                                                                            class="form-label">Session Frequency</label>
                                                                        <select class="form-control"
                                                                            name="session_frequency" required>
                                                                            <option value="">Select Frequency</option>
                                                                            <option value="1">Once a Day</option>
                                                                            <option value="2">Twice a Day</option>
                                                                            <option value="3">Thrice a Day</option>
                                                                        </select>
                                                                    </div> --}}

                                                                    {{-- <!-- Session Time -->
                                                                    <div class="mb-3">
                                                                        <label for="session_time" class="form-label">Session
                                                                            Time</label>
                                                                        <select class="form-control" name="session_time"
                                                                            required>
                                                                            <option value="">Select Time Slot
                                                                            </option>
                                                                            <option value="10:00 AM">10:00 AM</option>
                                                                            <option value="11:00 AM">11:00 AM</option>
                                                                            <option value="02:00 PM">02:00 PM</option>
                                                                            <option value="04:00 PM">04:00 PM</option>
                                                                            <option value="06:00 PM">06:00 PM</option>

                                                                        </select>
                                                                    </div> --}}

                                                                    <!-- Doctor Selection -->
                                                                    {{-- <div class="mb-3">
                                                                        <label for="doctor" class="form-label">Assign
                                                                            Doctor</label>
                                                                        <select class="form-control" name="doctor_id"
                                                                            required>
                                                                            <option value="">Select Doctor</option>
                                                                            @foreach ($doctorLists as $doctor)
                                                                                <option value="{{ $doctor->id }}">
                                                                                    {{ $doctor->name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>

                                                                    <div class="mb-3">
                                                                        <label for="session_description"
                                                                            class="form-label">Description /
                                                                            Details</label>
                                                                        <textarea class="form-control" name="session_description" rows="4" placeholder="Enter session details..."></textarea>
                                                                    </div> --}}

                                                                    {{-- Calender  --}}


                                                                    <!-- Submit Button -->
                                                                    <button type="submit" class="btn btn-primary">Save
                                                                        Session</button>
                                                                </form>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <!-- Pagination Links -->
                                <div class="d-flex justify-content-end mt-3">
                                    {{ $patientLists->links() }}
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="d-flex justify-content-end mb-3">
                            <input type="date" id="filterDate" class="form-control me-2" style="width: 200px;">
                            <select id="filterMonth" class="form-control" style="width: 200px;">
                                <option value="">Select Month</option>
                                <option value="01">January</option>
                                <option value="02">February</option>
                                <option value="03">March</option>
                                <option value="04">April</option>
                                <option value="05">May</option>
                                <option value="06">June</option>
                                <option value="07">July</option>
                                <option value="08">August</option>
                                <option value="09">September</option>
                                <option value="10">October</option>
                                <option value="11">November</option>
                                <option value="12">December</option>
                            </select>
                        </div>
                        <div class="table-responsive p-0">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table align-items-center mb-0">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Sunday</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Monday</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Tuesday</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Wednesday</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Thursday</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Friday</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Saturday</th>

                                            </tr>
                                        </thead>
                                        <tbody id="dataTable">
                                            {{-- @foreach ($weekData as $data)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-xs">{{ $data->author }}</h6>
                                                            <p class="text-xs text-secondary mb-0">{{ $data->email }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{ $data->function }}</p>
                                                    <p class="text-xs text-secondary mb-0">{{ $data->organization }}</p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <span class="badge badge-sm badge-success">{{ $data->technology }}</span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-normal">{{ $data->employed_date }}</span>
                                                </td>
                                                <td class="align-middle">
                                                    <a href="javascript:;" class="text-secondary font-weight-normal text-xs" data-toggle="tooltip" data-original-title="Edit user">Edit</a>
                                                </td>
                                            </tr>
                                            @endforeach --}}
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <footer class="footer pt-3  ">
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

            <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" rel="stylesheet">
            <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>
            <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales-all.min.js"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    var calendarEl = document.getElementById('calendar');

                    if (!calendarEl) {
                        console.error("Calendar element not found.");
                        return;
                    }

                    var calendar = new FullCalendar.Calendar(calendarEl, {
                        initialView: 'dayGridMonth',
                        selectable: true,
                        headerToolbar: {
                            left: 'prev,next today',
                            center: 'title',
                            right: 'timeGridWeek'
                        },
                        events: '{{ route('assign.planing') }}', // Fetch events
                        select: function(info) {
                            $('#eventModal').show();
                            $('#saveEvent').off().on('click', function() {
                                var description = $('#eventDescription').val();
                                var frequency = $('#eventFrequency').val();

                                $.ajax({
                                    url: '/calendar-events',
                                    method: 'POST',
                                    data: {
                                        date: info.startStr,
                                        description: description,
                                        frequency: frequency,
                                        _token: '{{ csrf_token() }}'
                                    },
                                    success: function(response) {
                                        alert('Event saved!');
                                        $('#eventModal').hide();
                                        calendar.refetchEvents();
                                    },
                                    error: function(xhr) {
                                        console.error("Error saving event:", xhr
                                            .responseText);
                                    }
                                });
                            });
                        }
                    });

                    calendar.render();
                });
            </script>
        </footer>
    </div>
    </main>
@endsection
