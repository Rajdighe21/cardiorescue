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
                        <div class="container">
                            <div class="row align-items-center">
                                <form action="{{ route('reclick.patientSrch') }}" method="get"
                                    class="col-md-6 d-flex align-items-center flex-wrap">
                                    @csrf
                                    <input type="text" class="form-control me-2 mb-2 mb-md-0" name="patientSrch"
                                        placeholder="Search..." style="width: 200px;">

                                    <button class="btn btn-primary me-2 mb-2 mb-md-0" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>


                                </form>

                                <div class="col-md-6 d-flex justify-content-end mt-3 mt-md-0">
                                    <button class="btn btn-primary btn-sm">
                                        <a href="{{ route('reclick.index') }}" style="color: aliceblue">Back</a>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('reclick.store') }}" method="post">
                            @csrf
                            @if (!empty($patientInfo))
                                <h5 class="text-uppercase text-lg">CR0000{{ $patientInfo->id }}</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label ">Patient
                                                    name</label>
                                                <input class="form-control @error('name') is-invalid @enderror"
                                                    name="patients_name" type="text" placeholder="Name"
                                                    value="{{ $patientInfo->patient_name }}">

                                                <input class="form-control" name="patient_id" type="hidden"
                                                    placeholder="Name" value="{{ $patientInfo->id }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">Email address
                                                    (optional)</label>
                                                <input class="form-control @error('email') is-invalid @enderror"
                                                    name="email" type="email" placeholder="name@example.com"
                                                    value="{{ $patientInfo->email }}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label ">Age</label>
                                                <input class="form-control @error('age') is-invalid @enderror"
                                                    name="age" type="text" placeholder="XY Years"
                                                    value="{{ $patientInfo->date_of_birth }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">Contact</label>
                                                <input class="form-control @error('contact') is-invalid @enderror"
                                                    name="contact" max="10" min="10" type="text"
                                                    placeholder="91+" value="{{ $patientInfo->contact }}">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label text-danger">Get
                                                    First
                                                    First Payment *</label>
                                                <input class="form-control @error('first_payment') is-invalid @enderror"
                                                    name="first_payment" placeholder="Amt IN INR" value="" id="first_payment">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label">Registration
                                                    Date</label>
                                                <input class="form-control @error('registration_date') is-invalid @enderror"
                                                    name="registration_date" type="datetime-local" value="">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="example-text-input" class="form-control-label">Select a
                                                Gender</label>
                                            <div class="btn-group-toggle" data-toggle="buttons">
                                                @if ($patientInfo->gender == 'male')
                                                    <label class="btn ">
                                                        <input type="radio" name="gender" value="Male" id="option1"
                                                            autocomplete="off" checked>
                                                        Male
                                                    </label>
                                                @else
                                                    <label class="btn ">
                                                        <input type="radio" name="gender" value="Female"
                                                            id="option2" autocomplete="off" checked> Female
                                                    </label>
                                                @endif



                                            </div>
                                        </div>



                                        <div class="col-md-6">
                                            <label for="example-text-input" class="form-control-label">Patient any
                                                medication,
                                                currently
                                                ?</label>
                                            <div class="btn-group-toggle" data-toggle="buttons">
                                                <label class="btn ">
                                                    <input type="checkbox" name="get_medicine" id="medication"
                                                        {{ $patientInfo->get_medicine = 'Yes' ? 'Checked' : '' }}>
                                                    Click If Yes
                                                </label>
                                            </div>
                                        </div>

                                        <div class="col-md-6" id="medicine_list">
                                            <div class="form-group">
                                                <label for="exampleFormControlTextarea0">Medicine List</label>
                                                <textarea class="form-control @error('medicine_list') is-invalid @enderror" name="medicine_list" rows="3"
                                                    placeholder="Enter Here...">{{ $patientInfo->medicine_list }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="describe_problem">Describe a problem</label>
                                                <textarea class="form-control @error('describe_problem') is-invalid @enderror" id="describe_problem"
                                                    name="describe_problem" rows="3" placeholder="Enter Here...">{{ $patientInfo->describe_problem }}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="address">Address</label>
                                                <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3"
                                                    placeholder="Enter Here...">{{ $patientInfo->address }}</textarea>
                                            </div>
                                        </div>


                                        <div class="col-md-6">
                                            <label for="example-text-input" class="form-control-label">Staus</label>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="status"
                                                    id="active" value="Active"
                                                    {{ $patientInfo->status = 'Active' ? 'Checked' : '' }}>
                                                <label class="custom-control-label" for="status">Clicked</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="status"
                                                    id="Ofline" value="Offline"
                                                    {{ $patientInfo->status = 'Yes' ? 'Offline' : '' }}>
                                                <label class="custom-control-label" for="status">Pending</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="status"
                                                    id="Refund" value="Refund"
                                                    {{ $patientInfo->status = 'Yes' ? 'Refund' : '' }}>
                                                <label class="custom-control-label" for="status">Refund</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" name="status"
                                                    id="Reclick " value="Reclick">
                                                <label class="custom-control-label" for="status">Reclick</label>
                                            </div>

                                        </div>

                                    </div>


                                    {{-- Step Two Start From Here --}}
                                    <hr class="horizontal dark">
                                    <p class="text-uppercase text-sm"> Add More Details ( Step - 2 ) Reclick</p>
                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label ">Number of
                                                    Manual
                                                    Session </label>
                                                <input class="form-control @error('manual_session') is-invalid @enderror"
                                                    name="manual_session" id="manual_session_new"
                                                    placeholder="Session Numbers">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label ">Cost of Manual
                                                    Session</label>
                                                <input
                                                    class="form-control @error('cost_manual_session') is-invalid @enderror"
                                                    name="cost_manual_session" type="text" id="new_cost_manual"
                                                    placeholder="Enter Here...">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label ">Number of
                                                    Robotics</label>
                                                <input class="form-control @error('robotics') is-invalid @enderror"
                                                    name="robotics" type="text" placeholder="Enter Here..." id="new_robotics">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label ">Cost of
                                                    Robotics</label>
                                                <input class="form-control @error('cost_robotics') is-invalid @enderror"
                                                    name="cost_robotics" type="text" placeholder="Enter Here..." id="new_robotics_cost">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="example-text-input" class="form-control-label">Assessment</label>
                                            <div class="btn-group-toggle" data-toggle="buttons">
                                                <label class="btn">
                                                    <input type="radio" name="assessment" value="Yes"
                                                        id="assessment1" autocomplete="off">
                                                    Yes
                                                </label>
                                                <label class="btn">
                                                    <input type="radio" name="assessment" value="No"
                                                        id="assessment2" autocomplete="off"> No
                                                </label>
                                            </div>
                                            @error('assessment')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="cost_assessment" class="form-control-label">Cost of
                                                    Assessment</label>
                                                <input class="form-control @error('cost_assessment') is-invalid @enderror"
                                                    name="cost_assessment" type="text" placeholder="Enter Here..."
                                                    id="new_assessment_cost">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <label for="example-text-input" class="form-control-label">Muscle
                                                Testing</label>
                                            <div class="btn-group-toggle" data-toggle="buttons">
                                                <label class="btn">
                                                    <input type="radio" name="muscle_test" value="Yes"
                                                        id="muscle_test1" autocomplete="off">
                                                    Yes
                                                </label>
                                                <label class="btn">
                                                    <input type="radio" name="muscle_test" value="No"
                                                        id="muscle_test2" autocomplete="off"> No
                                                </label>
                                            </div>
                                            @error('muscle_test')
                                                <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="cost_muscle_test" class="form-control-label">Cost of Muscle
                                                    Test</label>
                                                <input
                                                    class="form-control @error('cost_muscle_test') is-invalid @enderror"
                                                    name="cost_muscle_test" type="text" placeholder="Enter Here..."
                                                    id="new_muscleTest_cost">
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
                                                <label for="cost_ms" class="form-control-label">Cost of MS</label>
                                                <input class="form-control @error('cost_ms') is-invalid @enderror"
                                                    name="cost_ms" type="text" placeholder="Enter Here..."
                                                    id="new_ms_cost">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="example-text-input" class="form-control-label">Ultrasound
                                                (US)</label>
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
                                                <label for="cost_us" class="form-control-label">Cost of US</label>
                                                <input class="form-control @error('cost_us') is-invalid @enderror"
                                                    name="cost_us" type="text" placeholder="Enter Here..."
                                                    id="new_us_cost">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="example-text-input" class="form-control-label">Ayurvedic</label>
                                            <div class="btn-group-toggle" data-toggle="buttons">
                                                <label class="btn">
                                                    <input type="radio" name="ayurvedic" value="Yes"
                                                        id="ayurvedic1" autocomplete="off">
                                                    Yes
                                                </label>
                                                <label class="btn">
                                                    <input type="radio" name="ayurvedic" value="No"
                                                        id="ayurvedic2" autocomplete="off"> No
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
                                                    id="new_ayurvedic_cost">
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
                                                <label for="cost_harness" class="form-control-label">Cost of
                                                    Harnes</label>
                                                <input class="form-control @error('cost_harness') is-invalid @enderror"
                                                    name="cost_harness" type="text" placeholder="Enter Here..."
                                                    id="new_harness_cost">
                                            </div>
                                        </div>


                                        {{-- Mathamatic Sums --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label ">Total
                                                    Cost (after change amt click here)</label>
                                                <input class="form-control @error('total_cost') is-invalid @enderror"
                                                    name="total_cost" type="text" placeholder="Enter Here..."
                                                    id="sum_of_total_cost" >
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label ">Package
                                                    Price</label>
                                                <input class="form-control @error('package_price') is-invalid @enderror"
                                                    name="package_price" type="text" placeholder="Enter Here..."
                                                    id="new_package_price">
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="example-text-input" class="form-control-label ">Given
                                                    Discout (after change amt click here)</label>
                                                <input class="form-control @error('given_discount') is-invalid @enderror"
                                                    name="given_discount" type="text" placeholder="Enter Here..."
                                                    id="new_given_discount">
                                            </div>
                                        </div>

                                    </div>
                                    <button type="submit" class="btn btn-success btn-sm ms-auto">Submit</button>
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
