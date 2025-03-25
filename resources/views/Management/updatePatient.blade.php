@extends('Management.layouts.app')

@php
    // Assuming $patientInfo contains the data structure you provided
    $percentages = json_decode($patientInfo['percentage'], true);
    $sessions_no = json_decode($patientInfo['session_no'], true);
    $doctors_name = json_decode($patientInfo['doctor_name'], true);
    $apps_date = json_decode($patientInfo['app_date'], true);

@endphp

@section('mainContent')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-8">
                @if (Session::has('success'))
                    <h6 class="alert alert-success text-white">{{ Session::get('success') }}</h6>
                @endif
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Next Appointment</p>
                            <button class="btn btn-primary btn-sm ms-auto"> <a href="{{ route('manage.patientsList') }}"
                                    style="color: aliceblue">Back</a></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('UpdatePatient.patient', $patientInfo->id) }}" method="post">
                            @csrf
                            <p class="text-uppercase text-sm">Patient Information</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label ">Patient name</label>
                                        <input class="form-control @error('name') is-invalid @enderror" name="name"
                                            type="text" placeholder="Name" value="{{ $patientInfo->name }}">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Email address
                                            (optional)</label>
                                        <input class="form-control @error('email') is-invalid @enderror" name="email"
                                            type="email" placeholder="name@example.com" value="{{ $patientInfo->email }}">
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Patient Age</label>
                                        <input class="form-control @error('age') is-invalid @enderror" name="age"
                                            type="text" placeholder="90Years" value="{{ $patientInfo->age }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Patient Addres</label>
                                        <input class="form-control @error('address') is-invalid @enderror" name="address"
                                            type="text" placeholder="Enter Address" value="{{ $patientInfo->address }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Appointment Date</label>
                                        <input class="form-control @error('app_date') is-invalid @enderror" name="app_date"
                                            type="datetime-local" value="{{ $patientInfo->app_date }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="example-text-input" class="form-control-label">Session Number</label>
                                    <select class="form-control @error('session_no') is-invalid @enderror"
                                        data-toggle="select" title="Simple select" data-live-search="true"
                                        data-live-search-placeholder="Search ..." name="session_no">
                                        <option disabled selected>Selected a Session</option>
                                        @php
                                            $maxSessionNo = max($sessions_no);
                                        @endphp

                                        @for ($i = 1; $i <= 15; $i++)
                                            <option value="{{ $i }}"
                                                @if (in_array($i, $sessions_no) || $i == $maxSessionNo + 1) selected @endif>
                                                Session {{ $i }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="example-text-input" class="form-control-label">Select A Doctor</label>
                                    <select class="form-control @error('doctor_name') is-invalid @enderror"
                                        data-toggle="select" title="Simple select" data-live-search="true"
                                        data-live-search-placeholder="Search ..." name="doctor_name">
                                        <option disabled selected>Doctor Name</option>
                                        @foreach ($doctors as $doctor)
                                            <option value=" {{ $doctor->name }}">{{ $doctor->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="percentageexample-text-input" class="form-control-label ">Relif in
                                            Percentage</label>
                                        <input class="form-control @error('percentage') is-invalid @enderror"
                                            name="percentage" type="text" placeholder="Enter Percentage">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label ">Description</label>
                                        <input class="form-control @error('description') is-invalid @enderror"
                                            name="description" type="text" placeholder="Comment From Patient">
                                    </div>
                                </div>
                            </div>

                            <hr class="horizontal dark">
                            <p class="text-uppercase text-sm">Contact Information</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Contact</label>
                                        <input class="form-control @error('contact') is-invalid @enderror" name="contact"
                                            max="10" min="10" type="text" placeholder="91+"
                                            value="{{ $patientInfo->contact }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="example-text-input" class="form-control-label">Staus</label>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" name="status" id="active"
                                            value="Active" {{ $patientInfo->status == 'Active' ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="status">Clicked</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" name="status" id="Ofline"
                                            value="Offline" {{ $patientInfo->status == 'Offline' ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="status">Pending</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" name="status" id="Refund"
                                            value="Refund" {{ $patientInfo->status == 'Refund' ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="status">Refund</label>
                                    </div>

                                    @error('status')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success btn-sm ms-auto">Submit</button>
                        </form>
                    </div>
                </div>


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
                                                    Doctor</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                                    Last Appointment</th>
                                                <th
                                                    class="text-uppercase text-secondary text-xxs font-weight-bolder text-center opacity-7 ps-2">
                                                    Relief</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sessions_no as $index => $session_no)
                                                <tr>
                                                    <td>
                                                        <div class="d-flex px-2">
                                                            <div>
                                                                {{-- <img src="../assets/img/small-logos/logo-spotify.svg"
                                                      class="avatar avatar-sm rounded-circle me-2"
                                                            alt="spotify"> --}}
                                                            </div>
                                                            <div class="my-auto">
                                                                <h6 class="mb-0 text-sm">Session {{ $session_no }}</h6>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="">
                                                        {{-- Displaying doctor names --}}
                                                        <p class="text-sm font-weight-bold mb-0">
                                                            {{ isset($doctors_name[$index]) ? $doctors_name[$index] : '' }}
                                                        </p>
                                                    </td>
                                                    <td>
                                                        {{-- Displaying appointment dates --}}
                                                        <span class="text-xs font-weight-bold">
                                                            {{ isset($apps_date[$index]) ? $apps_date[$index] : '' }}
                                                        </span>
                                                    </td>
                                                    <td class="align-middle text-center">
                                                        {{-- Displaying percentages --}}
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
                                                     {{ $percentage <= 25 ? 'bg-gradient-danger' : ($percentage >= 60 ? 'bg-gradient-success' : 'bg-gradient-info') }}"
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
                                                    <td class="align-middle">
                                                        <button class="btn btn-link text-secondary mb-0">
                                                            <i class="fa fa-ellipsis-v text-xs"></i>
                                                        </button>
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
            </div>


            <div class="col-md-4">
                <div class="card card-profile">
                    <img src="{{ asset('management/assets/img/curved-images/curved11-small.jpg') }}"
                        alt="Image placeholder" class="card-img-top">
                    <div class="row justify-content-center">
                        <div class="col-4 col-lg-4 order-lg-2">
                            <div class="mt-n4 mt-lg-n6 mb-4 mb-lg-0">
                                <a href="javascript:;">
                                    <img src="{{ asset($patientInfo->image) }}"
                                        class="rounded-circle img-fluid border border-2 border-white">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="card-header text-center border-0 pt-0 pt-lg-2 pb-4 pb-lg-3">
                        <div class="d-flex justify-content-between">
                            <a href="javascript:;" class="btn btn-sm btn-info mb-0 d-none d-lg-block">Connect</a>
                            <a href="javascript:;" class="btn btn-sm btn-info mb-0 d-block d-lg-none"><i
                                    class="ni ni-collection"></i></a>
                            <a href="javascript:;"
                                class="btn btn-sm btn-dark float-right mb-0 d-none d-lg-block">Message</a>
                            <a href="javascript:;" class="btn btn-sm btn-dark float-right mb-0 d-block d-lg-none"><i
                                    class="ni ni-email-83"></i></a>
                        </div>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col">
                                <div class="d-flex justify-content-center">
                                    <div class="d-grid text-center">
                                        <span class="text-lg font-weight-bolder">0</span>
                                        <span class="text-sm opacity-8">Patient's</span>
                                    </div>
                                    <div class="d-grid text-center mx-4">
                                        <span class="text-lg font-weight-bolder">0</span>
                                        <span class="text-sm opacity-8">visits</span>
                                    </div>
                                    <div class="d-grid text-center">
                                        <span class="text-lg font-weight-bolder">0</span>
                                        <span class="text-sm opacity-8">Clicked</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center mt-4">
                            <h5>
                                PHYSIOTHERAPIST<span class="font-weight-light"></span>
                            </h5>

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
                            <a href="{{ route('indexone') }}" class="font-weight-bold" target="_blank">Cardio Rescue
                                Team</a>
                            for a better web.
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com" class="nav-link text-muted"
                                    target="_blank">Creative Tim</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/presentation" class="nav-link text-muted"
                                    target="_blank">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/blog" class="nav-link text-muted"
                                    target="_blank">Blog</a>
                            </li>
                            <li class="nav-item">
                                <a href="https://www.creative-tim.com/license" class="nav-link pe-0 text-muted"
                                    target="_blank">License</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
@endsection
