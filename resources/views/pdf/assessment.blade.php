<!DOCTYPE html>
<html lang="en">
@php

    if (!empty($lastRecord)) {
        $percentages = json_decode($lastRecord['percentage'], true);
        $session_num = json_decode($lastRecord['session_num'], true);
        $dr_name = json_decode($lastRecord['dr_name'], true);
        $diagnosis = json_decode($lastRecord['diagnosis'], true);
        $app_date = json_decode($lastRecord['app_date'], true);
    }
@endphp

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
    @php
        $sessionNums = json_decode($lastRecord->app_date);
        $lastSessionNum = !empty($sessionNums) ? end($sessionNums) : 'No Data available';
    @endphp
    <h4 class="date"> Date: @if (!empty($lastSessionNum))
            {{  \Carbon\Carbon::parse($lastSessionNum)->format('d M Y') }}
        @else
            No Record Found
        @endif
    </h4>
    <h4 class="Info" style="margin-top: 1rem">Name : {{ $lastRecord->name }}</h4>
    <h4 class="Info">Receipt No : CR0000{{ $lastRecord->patients_id }}</h4>


          <!--<img src="{{ asset($lastRecord->posture) }}" alt="Patients_Image" width="120">  -->
        
   <br><br>
    <h4>Current Medical History</h4>
    <p>{{ $lastRecord->current_status }}</p>
    <div style="overflow-x: auto; margin: 2px 0;">
        <table
            style="width: 100%; border-collapse: collapse; margin: 25px 0; font-size: 14px; text-align: left; box-shadow: 0 0 20px rgba(0, 0, 0, 0.15); border-radius: 5px; overflow: hidden;">
            <thead>
                <tr style="background-color: #350098; color: #0e0101;">
                    <th style="padding: 5px 10px;">INFORMATION</th>
                    <th style="padding: 5px 10px;">DETAIL'S</th>

                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Surgical History</td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->surgical_history }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Medical History</td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->medical_history }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Cervical Flexion </td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->cervical_flexion }}</td>
                </tr>

                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Cervical Extension</td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->cervical_extension }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Cervical SideFlexion</td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->cervical_sideFlexion }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Cervical Rotation </td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->cervical_rotation }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Shoulder Side </td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->shoulder_side }}</td>
                </tr>

                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Shoulder Flexion</td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->shoulder_flexion }}</td>
                </tr>

                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Shoulder Extension </td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->shoulder_extension }}</td>
                </tr>

                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Shoulder Adduction </td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->shoulder_adduction }}</td>
                </tr>

                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Shoulder Abduction</td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->shoulder_abduction }}</td>
                </tr>


                <!-- Add more rows as needed -->
            </tbody>
        </table>
        <h4 class="Info">ELBOW And WRIST</h4>
        <table
            style="width: 100%; border-collapse: collapse; margin: 25px 0; font-size: 14px; text-align: left; box-shadow: 0 0 20px rgba(0, 0, 0, 0.15); border-radius: 5px; overflow: hidden;">
            <thead>
                <tr style="background-color: #350098; color: #0e0101;">
                    <th style="padding: 5px 10px;">INFORMATION</th>
                    <th style="padding: 5px 10px;">DETAILS'S</th>

                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Elbow Side</td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->elbow_side }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Elbow Flexion</td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->elbow_flexion }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Elbow Extension</td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->elbow_extension }}</td>
                </tr>

                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Wrist Side</td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->wrist_side }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Wrist Flexion</td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->wrist_flexion }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Wrist Extension</td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->wrist_extension }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Shoulder Side </td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->shoulder_side }}</td>
                </tr>

                <!-- Add more rows as needed -->
            </tbody>
        </table>

        <h4 class="Info">Ulnar Deviation And Radial Deviation</h4>
        <table
            style="width: 100%; border-collapse: collapse; margin: 25px 0; font-size: 14px; text-align: left; box-shadow: 0 0 20px rgba(0, 0, 0, 0.15); border-radius: 5px; overflow: hidden;">
            <thead>
                <tr style="background-color: #350098; color: #0e0101;">
                    <th style="padding: 5px 10px;">INFORMATION</th>
                    <th style="padding: 5px 10px;">DETAILS'S</th>

                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Ulnar Deviation</td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->ulnar_deviation }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Radial Deviation</td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->radial_deviation }}</td>
                </tr>
                <!-- Add more rows as needed -->
            </tbody>
        </table>


        <h4 class="Info">Hip, knee And Ankle</h4>
        <table
            style="width: 100%; border-collapse: collapse; margin: 25px 0; font-size: 14px; text-align: left; box-shadow: 0 0 20px rgba(0, 0, 0, 0.15); border-radius: 5px; overflow: hidden;">
            <thead>
                <tr style="background-color: #350098; color: #0e0101;">
                    <th style="padding: 5px 10px;">INFORMATION</th>
                    <th style="padding: 5px 10px;">DETAILS'S</th>

                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Hip Side</td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->hip_side }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Hip Flexion</td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->hip_flexion }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Hip Extension</td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->hip_extension }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Hip Adduction</td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->hip_adduction }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Hip Abduction</td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->hip_abduction }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Knee Side</td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->knee_side }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Knee Flexion</td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->knee_flexion }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Knee Extension</td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->knee_extension }}</td>
                </tr>
                {{-- <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Knee Reflexes</td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->knee_reflexes }}</td>
                </tr> --}}
                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Ankle Side</td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->ankle_side }}</td>
                </tr>
                {{-- <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Ankle Reflexes</td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->ankle_reflexes }}</td>
                </tr> --}}
            </tbody>
        </table>


        <h4 class="Info">Dorsiflexion And Plantarflexion</h4>
        <table
            style="width: 100%; border-collapse: collapse; margin: 25px 0; font-size: 14px; text-align: left; box-shadow: 0 0 20px rgba(0, 0, 0, 0.15); border-radius: 5px; overflow: hidden;">
            <thead>
                <tr style="background-color: #350098; color: #0e0101;">
                    <th style="padding: 5px 10px;">INFORMATION</th>
                    <th style="padding: 5px 10px;">DETAILS'S</th>

                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Dorsiflexion</td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->dorsiflexion }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Plantarflexion</td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->plantarflexion }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">MMT</td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->mmt }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">MET</td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->met }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Right Upper Limb</td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->rt_upper_limb }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Left Upper Limb</td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->lt_upper_limb }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Right Lower Limb</td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->rt_lower_limb }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Left Lower Limb</td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->lt_lower_limb }}</td>
                </tr>

                <!-- Add more rows as needed -->
            </tbody>
        </table>


        <h4 class="Info">Reflexes</h4>
        <table
            style="width: 100%; border-collapse: collapse; margin: 25px 0; font-size: 14px; text-align: left; box-shadow: 0 0 20px rgba(0, 0, 0, 0.15); border-radius: 5px; overflow: hidden;">
            <thead>
                <tr style="background-color: #350098; color: #0e0101;">
                    <th style="padding: 5px 10px;">INFORMATION</th>
                    <th style="padding: 5px 10px;">DETAILS'S</th>

                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Bisceps Reflexes</td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->bisceps_reflexes }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Triceps Reflex</td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->triceps_reflex }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Brachioradialis Reflexes</td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->brachioradialis_reflexes }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Knee Reflexes</td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->knee_reflexes }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Ankle Reflexes</td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->ankle_reflexes }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Plantar Reflexes</td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->plantar_reflexes }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Balence Reflexes</td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->balence_reflexes }}</td>
                </tr>
            </tbody>
        </table>

        <h4 class="Info">Special Test</h4>
        <table
            style="width: 100%; border-collapse: collapse; margin: 25px 0; font-size: 14px; text-align: left; box-shadow: 0 0 20px rgba(0, 0, 0, 0.15); border-radius: 5px; overflow: hidden;">
            <thead>
                <tr style="background-color: #350098; color: #0e0101;">
                    <th style="padding: 5px 10px;">INFORMATION</th>
                    <th style="padding: 5px 10px;">DETAILS'S</th>

                </tr>
            </thead>
            <tbody>
                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Special Test</td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->special_test }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Pain Muscle Tone</td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->pain_muscle_tone }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Touch Muscle Tone</td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->touch_muscle_tone }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Temp Muscle Tone</td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->temp_muscle_tone }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Two Point Discrimination</td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->two_point_discrimination }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Baragnosis Muscle Tone</td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->baragnosis_muscle_tone }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Stregnosis Muscle Tone</td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->stregnosis_muscle_tone }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Gait</td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->gait }}</td>
                </tr>
                <tr style="border-bottom: 1px solid #dddddd;">
                    <td style="padding: 3px 15px;">Limb</td>
                    <td style="padding: 3px 15px;">{{ $lastRecord->limb }}</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div style="overflow-x: auto; margin: 20px 0;">
        <h4 class="Info">Assessment Details<span style="color: red">*</span></h4>

        <table
            style="width: 100%; border-collapse: collapse; margin: 25px 0; font-size: 12px; text-align: left; box-shadow: 0 0 20px rgba(0, 0, 0, 0.15); border-radius: 5px; overflow: hidden;">
            <thead>
                <tr style="background-color: #009879; color: #130606;">
                    <th style="padding: 8px 10px;">Doctor Name</th>
                    <th style="padding: 8px 10px;">Session No</th>
                    <th style="padding: 8px 10px;">Percentage</th>
                    <th style="padding: 8px 10px;">Diagnosis</th>
                    <th style="padding: 8px 10px;">Appointment Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($session_num as $index => $session_no)
                    <tr style="border-bottom: 1px solid #dddddd;">
                        <td style="padding: 8px 10px;"> {{ isset($dr_name[$index]) ? $dr_name[$index] : '' }}</td>
                        <td style="padding: 8px 10px;">{{ $session_no }}</td>
                        @php
                            $percentage = isset($percentages[$index]) ? $percentages[$index] : '0';
                        @endphp
                        <td style="padding: 8px 10px;">
                            @if ($percentage == '0')
                                Assessment
                            @else
                                {{ $percentage }}
                            @endif
                        </td>
                        <td style="padding: 8px 10px;">{{ isset($diagnosis[$index]) ? $diagnosis[$index] : '' }}</td>

 <td style="padding: 8px 10px;">{{ isset($app_date[$index]) ? \Carbon\Carbon::parse($app_date[$index])->format('d M Y, h:i A') : '' }}</td>
 </tr>
                @endforeach
            </tbody>
        </table>
    </div>








  <span> <img src="{{ asset('images/stamp.png') }}" class="stampimg" alt="Stamp" width="120"></span> 


</body>

</html>
