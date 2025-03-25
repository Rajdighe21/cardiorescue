@php
    $decode = json_decode($data->data);
@endphp

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge, chrome=1" />
    <link rel="icon" type="image/x-icon" href="{{ asset('index_assets/images/cardio-rescue-logo.webp') }}">
    <title>
        Doctor | consultation
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('management/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('management/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('management/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('management/assets/css/argon-dashboard.css?v=2.0.4') }}" rel="stylesheet" />
</head>

<body class="g-sidenav-show   bg-gray-100">
    <div class="min-height-300  position-absolute w-100" style="background-color: rgb(5, 64, 99) !important"></div>

    <main class="main-content position-relative border-radius-lg">
        <!-- Navbar -->
        <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur"
            data-scroll="false">
            <div class="container-fluid py-1 px-3">
                <nav aria-label="breadcrumb">
                    <h5 class="font-weight-bolder text-white mb-0">Dr. {{ strtoupper(auth()->user()->name) }}</h5>
                </nav>
                <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                        <ul class="navbar-nav  justify-content-end">
                            <li class="nav-item d-flex align-items-center">
                                <a href="{{ route('doctor.logout') }}"
                                    class="nav-link text-white font-weight-bold px-0">
                                    <i class="fa fa-sign-out me-sm-1"></i>
                                    <span class="d-sm-inline d-none">Sign Out</span>
                                </a>
                            </li>

                            <li class="nav-item px-3 d-flex align-items-center">

                            </li>

                        </ul>
                    </div>

                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="container-fluid py-4">
            @if (Session::has('success'))
                <h6 class="alert alert-success text-white m-4">{{ Session::get('success') }}</h6>
            @endif
            <div class="row">
            </div>
            <div class="row mt-4">
                <div class="col-lg-12 mb-lg-0 mb-4">
                    <div class="card">
                        <div class="card-header pb-0 p-3">
                            <div class="d-flex justify-content-between">
                                <h6 class="mb-2">Appointment For</h6>
                               <a href="{{route('doctor.dashboard')}}"><button type="submit" class="btn btn-primary mt-2">Back</button></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">

                                    <form action="{{ route('doctor.startSession') }}" method="post">
                                        @csrf
                                        <label for="session_start" class="form-label">Session Start</label>
                                        <input type="text" class="form-control shadow-sm" id="session_start"
                                            name="session_start" readonly
                                            value="{{ $sessionStart ? $sessionStart->session_start : '' }}">

                                        <input type="hidden" id="patient_id" name="patient_id"
                                            value="{{ $decode->patient_id }}" readonly>

                                        @if (empty($sessionStart->session_start))
                                            <button type="submit" class="btn btn-primary mt-2"
                                                id="startSessionButton">Start
                                                Session</button>
                                        @endif
                                    </form>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <form action="{{ route('doctor.endSession') }}" method="post">
                                        @csrf
                                        <label for="session_end" class="form-label">Session End</label>
                                        <input type="text" class="form-control shadow-sm" id="session_end"
                                            name="session_end"
                                            value="{{ $sessionStart ? $sessionStart->session_end : '' }}" readonly>
                                        <input type="hidden" id="patient_id" name="patient_id"
                                            value="{{ $decode->patient_id }}" readonly>
                                        @if (empty($sessionStart->session_end))
                                            <button type="submit" class="btn btn-danger mt-2" id="endSessionButton">End
                                                Session</button>
                                        @endif

                                    </form>
                                </div>
                            </div>
                            <form action="{{ route('doctor.storeConsultation') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input type="text" class="form-control shadow-sm" id="name"
                                            name="name" placeholder="Enter patient name"
                                            value="{{ $decode->name }}" readonly>

                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="patient_id" class="form-label">Patient ID</label>
                                        <input type="number" class="form-control shadow-sm" id="patient_id"
                                            name="patient_id" value="{{ $decode->patient_id }}" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="diagnosis" class="form-label">Diagnosis</label>
                                        <textarea class="form-control shadow-sm" id="diagnosis" name="diagnosis" rows="3"
                                            placeholder="Enter diagnosis details" required></textarea>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="percentage" class="form-label">Percentage</label>
                                        <input type="text" class="form-control shadow-sm" id="percentage"
                                            name="percentage" placeholder="Enter percentage" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="treatment_protocol" class="form-label">Treatment Protocol</label>
                                        <textarea class="form-control shadow-sm" id="treatment_protocol" name="treatment_protocol" rows="3"
                                            placeholder="Enter treatment protocol" required></textarea>
                                    </div>
                                        <div class="col-md-6 mb-3">
                                        <label for="after_treatment_protocol" class="form-label">After Treatment Protocol</label>
                                        <textarea class="form-control shadow-sm" id="after_treatment_protocol" name="after_treatment_protocol" rows="3"
                                            placeholder="Enter treatment protocol" required></textarea>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="prevideo" class="form-label">Pre-Session Video</label>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="prevideo"
                                                name="prevideo" value="Available">
                                            <label class="form-check-label" for="prevideo">Available</label>
                                        </div>

                                        <label for="postvideo" class="form-label">Post-Session Video</label>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="postvideo"
                                                name="postvideo" value="Available">
                                            <label class="form-check-label" for="postvideo">Available</label>
                                        </div>
                                    </div>
                                </div>
                                @if (!empty($sessionStart->session_end) && !empty($sessionStart->session_start))
                                <button type="submit" class="btn btn-primary shadow-sm mt-3">Submit</button>
                                @endif
                            </form>
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
                                    <a href="https://www.cardiorescue.in" class="font-weight-bold"
                                        target="_blank">Cardio Rescue Team</a>

                                </div>
                            </div>

                        </div>
                    </div>
                </footer>
            </div>
    </main>

    <script>
        document.getElementById('startSessionButton').addEventListener('click', function() {
            const now = new Date();
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const day = String(now.getDate()).padStart(2, '0');
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const formattedDateTime = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
            document.getElementById('session_start').value = formattedDateTime;
        });
    </script>

    <script>
        document.getElementById('endSessionButton').addEventListener('click', function() {
            const now = new Date();
            const year = now.getFullYear();
            const month = String(now.getMonth() + 1).padStart(2, '0');
            const day = String(now.getDate()).padStart(2, '0');
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            const formattedDateTime = `${year}-${month}-${day} ${hours}:${minutes}:${seconds}`;
            document.getElementById('session_end').value = formattedDateTime;
        });
    </script>
</body>

</html>
