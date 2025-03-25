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
                            <p class="mb-0">Patient Details</p>
                            <button class="btn btn-primary btn-sm ms-auto"> <a href="{{ route('manage.patientsList') }}"
                                    style="color: aliceblue">Back</a></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('manage.registerUpdate', $lastValue->id) }}" method="post">
                            @csrf
                            <h5 class="text-uppercase text-lg">CR0000{{ $lastValue->id }}</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label ">Patient name</label>
                                            <input class="form-control @error('name') is-invalid @enderror" name="name"
                                                type="text" placeholder="Name" value="{{ $lastValue->patient_name }}"
                                                readonly>

                                            <input class="form-control" name="authname[]" type="hidden" placeholder="Name"
                                                value="{{ auth()->user()->name }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Email address
                                                (optional)</label>
                                            <input class="form-control @error('email') is-invalid @enderror" name="email"
                                                type="email" placeholder="name@example.com"
                                                value="{{ $lastValue->email }}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label ">Age</label>
                                            <input class="form-control @error('age') is-invalid @enderror" name="age"
                                                type="text" placeholder="XY Years"
                                                value="{{ $lastValue->date_of_birth }}" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Contact</label>
                                            <input class="form-control @error('contact') is-invalid @enderror"
                                                name="contact" max="10" min="10" type="text"
                                                placeholder="91+" value="{{ $lastValue->contact }}" readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Get First
                                                Payment</label>
                                            <input class="form-control @error('payment_amt') is-invalid @enderror"
                                                name="payment_amt" placeholder="Amt IN INR"
                                                value="{{ $lastValue->payment_amt }}">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Registration
                                                Date</label>
                                            <input class="form-control @error('regi_date') is-invalid @enderror"
                                                name="regi_date" type="datetime-local" value="{{ $lastValue->regi_date }}"
                                                readonly>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="example-text-input" class="form-control-label">Select a Gender</label>
                                        <div class="btn-group-toggle" data-toggle="buttons">
                                            <label class="btn ">
                                                <input type="radio" name="gender" value="Male" id="option1"
                                                    autocomplete="off"
                                                    {{ $lastValue->gender == 'Male' ? 'checked' : ' ' }}>
                                                Male
                                            </label>
                                            <label class="btn ">
                                                <input type="radio" name="gender" value="Female" id="option2"
                                                    autocomplete="off"
                                                    {{ $lastValue->gender == 'Female' ? 'checked' : ' ' }}> Female
                                            </label>

                                        </div>
                                        @error('gender')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>



                                    <div class="col-md-6">
                                        <label for="example-text-input" class="form-control-label">Patient any medication,
                                            currently
                                            ?</label>
                                        <div class="btn-group-toggle" data-toggle="buttons">
                                            <label class="btn ">
                                                <input type="checkbox" name="get_medicine" id="medication"
                                                    {{ $lastValue->get_medicine == 'on' ? 'checked' : ' ' }} readonly>
                                                Click If Yes
                                            </label>
                                        </div>
                                        @error('get_medicine')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6"
                                        style="display: {{ $lastValue->get_medicine == 'on' ? ' ' : 'none' }};"
                                        id="medicine-list">
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea0">Medicine List</label>
                                            <textarea class="form-control @error('medicine_list') is-invalid @enderror" name="medicine_list" rows="3"
                                                placeholder="Enter Here..." >{{ $lastValue->medicine_list }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="describe_problem">Describe a problem</label>
                                            <textarea class="form-control @error('describe_problem') is-invalid @enderror" id="describe_problem"
                                                name="describe_problem" rows="3" placeholder="Enter Here..." >{{ $lastValue->describe_problem }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3"
                                                placeholder="Enter Here..." >{{ $lastValue->address }}</textarea>
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <label for="example-text-input" class="form-control-label">Staus</label>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="status"
                                                id="active" value="Active"
                                                {{ $lastValue->status == 'Active' ? 'checked' : ' ' }}>
                                            <label class="custom-control-label" for="status">Clicked</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="status"
                                                id="Ofline" value="Offline"
                                                {{ $lastValue->status == 'Offline' ? 'checked' : ' ' }}>
                                            <label class="custom-control-label" for="status">Pending</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="status"
                                                id="Refund" value="Refund"
                                                {{ $lastValue->status == 'Refund' ? 'checked' : ' ' }}>
                                            <label class="custom-control-label" for="status">Refund</label>
                                        </div>

                                        @error('status')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>


                                {{-- Step Two Start From Here --}}
                                <hr class="horizontal dark">
                                <p class="text-uppercase text-sm"> Add More Details ( Step - 2 ) </p>
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label ">Number of Manual
                                                Session </label>
                                            <input class="form-control @error('session_numbers') is-invalid @enderror"
                                                name="session_numbers" id="session_numbers"
                                                placeholder="Session Numbers">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label ">Cost of Manual
                                                Session</label>
                                            <input class="form-control @error('cost_of_session') is-invalid @enderror"
                                                name="cost_of_session" type="text" placeholder="Enter Here...">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label ">Number of
                                                Robotics</label>
                                            <input class="form-control @error('number_of_robotics') is-invalid @enderror"
                                                name="number_of_robotics" type="text" placeholder="Enter Here...">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label ">Cost of
                                                Robotics</label>
                                            <input class="form-control @error('cost_of_robotic') is-invalid @enderror"
                                                name="cost_of_robotic" type="text" placeholder="Enter Here...">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="example-text-input" class="form-control-label">Assessment</label>
                                        <div class="btn-group-toggle" data-toggle="buttons">
                                            <label class="btn">
                                                <input type="radio" name="assessment" value="Yes" id="assessment1"
                                                    autocomplete="off">
                                                Yes
                                            </label>
                                            <label class="btn">
                                                <input type="radio" name="assessment" value="No" id="assessment2"
                                                    autocomplete="off"> No
                                            </label>
                                        </div>
                                        @error('assessment')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cost_of_assessment" class="form-control-label">Cost of
                                                Assessment</label>
                                            <input class="form-control @error('cost_of_assessment') is-invalid @enderror"
                                                name="cost_of_assessment" type="text" placeholder="Enter Here..."
                                                id="cost_of_assessment">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <label for="example-text-input" class="form-control-label">Muscle Testing</label>
                                        <div class="btn-group-toggle" data-toggle="buttons">
                                            <label class="btn">
                                                <input type="radio" name="machine_test" value="Yes"
                                                    id="machine_test1" autocomplete="off">
                                                Yes
                                            </label>
                                            <label class="btn">
                                                <input type="radio" name="machine_test" value="No"
                                                    id="machine_test2" autocomplete="off"> No
                                            </label>
                                        </div>
                                        @error('machine_test')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cost_machine_test" class="form-control-label">Cost of Muscle
                                                Test</label>
                                            <input class="form-control @error('cost_machine_test') is-invalid @enderror"
                                                name="cost_machine_test" type="text" placeholder="Enter Here..."
                                                id="cost_machine_test">
                                        </div>
                                    </div>


                                    <div class="col-md-6">
                                        <label for="example-text-input" class="form-control-label">Muscle stimulator
                                            (MS)</label>
                                        <div class="btn-group-toggle" data-toggle="buttons">
                                            <label class="btn">
                                                <input type="radio" name="ms" value="Yes" id="ms1"
                                                    autocomplete="off">
                                                Yes
                                            </label>
                                            <label class="btn">
                                                <input type="radio" name="ms" value="No" id="ms2"
                                                    autocomplete="off"> No
                                            </label>
                                        </div>
                                        @error('ms')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cost_of_ms" class="form-control-label">Cost of MS</label>
                                            <input class="form-control @error('cost_of_ms') is-invalid @enderror"
                                                name="cost_of_ms" type="text" placeholder="Enter Here..."
                                                id="cost_of_ms">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="example-text-input" class="form-control-label">Ultrasound (US)</label>
                                        <div class="btn-group-toggle" data-toggle="buttons">
                                            <label class="btn">
                                                <input type="radio" name="us" value="Yes" id="us1"
                                                    autocomplete="off">
                                                Yes
                                            </label>
                                            <label class="btn">
                                                <input type="radio" name="us" value="No" id="us2"
                                                    autocomplete="off"> No
                                            </label>
                                        </div>
                                        @error('us')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cost_of_us" class="form-control-label">Cost of US</label>
                                            <input class="form-control @error('cost_of_us') is-invalid @enderror"
                                                name="cost_of_us" type="text" placeholder="Enter Here..."
                                                id="cost_of_us">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="example-text-input" class="form-control-label">Ayurvedic</label>
                                        <div class="btn-group-toggle" data-toggle="buttons">
                                            <label class="btn">
                                                <input type="radio" name="ayurvedic" value="Yes" id="ayurvedic1"
                                                    autocomplete="off">
                                                Yes
                                            </label>
                                            <label class="btn">
                                                <input type="radio" name="ayurvedic" value="No" id="ayurvedic2"
                                                    autocomplete="off"> No
                                            </label>
                                        </div>
                                        @error('ayurvedic')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="cost_ayurvedic" class="form-control-label">Cost of
                                                Ayurvedic</label>
                                            <input class="form-control @error('cost_ayurvedic') is-invalid @enderror"
                                                name="cost_ayurvedic" type="text" placeholder="Enter Here..."
                                                id="cost_ayurvedic">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="example-text-input" class="form-control-label">Harness</label>
                                        <div class="btn-group-toggle" data-toggle="buttons">
                                            <label class="btn">
                                                <input type="radio" name="harness" value="Yes" id="harness1"
                                                    autocomplete="off">
                                                Yes
                                            </label>
                                            <label class="btn">
                                                <input type="radio" name="harness" value="No" id="harness2"
                                                    autocomplete="off"> No
                                            </label>
                                        </div>
                                        @error('harness')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="harness_cost" class="form-control-label">Cost of Harnes</label>
                                            <input class="form-control @error('harness_cost') is-invalid @enderror"
                                                name="harness_cost" type="text" placeholder="Enter Here..."
                                                id="harness_cost">
                                        </div>
                                    </div>


                                    {{-- Mathamatic Sums --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label ">Total Cost</label>
                                            <input class="form-control @error('total_amt') is-invalid @enderror"
                                                name="total_amt" type="text" placeholder="Enter Here..."
                                                id="total_amt">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label ">Package
                                                Price</label>
                                            <input class="form-control @error('package_price') is-invalid @enderror"
                                                name="package_price" type="text" placeholder="Enter Here..."
                                                id="package_price">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label ">Given
                                                Discout</label>
                                            <input class="form-control @error('discount_amt') is-invalid @enderror"
                                                name="discount_amt" type="text" placeholder="Enter Here..."
                                                id="discount_amt">
                                        </div>
                                    </div>




                                </div>
                                <button type="submit" class="btn btn-success btn-sm ms-auto">Submit</button>
                                @if (!empty($lastValue->total_amt))
                                    <a href="{{ route('manage.invoicePdf', $lastValue->id) }}"><button type="button"
                                            class="btn btn-primary btn-sm ms-auto">Print</button></a>
                                @endif
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
