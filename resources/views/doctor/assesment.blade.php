<!DOCTYPE html>
<html lang="en">
@php
    $patient = $patient_detail->first(); // Get the first patient from the collection
@endphp

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}

    <title>Patient Assessment</title>


    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/admin/dashboard/dist/css/adminlte.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/admin/dashboard/plugins/fontawesome-free/css/all.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"
        integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/dropzone.min.css"> --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

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
                    <div class="card card-info shadow">
                        @include('admin.message')

                        <div class="card-header">
                            <h3 class="card-title">Patient Assessment</h3>
                        </div>

                        <form method="post" patient_="assessmentForm" action="{{ route('assessment.store') }}"
                            enctype="multipart/form-data" name="assessmentForm">
                            @csrf
                            <div class="card-body row">
                                @foreach ($patient_detail as $patient)
                                    <input type="hidden" name="patients_id" class="form-control" id="patients_id"
                                        placeholder="Enter Patient Id" readonly value="{{ $patient->id }}">
                                @endforeach

                                <div class="form-group col-md-6">
                                    @if (!empty($patient_detail))
                                        @foreach ($patient_detail as $patient)
                                            <label for="age">Age</label>
                                            <input type="text" name="name" class="form-control" id="name"
                                                placeholder="Enter name" readonly value="{{ $patient->patient_name }}">
                                        @endforeach
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    @if (!empty($patient_detail))
                                        @foreach ($patient_detail as $patient)
                                            <label for="age">Age</label>
                                            <input type="text" name="age" class="form-control" id="age"
                                                placeholder="Enter Age" value="{{ $patient->date_of_birth }}" readonly>
                                        @endforeach
                                    @endif

                                </div>

                                <div class="form-group col-md-6">
                                    @if (!empty($patient_detail))
                                        <label>Gender</label>
                                        @foreach ($patient_detail as $patient)
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="male"
                                                    name="gender" {{ $patient->gender == 'Male' ? 'checked' : '' }}
                                                    value="Male">
                                                <label for="male" class="custom-control-label">Male</label>
                                            </div>
                                            <div class="custom-control custom-radio">
                                                <input class="custom-control-input" type="radio" id="female"
                                                    name="gender" {{ $patient->gender == 'Female' ? 'checked' : '' }}
                                                    value="Female">
                                                <label for="female" class="custom-control-label">Female</label>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Doctor Name</label>
                                    <input type="text" value="Dr. {{ auth()->user()->name }}" class="form-control"
                                        readonly name="dr_name[]">
                                    <span class="text-danger" id="dr_name-error">
                                        @error('dr_name')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Select Session No.</label>
                                    <select class="form-control @error('session_num') is-invalid @enderror"
                                        name="session_num[]" required>
                                        <option selected disabled>Session Numbers</option>
                                        <option value="0">Assessment</option>
                                    </select>
                                    <span class="text-danger" id="session_num-error">
                                        @error('session_num')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Appointment Date</label>
                                    <input type="datetime-local"
                                        class="form-control @error('app_date') is-invalid  @enderror" id="app_date"
                                        rows="2" name="app_date[]" placeholder="Enter app_date" required>
                                    <span class="text-danger" id="app_date-error">
                                        @error('app_date')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Percentage</label>
                                    <input type="text"
                                        class="form-control @error('percentage') is-invalid  @enderror" id="percentage"
                                        rows="2" name="percentage[]" placeholder="IF Assessment Enter 0" required>
                                    <span class="text-danger" id="percentage-error">
                                        @error('percentage')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Diagnosis</label>
                                    <textarea class="form-control @error('diagnosis') is-invalid  @enderror" id="diagnosis" rows="2"
                                        name="diagnosis[]" placeholder="Enter Diagnosis History" required></textarea>
                                    <span class="text-danger" id="diagnosis-error">
                                        @error('diagnosis')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Current Status*</label>
                                    <textarea class="form-control @error('current_status') is-invalid  @enderror" id="current_status" rows="2"
                                        name="current_status" placeholder="Enter History" required></textarea>
                                    <span class="text-danger" id="current_status-error">
                                        @error('current_status')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Surgical History</label>
                                    <textarea class="form-control @error('surgical_history') is-invalid  @enderror" id="surgical_history" rows="2"
                                        name="surgical_history" placeholder="Enter Surgical History">{{ old('surgical_history') }}</textarea>
                                    <span class="text-danger" id="surgical_history-error">
                                        @error('surgical_history')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Medical History</label>
                                    <textarea class="form-control @error('medical_history') is-invalid  @enderror" rows="2" id="medical_history"
                                        name="medical_history" placeholder="Enter Medical History">{{ old('medical_history') }}</textarea>
                                    <span class="text-danger" id="medical_history-error">
                                        @error('medical_history')
                                            {{ $message }}
                                        @enderror
                                    </span>

                                </div>

                                {{-- <div class="form-group col-md-6">
                                    <label for="posture">Posture</label>
                                    <input type="file" class="form-control" id="" name="posture[]"
                                        multiple>
                                    <input type="hidden" class="custom-file-input" id="posture" name="posture"
                                        value="Demo.Jpg">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="range_of_motion">Range of Motion</label>
                                    <input type="file" class="form-control" id="range_of_motion"
                                        name="range_of_motion[]" multiple>
                                    <input type="hidden" class="custom-file-input" id="range_of_motion[]"
                                        name="range_of_motion" value="Demo.Jpg">
                                </div> --}}
                            </div>

                            <hr>


                            <div class="card-body row">
                                <div class="form-group col-md-3">
                                    <label for="cervical_flexion">Cervical Flexion</label>
                                    <input type="text" name="cervical_flexion"
                                        class="form-control @error('cervical_flexion') is-invalid @enderror"
                                        id="cervical_flexion" placeholder="Enter Flexion"
                                        value="{{ old('cervical_flexion') }}">
                                    <span class="text-danger" id="cervical_extension-error">
                                        @error('cervical_flexion')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="cervical_extension">Cervical Extension</label>
                                    <input type="text" name="cervical_extension"
                                        class="form-control @error('cervical_extension') is-invalid @enderror"
                                        id="cervical_extension" placeholder="Enter Extension"
                                        value="{{ old('cervical_extension') }}">
                                    <span class="text-danger" id="cervical_extension-error">
                                        @error('cervical_extension')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="cervical_sideFlexion">Cervical SideFlexion</label>
                                    <input type="text" name="cervical_sideFlexion"
                                        class="form-control @error('cervical_sideFlexion') is-invalid @enderror"
                                        id="cervical_sideFlexion" placeholder="Enter SideFlexion"
                                        value="{{ old('cervical_sideFlexion') }}">
                                    <span class="text-danger" id="cervical_sideFlexion-error">
                                        @error('cervical_sideFlexion')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="cervical_rotation">Cervical Rotation</label>
                                    <input type="text" name="cervical_rotation"
                                        class="form-control @error('cervical_rotation') is-invalid @enderror"
                                        id="cervical_rotation" placeholder="Enter Rotation"
                                        value="{{ old('cervical_sideFlexion') }}">
                                    <span class="text-danger" id="cervical_rotation-error">
                                        @error('cervical_rotation')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="shoulder">Shoulder</label>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="shoulder_left"
                                            name="shoulder_side[]" value="Left Shoulder"
                                            {{ in_array('Left Shoulder', old('shoulder_side', [])) ? 'checked' : '' }}>
                                        <label for="shoulder_left" class="custom-control-label">Left</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="shoulder_right"
                                            name="shoulder_side[]" value="Right Shoulder"
                                            {{ in_array('Right Shoulder', old('shoulder_side', [])) ? 'checked' : '' }}>
                                        <label for="shoulder_right" class="custom-control-label">Right</label>
                                    </div>
                                    <span class="text-danger" id="shoulder_side-error">
                                        @error('shoulder_side')
                                            Please select at least one shoulder side.
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="shoulder_flexion">Shoulder Flexion</label>
                                    <input type="text" name="shoulder_flexion"
                                        class="form-control @error('shoulder_flexion') is-invalid @enderror"
                                        id="shoulder_flexion" placeholder="Enter Flexion"
                                        value="{{ old('shoulder_flexion') }}">
                                    <span class="text-danger" id="cervical_rotation-error">
                                        @error('shoulder_flexion')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="shoulder_extension">Shoulder Extension</label>
                                    <input type="text" name="shoulder_extension"
                                        class="form-control @error('shoulder_extension') is-invalid @enderror"
                                        id="shoulder_extension" placeholder="Enter Extension"
                                        value="{{ old('shoulder_extension') }}">
                                    <span class="text-danger" id="cervical_rotation-error">
                                        @error('shoulder_extension')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="shoulder_adduction">Shoulder Adduction</label>
                                    <input type="text" name="shoulder_adduction"
                                        class="form-control @error('shoulder_adduction') is-invalid @enderror"
                                        id="shoulder_adduction" placeholder="Enter Adduction"
                                        value="{{ old('shoulder_adduction') }}">
                                    <span class="text-danger" id="cervical_rotation-error">
                                        @error('shoulder_adduction')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="shoulder_abduction">Shoulder Abduction </label>
                                    <input type="text" name="shoulder_abduction"
                                        class="form-control @error('shoulder_abduction') is-invalid @enderror"
                                        id="shoulder_abduction" placeholder="Enter Abduction"
                                        value="{{ old('shoulder_abduction') }}">
                                    <span class="text-danger" id="cervical_rotation-error">
                                        @error('shoulder_abduction')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <hr>

                            <div class="card-body row">
                                <div class="form-group col-md-3">
                                    <label for="elbow">Elbow</label>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="elbow_left"
                                            name="elbow_side[]" value="Left Elbow"
                                            {{ in_array('Left Elbow', old('elbow_side', [])) ? 'checked' : '' }}>
                                        <label for="elbow_left" class="custom-control-label">Left</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="elbow_right"
                                            name="elbow_side[]" value="Right Elbow"
                                            {{ in_array('Right Elbow', old('elbow_side', [])) ? 'checked' : '' }}>
                                        <label for="elbow_right" class="custom-control-label">Right</label>
                                    </div>
                                    <span class="text-danger" id="elbow_side-error">
                                        @error('elbow_side')
                                            Please select at least one Elbow side.
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="elbow_flexion">Elbow Flexion</label>
                                    <input type="text" name="elbow_flexion"
                                        class="form-control @error('elbow_flexion') is-invalid @enderror"
                                        id="elbow_flexion" placeholder="Enter Flexion"
                                        value="{{ old('elbow_flexion') }}">
                                    <span class="text-danger" id="elbow_flexion-error">
                                        @error('elbow_flexion')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="elbow_extension">Elbow Extension</label>
                                    <input type="text" name="elbow_extension"
                                        class="form-control @error('elbow_extension') is-invalid @enderror"
                                        id="elbow_extension" placeholder="Enter Extension"
                                        value="{{ old('elbow_extension') }}">
                                    <span class="text-danger" id="elbow_extension-error">
                                        @error('elbow_extension')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="wrist">Wrist</label>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="wrist_left"
                                            name="wrist_side[]" value="Left Wrist"
                                            {{ in_array('Left Wrist', old('wrist_side', [])) ? 'checked' : '' }}>
                                        <label for="wrist_left" class="custom-control-label">Left</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="wrist_right"
                                            name="wrist_side[]" value="Right Wrist"
                                            {{ in_array('Right Wrist', old('wrist_side', [])) ? 'checked' : '' }}>
                                        <label for="wrist_right" class="custom-control-label">Right</label>
                                    </div>
                                    <span class="text-danger" id="wrist_side-error">
                                        @error('wrist_side')
                                            Please select at least one Wrist side.
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="wrist_flexion">Wrist Flexion</label>
                                    <input type="text" name="wrist_flexion"
                                        class="form-control @error('wrist_flexion') is-invalid @enderror"
                                        id="wrist_flexion" placeholder="Enter Flexion"
                                        value="{{ old('wrist_flexion') }}">
                                    <span class="text-danger" id="wrist_flexion-error">
                                        @error('wrist_flexion')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="wrist_extension">Wrist Extension</label>
                                    <input type="text" name="wrist_extension"
                                        class="form-control @error('wrist_extension') is-invalid @enderror"
                                        id="wrist_extension" placeholder="Enter Extension"
                                        value="{{ old('wrist_extension') }}">
                                    <span class="text-danger" id="wrist_extension-error">
                                        @error('wrist_extension')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="ulnar_deviation">Ulnar Deviation</label>
                                    <input type="text" name="ulnar_deviation"
                                        class="form-control @error('ulnar_deviation') is-invalid @enderror"
                                        id="ulnar_deviation" placeholder="Enter Deviation"
                                        value="{{ old('ulnar_deviation') }}">
                                    <span class="text-danger" id="ulnar_deviation-error">
                                        @error('ulnar_deviation')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="radial_deviation">Radial Deviation</label>
                                    <input type="text" name="radial_deviation"
                                        class="form-control @error('radial_deviation') is-invalid @enderror"
                                        id="radial_deviation" placeholder="Enter Deviation"
                                        value="{{ old('radial_deviation') }}">
                                    <span class="text-danger" id="radial_deviation-error">
                                        @error('radial_deviation')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                            </div>

                            <hr>

                            <div class="card-body row">
                                <div class="form-group col-md-3">
                                    <label for="hip">Hip</label>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="hip_left"
                                            {{ in_array('Left Hip', old('hip_side', [])) ? 'checked' : '' }}
                                            name="hip_side[]" value="Left Hip">
                                        <label for="hip_left" class="custom-control-label">Left</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="hip_right"
                                            {{ in_array('Right Hip', old('hip_side', [])) ? 'checked' : '' }}
                                            name="hip_side[]" value="Right Hip">
                                        <label for="hip_right" class="custom-control-label">Right</label>
                                    </div>
                                    <span class="text-danger" id="hip_side-error">
                                        @error('hip_side')
                                            Please select at least one Hip side.
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="hip_flexion">Hip Flexion</label>
                                    <input type="text" name="hip_flexion"
                                        class="form-control @error('hip_flexion') is-invalid @enderror"
                                        id="hip_flexion" placeholder="Enter Flexion"
                                        value="{{ old('hip_flexion') }}">
                                    <span class="text-danger" id="hip_flexion-error">
                                        @error('hip_flexion')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="hip_extension">Hip Extension</label>
                                    <input type="text" name="hip_extension"
                                        class="form-control @error('hip_extension') is-invalid @enderror"
                                        id="hip_extension" placeholder="Enter Extension"
                                        value="{{ old('hip_extension') }}">
                                    <span class="text-danger" id="hip_extension-error">
                                        @error('hip_extension')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="hip_adduction">Hip Adduction</label>
                                    <input type="text" name="hip_adduction"
                                        class="form-control @error('hip_adduction') is-invalid @enderror"
                                        id="hip_adduction" placeholder="Enter Adduction"
                                        value="{{ old('hip_adduction') }}">
                                    <span class="text-danger" id="hip_adduction-error">
                                        @error('hip_adduction')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="hip_abduction">Hip Abduction </label>
                                    <input type="text" name="hip_abduction"
                                        class="form-control @error('hip_abduction') is-invalid @enderror"
                                        id="hip_abduction" placeholder="Enter Abduction"
                                        value="{{ old('hip_abduction') }}">
                                    <span class="text-danger" id="hip_abduction-error">
                                        @error('hip_abduction')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>
                            <hr>

                            <div class="card-body row">
                                <div class="form-group col-md-3">
                                    <label for="knee">Knee</label>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="left_knee"
                                            name="knee_side[]" value="Left Knee"
                                            {{ in_array('Left Knee', old('knee_side', [])) ? 'checked' : '' }}>
                                        <label for="left_knee" class="custom-control-label">Left</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="knee_right"
                                            name="knee_side[]" value="Right Knee"
                                            {{ in_array('Right Knee', old('knee_side', [])) ? 'checked' : '' }}>
                                        <label for="knee_right" class="custom-control-label">Right</label>
                                    </div>
                                    <span class="text-danger" id="knee_side-error">
                                        @error('knee_side')
                                            Please select at least one Knee side.
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="knee_flexion">Knee Flexion</label>
                                    <input type="text" name="knee_flexion"
                                        class="form-control @error('knee_flexion') is-invalid @enderror"
                                        id="knee_flexion" placeholder="Enter Flexion"
                                        value="{{ old('knee_flexion') }}">
                                    <span class="text-danger" id="knee_flexion-error">
                                        @error('knee_flexion')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="knee_extension">Knee Extension</label>
                                    <input type="text" name="knee_extension"
                                        class="form-control @error('knee_extension') is-invalid @enderror"
                                        value="{{ old('knee_extension') }}" id="knee_extension"
                                        placeholder="Enter Extension">
                                    <span class="text-danger" id="knee_extension-error">
                                        @error('knee_extension')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="ankle">Ankle</label>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="ankle_left"
                                            {{ in_array('Left Ankle', old('ankle_side', [])) ? 'checked' : '' }}
                                            name="ankle_side[]" value="Left Ankle">
                                        <label for="ankle_left" class="custom-control-label">Left</label>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input class="custom-control-input" type="checkbox" id="ankle_right"
                                            {{ in_array('Right Ankle', old('ankle_side', [])) ? 'checked' : '' }}
                                            name="ankle_side[]" value="Right Ankle">
                                        <label for="ankle_right" class="custom-control-label">Right</label>
                                    </div>
                                    <span class="text-danger" id="ankle_side-error">
                                        @error('ankle_side')
                                            Please select at least one Ankle side.
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="dorsiflexion">Dorsiflexion</label>
                                    <input type="text" name="dorsiflexion"
                                        class="form-control @error('dorsiflexion') is-invalid @enderror"
                                        id="dorsiflexion" placeholder="Enter Dorsiflexion"
                                        value="{{ old('dorsiflexion') }}">
                                    <span class="text-danger" id="dorsiflexion-error">
                                        @error('dorsiflexion')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-4">
                                    <label for="plantarflexion">Plantarflexion</label>
                                    <input type="text" name="plantarflexion"
                                        class="form-control @error('plantarflexion') is-invalid @enderror"
                                        id="plantarflexion" placeholder="Enter Plantarflexion"
                                        value="{{ old('plantarflexion') }}">
                                    <span class="text-danger" id="plantarflexionx-error">
                                        @error('plantarflexion')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>
                            </div>

                            <hr>

                            <div class="card-body row">

                                <div class="form-group col-md-6">
                                    <label>MMT (Manual Muscle Testing)</label>
                                    <textarea class="form-control @error('mmt') is-invalid @enderror" rows="2" name="mmt"
                                        placeholder="Enter Manual Muscle Testing">{{ old('mmt') }}</textarea>
                                    <span class="text-danger" id="mmt-error">
                                        @error('mmt')
                                            Enter Manual Muscle Testing Details
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>MET (Muscle Energy Technique)</label>
                                    <textarea class="form-control @error('met') is-invalid @enderror" rows="2" name="met"
                                        placeholder="Enter Gradings">{{ old('met') }}</textarea>
                                    <span class="text-danger" id="mmt-error">
                                        @error('mmt')
                                            Enter Muscle Energy Technique Details
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="rt_upper_limb">Right Upper Limb</label>
                                    <input type="text" name="rt_upper_limb"
                                        class="form-control @error('rt_upper_limb') is-invalid @enderror"
                                        id="rt_upper_limb" value="{{ old('rt_upper_limb') }}"
                                        placeholder="Enter Muscle Tone">
                                    <span class="text-danger" id="rt_upper_limb-error">
                                        @error('rt_upper_limb')
                                            The Right Upper Limb field is required.
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="lt_upper_limb">Left Upper Limb</label>
                                    <input type="text" name="lt_upper_limb"
                                        class="form-control @error('lt_upper_limb') is-invalid @enderror"
                                        id="lt_upper_limb" value="{{ old('lt_upper_limb') }}"
                                        placeholder="Enter Muscle Tone">
                                    <span class="text-danger" id="lt_upper_limb-error">
                                        @error('lt_upper_limb')
                                            The Left Upper Limb field is required.
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="rt_lower_limb">Right Lower Limb</label>
                                    <input type="text" name="rt_lower_limb"
                                        class="form-control @error('rt_lower_limb') is-invalid @enderror"
                                        id="rt_lower_limb" value="{{ old('rt_lower_limb') }}"
                                        placeholder="Enter Muscle Tone">
                                    <span class="text-danger" id="rt_lower_limb-error">
                                        @error('rt_lower_limb')
                                            The Right Lower Limb field is required.
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="lt_lower_limb">Left Lower Limb</label>
                                    <input type="text" name="lt_lower_limb"
                                        class="form-control @error('lt_lower_limb') is-invalid @enderror"
                                        id="lt_lower_limb" value="{{ old('lt_lower_limb') }}"
                                        placeholder="Enter Muscle Tone">
                                    <span class="text-danger" id="lt_lower_limb-error">
                                        @error('lt_lower_limb')
                                            The Left Lower Limb field is required.
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-12">
                                    <h4 class="text-primary">Reflexes</h4>
                                </div>

                                <div class="form-group col-md-2">
                                    <label>Bisceps</label>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="bisceps_absent"
                                            name="bisceps_reflexes" value="Absent"
                                            {{ old('bisceps_reflexes') === 'Absent' ? 'checked' : '' }}>
                                        <label for="bisceps_absent" class="custom-control-label">Absent</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="bisceps_present"
                                            name="bisceps_reflexes" value="Present"
                                            {{ old('bisceps_reflexes') === 'Present' ? 'checked' : '' }}>
                                        <label for="bisceps_present" class="custom-control-label">Present</label>
                                    </div>
                                    <span class="text-danger" id="bisceps_reflexes-error">
                                        @error('bisceps_reflexes')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-2">
                                    <label>Triceps</label>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="triceps_absent"
                                            name="triceps_reflex" value="Absent"
                                            {{ old('triceps_reflex') === 'Absent' ? 'checked' : '' }}>
                                        <label for="triceps_absent" class="custom-control-label">Absent</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="triceps_present"
                                            name="triceps_reflex" value="Present"
                                            {{ old('triceps_reflex') === 'Present' ? 'checked' : '' }}>
                                        <label for="triceps_present" class="custom-control-label">Present</label>
                                    </div>
                                    <span class="text-danger" id="triceps_reflex-error">
                                        @error('triceps_reflex')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>


                                <div class="form-group col-md-2">
                                    <label>Brachioradialis</label>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio"
                                            id="brachioradialis_absent" name="brachioradialis_reflexes"
                                            value="Absent"
                                            {{ old('brachioradialis_reflexes') === 'Absent' ? 'checked' : '' }}>
                                        <label for="brachioradialis_absent"
                                            class="custom-control-label">Absent</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio"
                                            id="brachioradialis_present" name="brachioradialis_reflexes"
                                            value="Present"
                                            {{ old('brachioradialis_reflexes') === 'Present' ? 'checked' : '' }}>
                                        <label for="brachioradialis_present"
                                            class="custom-control-label">Present</label>
                                    </div>
                                    <span class="text-danger" id="bisceps_reflexes-error">
                                        @error('brachioradialis_reflexes')
                                            Select One*
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-2">
                                    <label>Knee</label>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="knee_absent"
                                            name="knee_reflexes" value="Absent"
                                            {{ old('knee_reflexes') === 'Absent' ? 'checked' : '' }}>
                                        <label for="knee_absent" class="custom-control-label">Absent</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="knee_present"
                                            name="knee_reflexes" value="Present"
                                            {{ old('knee_reflexes') === 'Present' ? 'checked' : '' }}>
                                        <label for="knee_present" class="custom-control-label">Present</label>
                                    </div>
                                    <span class="text-danger" id="knee_reflexes-error">
                                        @error('knee_reflexes')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-2">
                                    <label>Ankle</label>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="ankle_absent"
                                            name="ankle_reflexes" value="Absent"
                                            {{ old('ankle_reflexes') === 'Absent' ? 'checked' : '' }}>
                                        <label for="ankle_absent" class="custom-control-label">Absent</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="ankle_present"
                                            name="ankle_reflexes" value="Present"
                                            {{ old('ankle_reflexes') === 'Present' ? 'checked' : '' }}>
                                        <label for="ankle_present" class="custom-control-label">Present</label>
                                    </div>
                                    <span class="text-danger" id="ankle_reflexes-error">
                                        @error('ankle_reflexes')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-2">
                                    <label>Plantar </label>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="plantar_absent"
                                            name="plantar_reflexes" value="Absent"
                                            {{ old('plantar_reflexes') === 'Absent' ? 'checked' : '' }}>
                                        <label for="plantar_absent" class="custom-control-label">Absent</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="plantar_present"
                                            name="plantar_reflexes" value="Present"
                                            {{ old('plantar_reflexes') === 'Present' ? 'checked' : '' }}>
                                        <label for="plantar_present" class="custom-control-label">Present</label>
                                    </div>
                                    <span class="text-danger" id="plantar_reflexes-error">
                                        @error('plantar_reflexes')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Balence</label>
                                    <textarea class="form-control @error('balence_reflexes') is-invalid @enderror" rows="2"
                                        name="balence_reflexes" placeholder="Romberq Test ">{{ old('balence_reflexes') }}</textarea>
                                    <span class="text-danger" id="balence_reflexes-error">
                                        @error('balence_reflexes')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Special Test</label>
                                    <textarea class="form-control @error('special_test') is-invalid @enderror" rows="2" name="special_test"
                                        placeholder="Enter Test">{{ old('special_test') }}</textarea>
                                    <span class="text-danger" id="special_test-error">
                                        @error('special_test')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-12">
                                    <h4 class="text-primary">Sensaction</h4>
                                </div>
                                <div class="form-group col-md-12">
                                    <h5 class="">(A) Superficial</h5>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="pain_muscle_tone">Pain</label>
                                    <input type="text" name="pain_muscle_tone"
                                        class="form-control @error('pain_muscle_tone') is-invalid @enderror"
                                        value="{{ old('pain_muscle_tone') }}" id="pain_muscle_tone"
                                        placeholder="Enter Muscle Tone">
                                    <span class="text-danger" id="pain_muscle_tone-error">
                                        @error('pain_muscle_tone')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="touch_muscle_tone">Touch</label>
                                    <input type="text" name="touch_muscle_tone"
                                        class="form-control @error('touch_muscle_tone') is-invalid @enderror"
                                        value="{{ old('touch_muscle_tone') }}" id="touch_muscle_tone"
                                        placeholder="Enter Muscle Tone">
                                    <span class="text-danger" id="touch_muscle_tone-error">
                                        @error('touch_muscle_tone')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="temp_muscle_tone">Temp</label>
                                    <input type="text" name="temp_muscle_tone"
                                        class="form-control @error('temp_muscle_tone') is-invalid @enderror"
                                        value="{{ old('temp_muscle_tone') }}" id="temp_muscle_tone"
                                        placeholder="Enter Muscle Tone">
                                    <span class="text-danger" id="temp_muscle_tone-error">
                                        @error('temp_muscle_tone')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="two_point_discrimination">2 Point Discrimination</label>
                                    <input type="text" name="two_point_discrimination"
                                        class="form-control @error('two_point_discrimination') is-invalid @enderror"
                                        value="{{ old('two_point_discrimination') }}" id="two_point_discrimination"
                                        placeholder="Enter Muscle Tone">
                                    <span class="text-danger" id="two_point_discrimination-error">
                                        @error('two_point_discrimination')
                                            The Discrimination field is required.
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-12">
                                    <h5 class="">(B) Combined Cortical</h5>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="baragnosis_muscle_tone">Baragnosis</label>
                                    <input type="text" name="baragnosis_muscle_tone"
                                        class="form-control @error('baragnosis_muscle_tone') is-invalid @enderror"
                                        id="baragnosis_muscle_tone" placeholder="Enter Muscle Tone"
                                        value="{{ old('baragnosis_muscle_tone') }}">
                                    <span class="text-danger" id="baragnosis_muscle_tone-error">
                                        @error('baragnosis_muscle_tone')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="stregnosis_muscle_tone">Stregnosis</label>
                                    <input type="text" name="stregnosis_muscle_tone"
                                        class="form-control @error('stregnosis_muscle_tone') is-invalid @enderror"
                                        id="stregnosis_muscle_tone" placeholder="Enter Muscle Tone"
                                        value="{{ old('stregnosis_muscle_tone') }}">
                                    <span class="text-danger" id="stregnosis_muscle_tone-error">
                                        @error('stregnosis_muscle_tone')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Gait</label>
                                    <textarea class="form-control @error('gait') is-invalid @enderror" rows="2" name="gait"
                                        placeholder="Romberq Test ">{{ old('gait') }}</textarea>
                                    <span class="text-danger" id="gait-error">
                                        @error('gait')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Limb Length & Limb Girth</label>
                                    <textarea class="form-control @error('limb') is-invalid @enderror" rows="2" name="limb"
                                        placeholder="Enter Test">{{ old('limb') }}</textarea>
                                    <span class="text-danger" id="limb-error">
                                        @error('limb')
                                            {{ $message }}
                                        @enderror
                                    </span>
                                </div>

                                {{-- <div class="form-group col-md-6">
                                    <label for="investigation">Investigation (Multiple)</label>

                                    <input type="file" class="form-control" id="investigation"
                                        name="investigation[]" multiple>
                                    <input type="hidden" class="custom-file-input" id="investigation"
                                        name="investigation" value="Demo.Jpg">

                                </div>
                                <div class="form-group col-md-6">
                                    <label for="mri">M R I (Single)</label>
                                    <input type="file" class="form-control" id="mri" name="mri[]"
                                        multiple>
                                    <input type="hidden" class="custom-file-input" id="mri" name="mri"
                                        value="Demo.Jpg">

                                </div>
                                <div class="form-group col-md-6">
                                    <label for="x_ray">X-ray (Single)</label>

                                    <input type="file" class="form-control" id="x_ray" name="x_ray[]"
                                        multiple>
                                    <input type="hidden" class="custom-file-input" id="x_ray" name="x_ray"
                                        value="Demo.Jpg">

                                </div> --}}
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>





</body>

<script>
    $(document).ready(function() {
        $('#name_values').on('input', function() {
            var sourceValue = $('#name_values').val(sourceValue);
            $('#age').val(sourceValue);
        });
    });
</script>



</html>
