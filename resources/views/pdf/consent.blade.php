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
            left: 38%;

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
            <img src="{{ asset('images/logo.webp') }}" alt="Your Company Logo" width="120" style="margin-top:-15px;"> 
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
    <h4 class="date"> Date: {{ \Carbon\Carbon::parse($data->start_date)->format('d M Y') }}</h4>
    <h4 class="Info" style="margin-top: 1rem">Name : &nbsp; {{ $data->name }} </h4>
    <h4 class="Info">Patient Id : &nbsp; CR0000{{ $data->patient_id }} </h4>

    <table>

    </table>
    <span>
        <!--<img src="{{ asset('images/stamp.png') }}" class="stampimg" alt="Stamp" width="120"></span>-->
        <h2 style="text-align: center; font-family: 'Arial', sans-serif;  color: #2C3E50;"> Patient Consent Form
        </h2>

        <div style="width: 100%; margin-top: 1.4rem; font-family: Arial, sans-serif;">
            <table
                style="width: 100%; border-collapse: collapse; font-size: 14px; table-layout: fixed; border-radius: 10px; overflow: hidden; background-color: #fff; box-shadow: 0 5px 10px rgba(0, 0, 0, 0.2); border: 1px solid #ddd;">
                <tbody>
                    <tr style="background-color: #f9f9f9;">
                        <td
                            style="padding: 12px; border-bottom: 1px solid #ddd; font-weight: bold; color: #333; border-right: 1px solid #ddd;">
                            CRN Number:</td>
                        <td
                            style="padding: 12px; border-bottom: 1px solid #ddd; color: #333; border-right: 1px solid #ddd;">
                            -----</td>
                        <td
                            style="padding: 12px; border-bottom: 1px solid #ddd; font-weight: bold; color: #333; border-right: 1px solid #ddd;">
                            Patient Name:</td>
                        <td style="padding: 12px; border-bottom: 1px solid #ddd; color: #333;">{{ $data->name }}</td>
                    </tr>
                    <tr>
                        <td
                            style="padding: 12px; border-bottom: 1px solid #ddd; font-weight: bold; color: #333; border-right: 1px solid #ddd;">
                            Name of Responsible Person:</td>
                        <td
                            style="padding: 12px; border-bottom: 1px solid #ddd; color: #333; border-right: 1px solid #ddd;">
                            -----</td>
                        <td
                            style="padding: 12px; border-bottom: 1px solid #ddd; font-weight: bold; color: #333; border-right: 1px solid #ddd;">
                            Address:</td>
                        <td style="padding: 12px; border-bottom: 1px solid #ddd; color: #333;">{{ $data->address }}</td>
                    </tr>
                    <tr style="background-color: #f9f9f9;">
                        <td
                            style="padding: 12px; border-bottom: 1px solid #ddd; font-weight: bold; color: #333; border-right: 1px solid #ddd;">
                            Age:</td>
                        <td
                            style="padding: 12px; border-bottom: 1px solid #ddd; color: #333; border-right: 1px solid #ddd;">
                            {{ $data->age }}</td>
                        <td
                            style="padding: 12px; border-bottom: 1px solid #ddd; font-weight: bold; color: #333; border-right: 1px solid #ddd;">
                            DOB:</td>
                        <td style="padding: 12px; border-bottom: 1px solid #ddd; color: #333;">-----</td>
                    </tr>
                    <tr>
                        <td
                            style="padding: 12px; border-bottom: 1px solid #ddd; font-weight: bold; color: #333; border-right: 1px solid #ddd;">
                            Procedure:</td>
                        <td
                            style="padding: 12px; border-bottom: 1px solid #ddd; color: #333; border-right: 1px solid #ddd;">
                            Physiotherapy, Rehabilitation, Naturopathy</td>
                        <td
                            style="padding: 12px; border-bottom: 1px solid #ddd; font-weight: bold; color: #333; border-right: 1px solid #ddd;">
                            Body Part:</td>
                        <td style="padding: 12px; border-bottom: 1px solid #ddd; color: #333;">{{ $data->body_part }}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>


        <div class="important-note" style="margin-top:1rem">
            <p><span class="highlight">Notice:</span> The mode of treatment, recovery rate of the patient at present,
                and future consequences may vary from patient to patient. Therefore, Cardio Rescue will not be held
                liable for any future consequences related to the treatment process. Additionally, the company will not
                be responsible for any financial settlements arising from treatment-related issues. The actual service
                provider company has hired the professionals to carry out the treatment procedures. So the Cardio Rescue
                or any person, agent working under it or acting through it will not be
                responsible for any kind of mishap, negligence on account of professionals during the course of
                treatment.</p>
        </div>

        <hr>

        <h4>Consent Confirmation</h4>
        <p>The procedure of treatment has been carefully explained to me in detail, in a language that I comprehend,
            and I have fully understood the treatment. I confirm to start the treatment. </p>

        <hr>
        <p>The procedure and process of treatment and its risks/benefits and expected duration of treatment and other
            relevant
            details of the treatment explained to me in details. I understand that my participation is voluntary and I
            am agreeing
            with the terms and conditions with the company. My treatment will start from <span
                style="color: #031c4b";><strong>{{ \Carbon\Carbon::parse($data->start_date)->format('d M Y') }}<strong></span>
            Will continue for <strong>{{ $data->number_of_session }}</strong>
            Number of Sessions <strong>{{ $data->session_in_day }}</strong>. Result may vary from person to person. </p>
        <p style="margin-left: 20%; margin-top:0.7rem;">The treatment will be given externally. the company will not be
            responsible for the </p>
        <p>changes in internal part after
            treatment. I acknowledge that if I wish to discontinue my treatment before completing the treatment
            procedure than
            I am fully responsible for the conditions/risk/happening in my body at that time of withdraw treatment. I am
            ready to
            acknowledge myself for the treatment/procedure after each and every aspect regarding the mode of treatment,
            risk
            factor if any is explained to me. Neither the company nor it's hired employee in any way will be considered
            responsible
            an will also not be liable for any sought of my compensation in future for treatment as they have completely
            made me
            aware with the treatment/procedure I am going to opt for. Due to current situation of pandemic the
            Therapist/Physiotherapist ,Ayurveda Doctor who will be coming at your house can be Physiotherapist with
            provisional
            Degree of physiotherapy, or Naturopath therapist or Ayurveda Doctor. </p>

        <p style="margin-top:0.7rem;">Depending on patient general condition as the
            <strong>{{ $data->describe_problem }}</strong> {{ $data->gender }} expected result for the
            patient
            may vary and the duration of time for desired result may also vary. In that case the charges for additional
            treatment to achieve the goals will be bear by patient only.
        </p>

        <p style="margin-top:0.7rem;">The treating Doctor, Therapist, Physiotherapist, Naturopath, Ayurveda Doctor are
            trained for treating
            chronic condition and for rehabilitation services only. In case of emergency condition the treating doctor,
            therapist , physiotherapist, Naturopath, Ayurveda Doctor will not be involved in any procedure of taking
            care
            of patient and patient will be referred for emergency healthcare professional by family or relatives
        </p>

        <p style="margin-top:0.7rem;">I am aware that I have <strong>{{ $data->aware_that }}</strong>. In case of event
            of death or any case of mishappening
            during the course of treatment doctor,therapist, Physiotherapist ,Naturopath, Ayurveda Doctor or
            organization will not be held responsible for the same by me or none of my relative.
        </p>

        <p style="margin-left: 20%;margin-top:0.7rem;"> This is to notify that I <strong>{{ $data->name }}</strong>
            is willing to undergo the treatment With
        </p>
        <p> Doctors, therapist,Naturopath, Physiotherapis, Ayurveda Doctor for my treatment of
            <strong>{{ $data->aware_that }}</strong>. The procedure
            of treatment along my condition has been explained to me. I have been made aware the condition from which
            I am suffering and it has been explained to me that this may affect my treatment and results also. The
            treatment
            is purely conducted from improving my quality of life and rehabilitation. The treatment will only help me
            with
            my daily activities.Other than my physical improvement treatment will not be provided for any other ailment
            of mine. and I will be solely responsible for the outcome of other ailment. Cardio Rescue or its
            Doctors,therapist,Naturopath, Physiotherapist, Ayurveda Doctor or organization will not be responsible for
            that.
        </p>

        <p style="margin-left: 20%;margin-top:0.7rem;"> I do give my consent to Doctors, therapist, Naturopath,
            Physiotherapist, Ayurveda</p>
        <p> Doctor to continue
            with treatment process and procedure after knowing fully about my condition.
        </p>
        <p>I have shared all the my medical history with the Ayurveda Doctor is true & authentic. I will be fully
            responsible for the consequences during/after course, if it is caused due to not sharing the required
            information with the doctor before.</p>
        <p style="margin-top:0.7rem;">The mode of treatment and it's risks / benefits and other relevant details of the
            treatment are explained to me
            in detail.
        </p>

        <p style="margin-top:0.7rem;">I have been explained the Snehan, Swedan procedures properly. Also Pathya and
            Apathya (Do's and Don'ts) in
            detail.
        </p>

        <p style="margin-top:0.7rem;">I acknowledge that if I wish to discontinue my treatment prior to expected
            duration and do not follow the
            instructions given by Ayurveda Doctor. I'm fully responsible for the condition further.
        </p>

        <p style="margin-top:0.7rem;">I will be fully responsible for the consequences or ineffectiveness of treatment,
            if not taking the proper pathya
            and Apathya, without proper procedures guided by the doctor.
        </p>

        <p style="margin-top:1.5rem;"><strong>Approved by Patient / Relative / Guardia</strong> </p>

        <p style="margin-top:1.5rem;">I <strong>{{ $data->name }}</strong> acknowledged that above information
            provided by me is correct. I further understand the
            procedure/treatment doesn’t involve any risk. Treatment process and doctor,therapist,Naturopath,
            Physiotherapist,
            Ayurveda Doctor which will be required for treatment will change as per requirement of patient. I agree to
            take part
            in the above treatment. </p>

        <table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
            <thead>
                <tr>
                    <th style="padding: 12px; border: 1px solid #ddd; background-color: #f4f4f4; text-align: left;">
                        Condition</th>
                    <th style="padding: 12px; border: 1px solid #ddd; background-color: #f4f4f4; text-align: left;">
                        Answer</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd;">If they attained the age of 18</td>
                    <td style="padding: 10px; border: 1px solid #ddd; color:  rgb(56, 54, 54); font-weight: bold;">Yes
                    </td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd;">Are of sound mind</td>
                    <td style="padding: 10px; border: 1px solid #ddd; color: rgb(56, 54, 54); font-weight: bold;">Yes
                    </td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd;">Consent has not been obtained by coercion,
                        undue-influence, mistake, misrepresentation, or fraud</td>
                    <td style="padding: 10px; border: 1px solid #ddd; color:  rgb(56, 54, 54); font-weight: bold;">Yes
                    </td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd;">If a child is involved or person below 18, they
                        understand what is involved in treatment</td>
                    <td style="padding: 10px; border: 1px solid #ddd; color:  rgb(56, 54, 54); font-weight: bold;">Yes
                    </td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd;">The procedure regarding treatment has been
                        clearly explained to me</td>
                    <td style="padding: 10px; border: 1px solid #ddd; color:  rgb(56, 54, 54); font-weight: bold;">Yes
                    </td>
                </tr>
                <tr>
                    <td style="padding: 10px; border: 1px solid #ddd;">If there are any changes including the knee part,
                        I am responsible for them</td>
                    <td style="padding: 10px; border: 1px solid #ddd; color:  rgb(56, 54, 54); font-weight: bold;">Yes
                    </td>
                </tr>
            </tbody>
        </table>


        <div
        style="width: 100%; border: 1px solid #ddd; padding: 20px; margin-top: 20px; font-family: Arial, sans-serif;">
        <p style="font-size: 16px; margin-bottom: 20px;">
            <strong>Consent Certification</strong>
        </p>

        <div style="margin-bottom: 20px;">
            <label style="display: inline-block; width: 80px; font-weight: bold;">Date:</label>
            <span style="border-bottom: 1px solid #ddd; padding: 0 10px;">{{ \Carbon\Carbon::parse($data->start_date)->format('d/m/Y') }}</span>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: inline-block; width: 150px; font-weight: bold;">(Signature/Thumb):</label>
             @if ($data->patient_signature)
               <img src="{{ $data->patient_signature }}" alt="Signature" style="max-width: 130px;"/>
            @else
                <span style="border-bottom: 1px solid #ddd; padding: 0 10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            @endif  
            
        </div>

        <div style="margin-bottom: 30px;">
            <label style="display: inline-block; width: 80px; font-weight: bold;">Place:</label>
            <span style="border-bottom: 1px solid #ddd; padding: 0 10px;">{{ $data->address }}</span>
        </div>

        <p style="font-size: 16px; margin-bottom: 20px;">
            This is certified that the above consent has been obtained in my presence.
        </p>

        <div style="margin-bottom: 20px;">
            <label style="display: inline-block; width: 80px; font-weight: bold;">Date:</label>
            <span style="border-bottom: 1px solid #ddd; padding: 0 10px;">{{ \Carbon\Carbon::parse($data->start_date)->format('d/m/Y') }}</span>
        </div>

        <div style="margin-bottom: 20px;">
            <label style="display: inline-block; width: 200px; font-weight: bold;">(Signature/Thumb of Witness):</label>
              @if ($data->patient_signature)
               <img src="{{ $data->patient_signature }}" alt="Signature" style="max-width: 130px;"/>
            @else
                <span style="border-bottom: 1px solid #ddd; padding: 0 10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
            @endif  
        </div>

        <div style="margin-bottom: 30px;">
            <label style="display: inline-block; width: 80px; font-weight: bold;">Place:</label>
            <span style="border-bottom: 1px solid #ddd; padding: 0 10px;">{{ $data->address }}</span>
        </div>

        <p style="font-size: 14px; color: #666;">
            <strong>Condition for Use:</strong> This form certifies that consent has been documented as per protocol.
        </p>
    </div>

        <div style="font-family: Arial, sans-serif; margin-top: 20px;">
            <p style="font-size: 10px; color: #666; line-height: 1.5;">
                <strong>The Signed Consent form will be valid for an indefinite period</strong>, consent form will
                automatically lapse when the purpose for which consent was obtained ceases to exist.
            </p>

            <p style="font-size: 12px; color: #666; line-height: 1.5;">
                <strong>We can include details or full names of any persons</strong> in an image on our website or in
                printed publications, with specific permission.
            </p>

            <p style="font-size: 12px; color: #666; line-height: 1.5;">
                <strong>The information obtained from patients</strong> can be used for research and development
                purposes, which will not affect the treatment process and their quality.
            </p>
        </div>



</body>

</html>
