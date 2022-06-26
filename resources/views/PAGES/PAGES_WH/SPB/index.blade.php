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
                <h5 class="card-title mb-0">Daftar Surat Order Barang (SOB)</h5>
            </div>
            <div class="card-body">
                <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="sobList"
                                class="table table-bordered dt-responsive nowrap table-striped align-middle dataTable no-footer dtr-inline collapsed"
                                style="width: 100%;" aria-describedby="example_info">
                                <thead>
                                    {{-- <tr>
                                        <th scope="col" style="width: 17.4px;" class="sorting sorting_asc" tabindex="0"
                                            aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending"
                                            aria-label=": activate to sort column descending">
                                            #
                                        </th>
                                        <th data-ordering="false" class="sorting" tabindex="0" aria-controls="example"
                                            rowspan="1" colspan="1" style="width: 41.4px;"
                                            aria-label="SR No.: activate to sort column ascending">No. RPU</th>
                                        <th data-ordering="false" class="sorting" tabindex="0" aria-controls="example"
                                            rowspan="1" colspan="1" style="width: 32.4px;"
                                            aria-label="ID: activate to sort column ascending">No. SPB</th>
                                        <th data-ordering="false" class="sorting" tabindex="0" aria-controls="example"
                                            rowspan="1" colspan="1" style="width: 78.4px;"
                                            aria-label="Purchase ID: activate to sort column ascending">Nama Sparepart</th>
                                        <th data-ordering="false" class="sorting" tabindex="0" aria-controls="example"
                                            rowspan="1" colspan="1" style="width: 262.4px;"
                                            aria-label="Title: activate to sort column ascending">Jumlah</th>
                                        <th data-ordering="false" class="sorting" tabindex="0" aria-controls="example"
                                            rowspan="1" colspan="1" style="width: 71.4px;"
                                            aria-label="User: activate to sort column ascending">PIC MCC</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                            style="width: 80.4px;"
                                            aria-label="Assigned To: activate to sort column ascending">PIC Warehouse</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                            style="width: 73.4px;"
                                            aria-label="Created By: activate to sort column ascending">Foto</th>
                                    </tr> --}}
                                    <tr>
                                        <th>#</th>
                                        <th>No. RPU</th>
                                        <th>No. SPB</th>
                                        <th>Nama Sparepart</th>
                                        <th>Jumlah</th>
                                        <th>PIC MCC</th>
                                        <th>PIC Warehouse</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="">
                                        <td>1</td>
                                        <td>01</td>
                                        <td>VLZ-452</td>
                                        <td>VLZ1400087402</td>
                                        <td>14</td>
                                        <td>Joseph Parker</td>
                                        <td>Alexis Clarke</td>
                                        <td>
                                            <button class="btn btn-primary">Generate</button>
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td>1</td>
                                        <td>01</td>
                                        <td>VLZ-452</td>
                                        <td>VLZ1400087402</td>
                                        <td>14</td>
                                        <td>Joseph Parker</td>
                                        <td>Alexis Clarke</td>
                                        <td>Daffa Parker</td>
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
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Daftar SPB</h5>
            </div>
            <div class="card-body">
                <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="spbList"
                                class="table table-bordered dt-responsive nowrap table-striped align-middle dataTable no-footer dtr-inline collapsed"
                                style="width: 100%;" aria-describedby="example_info">
                                <thead>
                                    {{-- <tr>
                                        <th scope="col" style="width: 17.4px;" class="sorting sorting_asc" tabindex="0"
                                            aria-controls="example" rowspan="1" colspan="1" aria-sort="ascending"
                                            aria-label=": activate to sort column descending">
                                            #
                                        </th>
                                        <th data-ordering="false" class="sorting" tabindex="0" aria-controls="example"
                                            rowspan="1" colspan="1" style="width: 41.4px;"
                                            aria-label="SR No.: activate to sort column ascending">No. RPU</th>
                                        <th data-ordering="false" class="sorting" tabindex="0" aria-controls="example"
                                            rowspan="1" colspan="1" style="width: 32.4px;"
                                            aria-label="ID: activate to sort column ascending">No. SPB</th>
                                        <th data-ordering="false" class="sorting" tabindex="0" aria-controls="example"
                                            rowspan="1" colspan="1" style="width: 78.4px;"
                                            aria-label="Purchase ID: activate to sort column ascending">Nama Sparepart</th>
                                        <th data-ordering="false" class="sorting" tabindex="0" aria-controls="example"
                                            rowspan="1" colspan="1" style="width: 262.4px;"
                                            aria-label="Title: activate to sort column ascending">Jumlah</th>
                                        <th data-ordering="false" class="sorting" tabindex="0" aria-controls="example"
                                            rowspan="1" colspan="1" style="width: 71.4px;"
                                            aria-label="User: activate to sort column ascending">PIC MCC</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                            style="width: 80.4px;"
                                            aria-label="Assigned To: activate to sort column ascending">PIC Warehouse</th>
                                        <th class="sorting" tabindex="0" aria-controls="example" rowspan="1" colspan="1"
                                            style="width: 73.4px;"
                                            aria-label="Created By: activate to sort column ascending">Foto</th>
                                    </tr> --}}
                                    <tr>
                                        <th>#</th>
                                        <th>No. RPU</th>
                                        <th>No. SPB</th>
                                        <th>Nama Sparepart</th>
                                        <th>Jumlah</th>
                                        <th>PIC MCC</th>
                                        <th>PIC Warehouse</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="">
                                        <td>1</td>
                                        <td>01</td>
                                        <td>VLZ-452</td>
                                        <td>VLZ1400087402</td>
                                        <td>14</td>
                                        <td>Joseph Parker</td>
                                        <td>Alexis Clarke</td>
                                        <td>
                                            <button class="btn btn-primary">Generate</button>
                                        </td>
                                    </tr>
                                    <tr class="">
                                        <td>1</td>
                                        <td>01</td>
                                        <td>VLZ-452</td>
                                        <td>VLZ1400087402</td>
                                        <td>14</td>
                                        <td>Joseph Parker</td>
                                        <td>Alexis Clarke</td>
                                        <td>Daffa Parker</td>
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
