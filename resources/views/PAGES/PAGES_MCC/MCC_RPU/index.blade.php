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
                </ol>
            </div>

        </div>
    </div>
</div>
@if (session('berhasil'))
<div class="alert alert-success">
    {{ session('berhasil') }}
</div>
@endif

@if (session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h5 class="card-title mb-0">Daftar Request Perbaikan Unit (RPU)</h5>
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
                            {{-- <table id="rpuList"
                                class="table table-bordered dt-responsive nowrap table-striped align-middle dataTable no-footer dtr-inline collapsed"
                                style="width: 100%;" aria-describedby="example_info"> --}}
                                <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>No. RPU</th>
                                            <th>Status</th>
                                            <th>Tanggal</th>
                                            <th>Nomor Unit</th>
                                            <th>Lokasi</th>
                                            <th>Hour Mater (HM)</th>
                                            <th>Kilo Meter (KM)</th>
                                            <th>Laporan Kerusakan</th>
                                            <th>PIC FOREMAN</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($passing['rpus'] as $rpu)
                                        <tr class="">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $rpu->no_rpu }}</td>
                                            <td>{{ $rpu['status']['deskripsi_status'] }}</td>
                                            <td>{{ $rpu->created_at }}</td>
                                            <td>{{ $rpu->nomer_unit }}</td>
                                            <td>{{ $rpu->lokasi }}</td>
                                            <td>{{ $rpu->hm }}</td>
                                            <td>{{ $rpu->km }}</td>
                                            <td>
                                                <button class="btn btn-primary" data-no-rpu="{{$rpu->no_rpu}}"
                                                    id="btnViewKerusakan">Detail
                                                    Kerusakan</button>
                                            </td>
                                            <td>{{ $rpu['foreman']['name'] }}</td>
                                            <td>
                                                <div class="dropup d-inline-block">
                                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                                        data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="ri-more-fill align-middle"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end" style="z-index: 1;">
                                                        <li>
                                                            <a href="{{route('history.page',$rpu->no_rpu)}}"
                                                                target="_blank" class="dropdown-item edit-item-btn"><i
                                                                    class=" ri-history-fill align-bottom me-2 text-muted"></i>
                                                                History RPU
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
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
<div id="listKerusakan" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Daftar Kerusakan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                <div class="accordion custom-accordionwithicon accordion-fill-primary" id="accordionBordered">

                </div>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

{{-- Modal History --}}
<div id="rpu_history" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">History</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                <div class="acitivity-timeline acitivity-main">
                    <div class="acitivity-item d-flex">
                        <div class="flex-shrink-0 avatar-xs acitivity-avatar">
                            <div class="avatar-title bg-success text-white rounded-circle">
                                <i class="ri-home-gear-fill"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1 lh-base">Step 1</h6>
                            <p class="text-muted mb-1">Selesai (Lorem ipsum dolor sit.)</p>
                            <small class="mb-0 text-muted">02:14 PM Today</small>
                        </div>
                    </div>
                    <div class="acitivity-item d-flex py-3">
                        <div class="flex-shrink-0 avatar-xs acitivity-avatar">
                            <div class="avatar-title bg-warning text-white rounded-circle">
                                <i class="ri-hammer-fill"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1 lh-base">Step 2</h6>
                            <p class="text-muted mb-1">On Progress (Lorem ipsum dolor sit.)</p>
                            <small class="mb-0 text-muted">09:14 PM Today</small>
                        </div>
                    </div>
                    <div class="acitivity-item d-flex py-3">
                        <div class="flex-shrink-0 avatar-xs acitivity-avatar">
                            <div class="avatar-title bg-danger text-white rounded-circle">
                                <i class="ri-charging-pile-2-fill"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1 lh-base">Step 3</h6>
                            <p class="text-muted mb-1">Belum Selesai (Lorem ipsum dolor sit.)</p>
                            <small class="mb-0 text-muted">10:14 PM Today</small>
                        </div>
                    </div>
                    <div class="acitivity-item d-flex">
                        <div class="flex-shrink-0 avatar-xs acitivity-avatar">
                            <div class="avatar-title bg-danger text-white rounded-circle">
                                <i class="ri-charging-pile-2-fill"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1 ms-3">
                            <h6 class="mb-1 lh-base">Step 4</h6>
                            <p class="text-muted mb-1">Belum Selesai (Lorem ipsum dolor sit.)</p>
                            <small class="mb-0 text-muted">20:14 PM Today</small>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Tutup</button>
                <button type="button" class="btn btn-primary ">Save Changes</button>
            </div> --}}

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">

@endsection
@section('script')

<!-- JAVASCRIPT -->
<script src="{{ URL::asset('assets/libs/simplebar/simplebar.min.js')}}"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<!--datatable js-->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script src="{{ URL::asset('assets/js/pages/datatables.init.js')}}"></script>

<script>
    $('document').ready(function () {
        $('#scroll-horizontal tbody').on( 'click', '#btnViewKerusakan', function () {
            $(this).text('Loading detail..');
            var rpu = $(this).data('no-rpu'); 
            // VIEW_DETAIL_KERUSAKAN(rpu);

            let _token   = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                type:'POST',
                url: "{{ url('/get-kerusakan-with-barang') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    no_rpu :rpu,
                    _token : _token
                },
                success: (data) => {
                    var html = '';
                    var i;
                    for(i=0; i<data.data.length;i++){
                        if(i !== 0 ){
                            var x = 'collapsed';
                            y = 'false';
                            xx = ''

                        }else{
                            var x = '';
                            y = 'false';
                            xx = 'show';

                        }
                        
                        if(data.data[i].barang !== null){
                            var ul = '';
                            for(m=0;m<data.data[i].barang.length;m++){
                                ul += '<li>'+data.data[i].barang[m].nama_barang+'</li>';
                            }
                        }else{
                            var ul = '<li>Tidak Ada listing barang yang di butuhkan</li>';
                        }
                        html += '<div class="accordion-item">'+
                                    '<h2 class="accordion-header" id="dancok'+data.data[i].id+'">'+
                                        '<button class="accordion-button '+x+'" type="button" data-bs-toggle="collapse" data-bs-target="#CVAR'+data.data[i].id+'" aria-expanded="'+y+'" aria-controls="CVAR'+data.data[i].id+'">'+
                                            data.data[i].keluhan+
                                        ' </button>'+
                                    ' </h2>'+
                                    '<div id="CVAR'+data.data[i].id+'" class="accordion-collapse collapse '+xx+'" aria-labelledby="dancok'+data.data[i].id+'" data-bs-parent="#accordionBordered">'+
                                        '<div class="accordion-body">'+
                                            '<ul>'+
                                                ul+
                                            '</ul>'+
                                        '</div>'+
                                    '</div>'+
                                '</div> ';
                    }
                    $('#accordionBordered').html(html);
                    $('#listKerusakan').modal('show');
                    $(this).text('Detail Kerusakan');
                },
                error: function(data){
                    // $("body").removeClass("spinner");
                    // swal({
                    //     title: "Opss..",
                    //     text: "Terjadi kesalahan.",
                    //     icon: "error"
                    // });
                }
            });
        });


    })

</script>
@endsection