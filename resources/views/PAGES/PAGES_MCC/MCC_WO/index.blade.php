@extends('layouts.master')
@section('title') @lang('translation.analytics') @endsection
@section('css')

<link href="{{ URL::asset('assets/libs/jsvectormap/jsvectormap.min.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{ URL::asset('assets/libs/@simonwep/@simonwep.min.css') }}" /> <!-- 'classic' theme -->

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
                    <div class="col-6">
                        <h5 class="card-title mb-0">Daftar Work Order (WO)</h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="woList"
                                class="table table-bordered dt-responsive nowrap table-striped align-middle dataTable no-footer dtr-inline collapsed"
                                style="width: 100%;" aria-describedby="example_info">
                                {{-- <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%"> --}}
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>No RPU</th>
                                            <th>Pembuat RPU (MCC)</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       <tr>
                                            <td>1</td>
                                            <td>SR-1657596481</td>
                                            <td><strong>Daffa</strong> </td>
                                            <td class="text-center"><span class="badge badge-soft-info fs-10 p-3">Work Order Siap Dibuat</span></td>
                                            <td class="text-center"><button type="button" class="btn btn-primary btn-label waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#createWO"><i class="ri-edit-2-fill label-icon align-middle fs-16 me-2"></i> Buat WO</button></td>
                                       </tr>
                                       <tr>
                                            <td>2</td>
                                            <td>SR-1657596481</td>
                                            <td><strong>Daffa</strong> </td>
                                            <td class="text-center"><span class="badge badge-soft-warning fs-10 p-3">Work Order Dalam Pengerjaan</span></td>
                                            <td class="text-center">-</td>
                                        </tr>
                                       <tr>
                                            <td>3</td>
                                            <td>SR-1657596481</td>
                                            <td><strong>Daffa</strong> </td>
                                            <td class="text-center"><span class="badge badge-soft-success fs-10 p-3">Work Order Selesai</span></td>
                                            <td class="text-center"><button type="button" class="btn btn-primary btn-label waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#createJadwal"><i class="ri-calendar-todo-fill label-icon align-middle fs-16 me-2"></i> Buat Jadwal</button></td>
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


{{-- Modal Buat SOB --}}
<!-- Default Modals -->
<div id="createWO" class="modal zoomIn" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Buat Work Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card-header border-bottom-dashed px-3">
                            <div class="d-flex">
                                <div class="flex-grow-1">
                                    <div class="mt-1">
                                        <h6 class="text-muted text-uppercase fw-bold fs-14">Detail Unit</h6>
                                        <p class="text-muted mb-0" id="">Nomor  : MPE 311</p>
                                        <p class="text-muted mb-0" id="">Brand  : Volvo</p>
                                        <p class="text-muted mb-0" id="">Series : FMX 480 6X4</p>
                                    </div>
                                </div>
                                <div class="flex-shrink-0 mt-sm-0 mt-3">
                                  <img src="{{ URL::asset('assets/images/logo-dark.png') }}" class="card-logo card-logo-dark w-25 float-end" alt="logo dark" height="">
                                </div>
                            </div>
                        </div>
                        <!--end card-header-->
                    </div>
                    <!--end col-->
                    <div class="col-lg-12">
                        <div class="card-body p-4">
                            <div class="row g-3">
                                <div class="col-lg-3 col-6">
                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Nomer RPU </p>
                                    <h5 class="fs-14 mb-0"><span id="">SR-1657596481</span></h5>
                                </div>
                                <!--end col-->
                                <div class="col-lg-3 col-6">
                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Jenis Service</p>
                                    <h5 class="fs-14 mb-0"><span id="">Terjadwal</small></h5>
                                </div>
                                <!--end col-->
                                <div class="col-lg-3 col-6">
                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Hour Meter ( HM )</p>
                                    <h5 class="fs-14 mb-0"><span id="">755.96</span></h5>
                                </div>
                                <!--end col-->
                                <div class="col-lg-3 col-6">
                                    <p class="text-muted mb-2 text-uppercase fw-semibold">Kilo Meter ( KM )</p>
                                    <h5 class="fs-14 mb-0"><span id="">755.96</span></h5>
                                </div>
                                <!--end col-->
                            </div>
                            <!--end row-->
                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end col-->
                    <div class="col-lg-12">
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                {{-- table Kerusakan --}}
                                <table class="table table-borderless table-nowrap align-middle mb-3 ">
                                    <thead>
                                        <tr class="table-active">
                                            <th scope="col" style="width: 50px;">#</th>
                                            <th scope="col">Daftar Kerusakan</th>
                                        </tr>
                                    </thead>
                                    <tbody id="products-list">
                                        <tr>
                                            <th scope="row">1.</th>
                                            <th>Kurang Ngebut Bos</th>
                                        </tr>
                                        <tr>
                                            <th scope="row">2.</th>
                                            <th>Kurang Responsip Bos</th>
                                        </tr>
                                        <tr>
                                            <th scope="row">3.</th>
                                            <th>Kurang GerGer Bos</th>
                                        </tr>
                                    </tbody>
                                </table>
                                <!--end table-->
                                {{-- Table kebutuhan --}}
                                <h6 class="text-muted text-uppercase fw-semibold mb-3">Daftar Barang:</h6>
                                <table class="table table-borderless table-nowrap align-middle mb-0">
                                    <thead>
                                        <tr class="table-active">
                                            <th scope="col" style="width: 50px;">#</th>
                                            <th scope="col">Nama Barang</th>
                                            <th scope="col">Jumlah</th>
                                        </tr>
                                    </thead>
                                    <tbody id="products-list">
                                        <tr>
                                            <th scope="row">1.</th>
                                            <th>Spion Racing</th>
                                            <th>20 Pcs</th>
                                        </tr>
                                        <tr>
                                            <th scope="row">2.</th>
                                            <th>Baut Monel Variasi</th>
                                            <th>30 Set</th>
                                        </tr>
                                        <tr>
                                            <th scope="row">3.</th>
                                            <th>Selang Bensin</th>
                                            <th>5 Meter</th>
                                        </tr>
                                    </tbody>
                                </table>
                                <!--end table-->
                            </div>
                            <div class="mt-3">
                                <h6 class="text-muted text-uppercase fw-semibold mb-3">Work Order Details:</h6>
                                <p class="text-muted mb-1">Foreman: <span class="fw-medium" id="">Arvan Si Pitung</span></p>
                                <p class="text-muted mb-1">Lokasi: <span class="fw-medium" id="">Workshop</span></p>
                            </div>
                            <div class="hstack gap-2 justify-content-end d-print-none mt-4">
                                <a href="javascript:window.print()" class="btn btn-success"><i class="ri-printer-line align-bottom me-1"></i> Print</a>
                                <a href="javascript:void(0);" class="btn btn-primary"><i class="ri-download-2-line align-bottom me-1"></i> Download</a>
                            </div>
                        </div>
                        <!--end card-body-->
                    </div>
                    <!--end col-->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary ">Submit</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
{{-- End Modal SOB --}}

{{-- Modal Penjadwalan --}}
<div id="createJadwal" class="modal fade" tabindex="-1" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 overflow-hidden">
            <div class="modal-header p-3">
                <h4 class="card-title mb-0">Penjadwalan Servis</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="alert alert-success  rounded-0 mb-0">
                <p class="mb-0">Unit <span class="fw-semibold">MPE 311 </span> telah selesai servis, Silahkan jadwalkan servis selanjutnya.</p>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        {{-- <label for="tanggalServis" class="form-label">Pilih Tanggal</label> --}}
                        <input type="text" class="form-control" id="jadwalServis" data-provider="flatpickr" data-date-format="d M, Y" placeholder="Pilih Tanggal">
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Buat Jadwal</button>
                    </div>
                </form>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
{{-- End Modal Penjadwalan --}}

@endsection
@section('script')
<!-- JAVASCRIPT -->
<script src="{{ URL::asset('assets/libs/datatables/jquery-3.6.0.min.js') }}"></script>

<!-- apexcharts -->
<script src="{{ URL::asset('/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/jsvectormap/jsvectormap.min.js') }}"></script>
{{-- <script src="{{ URL::asset('assets/libs/jsvectormap//world-merc.js') }}"></script> --}}

<!-- dashboard init -->
<script src="{{ URL::asset('/assets/js/pages/dashboard-analytics.init.js') }}"></script>
<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
<!-- App js -->
{{-- <script src="{{ URL::asset('assets/js/app.js')}}"></script> --}}

{{-- Data table --}}
<script src="{{ URL::asset('assets/libs/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/datatables/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/datatables/dataTables.responsive.min.js') }}"></script>

{{-- Invoice --}}
<script src="{{ URL::asset('/assets/js/pages/invoicedetails.js') }}"></script>

{{-- Datepicker --}}
<script src="{{ URL::asset('assets/libs/@simonwep/@simonwep.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/form-pickers.init.js') }}"></script>
<!-- flatpickr.js -->
<script type='text/javascript' src='{{ URL::asset('assets/libs/flatpickr/flatpickr.min.js') }}'></script>

<script>
    $(document).ready(function(){
        $('#woList').DataTable();

        //DateTime
        $('#jadwalServis').flatpickr({
            'locale': 'sv',
        });
    })
</script>

@endsection