@extends('Management.layouts.app')

@section('mainContent')
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                  @if (Session::has('success'))
                <h6 class="alert alert-success text-white">{{ Session::get('success') }}</h6>
            @endif
                <div class="card mb-4">
                    <div class="card-header pb-0 d-flex justify-content-between align-items-center flex-wrap">
                        <h6 class="m-0">
                            <a href="{{ route('manage.dashboard') }}" class="opacity-9 text-seconday">Back </a>
                        </h6>
                        <div class="d-flex align-items-center flex-wrap">
                            <h3 class="text-primary shadow fw-bold mb-0 me-3 p-1 rounded">Consent</h3>

                            <form action="{{ route('consentSrch') }}" method="post"
                                class="d-flex align-items-center flex-wrap">
                                @csrf
                                <input type="text" class="form-control me-2 mb-2 mb-sm-0" name="consentSrch"
                                    placeholder="Search..." style="width: 200px;">


                                <button class="btn btn-primary me-2 mb-2 mb-sm-0" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>


                                <a href="{{ route('manage.consent') }}" class="mb-2 mb-sm-0">
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
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Contact</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Session Num's</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Package Price</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Location</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($patient_lists as $patient_list)
                                        <tr>
                                            <td>
                                                <div class="d-flex px-2 py-1">


                                                    <div class="d-flex flex-column justify-content-center">
                                                        <h6 class="mb-0 text-sm">{{ $patient_list->patient_name }}</h6>
                                                        <p class="text-xs text-secondary mb-0">CR0000{{ $patient_list->id }}
                                                        </p>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="align-middle text-center text-sm">
                                                <p class="text-xs font-weight-bold mb-0">{{ $patient_list->contact }}</p>
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
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">
                                                    @if (!empty($patient_list->location))
                                                        {{ $patient_list->location }}
                                                    @else
                                                        No Record Found
                                                    @endif
                                                </span>
                                            </td>
                                            <td class="align-middle ">
                                                @php
                                                    $consent = $consents->firstWhere('patient_id', $patient_list->id);
                                                @endphp
                                                <a href="{{ route('manage.addConsent', $patient_list->id) }}">
                                                    <i class="ni ni-fat-add  text-primary  p-2 shadow rounded"></i>
                                                </a>
                                                @if ($consent)
                                                    <a href="{{ route('manage.consentPdf', $patient_list->id) }}">
                                                        <i
                                                            class="ni ni-cloud-download-95  text-primary  p-1 shadow rounded"></i>
                                                    </a>
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
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
