@extends('admin.dashboard.app')



@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Patint's List</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Patient's List</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Patient Name</th>
                                        <th>Patient Email</th>
                                        <th>Contact</th>
                                        <th>Suffering From</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($patientsLists as $patientsList)
                                        <tr>
                                            <td>{{ $patientsList->patientname }}</td>
                                            <td>{{ $patientsList->patientemail }}</td>
                                            <td>{{ $patientsList->patientphone }}</td>
                                            <td>
                                                @php
                                                $sufferingArray = explode(',', $patientsList->suffering); // Convert comma-separated string to array
                                            @endphp

                                            @foreach ($conditions as $condition)
                                                @if (in_array($condition->id, $sufferingArray))
                                                    {{ $condition->name }}@if (!$loop->last), @endif
                                                @endif
                                            @endforeach

                                            </td>
                                            <td>{{ $patientsList->created_at->format('d/m/Y') }}</td>
                                        </tr>
                                    @endforeach


                                </tbody>

                            </table>


                        </div>
                        <!-- /.card-body -->

                    </div>
                    <!-- /.card -->
                    {{ $patientsLists->links() }}


                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection
