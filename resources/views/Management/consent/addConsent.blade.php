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
                            <button class="btn btn-primary btn-sm ms-auto"> <a href="{{ route('manage.consent') }}"
                                    style="color: aliceblue">Back</a></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('manage.storeConsent') }}" method="post">
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
                                        <label for="example-text-input" class="form-control-label">Address</label>
                                        <input class="form-control @error('address') is-invalid @enderror" name="address"
                                            type="text" value="{{ $patients->address }}"
                                           >
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label">Treatment Start
                                            Date</label>
                                        <input type="datetime-local"
                                            class="form-control @error('start_date') is-invalid @enderror" name="start_date"
                                            placeholder="Enter Here">
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <label for="example-text-input" class="form-control-label">Select a Gender</label>
                                    <div class="btn-group-toggle" data-toggle="buttons">
                                        <label class="btn ">
                                            <input type="radio" name="gender" value="He" id="option1"
                                                autocomplete="off" {{ $patients->gender == 'Male' ? 'checked' : ' ' }}>
                                            Male
                                        </label>
                                        <label class="btn ">
                                            <input type="radio" name="gender" value="She" id="option2"
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
                                        <label for="example-text-input" class="form-control-label">Body Part</label>
                                        <input class="form-control @error('body_part') is-invalid @enderror"
                                            name="body_part" placeholder="Enter Here">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="example-text-input" class="form-control-label  ">Number Of
                                            Session</label>
                                        <select name="number_of_session"
                                            class="form-select form-control @error('number_of_session') is-invalid @enderror "
                                            aria-label="Default select example">
                                            <option selected>Select Here</option>
                                            @for ($i = 1; $i <= 100; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="example-text-input" class="form-control-label">Session in Day</label>
                                    <select name="session_in_day"
                                        class="form-select  form-control @error('session_in_day') is-invalid @enderror"
                                        aria-label="Default select example">
                                        <option >Select Here</option>
                                        <option value="Once a Day">Once a Day</option>
                                        <option value="Twice a day">Twice a day</option>
                                        <option value="Thrice a day">Thrice a day</option>
                                    </select>


                                    @error('session_in_day')
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
                                    <div class="form-group">
                                        <label for="aware_that">Aware That</label>
                                        <textarea class="form-control @error('aware_that') is-invalid @enderror" id="aware_that" name="aware_that"
                                            rows="3" placeholder="Enter Here..."></textarea>
                                    </div>
                                </div>

                                <!-- Signature Field -->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="signature">Patient's Signature</label>
                                        <canvas id="signature-pad" width="400" height="200"
                                            style="border: 1px solid #000;"></canvas>
                                        <button type="button" id="clear-signature"
                                            class="btn btn-secondary btn-sm mt-2">Clear</button>
                                        <button type="button" id="save-signature"
                                            class="btn btn-primary btn-sm mt-2">Save</button>
                                        <input type="hidden" name="signature" id="signature">
                                    </div>
                                </div>

                            </div>

                            <button type="submit" class="btn btn-success btn-sm ms-auto">Submit</button>
                        </form>
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

                </div>
            </div>
        </footer>
    </div>
@endsection
