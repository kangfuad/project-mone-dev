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
                    @if(isset($title))
                        <li class="breadcrumb-item active">{{ $title }}</li>
                    @endif
                </ol>
            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Listing Sparepart</h5>
            </div>
            <div class="card-body">
                <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="sobList"
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
                                        <th>Action</th>
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
                                            <button class="btn btn-primary">Detail Kerusakan</button>
                                        </td>
                                        <td>Fuad</td>
                                        <td>
                                            <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#modal-listing">Input Sparepart</button>
                                        </td>
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
@include('PAGES.PAGES_FM.LISTING.modal')
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
        $('#sobList').DataTable();
        $('#spbList').DataTable();
    })

</script>
@endsection
