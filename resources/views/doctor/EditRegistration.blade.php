<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

    <title>Patient Registration</title>


    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/admin/dashboard/dist/css/adminlte.min.css') }}">


    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css"> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script> --}}

</head>

<body class="hold-transition sidebar-mini layout-fixed">

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"></h1>
                </div>

            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid ">
            <div class="row justify-content-center ">
                <div class="col-md-8">
                    <div class="card card-primary shadow">
                        @include('admin.message')

                        <div class="card-header">
                            <h3 class="card-title">Patient Registration</h3>
                        </div>

                        {{-- <form method="post" id="registrationForm" action="{{ route('registration') }}"
                            enctype="multipart/form-data" name="registrationForm">

                            @csrf --}}
                        <div class="card-body row">

                            <div class="form-group col-md-12">
                                <label for="patient_name">Receipt Number</label>
                                <input type="text" value="CR0000{{ $lastValue->id }}" name="receipt_no"
                                    class="form-control" id="receipt_no" placeholder="Enter Name" readonly>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="patient_name">Patient Name </label>
                                <input type="text" name="patient_name" value="{{ $lastValue->patient_name }}"
                                    class="form-control" id="patient_name" placeholder="Enter Name" readonly>
                            </div>

                            {{-- <div class="form-group col-md-6">
                                    <label for="patient_image">Patient Image</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="patient_image"
                                            name="patient_image[]" multiple>
                                        <input type="hidden" class="custom-file-input" id="patient_image"
                                            name="patient_image" value="Demo.Jpg">
                                        <label class="custom-file-label" for="patient_image">Choose file</label>
                                    </div>
                                </div> --}}


                            <div class="form-group col-md-6">
                                <label for="gender">Gender </label>
                                <input type="text" name="gender" class="form-control" id="date_of_birth"
                                    value="{{ $lastValue->gender }}" readonly>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="date_of_birth">Enter Patient's Age </label>
                                <input type="text" name="date_of_birth" class="form-control" id="date_of_birth"
                                    placeholder="Age" value="{{ $lastValue->date_of_birth }}" readonly>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="height">Height</label>
                                <input type="text" name="height" class="form-control" id="height"
                                    placeholder="Enter Height" value="{{ $lastValue->height }}" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="weight">Weight </label>
                                <input type="text" name="weight" class="form-control" id="weight"
                                    placeholder="Enter Weight" value="{{ $lastValue->weight }}" readonly>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="contact">Contact No</label>
                                <input type="text" name="contact" class="form-control" id="contact"
                                    placeholder="91+" value="{{ $lastValue->contact }}" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email </label>
                                <input type="email" name="email" class="form-control" id="email"
                                    placeholder="example@example.com" value="{{ $lastValue->email }}" readonly>
                            </div>

                            <div class="form-group col-md-6">
                                <label> Patient any medication, currently ?</label>
                                <input type="email" name="email" class="form-control" id="email"
                                    placeholder="example@example.com" value="{{ $lastValue->get_medicine }}" readonly>
                            </div>

                            @if (!empty($lastValue->medicine_list))
                                <div class="form-group col-md-12" id="medicine_list">
                                    <label> Medical List's </label>
                                    <textarea class="form-control" rows="3" name="medicine_list" placeholder="Medicine's" readonly>{{ $lastValue->medicine_list }}</textarea>
                                </div>
                            @endif


                            <div class="form-group col-md-12">
                                <label>Describe a Problem</label>
                                <textarea class="form-control" rows="3" name="describe_problem" placeholder="Enter Problems" readonly> {{ $lastValue->describe_problem }}</textarea>
                            </div>

                            <div class="form-group col-md-12">
                                <label> Address</label>
                                <textarea class="form-control" rows="3" name="address" placeholder="Enter Address" readonly>{{ $lastValue->address }}</textarea>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="emg_contact_name">Emegency Contact Name</label>
                                <input type="text" name="emg_contact_name" class="form-control"
                                    id="emg_contact_name" placeholder="Enter Name"
                                    value="{{ $lastValue->emg_contact_name }}" readonly>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="relationship">Relationship </label>
                                <input type="text" name="relationship" class="form-control" id="relationship"
                                    value="{{ $lastValue->relationship }}" readonly>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="emg_contact_number">Emeregency Contact Number </label>
                                <input type="text" name="emg_contact_number" placeholder="Enter Number"
                                    class="form-control" id="emg_contact_number"
                                    value="{{ $lastValue->emg_contact_number }}" readonly>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="payment_amt">Get Payment </label>
                                <input type="text" name="payment_amt" placeholder="₹" class="form-control"
                                    id="payment_amt" value="{{ $lastValue->payment_amt }}" readonly>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="regi_date">Registration Date </label>
                                <input type="date" name="regi_date" class="form-control" id="regi_date"
                                    placeholder="Enter Name" value="{{ $lastValue->regi_date }}" readonly>
                            </div>


                        </div>
                        <hr>




                        <div class="card-body row" id="schedule" style="display: none;">
                            <div class="form-group col-md-6">
                                <label for="session_numbers">Number of Manual Session <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="session_numbers" class="form-control"
                                    id="session_numbers" placeholder="Session Numbers"
                                    value="{{ $lastValue->session_numbers }}" readonly>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="cost_of_session">Cost of Manual Session <span
                                        class="text-danger">*</span></label>
                                <input type="text" name="cost_of_session" class="form-control"
                                    id="cost_of_session" placeholder="Per Session Amount"
                                    value="{{ $lastValue->cost_of_session }}" readonly>
                            </div>


                            <div class="form-group col-md-6">
                                <label for="number_of_robotics">Number of Robotics</label>
                                <input type="text" name="number_of_robotics" class="form-control"
                                    id="number_of_robotics" placeholder="Robotic Numbers"
                                    value="{{ $lastValue->number_of_robotics }}" readonly>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="cost_of_robotic">Cost of Robotics</label>
                                <input type="text" name="cost_of_robotic" class="form-control"
                                    id="cost_of_robotic" placeholder="Per Robotic Amount"
                                    value="{{ $lastValue->cost_of_robotic }}" readonly>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Assessment</label>

                                <input type="text" name="cost_of_robotic" class="form-control"
                                    id="cost_of_robotic" placeholder="Per Robotic Amount"
                                    value="{{ $lastValue->assessment }}" readonly>


                            </div>

                            <div class="form-group col-md-6">
                                <label for="cost_of_assessment">Cost of Assessment</label>
                                <input type="text" name="cost_of_assessment" class="form-control"
                                    id="cost_of_assessment" placeholder="Assessment Amount"
                                    value="{{ $lastValue->cost_of_assessment }}" readonly>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Muscle Testing</label>
                                <input type="text" name="cost_of_assessment" class="form-control"
                                    id="cost_of_assessment" placeholder="Assessment Amount"
                                    value="{{ $lastValue->machine_test }}" readonly>

                            </div>

                            <div class="form-group col-md-6">
                                <label for="cost_machine_test">Cost of Muscle Test</label>
                                <input type="text" name="cost_machine_test" class="form-control"
                                    id="cost_machine_test" placeholder="Machine Test Amount"
                                    value="{{ $lastValue->cost_machine_test }}" readonly>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Muscle stimulator (MS)</label>
                                <input type="text" name="cost_machine_test" class="form-control"
                                    id="cost_machine_test" placeholder="Machine Test Amount"
                                    value="{{ $lastValue->ms }}" readonly>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="cost_of_ms">Cost of MS</label>
                                <input type="text" class="form-control" value="{{ $lastValue->cost_of_ms }}"
                                    readonly>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Ultrasound (US)</label>
                                <input type="text" class="form-control" value="{{ $lastValue->us }}" readonly>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="cost_of_us">Cost of US</label>
                                <input type="text" class="form-control" value="{{ $lastValue->cost_of_us }}"
                                    readonly>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Ayurvedic</label>
                                <input type="text" class="form-control" value="{{ $lastValue->ayurvedic }}"
                                    readonly>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="cost_ayurvedic">Cost of Ayurvedic</label>
                                <input type="text" class="form-control" value="{{ $lastValue->cost_ayurvedic }}"
                                    readonly>
                            </div>

                            <div class="form-group col-md-6">
                                <label>Harness</label>
                                <input type="text" class="form-control" value="{{ $lastValue->harness }}"
                                    readonly>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="harness_cost">Cost of Harness</label>
                                <input type="text" class="form-control" value="{{ $lastValue->harness_cost }}"
                                    readonly>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="total_amt">Total Amount ₹</label>
                                <input type="text" class="form-control" value="{{ $lastValue->total_amt }}"
                                    readonly>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="discount_amt">Discount ₹</label>
                                <input type="text" class="form-control" value="{{ $lastValue->discount_amt }}"
                                    readonly>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="grand_total">Grand Total ₹</label>
                                <input type="text" class="form-control" value="{{ $lastValue->grand_total }}"
                                    readonly>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="paid_amt">Paid Amount ₹</label>
                                <input type="text" class="form-control" value="{{ $lastValue->paid_amt }}"
                                    readonly>
                            </div>

                            <div class="form-group col-md-12">
                                <label for="balance">Balance ₹</label>
                                <input type="text" class="form-control" value="{{ $lastValue->balance }}"
                                    readonly>
                            </div>

                        </div>

                        <div class="card-footer">
                            <a href="{{ url('download-receipt') }}"> <button type="button" id="receipt"
                                    class="btn btn-secondary">Receipt</button></a>
                            <a href="{{ url('download-invoice') }}"> <button type="button" id="invoice"
                                    class="btn btn-secondary"> <i class="fas fa-download"></i>Invoice</button>
                            </a>
                            <a href="{{ route('manage.patientsList') }}"> <button type="button" id="invoice"
                                    class="btn btn-info"> <i class="fas fa-download"></i>Back</button>
                            </a>

                            <button type="button" class="btn btn-success float-right" id="nextTreatment">View
                                More</button>

                        </div>
                        {{--
                        </form> --}}
                    </div>

                </div>
            </div>
        </div>
    </section>





