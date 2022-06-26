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

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-12">
                        <h5 class="card-title mb-0">Form Request Perbaikan Unit (RPU)</h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form action="">
                    <div>
                        <label for="basiInput" class="form-label">No. RPU</label>
                        <input type="text" class="form-control" id="basiInput" readonly value="SR-01022022">
                    </div>
                    <div class="mt-3">
                        <label for="basiInput" class="form-label">Tanggal Pembuatan RPU</label>
                        <input type="date" class="form-control" id="basiInput" readonly value="2022-08-10">
                    </div>
                    <div class="mt-3">
                        <label for="basiInput" class="form-label">Nomer Unit</label>
                        <select class="js-example-basic-single" name="state">
                            <option value="">Pilih Kendaraan</option>
                            <option value="">DD 1234 MPE</option>
                            <option value="">DD 1233 MPE</option>
                            <option value="">DD 1235 MPE</option>
                            <option value="">DD 1236 MPE</option>
                            <option value="">DD 1237 MPE</option>
                        </select>
                    </div>
                    <div class="mt-3">
                        <label for="basiInput" class="form-label">Lokasi</label>
                        <input type="text" class="form-control" id="basiInput">
                    </div>
                    <div class="mt-3">
                        <label for="basiInput" class="form-label">Hour Meter (HM)</label>
                        <input type="number" class="form-control" id="basiInput">
                    </div>
                    <div class="mt-3">
                        <label for="basiInput" class="form-label">Kilo Meter (KM)</label>
                        <input type="number" class="form-control" id="basiInput">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--end col-->
</div>



@endsection
@section('script')
{{-- Jquery CDN --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

{{-- Select2 JS --}}
<!--select2 cdn-->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script src="{{ URL::asset('assets/js/pages/select2.init.js') }}"></script>

<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>

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
