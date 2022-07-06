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

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h5 class="card-title mb-0">Daftar Purchase Order</h5>
                    </div>
                    <div class="col-6">
                        <a type="button" href="{{route('warehouse.purchase_order.create')}}"
                            class="btn btn-primary btn-label waves-effect waves-light float-end"><i
                                class="ri-user-smile-line label-icon align-middle fs-16 me-2"></i> Buat Purchase Order</a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                    <div class="row">
                        <div class="col-sm-12">
                            <table id="poList"
                                class="table dt-responsive nowrap table-striped align-middle dataTable no-footer dtr-inline collapsed"
                                style="width: 100%;" aria-describedby="example_info">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>No. PO</th>
                                        <th>Tanggal</th>
                                        <th>PIC Warehouse</th>
                                        <th>Supplier</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @for($i = 1; $i < 10; $i++)
                                        <tr class="">
                                            <td width="10%" class="">{{$i}}</td>
                                            <td width="15%" class="">PO-16565350{{$i}}</td>                                            
                                            <td width="15%" class="">22 Juni 2022</td>                                            
                                            <td width="10%" class="">Daffa</td>
                                            <td width="15%" class="">PT ABC Logistik</td>                                            
                                            <td width="15%" class=""><span class="badge badge-soft-success">Diterima</span></td>                                            
                                            <td width="10%" class="">
                                                <div class="dropup d-inline-block">
                                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ri-more-fill align-middle"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end" style="z-index: 1;">
                                                        <li>
                                                            <a href=""
                                                                target="" class="dropdown-item edit-item-btn"  data-bs-toggle="modal" data-bs-target="#myModal"><i
                                                                    class=" ri-eye-fill align-bottom me-2 text-muted"></i>
                                                                Detail Barang
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="">
                                            <td width="10%" class="">{{$i}}</td>
                                            <td width="15%" class="">PO-16565350{{$i}}</td>                                            
                                            <td width="15%" class="">28 Juni 2022</td>                                            
                                            <td width="10%" class="">Daffa</td>
                                            <td width="15%" class="">PT ABC Logistik</td>                                            
                                            <td width="15%" class=""><span class="badge badge-soft-warning">Pending</span></td>                                            
                                            <td width="10%" class="">
                                                <div class="dropup d-inline-block">
                                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ri-more-fill align-middle"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end" style="z-index: 1;">
                                                        <li>
                                                            <a href=""
                                                                target="" class="dropdown-item edit-item-btn"  data-bs-toggle="modal" data-bs-target="#myModal"><i
                                                                    class=" ri-eye-fill align-bottom me-2 text-muted"></i>
                                                                Detail Barang
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
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
{{-- Modal detail barang --}}
<div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel"><span class="badge bg-primary p-2">Detail Barang ( PO-165653501 )</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">                    
                <ol class="list-group list-group-numbered">
                    <li class="list-group-item">Selang Bensin <span class="badge bg-primary float-end p-2">10 pcs</span></li>
                    <li class="list-group-item">Ban Dalam <span class="badge bg-primary float-end p-2">10 pcs</span></li>
                    <li class="list-group-item">Ban Dalam <span class="badge bg-primary float-end p-2">10 pcs</span></li>
                    <li class="list-group-item">Velg <span class="badge bg-primary float-end p-2">10 pcs</span></li>
                    <li class="list-group-item">Ban Dalam <span class="badge bg-primary float-end p-2">10 pcs</span></li>
                </ol>
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary ">Save Changes</button>
            </div> --}}

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
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
        $('#poList').DataTable();
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
