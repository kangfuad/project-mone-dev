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
                <h5 class="card-title mb-0">Listing Sparepart</h5>
            </div>
            <div class="card-body">
                <div id="example_wrapper" class="dataTables_wrapper dt-bootstrap5 no-footer">
                    <div class="row">
                        <div class="col-sm-12">
                            {{-- <table id="sobList"
                                class="table table-bordered dt-responsive nowrap table-striped align-middle dataTable no-footer dtr-inline collapsed"
                                style="width: 100%;" aria-describedby="example_info"> --}}
                                <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">

                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>No. RPU</th>
                                            <th>Tanggal</th>
                                            <th>Nomor Unit</th>
                                            <th>Lokasi</th>
                                            <th>Hour Mater (HM)</th>
                                            <th>Kilo Meter (KM)</th>
                                            <th width="10%">Laporan Kerusakan</th>
                                            <th>PIC MCC</th>
                                            <th width="10%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($passing['rpus'] as $rp)
                                        <tr class="">
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $rp->no_rpu }}</td>
                                            <td>{{ $passing['until']->hari_tanggal($rp->created_at) }}</td>
                                            <td>{{ $rp->nomer_unit }}</td>
                                            <td>{{ $rp->lokasi }}</td>
                                            <td>{{ $rp->hm }}</td>
                                            <td>{{ $rp->km }}</td>
                                            <td>
                                                <button class="btn btn-primary" data-no-rpu="{{$rp->no_rpu}}"
                                                    id="btnViewKerusakan">Detail
                                                    Kerusakan</button>
                                            </td>
                                            <td>{{ $rp['mcc']['name'] }}</td>
                                            <td>
                                                <a type="button" class="btn btn-primary"
                                                    href="{{ route('list.barang.create',$rp->no_rpu )}}">Input
                                                    Sparepart</a>
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
<meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">

@endsection
@section('script')
{{-- Jquery CDN --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
{{-- Data Table JS --}}
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
{{-- <script src="{{ URL::asset('assets/js/pages/datatables.init.js') }}"></script> --}}
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
                    // console.log(data.data)   
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