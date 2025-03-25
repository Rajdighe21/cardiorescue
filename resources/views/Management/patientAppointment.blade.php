@extends('Management.layouts.app')

@section('mainContent')
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center flex-wrap">
                        <h6 class="mb-0">
                            <a href="{{ route('manage.dashboard') }}" class="opacity-9 text-primary">BACK</a>
                        </h6>
                        <div class="d-flex align-items-center flex-wrap">
                            <form action="{{ route('appointmentSrch') }}" method="post"
                                class="d-flex align-items-center flex-wrap">
                                @csrf
                                <input type="text" class="form-control me-2 mb-2 mb-sm-0" name="appointmentSrch"
                                    placeholder="Search..." style="width: 200px;">


                                <button class="btn btn-primary me-2 mb-2 mb-sm-0" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>


                                <a href="{{ route('manage.bookApp') }}" class="mb-2 mb-sm-0">
                                    <button class="btn btn-secondary mt-3" type="button">
                                        Clear
                                    </button>
                                </a>
                            </form>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Patient Name</th>
                                        <th
                                            class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Registraion Date</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Contact</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Session Num's</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Package Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (!empty($patient_lists) && $patient_lists->count())
                                        @foreach ($patient_lists as $patient_list)
                                            <tr>
                                                <td>
                                                    <div class="d-flex px-2 py-1">


                                                        <div class="d-flex flex-column justify-content-center">
                                                            <h6 class="mb-0 text-sm">{{ $patient_list->patient_name }}</h6>
                                                            <p class="text-xs text-secondary mb-0">
                                                                CR0000{{ $patient_list->id }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <p class="text-xs font-weight-bold mb-0">{{ \Carbon\Carbon::parse($patient_list->regi_date)->format('d/m/Y, h:i A') }}
                                                    </p>
                                                </td>
                                                <td class="align-middle text-center text-sm">
                                                    <p class="text-xs font-weight-bold mb-0">{{ $patient_list->contact }}
                                                    </p>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold">
                                                        @if (!empty($patient_list->session_numbers))
                                                            {{ $patient_list->session_numbers }}
                                                        @else
                                                            No Record Found
                                                        @endif
                                                    </span>
                                                </td>
                                                <td class="align-middle text-center">
                                                    <span class="text-secondary text-xs font-weight-bold">
                                                        @if (!empty($patient_list->package_price))
                                                            {{ $patient_list->package_price }}
                                                        @else
                                                            No Record Found
                                                        @endif
                                                    </span>
                                                </td>
                                                <td class="align-middle ">
                                                    <a href="{{ route('manage.doctorApp',$patient_list->id) }}"> <span
                                                            class="ni ni-calendar-grid-58 text-primary p-1">
                                                            Book </span> </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="7"
                                                style="text-align: center; padding: 10px; font-weight: bold;">No patient
                                                records found</td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="m-1"> {{ $patient_lists->links() }}</div>

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
                            <a href="https://www.cardiorescue.in" class="font-weight-bold" target="_blank">Cardio Rescue
                                Team</a>

                        </div>
                    </div>

                </div>
            </div>
        </footer>
    </div>
    </main>
@endsection