</body>
<script>
    $("input[name='get_medicine']").change(function() {
        if ($(this).val() == "Yes") {
            $("#medicine_list").show();
        } else {
            $("#medicine_list").hide();
        }
    });
    $("button[id='nextTreatment']").click(function() {
        $("#schedule").show();
        $("button[id='nextTreatment']").hide();


    })

    //Methemetics sum's
    var sessionNumber = parseFloat($("input[name='session_numbers']").val()) || 0;
    $("input[name='session_numbers']").on('input', function() {
        sessionNumber = parseFloat($(this).val()) || 0;
    });
    var sessionAmount = parseFloat($("input[name='cost_of_session']").val()) || 0;
    $("input[name='cost_of_session']").on('input', function() {
        sessionAmount = parseFloat($(this).val()) || 0;
    });
    var roboticNumber = parseFloat($("input[name='number_of_robotics']").val()) || 0;
    $("input[name='number_of_robotics']").on('input', function() {
        roboticNumber = parseFloat($(this).val()) || 0;
    });
    var roboticAmount = parseFloat($("input[name='cost_of_robotic']").val()) || 0;
    $("input[name='cost_of_robotic']").on('input', function() {
        roboticAmount = parseFloat($(this).val()) || 0;
    });
    var assessmentAmount = parseFloat($("input[name='cost_of_assessment']").val()) || 0;
    $("input[name='cost_of_assessment']").on('input', function() {
        assessmentAmount = parseFloat($(this).val()) || 0;
    });
    var machineTestAmount = parseFloat($("input[name='cost_machine_test']").val()) || 0;
    $("input[name='cost_machine_test']").on('input', function() {
        machineTestAmount = parseFloat($(this).val()) || 0;
    });
    var msAmount = parseFloat($("input[name='cost_of_ms']").val()) || 0;
    $("input[name='cost_of_ms']").on('input', function() {
        msAmount = parseFloat($(this).val()) || 0;
    });
    var usAmount = parseFloat($("input[name='cost_of_us']").val()) || 0;
    $("input[name='cost_of_us']").on('input', function() {
        usAmount = parseFloat($(this).val()) || 0;
    });
    var ayurvedicAmount = parseFloat($("input[name='cost_ayurvedic']").val()) || 0;
    $("input[name='cost_ayurvedic']").on('input', function() {
        ayurvedicAmount = parseFloat($(this).val()) || 0;
    });
    var harnessAmount = parseFloat($("input[name='harness_cost']").val()) || 0;
    $("input[name='harness_cost']").on('input', function() {
        harnessAmount = parseFloat($(this).val()) || 0;
    });


    //ChangeEvent On Input Feild
    $(document).ready(function() {
        $('#total_amt').click(function() {
            $('#total_amt').val((sessionNumber * sessionAmount) + (roboticNumber * roboticAmount) +
                assessmentAmount + machineTestAmount + msAmount + usAmount + ayurvedicAmount +
                harnessAmount);
        });
    })

    $(document).ready(function() {
        $('#grand_total').click(function() {
            $('#grand_total').val(Math.round($("input[name='total_amt']").val() - ($(
                    "input[name='discount_amt']")
                .val() / 100 * $("input[name='total_amt']").val())));
            $('#paid_amt').val($("input[name='payment_amt']").val());
            $('#balance').val(Math.round($("input[name='grand_total']").val() - $(
                "input[name='paid_amt']").val()));
        });
    })
</script>


</html>
