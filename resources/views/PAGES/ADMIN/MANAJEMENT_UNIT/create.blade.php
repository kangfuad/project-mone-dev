@extends('layouts.master')
@section('title') @lang('translation.analytics') @endsection
@section('css')

<link href="{{ URL::asset('assets/libs/jsvectormap/jsvectormap.min.css') }}" rel="stylesheet">
{{-- Select2 CSS --}}
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"
    type="text/css" />

@endsection
@section('content')

<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">{{ $passing['title-page'] }}</h4>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ $passing['title'] }}</a></li>
                </ol>
            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
         {{-- Card RPU Form --}}
         <div class="card">
            <div class="card-header bg-primary">
                <div class="row">
                    <div class="col-6">
                        <h5 class="card-title mb-0 text-white">Form Tambah Unit</h5>
                    </div>
                    <div class="col-6">
                        <h4 class="card-title mb-0 float-end"><span
                                class="badge rounded-pill bg-light text-primary shadow p-2"> PIC MCC -
                                {{Auth::user()->name}}</span></h4>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <div>
                            <label for="unit_id" class="form-label">Unit ID</label>
                            <input type="text" class="form-control" id="unit_id" name="unit_id" value="" placeholder="Ex : MPE 321">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div>
                            <label for="unit_brand" class="form-label">Brand</label>
                            <input type="text" class="form-control" id="unit_brand" name="unit_brand" value="" placeholder="Ex : Volvo">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div>
                            <label for="unit_series" class="form-label">Series</label>
                            <input type="text" class="form-control" id="unit_series" name="unit_series" value="" placeholder="Ex : FMX 480 6X4">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div>
                            <label for="unit_pprod" class="form-label">PPROD Type</label>
                            <input type="text" class="form-control" id="unit_pprod" name="unit_pprod" value="" placeholder="Ex : FMX 480 6X4">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div>
                            <label for="unit_vin" class="form-label">VIN</label>
                            <input type="text" class="form-control" id="unit_vin" name="unit_vin" value="" placeholder="Ex : YV2JSWOD6DB641464">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div>
                            <label for="unit_vessel" class="form-label">Brand Vessel</label>
                            <input type="text" class="form-control" id="unit_vessel" name="unit_vessel" value="" placeholder="Ex : YV2JSWOD6DB641464">
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div>
                            <label for="unit_vessel_capacity" class="form-label">Vessel Capacity</label>
                            <input type="number" class="form-control" id="unit_vessel_capacity" name="unit_vessel_capacity" value="" placeholder="Ex : 85">
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div>
                            <label for="unit_gcw" class="form-label">GCW</label>
                            <input type="number" class="form-control" id="unit_gcw" name="unit_gcw" value="" placeholder="Ex : 11200">
                        </div>
                    </div>
                    <div class="col-md-4 mb-3">
                        <div>
                            <label for="unit_gvw" class="form-label">GVW</label>
                            <input type="number" class="form-control" id="unit_gvw" name="unit_gvw" value="" placeholder="Ex : 37000">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div>
                            <label for="unit_remarks" class="form-label">Remarks</label>
                            <input type="text" class="form-control" id="unit_remarks" name="unit_remarks" value="" placeholder="Ex : BD Accident di STA 18+500 (Tikungan Kajuq)	">
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <div>
                            <label for="unit_project" class="form-label">Project</label>
                            <input type="text" class="form-control" id="unit_project" name="unit_project" value="" placeholder="Ex : TCM">
                        </div>
                    </div>
                </div>

            </div>
            <div class="card-footer">
                <a type="submit" href="{{route('unit.index')}}"
                    class="btn btn-danger btn-label waves-effect waves-light float-start mt-3"><i
                        class="ri-arrow-left-down-line label-icon align-middle fs-16 me-2"></i>Kembali</a>
                <button type="submit" class="btn btn-primary btn-label waves-effect waves-light float-end mt-3"><i
                        class="   ri-arrow-right-up-line label-icon align-middle fs-16 me-2"></i>Submit</button>
            </div>
        </div>
    </div>
</div>




@endsection
@section('script')
{{-- Jquery CDN --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

{{-- Select2 JS --}}

{{-- List JS --}}
<script src="{{ URL::asset('assets/libs/list.js/list.js.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/list.pagination.js/list.pagination.js.min.js') }}"></script>
<!-- listjs init -->
<script src="{{ URL::asset('assets/js/pages/listjs.init.js') }}"></script>
{{-- Sweet alert 2 --}}
<script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<!-- dashboard init -->
<!--select2 cdn-->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ URL::asset('assets/js/pages/select2.init.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/datatables.init.js') }}"></script>
{{-- datatable js --}}
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
@endsection