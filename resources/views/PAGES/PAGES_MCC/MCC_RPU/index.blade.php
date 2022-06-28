@extends('layouts.master')
@section('title') @lang('translation.analytics') @endsection
@section('css')

<link href="{{ URL::asset('assets/libs/jsvectormap/jsvectormap.min.css') }}" rel="stylesheet">

@endsection
@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">{{ $passing['title-page'] }}</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ $passing['title'] }}</a></li>
                    {{-- @if(isset($title))
                        <li class="breadcrumb-item active">{{ $title }}</li>
                    @endif --}}
                </ol>
            </div>

        </div>
    </div>
</div>

{{-- <div class="row">
    <div class="col-xl-12">
        <div class="card crm-widget">
            <div class="card-body p-0">
                <div class="row row-cols-md-3 row-cols-1">
                    <div class="col col-lg border-end">
                        <div class="py-4 px-3">
                            <h5 class="text-muted text-uppercase fs-13">Campaign Sent <i
                                    class="ri-arrow-up-circle-line text-success fs-18 float-end align-middle"></i>
                            </h5>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="ri-space-ship-line display-6 text-muted"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h2 class="mb-0"><span class="counter-value" data-target="197">197</span></h2>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col -->
                    <div class="col col-lg border-end">
                        <div class="mt-3 mt-md-0 py-4 px-3">
                            <h5 class="text-muted text-uppercase fs-13">Annual Profit <i
                                    class="ri-arrow-up-circle-line text-success fs-18 float-end align-middle"></i></h5>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="ri-exchange-dollar-line display-6 text-muted"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h2 class="mb-0">$<span class="counter-value" data-target="489.4">489.4</span>k</h2>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col -->
                    <div class="col col-lg border-end">
                        <div class="mt-3 mt-md-0 py-4 px-3">
                            <h5 class="text-muted text-uppercase fs-13">
                                Lead Coversation <i
                                    class="ri-arrow-down-circle-line text-danger fs-18 float-end align-middle"></i>
                            </h5>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="ri-pulse-line display-6 text-muted"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h2 class="mb-0"><span class="counter-value" data-target="32.89">32.89</span>%</h2>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col -->
                    <div class="col col-lg border-end">
                        <div class="mt-3 mt-lg-0 py-4 px-3">
                            <h5 class="text-muted text-uppercase fs-13">
                                Daily Average Income <i
                                    class="ri-arrow-up-circle-line text-success fs-18 float-end align-middle"></i>
                            </h5>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="ri-trophy-line display-6 text-muted"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h2 class="mb-0">$<span class="counter-value" data-target="1596.5">1,596.5</span>
                                    </h2>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col -->
                    <div class="col col-lg">
                        <div class="mt-3 mt-lg-0 py-4 px-3">
                            <h5 class="text-muted text-uppercase fs-13">
                                Annual Deals <i
                                    class="ri-arrow-down-circle-line text-danger fs-18 float-end align-middle"></i>
                            </h5>
                            <div class="d-flex align-items-center">
                                <div class="flex-shrink-0">
                                    <i class="ri-service-line display-6 text-muted"></i>
                                </div>
                                <div class="flex-grow-1 ms-3">
                                    <h2 class="mb-0"><span class="counter-value" data-target="2659">2,659</span></h2>
                                </div>
                            </div>
                        </div>
                    </div><!-- end col -->
                </div><!-- end row -->
            </div><!-- end card body -->
        </div><!-- end card -->
    </div><!-- end col -->
</div> --}}

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                <div class="col-6">
                    <h5 class="card-title mb-0">Daftar Request Perbaikan Unit (RPU)</h5>
                </div>
                <div class="col-6">
                    <a type="button" href="{{route('mcc.rpu.create')}}" class="btn btn-primary btn-label waves-effect waves-light float-end"><i class="ri-user-smile-line label-icon align-middle fs-16 me-2"></i> Buat Request</a>
                </div>
                </div>
            </div>
            <div class="card-body">
                <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="rpuList"
                                class="table table-bordered dt-responsive nowrap table-striped align-middle dataTable no-footer dtr-inline collapsed"
                                style="width: 100%;" aria-describedby="example_info">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>No. RPU</th>
                                        <th>Tanggal</th>
                                        <th>Nomor Unit</th>
                                        <th>Lokasi</th>
                                        <th>Hour Mater (HM)</th>
                                        <th>Kilo Meter (KM)</th>
                                        <th>Laporan Kerusakan</th>
                                        <th>PIC MCC</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="">
                                        <td>1</td>
                                        <td>01</td>
                                        <td>1 Juni 2022</td>
                                        <td>VLZ1400087402</td>
                                        <td>Balikpapan</td>
                                        <td>99</td>
                                        <td>1010</td>
                                        <td>
                                            <button class="btn btn-primary" data-bs-target="#listKerusakan" data-bs-toggle="modal">Detail Kerusakan</button>
                                        </td>
                                        <td>Daffa</td>
                                    </tr>
                                    <tr class="">
                                        <td>1</td>
                                        <td>01</td>
                                        <td>1 Juni 2022</td>
                                        <td>VLZ1400087402</td>
                                        <td>Balikpapan</td>
                                        <td>99</td>
                                        <td>1010</td>
                                        <td>
                                            <button class="btn btn-primary" data-bs-target="#listKerusakan" data-bs-toggle="modal">Detail Kerusakan</button>
                                        </td>
                                        <td>Fuad</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end col-->
</div>



{{-- Modal List Kerusakan --}}
<div id="listKerusakan" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Daftar Kerusakan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                <ul class="list-group">
                    <li class="list-group-item"><i class="ri-information-fill align-middle me-2"></i>Rusak oi</li>
                    <li class="list-group-item"><i class="ri-information-fill align-middle me-2"></i>Send over all the documentation.</li>
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Tutup</button>
                {{-- <button type="button" class="btn btn-primary ">Save Changes</button> --}}
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endsection
@section('script')
{{-- Jquery CDN --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
{{-- Data Table JS --}}
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<!-- apexcharts -->
{{-- <script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script> --}}
{{-- <script src="{{ URL::asset('assets/libs/jsvectormap/jsvectormap.min.js') }}"></script> --}}
{{-- <script src="{{ URL::asset('assets/libs/jsvectormap//world-merc.js') }}"></script> --}}

<!-- dashboard init -->
{{-- <script src="{{ URL::asset('/assets/js/pages/dashboard-analytics.init.js') }}"></script> --}}
<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
{{-- <script src="{{ URL::asset('assets/js/pages/datatables.init.js') }}"></script> --}}

<script>

    $('document').ready(function () {
        $('#rpuList').DataTable();
        // $('#spbList').DataTable();
    })

</script>
@endsection
