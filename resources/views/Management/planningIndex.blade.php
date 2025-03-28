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
                                                        <a href="{{ route('assign.planing', $patient->id) }}"
                                                            class="btn btn-sm btn-primary p-2">
                                                            Assign Session
                                                        </a>
                                                    </td>
                                                </tr>
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
                    <div class="card-body px-4 pt-4 pb-2">
                        @php
                            $currentYear = now()->year;
                            $currentMonth = now()->format('F');
                        @endphp

                        <div class="d-flex justify-content-start mb-3">
                            <select id="filterYear" class="form-control me-3" style="width: 200px;">
                                <option value="">Select Year</option>
                                @foreach ($years as $year)
                                    <option value="{{ $year }}" {{ $year == $currentYear ? 'selected' : '' }}>
                                        {{ $year }}
                                    </option>
                                @endforeach
                            </select>

                            <select id="filterMonth" class="form-control" style="width: 200px;">
                                <option value="">Select Month</option>
                                @foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                                    <option value="{{ $month }}" {{ $month == $currentMonth ? 'selected' : '' }}>
                                        {{ $month }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="table-responsive p-0">
                            <div class="card">
                                <div class="table-responsive">
                                    <table class="table align-items-center mb-0 text-center">
                                        <thead>
                                            <tr>
                                                @foreach (['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'] as $day)
                                                    <th
                                                        class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                        {{ $day }}
                                                    </th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody id="weekPlantable">
                                            @foreach ($WeekSessions as $session)
                                                <tr>
                                                    @foreach (['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'] as $day)
                                                        <td>
                                                            @if ($session->day == $day)
                                                                <div class="d-flex flex-column align-items-center">
                                                                    <h6 class="mb-0 text-xs">
                                                                        {{ $session->patient ? $session->patient->patient_name : 'Unknown' }}
                                                                    </h6>
                                                                    <p class="text-xs text-secondary mb-0">
                                                                        {{ $session->date }}</p>
                                                                </div>
                                                            @else
                                                                <h6 class="mb-0 text-xs">-</h6>
                                                            @endif
                                                        </td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    </main>
@endsection


@section('scriptsCustom')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            function filterSessions() {
                let year = $("#filterYear").val();
                let month = $("#filterMonth").val();

                $.ajax({
                    url: "{{ route('filter.planning') }}", // Laravel route
                    type: "GET",
                    data: {
                        year: year,
                        month: month
                    },
                    success: function(response) {
                        $("#weekPlantable").html(response); // Replace table body with new data
                    },
                    error: function() {
                        alert("Error fetching data.");
                    }
                });
            }

            // Trigger AJAX when the user selects year or month
            $("#filterYear, #filterMonth").change(function() {
                filterSessions();
            });

            // Load data by default on page load
            filterSessions();
        });
    </script>
@endsection
