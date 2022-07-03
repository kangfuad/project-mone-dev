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
    <form action="{{route('mcc.rpu.post')}}" method="POST">
        <div class="col-lg-12">
            {{-- Card RPU Form --}}
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="card-title mb-0 text-white">Form Request Perbaikan Unit (RPU)</h5>
                        </div>
                        <div class="col-6">
                            <h4 class="card-title mb-0 float-end"><span
                                    class="badge rounded-pill bg-light text-primary shadow p-2"> PIC MCC -
                                    {{Auth::user()->name}}</span></h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="no_rpu" class="form-label">No. RPU</label>
                                <input type="text" class="form-control" id="no_rpu" name="no_rpu" readonly
                                    value="SR-<?=TIME()?>">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="tanggal_rpu" class="form-label">Tanggal Pembuatan RPU</label>
                                <input type="text" class="form-control" id="tanggal_rpu" name="tanggal_rpu" readonly
                                    value="{{ date('d-m-Y', time()) }}">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="id_foreman" class="form-label">Foreman</label>
                                <select class="js-example-basic-single" name="id_foreman" id="id_foreman">
                                    <option value="" disabled selected>Pilih Foreman</option>
                                    @foreach($passing['foreman'] as $fm)
                                    <option value="{{$fm->id}}">{{$fm->name}} / {{ count($fm['count_foreman']) }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div>
                                <label for="no_unit" class="form-label">Nomer Unit</label>
                                <select class="js-example-basic-single" name="no_unit" id="no_unit">
                                    <option value="">Pilih Kendaraan</option>
                                    @foreach($passing['units'] as $un)
                                        <option value="{{$un->UNIT_ID}}">{{ $un->UNIT_ID }} - {{ $un->BRAND_UNIT }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <label for="jenis_rpu" class="form-label">Jenis RPU</label>
                            <select class="form-select" aria-label="Default select example" id="jenis_rpu"
                                name="jenis_rpu">
                                <option value="">Pilih Jenis Servis</option>
                                <option value="Servis Rutin">Servis Rutin</option>
                                <option value="Servis Dadakan">Servis Dadakan</option>
                            </select>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="lokasi" class="form-label">Lokasi</label>
                                <select class="form-select" aria-label="Default select example" id="lokasi"
                                    name="lokasi">
                                    <option value="">Pilih Lokasi</option>
                                    <option value="Workshop">Workshop</option>
                                    <option value="Jalan Hawling">Jalan Hawling</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div>
                                <label for="hour_meter" class="form-label">Hour Meter (HM)</label>
                                <input type="number" class="form-control" id="hour_meter" name="hour_meter" min="0">
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div>
                                <label for="kilo_meter" class="form-label">Kilo Meter (KM)</label>
                                <input type="number" class="form-control" id="kilo_meter" name="kilo_meter" min="0">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            {{-- Card Daftar kerusakan --}}
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="card-title mb-0">Daftar Kerusakan</h5>
                        </div>
                        <div class="col-6">
                            <button type="button" id="addRow"
                                class="btn btn-primary btn-label waves-effect waves-light float-end"><i
                                    class="ri-tools-fill label-icon align-middle fs-16 me-2"></i>Tambah Laporan
                                Kerusakan</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="add-rows" class="table table-nowrap dt-responsive table-bordered display"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th width="90%">Keluhan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="card-footer">
                    <a type="submit" href="{{route('mcc.rpu.index')}}"
                        class="btn btn-danger btn-label waves-effect waves-light float-start mt-3"><i
                            class=" ri-checkbox-circle-fill label-icon align-middle fs-16 me-2"></i>Kembali</a>
                    <button type="submit" class="btn btn-primary btn-label waves-effect waves-light float-end mt-3"><i
                            class=" ri-checkbox-circle-fill label-icon align-middle fs-16 me-2"></i>Submit</button>
                </div>
            </div>
        </div>

        <!--end col-->
    </form>
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