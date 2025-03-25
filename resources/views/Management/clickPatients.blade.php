@extends('Management.layouts.app')

@section('mainContent')
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center flex-wrap">
                        <h6 class="mb-0">
                            <a href="{{ route('manage.dashboard') }}" class="opacity-9 text-primary">BACK</a>
                        </h6>
                        <div class="d-flex align-items-center flex-wrap">
                            <form action="{{ route('manage.SearchPatients') }}" method="get"
                                class="d-flex align-items-center flex-wrap">
                                <input type="text" class="form-control me-2 mb-2 mb-sm-0" name="searchKey"
                                    placeholder="Search..." style="width: 200px;">
                                <button class="btn btn-primary me-2 mb-2 mb-sm-0" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                                <a href="{{ route('manage.ClickPatients') }}" class="mb-2 mb-sm-0">
                                    <button class="btn btn-secondary mt-3" type="button">
                                        Clear
                                    </button>
                                </a>
                            </form>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Patient Name</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Last Session No.</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Last Session Doctor</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Relif</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            diagnosis</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Last App Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($patient_lists) && $patient_lists->count())
                                        @foreach ($patient_lists as $patient_list)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">
                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $patient_list->name }}</h6>
                                                            <p class="text-xs text-secondary mb-0">
                                                                CR0000{{ $patient_list->patients_id }}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    @php
                                                        $sessionNums = json_decode($patient_list->session_num);
                                                        $lastSessionNum = !empty($sessionNums)
                                                            ? end($sessionNums)
                                                            : 'No sessions available';
                                                    @endphp
                                                    <p class="text-xs font-weight-bold mb-0">{{ $lastSessionNum == 0 ? 'Assessment' : $lastSessionNum }}</p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    @php
                                                        $sessionNums = json_decode($patient_list->dr_name);
                                                        $lastSessionNum = !empty($sessionNums)
                                                            ? end($sessionNums)
                                                            : 'No sessions available';
                                                    @endphp
                                                    <p class="text-xs font-weight-bold mb-0">{{ $lastSessionNum }}</p>
                                                </td>
                                                <td class="align-middle">
                                                    @php
                                                        $sessionNums = json_decode($patient_list->percentage);
                                                        $percentage = !empty($sessionNums)
                                                            ? end($sessionNums)
                                                            : 'Assessment';
                                                    @endphp
                                                    @if ($percentage == '0')
                                                        <p class="text-sm font-weight-bold mb-0">Assessment</p>
                                                    @else
                                                        <span
                                                            class="me-2 text-xs font-weight-bold">{{ $percentage }}%</span>
                                                        <div>
                                                            <div class="progress">
                                                                <div class="progress-bar {{ $percentage <= 30 ? 'bg-gradient-danger' : ($percentage >= 60 ? 'bg-gradient-success' : 'bg-gradient-info') }}"
                                                                    role="progressbar" aria-valuenow="{{ $percentage }}"
                                                                    aria-valuemin="0" aria-valuemax="100"
                                                                    style="width: {{ $percentage }}%;">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </td>
                                                <td class="align-middle text-center">
                                                    @php
                                                        $sessionNums = json_decode($patient_list->diagnosis);
                                                        $lastSessionNum = !empty($sessionNums)
                                                            ? end($sessionNums)
                                                            : 'No Data available';
                                                    @endphp
                                                    <span class="text-secondary text-xs font-weight-bold">
                                                        @if (!empty($lastSessionNum))
                                                            {{ $lastSessionNum }}
                                                        @else
                                                            No Record Found
                                                        @endif
                                                    </span>
                                                </td>
                                                 <td class="align-middle text-center">
                                                    @php
                                                        $sessionNums = json_decode($patient_list->app_date);
                                                        $lastSessionNum = !empty($sessionNums)
                                                            ? end($sessionNums)
                                                            : $sessionNums;
                                                    @endphp
                                                    <span class="text-secondary text-xs font-weight-bold">
                                                        @if (!empty($lastSessionNum))
                                                            {{ \Carbon\Carbon::parse($lastSessionNum)->format('d M Y, h:i A') }}
                                                        @else
                                                            No Data available
                                                        @endif
                                                    </span>
                                                </td>
                                                <td class="align-middle">
                                                    <a href="{{ route('manage.view-pdf', $patient_list->id) }}">
                                                        <span class="text-primary text-xs font-weight-bold">View</span>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7"
                                                style="text-align: center; padding: 10px; font-weight: bold;">No patient
                                                records found</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="m-1"> {{ $patient_lists->links() }}</div>
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
        </footer>
    </div>
    </main>
@endsection
