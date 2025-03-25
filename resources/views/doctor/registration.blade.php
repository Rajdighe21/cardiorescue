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

                        <form method="post" id="registrationForm" action="{{ route('registration') }}"
                            enctype="multipart/form-data" name="registrationForm">

                            @csrf
                            <div class="card-body row">

                                <div class="form-group col-md-12">
                                    <label for="patient_name">Receipt Number</label>
                                    <input type="text" value="CR0000{{ $lastValue + 1 }}" name="receipt_no"
                                        class="form-control" id="receipt_no" placeholder="Enter Name" readonly>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="patient_name">Patient Name </label>
                                    <input type="text" name="patient_name" class="form-control" id="patient_name"
                                        placeholder="Enter Name">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="patient_image">Patient Image</label>
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input" id="patient_image"
                                            name="patient_image[]" multiple>
                                        <input type="hidden" class="custom-file-input" id="patient_image"
                                            name="patient_image" value="Demo.Jpg">
                                        <label class="custom-file-label" for="patient_image">Choose file</label>
                                    </div>
                                </div>


                                <div class="form-group col-md-6">
                                    <label for="gender">Select a Gender </label>
                                    <select class="form-control" id="gender" name="gender" data-component="dropdown"
                                        required aria-label="Gender">
                                        <option value="">Please Select</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="N/A">N/A</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="date_of_birth">Enter Patient's Age </label>
                                    <input type="text" name="date_of_birth" class="form-control" id="date_of_birth"
                                        placeholder="Age">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="height">Height</label>
                                    <input type="text" name="height" class="form-control" id="height"
                                        placeholder="Enter Height">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="weight">Weight </label>
                                    <input type="text" name="weight" class="form-control" id="weight"
                                        placeholder="Enter Weight">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="contact">Contact No</label>
                                    <input type="text" name="contact" class="form-control" id="contact"
                                        placeholder="91+">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="email">Email </label>
                                    <input type="email" name="email" class="form-control" id="email"
                                        placeholder="example@example.com">
                                </div>

                                <div class="form-group col-md-6">
                                    <label> Patient any medication, currently ?</label>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="customRadio1"
                                            name="get_medicine" value="Yes">
                                        <label for="customRadio1" class="custom-control-label">Yes</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="customRadio2"
                                            name="get_medicine" value="No">
                                        <label for="customRadio2" class="custom-control-label">No</label>
                                    </div>
                                </div>


                                <div class="form-group col-md-12" id="medicine_list" style="display: none">
                                    <label> Please list it here </label>
                                    <textarea class="form-control" rows="3" name="medicine_list" placeholder="Medicine's"></textarea>
                                </div>

                                <div class="form-group col-md-12">
                                    <label>Describe a Problem</label>
                                    <textarea class="form-control" rows="3" name="describe_problem" placeholder="Enter Problems"></textarea>
                                </div>

                                <div class="form-group col-md-12">
                                    <label> Address</label>
                                    <textarea class="form-control" rows="3" name="address" placeholder="Enter Address"></textarea>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="emg_contact_name">Emegency Contact Name</label>
                                    <input type="text" name="emg_contact_name" class="form-control"
                                        id="emg_contact_name" placeholder="Enter Name">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="relationship">Relationship </label>
                                    <input type="text" name="relationship" class="form-control"
                                        id="relationship">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="emg_contact_number">Emeregency Contact Number </label>
                                    <input type="text" name="emg_contact_number" placeholder="Enter Number"
                                        class="form-control" id="emg_contact_number">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="payment_amt">Get Payment </label>
                                    <input type="text" name="payment_amt" placeholder="₹" class="form-control"
                                        id="payment_amt">
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="regi_date">Registration Date </label>
                                    <input type="date" name="regi_date" class="form-control" id="regi_date"
                                        placeholder="Enter Name">
                                </div>


                            </div>
                            <hr>

                            <div class="card-body row" id="schedule" style="display: none;">
                                <div class="form-group col-md-6">
                                    <label for="session_numbers">Number of Manual Session <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="session_numbers" class="form-control"
                                        id="session_numbers" placeholder="Session Numbers">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="cost_of_session">Cost of Manual Session <span
                                            class="text-danger">*</span></label>
                                    <input type="text" name="cost_of_session" class="form-control"
                                        id="cost_of_session" placeholder="Per Session Amount">
                                </div>


                                <div class="form-group col-md-6">
                                    <label for="number_of_robotics">Number of Robotics</label>
                                    <input type="text" name="number_of_robotics" class="form-control"
                                        id="number_of_robotics" placeholder="Robotic Numbers">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="cost_of_robotic">Cost of Robotics</label>
                                    <input type="text" name="cost_of_robotic" class="form-control"
                                        id="cost_of_robotic" placeholder="Per Robotic Amount">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Assessment</label>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="customRadio3"
                                            name="assessment" value="Yes">
                                        <label for="customRadio3" class="custom-control-label">Yes</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="customRadio4"
                                            name="assessment" value="No">
                                        <label for="customRadio4" class="custom-control-label">No</label>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="cost_of_assessment">Cost of Assessment</label>
                                    <input type="text" name="cost_of_assessment" class="form-control"
                                        id="cost_of_assessment" placeholder="Assessment Amount">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Muscle Testing</label>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="customRadio5"
                                            name="machine_test" value="Yes">
                                        <label for="customRadio5" class="custom-control-label">Yes</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="customRadio6"
                                            name="machine_test" value="No">
                                        <label for="customRadio6" class="custom-control-label">No</label>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="cost_machine_test">Cost of Muscle Test</label>
                                    <input type="text" name="cost_machine_test" class="form-control"
                                        id="cost_machine_test" placeholder="Machine Test Amount">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Muscle stimulator (MS)</label>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="customRadio7"
                                            name="ms" value="Yes">
                                        <label for="customRadio7" class="custom-control-label">Yes</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="customRadio8"
                                            name="ms" value="No">
                                        <label for="customRadio8" class="custom-control-label">No</label>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="cost_of_ms">Cost of MS</label>
                                    <input type="text" name="cost_of_ms" class="form-control" id="cost_of_ms"
                                        placeholder="Muscle stimulator Amount">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Ultrasound (US)</label>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="customRadio9"
                                            name="us" value="Yes">
                                        <label for="customRadio9" class="custom-control-label">Yes</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="customRadio10"
                                            name="us" value="No">
                                        <label for="customRadio10" class="custom-control-label">No</label>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="cost_of_us">Cost of US</label>
                                    <input type="text" name="cost_of_us" class="form-control" id="cost_of_us"
                                        placeholder="Ultrasound Amount">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Ayurvedic</label>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="customRadio11"
                                            name="ayurvedic" value="Yes">
                                        <label for="customRadio11" class="custom-control-label">Yes</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="customRadio12"
                                            name="ayurvedic" value="No">
                                        <label for="customRadio12" class="custom-control-label">No</label>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="cost_ayurvedic">Cost of Ayurvedic</label>
                                    <input type="text" name="cost_ayurvedic" class="form-control"
                                        id="cost_ayurvedic" placeholder="Amount of Ayurvedic">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Harness</label>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="customRadio13"
                                            name="harness" value="Yes">
                                        <label for="customRadio13" class="custom-control-label">Yes</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="customRadio14"
                                            name="harness" value="No">
                                        <label for="customRadio14" class="custom-control-label">No</label>
                                    </div>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="harness_cost">Cost of Harness</label>
                                    <input type="text" name="harness_cost" value="" class="form-control"
                                        id="harness_cost" placeholder="Amount of Harness">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="total_amt">Total Amount ₹</label>
                                    <input type="text" name="total_amt" class="form-control" id="total_amt"
                                        placeholder="Enter Amount">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="package_price">Package Price</label>
                                    <input type="text" name="package_price" class="form-control"
                                        id="package_price" placeholder="Enter Amount">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="discount_amt">Discount ₹</label>
                                    <input type="text" name="discount_amt" class="form-control" id="discount_amt"
                                        placeholder="Enter Amount">
                                </div>

                                {{-- <div class="form-group col-md-6">
                                    <label for="grand_total">Grand Total ₹</label>
                                    <input type="text" name="grand_total" class="form-control" id="grand_total"
                                        placeholder="Enter Amount">
                                </div> --}}

                                <div class="form-group col-md-6">
                                    <label for="paid_amt">Paid Amount ₹</label>
                                    <input type="text" name="paid_amt" class="form-control" id="paid_amt"
                                        placeholder="Enter Amount" readonly>
                                </div>

                                <div class="form-group col-md-12">
                                    <label for="balance">Balance ₹</label>
                                    <input type="text" name="balance" class="form-control" id="balance"
                                        placeholder="Enter Amount">
                                </div>

                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <a href="{{ url('download-receipt') }}"> <button type="button" id="receipt"
                                        class="btn btn-secondary">Receipt</button></a>
                                <a href="{{ url('download-invoice') }}"> <button type="button" id="invoice"
                                        class="btn btn-secondary"> <i class="fas fa-download"></i>Invoice</button>
                                </a>


                                <button type="button" class="btn btn-success float-right"
                                    id="nextTreatment">Click</button>
                            </div>

                        </form>
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
        $('#discount_amt').click(function() {
            var totalAmount = $("input[name='total_amt']").val() - $("input[name='package_price']").val(); // Get the value of total_amt
            $('#discount_amt').val(Math.round(totalAmount)); // Set the value of discount_amt
        });
    });

    // $(document).ready(function() {
    //     $('#grand_total').click(function() {
    //         $('#grand_total').val(Math.round($("input[name='total_amt']").val() - ($(
    //                 "input[name='discount_amt']")
    //             .val() / 100 * $("input[name='total_amt']").val())));
    //         $('#paid_amt').val($("input[name='payment_amt']").val());
    //         $('#balance').val(Math.round($("input[name='grand_total']").val() - $(
    //             "input[name='paid_amt']").val()));
    //     });
    // })
</script>


</html>
