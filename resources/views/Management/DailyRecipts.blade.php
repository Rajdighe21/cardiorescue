@extends('Management.layouts.app')

@section('mainContent')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
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
                        <form action="{{ route('dailyRecipts.store') }}" method="post">
                            @csrf
                            <h5 class="text-uppercase text-lg">CR0000{{ $patients->id }}</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label ">Patient name</label>
                                        <input class="form-control @error('name') is-invalid @enderror" name="name"
                                            type="text" placeholder="Name" value="{{ $patients->patient_name }}"
                                            readonly>

                                        <input class="form-control" name="patient_id" type="hidden" placeholder="Name"
                                            value="{{ $patients->id }}">
                                        <input class="form-control" name="authname[]" type="hidden" placeholder="Name"
                                            value="{{ auth()->user()->name }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Email address
                                            (optional)</label>
                                        <input class="form-control @error('email') is-invalid @enderror" name="email"
                                            type="email" placeholder="name@example.com" value="{{ $patients->email }}"
                                            readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label ">Age</label>
                                        <input class="form-control @error('age') is-invalid @enderror" name="age"
                                            type="text" placeholder="XY Years" value="{{ $patients->date_of_birth }}"
                                            readonly>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Contact</label>
                                        <input class="form-control @error('contact') is-invalid @enderror" name="contact"
                                            max="10" min="10" type="text" value="{{ $patients->contact }}"
                                            placeholder="91+" readonly>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Get Payment</label>
                                        <input class="form-control @error('payment_amt') is-invalid @enderror"
                                            name="payment_amt" placeholder="Amt IN INR">
                                    </div>
                                </div>


                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Due Payment</label>
                                        <input class="form-control @error('due_payment') is-invalid @enderror"
                                            name="due_payment" placeholder="Amt IN INR">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Registration
                                            Date</label>
                                        <input class="form-control @error('regi_date') is-invalid @enderror"
                                            name="regi_date" type="datetime-local">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label for="example-text-input" class="form-control-label">Select a Gender</label>
                                    <div class="btn-group-toggle" data-toggle="buttons">
                                        <label class="btn ">
                                            <input type="radio" name="gender" value="Male" id="option1"
                                                autocomplete="off" {{ $patients->gender == 'Male' ? 'checked' : ' ' }}>
                                            Male
                                        </label>
                                        <label class="btn ">
                                            <input type="radio" name="gender" value="Female" id="option2"
                                                autocomplete="off" {{ $patients->gender == 'Female' ? 'checked' : ' ' }}>
                                            Female
                                        </label>

                                    </div>
                                    @error('gender')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="describe_problem">Describe a problem</label>
                                        <textarea class="form-control @error('describe_problem') is-invalid @enderror" id="describe_problem"
                                            name="describe_problem" rows="3" placeholder="Enter Here..."></textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label for="example-text-input" class="form-control-label">Payment
                                                Mode</label>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="payment_mode[]"
                                                    id="cash" value="Cash">
                                                <label class="custom-control-label" for="cash">Cash</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="payment_mode[]"
                                                    id="online" value="Online">
                                                <label class="custom-control-label" for="online">Online</label>
                                            </div>
                                            @error('payment_mode')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <label for="example-text-input" class="form-control-label">&nbsp;</label>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="payment_mode[]"
                                                    id="card" value="Card">
                                                <label class="custom-control-label" for="card">Using Card</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="payment_mode[]"
                                                    id="cheque" value="Cheque">
                                                <label class="custom-control-label" for="cheque">Cheque</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <button type="submit" class="btn btn-success btn-sm ms-auto">Submit</button>
                        </form>

                        @foreach ($patient_details as $patient_detail )
                            <a href="{{ route('manage.dailyReciptsPdf', $patient_detail->id) }}"> <button type="button"
                                    id="receipt" class="">Receipt {{ $loop->iteration }}</button></a>
                        @endforeach


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
