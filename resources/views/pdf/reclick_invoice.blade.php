<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Invoice PDF Header</title>
    <style>
        /* Reset default margin and padding */
        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        ul,
        ol,
        li,
        figure,
        figcaption,
        blockquote,
        dl,
        dd {
            margin: 0;
            padding: 0;
        }

        /* Header Styles */
        .header {
            padding: 13px 0;
            margin-bottom: 20px;
            /* Add margin at the bottom for spacing */
            text-align: center;
            color: #086eb6;
        }

        .header-logo {
            float: left;
            margin-right: 20px;
            margin-top: -2rem;
        }

        .header-brand {
            font-size: 34px;
            font-weight: bold;
        }

        .header-subtitle {
            margin-top: 5px;
            font-size: 16px;
        }

        /* Centering the header content */
        .centered {
            position: absolute;
            left: 43%;

            transform: translate(-50%, -50%);
        }

        .hr {
            margin-top: 4rem !important;
        }

        .date {
            float: right;
            margin-right: 20px;
        }

        .info {
            float: right
        }


        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 1rem;
        }

        th,
        td {
            border: 1px solid #000000;
            text-align: left;
            padding: 1px;
        }

        th {
            background-color: #f2f2f2;
        }

        ul {
            margin-left: 20px;
        }

        .stampimg {
            position: absolute;
            /* Position the image absolutely within the container */
            top: 41%;
            /* Align image to the top */
            left: 60%;
            /* Align image to the left */
            z-index: 1;
            /* Ensure the image is displayed above text */
            width: 28%;
            /* Make the image fill the container horizontally */
            object-fit: cover;
            /* Resize the image to cover the container */
            border-radius: 5px;
            /* Add rounded corners to the image */
        }
    </style>
</head>

