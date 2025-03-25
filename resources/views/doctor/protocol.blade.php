<!--
=========================================================
* Argon Dashboard 2 - v2.0.4
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
@php

    if (!empty($result)) {
        $percentages = json_decode($result['percentage'], true);
        $session_num = json_decode($result['session_num'], true);
        $dr_name = json_decode($result['dr_name'], true);
        $diagnosis = json_decode($result['diagnosis'], true);
        $app_date = json_decode($result['diagnosis'], true);
    }
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
    <link rel="icon" type="image/x-icon" href="{{ asset('index_assets/images/cardio-rescue-logo.webp') }}">
    <title>
        Protocol
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('management/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('management/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('management/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link id="pagestyle" href="{{ asset('management/assets/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />
</head>

<body class="g-sidenav-show bg-gray-100">
    <div class="position-absolute w-100 min-height-300 top-0"
        style="background-image: url('https://raw.githubusercontent.com/creativetimofficial/public-assets/master/argon-dashboard-pro/assets/img/profile-layout-header.jpg'); background-position-y: 50%;">
        <span class="mask bg-primary opacity-6"></span>
    </div>

    <div class="main-content position-relative max-height-vh-100 h-100">
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur"
            data-scroll="false">
            <div class="container-fluid py-1 px-3">
                <form action="{{ route('protocol.search') }}" method="get">
                    @csrf
                    <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                            <div class="input-group">
                                <input type="text" class="form-control" name="keyword" placeholder="Search Here...">
                            </div>
                        </div>
                        <button class="btn btn-icon btn-primary mt-3" type="submit">
                            <span class="btn-inner--icon"><i class="fas fa-search"></i></span>
                        </button>
                    </div>
                </form>
            </div>

            @if (session('success'))
                <div class="alert alert-success" role="alert">
                    <strong>Success!</strong> {{ session('success') }}

                </div>
            @endif
        </nav>
        <div class="card shadow-lg mx-4 card-profile-bottom">
            <div class="card-body p-3">
                <div class="row gx-4">
                    <div class="col-auto">
                        <div class="avatar avatar-xl position-relative">
                            @if (!empty($result))
                                <img src="{{ asset($result->image) }}" alt="profile_image"
                                    class="w-100 border-radius-lg shadow-sm">
                            @else
                                <img src="{{ asset('management/assets/img/blankpro.webp') }}" alt="profile_image"
                                    class="w-100 border-radius-lg shadow-sm">
                            @endif
                        </div>

                    </div>
                    <div class="col-auto my-auto">
                        <div class="h-100">
                            <h5 class="mb-1">
                                @if (!empty($result))
                                    {{ $result->name }}
                                @else
                                    <span style="color: red">Record Not Found</span>
                                @endif
                            </h5>
                            <p class="mb-0 font-weight-bold text-sm">
                                @if (!empty($register))
                                    {{ $register->email }}
                                @else
                                    <p>Example@test.com</p>
                                @endif
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid py-4">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        {{-- <div class="card-header pb-0">
                            <div class="d-flex align-items-center">
                                <p class="mb-0">Edit Profile</p>
                                <button class="btn btn-primary btn-sm ms-auto">Settings</button>
                            </div>
                        </div> --}}
                        <div class="card-body">
                            <form action="{{ route('protocol.store') }}" method="post">
                                @csrf
                                <p class="text-uppercase text-sm">Patient Protocol</p>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Username</label>
                                            @if (!empty($result))
                                                <input class="form-control @error('name') is-invalid @enderror"
                                                    value="{{ $result->name }}" readonly type="text"
                                                    placeholder="Patient's Name" name="name">
                                                @error('name')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            @else
                                                <input class="form-control" type="text" placeholder="Patient's Name"
                                                    readonly>
                                            @endif

                                            @if (!empty($result))
                                                <input type="hidden" class="form-control" id="patients_id"
                                                    name="patients_id" placeholder="Output Here..."
                                                    value="{{ $result->id }}">
                                            @else
                                                <input type="hidden" class="form-control" id="patients_id"
                                                    name="patients_id" placeholder="Output Here...">
                                            @endif


                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Age</label>
                                            @if (!empty($result))
                                                <input class="form-control" name="age" type="text"
                                                    value="{{ $result->age }}" placeholder="89Years" readonly>
                                            @else
                                                <input class="form-control" name="age" type="text"
                                                    placeholder="89Years" readonly>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Select A
                                                Doctor</label>
                                            <input class="form-control" name="doctor_name" type="text"
                                                value="Dr. {{ auth()->user()->name }}" placeholder="Dr. Name"
                                                readonly>

                                            {{-- <select class="form-control @error('doctor_name') is-invalid @enderror"
                                                data-toggle="select" title="Simple select" data-live-search="true"
                                                data-live-search-placeholder="Search ..." name="doctor_name">
                                                <option disabled selected>Doctor Name</option>
                                                @foreach ($doctors as $doctor)
                                                    <option value="{{ $doctor->name }}">{{ $doctor->name }}</option>
                                                @endforeach
                                            </select>
                                            @error('doctor_name')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror --}}
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="example-text-input" class="form-control-label">Gender</label>
                                        @if (!empty($result))
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" name="gender"
                                                    id="male" {{ $result->gender == 'Male' ? 'checked' : '' }}>

                                                <label class="custom-control-label" for="gender">Male</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" name="gender"
                                                    id="Female" {{ $result->gender == 'Female' ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="gender">Female</label>
                                            </div>
                                        @else
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" name="gender"
                                                    id="male">

                                                <label class="custom-control-label" for="gender">Male</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input type="radio" class="custom-control-input" name="gender"
                                                    id="Female">
                                                <label class="custom-control-label" for="gender">Female</label>
                                            </div>
                                        @endif

                                    </div>
                                   <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Apointment Date & Time</label>
                                            <input class="form-control @error('app_date') is-invalid @enderror" name="app_date" type="datetime-local">
                                            @error('app_date')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea1">Diagnosis</label>
                                            <textarea class="form-control @error('diagnosis') is-invalid @enderror" name="diagnosis"
                                                id="exampleFormControlTextarea1" rows="3" placeholder="Write Here"></textarea>
                                            @error('diagnosis')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                                <hr class="horizontal dark">
                                <p class="text-uppercase text-sm">Contact Information</p>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            @if (!empty($register))
                                                <label for="example-text-input" class="form-control-label">Address in
                                                    Description</label>
                                                <input class="form-control" type="text"
                                                    placeholder="Bld Mihail Kogalniceanu, nr. 8 Bl 1, Sc 1, Ap 09"
                                                    name="address" value="{{ $register->address }}" readonly>
                                            @else
                                                <label for="example-text-input" class="form-control-label">Address in
                                                    Description</label>
                                                <input class="form-control" type="text"
                                                    placeholder="Bld Mihail Kogalniceanu, nr. 8 Bl 1, Sc 1, Ap 09"
                                                    name="address" readonly>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="example-text-input" class="form-control-label">Session
                                            Number</label>
                                        <select class="form-control @error('session_no') is-invalid @enderror"
                                            data-toggle="select" title="Simple select" data-live-search="true"
                                            data-live-search-placeholder="Search ..." name="session_no">
                                            <option disabled selected>Selected a Session</option>
                                              @for ($i = 1 ; $i <= 60 ;$i++)
                                           <option value="{{$i}}">Session {{$i}}</option>

                                              @endfor
                                        </select>
                                        @error('session_no')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="example-text-input"
                                                class="form-control-label">Percentage</label>
                                            <input class="form-control @error('percentage') is-invalid @enderror"
                                                name="percentage" type="text" placeholder="Example 50">
                                            @error('percentage')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>

                                    </div>
                                    <div class="col-md-6">
                                        <button class="btn btn-icon btn-primary" type="submit">
                                            <span class="btn-inner--icon"><i class="ni ni-send"></i></span>
                                            <span class="btn-inner--text">Submit</span>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            @if (!empty($result))

                <div class="row mt-2">
                    <div class="col-12">
                        <div class="card mb-4">
                            <div class="card-header pb-0">
                                <h6>PAST HISTORY</h6>
                            </div>
                            <div class="card-body px-0 pt-0 pb-2">
                                <div class="table-responsive p-0">
                                    <table class="table align-items-center justify-content-center mb-0">
                                        <thead>
                                            <tr>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                                    Session Done</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Diagnosis</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Doctor</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                                    Relief</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($session_num as $index => $session_no)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2">
                                                            <div class="my-auto">
                                                                <h6 class="mb-0 text-sm">Session {{ $session_no }}
                                                                </h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="">
                                                        <span class="text-xs font-weight-bold">
                                                            {{ isset($diagnosis[$index]) ? $diagnosis[$index] : '' }}
                                                        </span>
                                                    </td>
                                                    <td>

                                                        <span class="text-xs font-weight-bold">
                                                            {{ isset($dr_name[$index]) ? $dr_name[$index] : '' }}
                                                        </span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        <div class="d-flex align-items-center justify-content-center">
                                                            @php
                                                                $percentage = isset($percentages[$index])
                                                                    ? $percentages[$index]
                                                                    : '0';
                                                            @endphp
                                                            @if ($percentage == '0')
                                                                <p class="text-sm font-weight-bold mb-0">
                                                                    Assessment
                                                                </p>
                                                            @else
                                                                <span
                                                                    class="me-2 text-xs font-weight-bold">{{ $percentage }}%</span>
                                                                <div>
                                                                    <div class="progress">
                                                                        <div class="progress-bar
                                                 {{ $percentage <= 30 ? 'bg-gradient-danger' : ($percentage >= 60 ? 'bg-gradient-success' : 'bg-gradient-info') }}"
                                                                            role="progressbar"
                                                                            aria-valuenow="{{ $percentage }}"
                                                                            aria-valuemin="0" aria-valuemax="100"
                                                                            style="width: {{ $percentage }}%;">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif


        </div>


        <div class="fixed-plugin">
            <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
                <i class="fa fa-cog py-2"> </i>
            </a>
            <div class="card shadow-lg">
                <div class="card-header pb-0 pt-3 ">
                    <div class="float-start">
                        <h5 class="mt-3 mb-0">Argon Configurator</h5>
                        <p>See our dashboard options.</p>
                    </div>
                    <div class="float-end mt-4">
                        <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                            <i class="fa fa-close"></i>
                        </button>
                    </div>
                    <!-- End Toggle Button -->
                </div>
                <hr class="horizontal dark my-1">
                <div class="card-body pt-sm-3 pt-0 overflow-auto">
                    <!-- Sidebar Backgrounds -->
                    <div>
                        <h6 class="mb-0">Sidebar Colors</h6>
                    </div>
                    <a href="javascript:void(0)" class="switch-trigger background-color">
                        <div class="badge-colors my-2 text-start">
                            <span class="badge filter bg-gradient-primary active" data-color="primary"
                                onclick="sidebarColor(this)"></span>
                            <span class="badge filter bg-gradient-dark" data-color="dark"
                                onclick="sidebarColor(this)"></span>
                            <span class="badge filter bg-gradient-info" data-color="info"
                                onclick="sidebarColor(this)"></span>
                            <span class="badge filter bg-gradient-success" data-color="success"
                                onclick="sidebarColor(this)"></span>
                            <span class="badge filter bg-gradient-warning" data-color="warning"
                                onclick="sidebarColor(this)"></span>
                            <span class="badge filter bg-gradient-danger" data-color="danger"
                                onclick="sidebarColor(this)"></span>
                        </div>
                    </a>
                    <!-- Sidenav Type -->
                    <div class="mt-3">
                        <h6 class="mb-0">Sidenav Type</h6>
                        <p class="text-sm">Choose between 2 different sidenav types.</p>
                    </div>
                    <div class="d-flex">
                        <button class="btn bg-gradient-primary w-100 px-3 mb-2 active me-2" data-class="bg-white"
                            onclick="sidebarType(this)">White</button>
                        <button class="btn bg-gradient-primary w-100 px-3 mb-2" data-class="bg-default"
                            onclick="sidebarType(this)">Dark</button>
                    </div>
                    <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
                    <!-- Navbar Fixed -->
                    <hr class="horizontal dark my-sm-4">
                    <div class="mt-2 mb-5 d-flex">
                        <h6 class="mb-0">Light / Dark</h6>
                        <div class="form-check form-switch ps-0 ms-auto my-auto">
                            <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version"
                                onclick="darkMode(this)">
                        </div>
                    </div>
                    <a class="btn bg-gradient-dark w-100"
                        href="https://www.creative-tim.com/product/argon-dashboard">Free
                        Download</a>
                    <a class="btn btn-outline-dark w-100"
                        href="https://www.creative-tim.com/learning-lab/bootstrap/license/argon-dashboard">View
                        documentation</a>
                    <div class="w-100 text-center">
                        <a class="github-button" href="https://github.com/creativetimofficial/argon-dashboard"
                            data-icon="octicon-star" data-size="large" data-show-count="true"
                            aria-label="Star creativetimofficial/argon-dashboard on GitHub">Star</a>
                        <h6 class="mt-3">Thank you for sharing!</h6>
                        <a href="https://twitter.com/intent/tweet?text=Check%20Argon%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fargon-dashboard"
                            class="btn btn-dark mb-0 me-2" target="_blank">
                            <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
                        </a>
                        <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/argon-dashboard"
                            class="btn btn-dark mb-0 me-2" target="_blank">
                            <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!--   Core JS Files   -->
        <script src="../assets/js/core/popper.min.js"></script>
        <script src="../assets/js/core/bootstrap.min.js"></script>
        <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
        <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
        <script>
            var win = navigator.platform.indexOf('Win') > -1;
            if (win && document.querySelector('#sidenav-scrollbar')) {
                var options = {
                    damping: '0.5'
                }
                Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
            }
        </script>
        <!-- Github buttons -->
        <script async defer src="https://buttons.github.io/buttons.js"></script>
        <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
        <script src="../assets/js/argon-dashboard.min.js?v=2.0.4"></script>


</body>

</html>
