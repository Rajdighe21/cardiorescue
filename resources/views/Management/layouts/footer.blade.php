<div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
        <i class="fa fa-cog py-2"> </i>
    </a>
    <div class="card shadow-lg">
        <div class="card-header pb-0 pt-3 ">
            <div class="float-start">
                <h5 class="mt-3 mb-0">Argon Configurator</h5>
                <p>See our dashboard options.</p>
            </div>
            <div class="float-end mt-4">
                <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                    <i class="fa fa-close"></i>
                </button>
            </div>
            <!-- End Toggle Button -->
        </div>
        <hr class="horizontal dark my-1">
        <div class="card-body pt-sm-3 pt-0 overflow-auto">
            <!-- Sidebar Backgrounds -->
            <div>
                <h6 class="mb-0">Sidebar Colors</h6>
            </div>
            <a href="javascript:void(0)" class="switch-trigger background-color">
                <div class="badge-colors my-2 text-start">
                    <span class="badge filter bg-gradient-primary active" data-color="primary"
                        onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-success" data-color="success"
                        onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-warning" data-color="warning"
                        onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-danger" data-color="danger"
                        onclick="sidebarColor(this)"></span>
                </div>
            </a>
            <!-- Sidenav Type -->
            <div class="mt-3">
                <h6 class="mb-0">Sidenav Type</h6>
                <p class="text-sm">Choose between 2 different sidenav types.</p>
            </div>
            <div class="d-flex">
                <button class="btn bg-gradient-primary w-100 px-3 mb-2 active me-2" data-class="bg-white"
                    onclick="sidebarType(this)">White</button>
                <button class="btn bg-gradient-primary w-100 px-3 mb-2" data-class="bg-default"
                    onclick="sidebarType(this)">Dark</button>
            </div>
            <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
            <!-- Navbar Fixed -->
            <div class="d-flex my-3">
                <h6 class="mb-0">Navbar Fixed</h6>
                <div class="form-check form-switch ps-0 ms-auto my-auto">
                    <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed"
                        onclick="navbarFixed(this)">
                </div>
            </div>
            <hr class="horizontal dark my-sm-4">
            <div class="mt-2 mb-5 d-flex">
                <h6 class="mb-0">Light / Dark</h6>
                <div class="form-check form-switch ps-0 ms-auto my-auto">
                    <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version"
                        onclick="darkMode(this)">
                </div>
            </div>
            <a class="btn bg-gradient-dark w-100" href="https://www.creative-tim.com/product/argon-dashboard">Free
                Download</a>
            <a class="btn btn-outline-dark w-100"
                href="https://www.creative-tim.com/learning-lab/bootstrap/license/argon-dashboard">View
                documentation</a>
            <div class="w-100 text-center">
                <a class="github-button" href="https://github.com/creativetimofficial/argon-dashboard"
                    data-icon="octicon-star" data-size="large" data-show-count="true"
                    aria-label="Star creativetimofficial/argon-dashboard on GitHub">Star</a>
                <h6 class="mt-3">Thank you for sharing!</h6>
                <a href="https://twitter.com/intent/tweet?text=Check%20Argon%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fargon-dashboard"
                    class="btn btn-dark mb-0 me-2" target="_blank">
                    <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
                </a>
                <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/argon-dashboard"
                    class="btn btn-dark mb-0 me-2" target="_blank">
                    <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
                </a>
            </div>
        </div>
    </div>