<body>
    <div class="header">
        <div class="header-logo">
        <img src="{{ asset('images/logo.webp') }}" alt="Your Company Logo" width="120">  
        </div>
        <div class="centered">
            <div class="header-brand">
                Cardio Rescue
            </div>
            <div class="header-subtitle">
                Damji Nenshi Wadi, Station Road, Bhandup(w) Mumbai-400078
            </div>
        </div>
    </div>
    <!-- Your invoice content goes here -->
    <hr class='hr'>
    <hr>
    <h4 class="date"> Date: {{ \Carbon\Carbon::parse($lastRecord->registration_date)->format('d M Y') }}</h4>
    <h4 class="Info" style="margin-top: 1rem">Name : {{ $lastRecord->patients_name }}</h4>
    <h4 class="Info">Receipt No : CR0000{{ $lastRecord->patient_id }}</h4>

    <table>
        <thead>
            <tr>
                <th>SR</th>
                <th>PARTICULARS</th>
                <th>QTY</th>
                <th>AMOUNT</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>1</td>
                <td>
                    @if (!empty($lastRecord->cost_ms))
                        Device Muscle Stimulator
                    @elseif(!empty($lastRecord->cost_us))
                        Device Ultrasound
                    @else
                        Device MS/US
                    @endif
                </td>
                <td>
                    @if (!empty($lastRecord->cost_ms))
                        1
                    @elseif(!empty($lastRecord->cost_us))
                        1
                    @elseif($lastRecord->ms == 'Yes')
                        1
                    @else
                        0
                    @endif
                </td>
                <td>
                    @if ($lastRecord->cost_ms != null)
                        {{ $lastRecord->cost_ms }}
                    @elseif($lastRecord->cost_us != null)
                        {{ $lastRecord->cost_us }}
                    @elseif($lastRecord->cost_ms == 0)
                        Compliment
                    @else
                        0
                    @endif
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>SMRT™ TREATMENT ({{ $lastRecord->manual_session }} Session: {{ $lastRecord->manual_session }}
                    Day
                    Traveling Including)</td>
                <td>{{ $lastRecord->manual_session }}</td>
                <td>{{ $lastRecord->cost_manual_session * $lastRecord->manual_session }}</td>
            </tr>


            <tr>
                <td>3</td>
                <td>
                    Ayurvedic Lep
                </td>
                <td>
                    @if (!empty($lastRecord->ayurvedic))
                        1
                    @else
                        0
                    @endif
                </td>
                <td>
                    @if (!empty($lastRecord->ayurvedic))
                        {{ $lastRecord->cost_ayurvedic }}
                    @else
                        0
                    @endif
                </td>
            </tr>
            <tr>
                <td>4</td>
                <td>
                    Assessment & Diet
                </td>
                <td>
                    @if (!empty($lastRecord->assessment))
                        1
                    @else
                        0
                    @endif
                </td>
                <td>
                    @if (!empty($lastRecord->assessment))
                        {{ $lastRecord->cost_assessment }}
                    @else
                        0
                    @endif
                </td>
            </tr>
            <tr>
                <td>5</td>
                <td>
                    Robotic Session Hand/Leg
                </td>
                <td>
                    @if (!empty($lastRecord->number_of_robotics))
                        {{ $lastRecord->number_of_robotics }}
                    @else
                        0
                    @endif
                </td>
                <td>
                    @if (!empty($lastRecord->number_of_robotics))
                        {{ $lastRecord->cost_of_robotic * $lastRecord->number_of_robotics }}
                    @else
                        0
                    @endif
                </td>
            </tr>
            <tr>
                <td>6</td>
                <td>Computerized Muscle Strength Examination</td>
                <td>
                    @if (!empty($lastRecord->cost_machine_test))
                        1
                    @else
                        0
                    @endif
                </td>
                <td>
                    @if (!empty($lastRecord->cost_machine_test))
                        {{ $lastRecord->cost_machine_test }}
                    @else
                        0
                    @endif
                </td>
            </tr>
            <tr>
                <td></td>
                <td>Total Amount</td>
                <td></td>
                <td> {{ $lastRecord->total_cost }}</td>
            </tr>
            <tr>
                <td></td>
                <td>Discount</td>
                <td></td>
                <td> {{ $lastRecord->given_discount }}</td>
            </tr>

            <tr>
                <td></td>
                <td><strong>Package Price</strong> </td>
                <td></td>
                <td><strong>{{ $lastRecord->package_price }}/- RS </strong></td>
            </tr>

            <!-- Add more rows as needed -->
        </tbody>
    </table>
    <h4 style="margin: 1rem 0 0 0">Terms & Conditions</h4>
    <span> <img src="{{ asset('images/stamp.png') }}" class="stampimg" alt="Stamp" width="120"></span> 

    <ul>
        <li>Subject to Bhandup Judiciar</li>
        <li>Cheque return penalty is 500</li>
        <li>Consumables will charged extra.</li>
        <li>Extra/top up treatment will be charged at extra premium.</li>
        <li>Exercise shall be followed Strictly.</li>
        <li>Results may vary person to person.</li>
        <li>Package is not transferable</li>
        <li>Devices delivered are not returnable under any circumstances.</li>
        <li>Additional test will result in additional charges and company will not bare the cost of any third party test
            treatment and admission.</li>
        <li>Misbehavior with doctors and company colleague will lead to immediate termination of services and incident
            will be reported</li>
        <li>Company Compliance team and immediate actions will be taken by legal team of company.</li>
        <li>We are happy to help you at our customer support operational between 12pm to 2pm on Monday and Tuesday only.
        </li>
        <li>Visiting Hour at Cardio Rescue is 10:00 AM to 05:00PM from Monday to Friday with Prior Appointment. </li>
        <li>The Above mentioned price are for the detailed services to be provided by the Company.</li>
        <li>In Case patient want to discontinue either from patient side or company side with the package provided to
            him/her the
            refund will be done after the deduction of the charges for the services already been provided which includes
            doctors
            and her assistant travelling from Bhandup to Patient Location from Patient Location to Bhandup ,
            transportation charges provided
            for the
            purpose of visit,visit charges of treatment and charges of no of muscle testing done and for the doctor
            visiting for the
            purpose of testing from Bhandup to Patient Location from Patient Location to Bhandup .</li>
        <li>Full Charges mentioned above will be applicable for the services and not on the discounted package amount in
            case of
            breech of package.</li>
        <li>In case the future instalment is not getting cleared on due dates the company has right to stop the
            treatment with
            immediate effect.</li>
        <li>In case of breech in package before the term period the machines provided to patient will not be taken back
            and charges
            will be applicable for the same as mentioned above in the invoice.</li>

        <!-- Add more list items as needed -->
    </ul>
</body>

</html>
