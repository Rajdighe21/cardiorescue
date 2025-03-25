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
                            <form action="{{ route('manage.registerStore') }}" method="post">
                            @csrf
                            <h5 class="text-uppercase text-lg">CR0000{{ $lastValue + 1 }}</h6>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label ">Patient name</label>
                                            <input class="form-control @error('name') is-invalid @enderror" name="name"
                                                type="text" placeholder="Name">

                                            <input class="form-control" name="authname[]"
                                                type="hidden" placeholder="Name" value="{{auth()->user()->name}}">
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
                                            <label for="example-text-input" class="form-control-label ">Age</label>
                                            <input class="form-control @error('age') is-invalid @enderror" name="age"
                                                type="text" placeholder="XY Years">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Contact</label>
                                            <input class="form-control @error('contact') is-invalid @enderror"
                                                name="contact" max="10" min="10" type="text"
                                                placeholder="91+">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Get First
                                                Payment</label>
                                            <input class="form-control @error('payment_amt') is-invalid @enderror"
                                                name="payment_amt" placeholder="Amt IN INR">
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Due Amount</label>
                                            <input class="form-control @error('pending_amount') is-invalid @enderror"
                                                name="pending_amount" placeholder="Amt IN INR">
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
                                                    autocomplete="off"> Male
                                            </label>
                                            <label class="btn ">
                                                <input type="radio" name="gender" value="Female" id="option2"
                                                    autocomplete="off"> Female
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
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" rows="3"
                                                placeholder="Enter Here..."></textarea>
                                        </div>
                                    </div>



                                    <div class="col-md-6">
                                        <label for="example-text-input" class="form-control-label">Patient any medication,
                                            currently
                                            ?</label>
                                        <div class="btn-group-toggle" data-toggle="buttons">
                                            <label class="btn ">
                                                <input type="checkbox" name="get_medicine" id="medication"> Click If Yes
                                            </label>
                                        </div>
                                        @error('get_medicine')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col-md-6" style="display: none;" id="medicine-list">
                                        <div class="form-group">
                                            <label for="exampleFormControlTextarea0">Medicine List</label>
                                            <textarea class="form-control @error('medicine_list') is-invalid @enderror" name="medicine_list" rows="3"
                                                placeholder="Enter Here..."></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-3">
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


                                    <div class="col-md-3">
                                        <label for="example-text-input" class="form-control-label">Location</label>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="location[]"
                                                id="Mumbai" value="Mumbai">
                                            <label class="custom-control-label" for="location">Mumbai</label>
                                        </div>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="location[]"
                                                id="Vapi" value="Vapi">
                                            <label class="custom-control-label" for="location">Vapi</label>
                                        </div>
                                        @error('location')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
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
