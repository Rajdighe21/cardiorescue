@extends('Management.layouts.app')

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
                            <p class="mb-0">Add Patient</p>
                            <button class="btn btn-primary btn-sm ms-auto"> <a href="{{ route('manage.patientsList') }}"
                                    style="color: aliceblue">Back</a></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('store.patient') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <p class="text-uppercase text-sm">Patient Information</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label ">Patient name</label>
                                        <input class="form-control @error('name') is-invalid @enderror" name="name"
                                            type="text" placeholder="Name">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Email address
                                            (optional)</label>
                                        <input class="form-control @error('email') is-invalid @enderror" name="email"
                                            type="email" placeholder="name@example.com">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Patient Image</label>
                                        <input class="form-control required @error('image') is-invalid @enderror"
                                            name="image" type="file" placeholder="Enter Password" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Patient Age</label>
                                        <input class="form-control @error('age') is-invalid @enderror" name="age"
                                            type="text" placeholder="90Years">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Patient Addres</label>
                                        <input class="form-control @error('address') is-invalid @enderror" name="address"
                                            type="text" placeholder="Enter Address">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Appointment Date</label>
                                        <input class="form-control @error('app_date') is-invalid @enderror"
                                            name="app_date[]" type="datetime-local">


                                        {{-- Range --}}
                                        <input name="percentage[]" type="hidden" value="0">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="example-text-input" class="form-control-label">Session Number</label>
                                    <select class="form-control @error('session_no') is-invalid @enderror"
                                        data-toggle="select" title="Simple select" data-live-search="true"
                                        data-live-search-placeholder="Search ..." name="session_no[]">
                                        <option disabled selected>Selected a Session</option>
                                        <option value="1">Session 1</option>
                                        <option value="2">Session 2</option>
                                        <option value="3">Session 3</option>
                                        <option value="4">Session 4</option>
                                        <option value="5">Session 5</option>
                                        <option value="6">Session 6</option>
                                        <option value="7">Session 7</option>
                                        <option value="8">Session 8</option>
                                        <option value="9">Session 9</option>
                                        <option value="10">Session 10</option>
                                        <option value="11">Session 11</option>
                                        <option value="12">Session 12</option>
                                        <option value="13">Session 13</option>
                                        <option value="14">Session 14</option>
                                        <option value="15">Session 15</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="example-text-input" class="form-control-label">Select A Doctor</label>
                                    <select class="form-control @error('doctor_name') is-invalid @enderror"
                                        data-toggle="select" title="Simple select" data-live-search="true"
                                        data-live-search-placeholder="Search ..." name="doctor_name[]">
                                        <option disabled selected>Doctor Name</option>
                                        @foreach ($doctors as $doctor)
                                            <option>{{ $doctor->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <hr class="horizontal dark">
                            <p class="text-uppercase text-sm">Contact Information</p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Contact</label>
                                        <input class="form-control @error('contact') is-invalid @enderror" name="contact"
                                            max="10" min="10" type="text" placeholder="91+">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="example-text-input" class="form-control-label">Staus</label>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="status"
                                            id="active" value="Active">
                                        <label class="custom-control-label" for="status">Clicked</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="status"
                                            id="Ofline" value="Offline">
                                        <label class="custom-control-label" for="status">Pending</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="status"
                                            id="Refund" value="Refund">
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
            </div>
            <div class="col-md-4">
                <div class="card card-profile">
                    <img src="{{ asset('management/assets/img/curved-images/curved11-small.jpg') }}"
                        alt="Image placeholder" class="card-img-top">
                    <div class="row justify-content-center">
                        <div class="col-4 col-lg-4 order-lg-2">
                            <div class="mt-n4 mt-lg-n6 mb-4 mb-lg-0">
                                <a href="javascript:;">
                                    <img src="{{ asset('management/assets/img/blankpro.webp') }}"
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