</div>
<!--   Core JS Files   -->
<script src="{{ asset('management/assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('management/assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('management/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('management/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
<script src="{{ asset('management/assets/js/plugins/chartjs.min.js') }}"></script>
<script>
    var ctx1 = document.getElementById("chart-line").getContext("2d");

    var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(94, 114, 228, 0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(94, 114, 228, 0.0)');
    gradientStroke1.addColorStop(0, 'rgba(94, 114, 228, 0)');
    new Chart(ctx1, {
        type: "line",
        data: {
            labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
            datasets: [{
                label: "Mobile apps",
                tension: 0.4,
                borderWidth: 0,
                pointRadius: 0,
                borderColor: "#5e72e4",
                backgroundColor: gradientStroke1,
                borderWidth: 3,
                fill: true,
                data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
                maxBarThickness: 6

            }],
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false,
                }
            },
            interaction: {
                intersect: false,
                mode: 'index',
            },
            scales: {
                y: {
                    grid: {
                        drawBorder: false,
                        display: true,
                        drawOnChartArea: true,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        padding: 10,
                        color: '#fbfbfb',
                        font: {
                            size: 11,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
                x: {
                    grid: {
                        drawBorder: false,
                        display: false,
                        drawOnChartArea: false,
                        drawTicks: false,
                        borderDash: [5, 5]
                    },
                    ticks: {
                        display: true,
                        color: '#ccc',
                        padding: 20,
                        font: {
                            size: 11,
                            family: "Open Sans",
                            style: 'normal',
                            lineHeight: 2
                        },
                    }
                },
            },
        },
    });
</script>
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('management/assets/js/argon-dashboard.min.js?v=2.0.4') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('#medication').click(function() {
            if ($(this).is(':checked')) {
                $('#medicine-list').show(); // Show the textarea if the checkbox is checked
            } else {
                $('#medicine-list').hide(); // Hide the textarea if the checkbox is unchecked
            }
        });
    });


    // $(document).ready(function() {
    //     function toggleCostInput() {
    //         if ($('#assessment2').is(':checked')) {
    //             $('#cost_of_assessment').val('0').prop('readonly', true); // Set value to 0 and make readonly
    //         } else {
    //             $('#cost_of_assessment').val('').prop('readonly', false); // Clear value and make editable
    //         }
    //     }
    //     $('#assessment1, #assessment2').change(toggleCostInput);
    //     toggleCostInput();
    // });


    // $(document).ready(function() {
    //     function toggleCostInput() {
    //         if ($('#machine_test2').is(':checked')) {
    //             $('#cost_machine_test').val('0').prop('readonly', true); // Set value to 0 and make readonly
    //         } else {
    //             $('#cost_machine_test').val('').prop('readonly', false); // Clear value and make editable
    //         }
    //     }
    //     $('#machine_test1, #machine_test2').change(toggleCostInput);
    //     toggleCostInput();
    // });

    // $(document).ready(function() {
    //     function toggleCostInput() {
    //         if ($('#ms2').is(':checked')) {
    //             $('#cost_of_ms').val('0').prop('readonly', true); // Set value to 0 and make readonly
    //         } else {
    //             $('#cost_of_ms').val('').prop('readonly', false); // Clear value and make editable
    //         }
    //     }
    //     $('#ms1, #ms2').change(toggleCostInput);
    //     toggleCostInput();
    // });


    // $(document).ready(function() {
    //     function toggleCostInput() {
    //         if ($('#us2').is(':checked')) {
    //             $('#cost_of_us').val('0').prop('readonly', true); // Set value to 0 and make readonly
    //         } else {
    //             $('#cost_of_us').val('').prop('readonly', false); // Clear value and make editable
    //         }
    //     }
    //     $('#us1, #us2').change(toggleCostInput);
    //     toggleCostInput();
    // });


    // $(document).ready(function() {
    //     function toggleCostInput() {
    //         if ($('#ayurvedic2').is(':checked')) {
    //             $('#cost_ayurvedic').val('0').prop('readonly', true); // Set value to 0 and make readonly
    //         } else {
    //             $('#cost_ayurvedic').val('').prop('readonly', false); // Clear value and make editable
    //         }
    //     }
    //     $('#ayurvedic1, #ayurvedic2').change(toggleCostInput);
    //     toggleCostInput();
    // });

    // $(document).ready(function() {
    //     function toggleCostInput() {
    //         if ($('#harness2').is(':checked')) {
    //             $('#harness_cost').val('0').prop('readonly', true); // Set value to 0 and make readonly
    //         } else {
    //             $('#harness_cost').val('').prop('readonly', false); // Clear value and make editable
    //         }
    //     }
    //     $('#harness1, #harness2').change(toggleCostInput);
    //     toggleCostInput();
    // });



    // Total Calculate

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

    $(document).ready(function() {
        $('#total_amt').click(function() {
            $('#total_amt').val((sessionNumber * sessionAmount) + (roboticNumber * roboticAmount) +
                assessmentAmount + machineTestAmount + msAmount + usAmount + ayurvedicAmount +
                harnessAmount);
        });
    })

    $(document).ready(function() {
        $('#discount_amt').click(function() {
            var totalAmount = $("input[name='total_amt']").val() - $("input[name='package_price']")
            .val(); // Get the value of total_amt
            $('#discount_amt').val(Math.round(totalAmount)); // Set the value of discount_amt
        });
    });


    $(document).ready(function() {
        $("#sum_of_total_cost").click(function() {
            //manual session calculator
            var new_manual_session = document.getElementById("manual_session_new");
            var new_manual = parseInt(new_manual_session.value);

            var new_cost_manual = document.getElementById("new_cost_manual");
            let new_cost_manual_txt = parseInt(new_cost_manual.value);

            //robotics session calculator
            let new_robotics = document.getElementById("new_robotics");
            let new_robotics_txt = parseInt(new_robotics.value);

            let new_robotics_cost = document.getElementById("new_robotics_cost");
            let new_robotics_cost_txt = parseInt(new_robotics_cost.value);

            //assessment
            let new_assessment_cost = document.getElementById("new_assessment_cost");
            let new_assessment_cost_txt = parseInt(new_assessment_cost.value);

            // muscle test
            let new_muscleTest_cost = document.getElementById("new_muscleTest_cost");
            let new_muscleTest_cost_txt = parseInt(new_muscleTest_cost.value);

            // ms
            let new_ms_cost = document.getElementById("new_ms_cost");
            let new_ms_cost_txt = parseInt(new_ms_cost.value);

            // us
            let new_us_cost = document.getElementById("new_us_cost");
            let new_us_cost_txt = parseInt(new_us_cost.value);

            // Ayurvedic
            let new_ayurvedic_cost = document.getElementById("new_ayurvedic_cost");
            let new_ayurvedic_cost_txt = parseInt(new_ayurvedic_cost.value);

            // harness
            let new_harness_cost = document.getElementById("new_harness_cost");
            let new_harness_cost_txt = parseInt(new_harness_cost.value);

            let Total_of_sum_first = new_manual * new_cost_manual_txt
            let Total_of_sum_second = new_robotics_txt * new_robotics_cost_txt

            let Total_of_sum_third = Total_of_sum_first + Total_of_sum_second +
                new_assessment_cost_txt + new_muscleTest_cost_txt + new_ms_cost_txt + new_us_cost_txt +
                new_ayurvedic_cost_txt + new_harness_cost_txt;

            $("#sum_of_total_cost").val(parseInt(Total_of_sum_third));
        })
    })

    $(document).ready(function() {
        $("#new_given_discount").click(function() {
            let sum_of_total_cost = document.getElementById("sum_of_total_cost");
            let sum_of_total_cost_txt = parseInt(sum_of_total_cost.value);

            let new_package_price = document.getElementById("new_package_price");
            let new_package_price_txt = parseInt(new_package_price.value);

            let new_given_discount = document.getElementById("sum_of_total_cost");
            $("#new_given_discount").val(sum_of_total_cost_txt - new_package_price_txt);
        })
    })




    // ONLINE E - SIGNATURE


    const canvas = document.getElementById('signature-pad');
    const signaturePad = new SignaturePad(canvas);

    document.getElementById('clear-signature').addEventListener('click', function() {
        signaturePad.clear();
    });

    document.getElementById('save-signature').addEventListener('click', function() {
        if (!signaturePad.isEmpty()) {
            const signatureData = signaturePad.toDataURL();
            document.getElementById('signature').value = signatureData;
            // Optionally, submit the form here or via AJAX
                        alert('Your signature is saved');

        } else {
            alert('Please provide a signature first.');
        }
    });

</script>




</body>

</html>


