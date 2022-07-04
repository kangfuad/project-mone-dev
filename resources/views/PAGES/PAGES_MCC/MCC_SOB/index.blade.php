@extends('layouts.master')
@section('title') @lang('translation.analytics') @endsection
@section('css')

<link href="{{ URL::asset('assets/libs/jsvectormap/jsvectormap.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />

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
                        <h5 class="card-title mb-0">Daftar Order Barang (SOB)</h5>
                    </div>
                    <div class="col-6">
                        <a type="button" href="{{route('mcc.rpu.create')}}"
                            class="btn btn-primary btn-label waves-effect waves-light float-end"><i
                                class="ri-user-smile-line label-icon align-middle fs-16 me-2"></i> Buat Request</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="rpuList"
                                class="table dt-responsive nowrap table-striped align-middle dataTable no-footer dtr-inline collapsed"
                                style="width: 100%;" aria-describedby="example_info">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>No. RPU</th>
                                        <th>List Sparepart</th>
                                        <th>PIC MCC</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for($i = 1; $i < 100; $i++)
                                        <tr class="">
                                            <td width="10%" class="">{{$i}}</td>
                                            <td width="15%" class="">SR-16565350{{$i}}</td>
                                            <td width="55%">
                                                <div class="accordion custom-accordionwithicon" id="accordionWithicon">
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="accordionwithiconExample2{{$i}}">
                                                            <button class="accordion-button collapsed" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#accor_iconExamplecollapse2{{$i}}"
                                                                aria-expanded="false"
                                                                aria-controls="accor_iconExamplecollapse2">
                                                                <i class="ri-user-location-line"></i> Tampilkan List Sparepart
                                                            </button>
                                                        </h2>
                                                        <div id="accor_iconExamplecollapse2{{$i}}"
                                                            class="accordion-collapse collapse"
                                                            aria-labelledby="accordionwithiconExample2"
                                                            data-bs-parent="#accordionWithicon">
                                                            <div class="accordion-body">
                                                                <ul class="list-group">
                                                                    <li class="list-group-item"><i
                                                                            class="mdi mdi-check-bold align-middle lh-1 me-2"></i> Send the
                                                                        billing agreement</li>
                                                                    <li class="list-group-item"><i
                                                                            class="mdi mdi-check-bold align-middle lh-1 me-2"></i> Send over
                                                                        all the documentation.</li>
                                                                    <li class="list-group-item"><i
                                                                            class="mdi mdi-check-bold align-middle lh-1 me-2"></i> Meeting
                                                                        with daron to review the intake form</li>
                                                                    <li class="list-group-item"><i
                                                                            class="mdi mdi-check-bold align-middle lh-1 me-2"></i> Check
                                                                        uikings theme and give customer support</li>
                                                                    <li class="list-group-item"><i
                                                                            class="mdi mdi-check-bold align-middle lh-1 me-2"></i> Start
                                                                        making a presentation</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td width="10%" class="">Daffa</td>
                                            <td width="10%" class="">
                                                <button type="button"
                                                    class="btn btn-success btn-label waves-effect waves-light" id="approveList"><i
                                                        class="ri-check-double-line label-icon align-middle fs-16 me-2" ></i>
                                                    Terima</button>
                                                <button type="button"
                                                    class="btn btn-danger btn-label waves-effect waves-light"><i
                                                        class=" ri-close-circle-fill label-icon align-middle fs-16 me-2"></i>
                                                    Tolak</button>
                                            </td>
                                        </tr>
                                    @endfor
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
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
{{-- Data Table JS --}}
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
{{-- Swal 2 --}}
<script src="{{ URL::asset('/assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/pages/sweetalerts.init.js') }}"></script>

<!-- dashboard init -->
<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>


<script>
    $('document').ready(function () {
        $('#rpuList').DataTable();
        // $('#spbList').DataTable();
        // $('#ping').on('click', function(){
            $('#approveList').on('click', function(){
            // alert('test');
            Swal.fire({
            title: 'Approve Permintaan Barang?',
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#405189',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Terima'
            }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire(
                'Success!',
                'Permintaan telah di terima',
                'success'
                )
            }
            })
    })

       
    })

    
   

</script>
@endsection
