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
                            <h5 class="card-title mb-0 text-white">Data Request Perbaikan Unit (RPU)</h5>
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
                                <input type="text" class="form-control" readonly
                                    value="{{ $passing['rpu']['no_rpu'] }}">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="tanggal_rpu" class="form-label">Tanggal Pembuatan RPU</label>
                                <input type="text" class="form-control" readonly
                                    value="{{ $passing['until']->hari_tanggal($passing['rpu']['created_at'])}}">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="no_unit" class="form-label">Nomer Unit</label>
                                <input type="text" class="form-control" value="{{ $passing['rpu']['nomer_unit'] }}"
                                    readonly>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="jenis_rpu" class="form-label">Jenis RPU</label>
                            <input type="text" class="form-control" value="{{ $passing['rpu']['jenis_rpu'] }}" readonly>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="lokasi" class="form-label">Lokasi</label>
                                <input type="text" class="form-control" value="{{ $passing['rpu']['lokasi'] }}"
                                    readonly>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div>
                                <label for="hour_meter" class="form-label">Hour Meter (HM)</label>
                                <input type="number" class="form-control" value="{{ $passing['rpu']['hm'] }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div>
                                <label for="kilo_meter" class="form-label">Kilo Meter (KM)</label>
                                <input type="number" class="form-control" value="{{ $passing['rpu']['km'] }}" readonly>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Card List Kerusakan --}}
            <div id="loop_item">
                {{-- @for($a = 1; $a<4; $a++) --}} 
                @foreach($passing['rpu']['keluhan'] as $kel) 
                <div class="card ribbon-box border shadow-none mb-3">
                    <div class="card-body">
                        <div class="ribbon ribbon-primary round-shape">{{ $loop->iteration }}. {{ $kel->keluhan }}</div>
                        <button type="button" data-id="{{$kel->id}}" id="addRowBarang"
                            class="btn btn-sm btn-primary btn-label waves-effect waves-light float-end mb-2"><i
                                class="ri-tools-fill label-icon align-middle fs-16 me-2"></i>Tambah Sparepart</button>
                        <div class="ribbon-content mt-4 text-muted">
                            <table id="add-rows{{$kel->id}}" class="table table-nowrap dt-responsive table-bordered display"
                                style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="70%">Barang</th>
                                        <th width="20%">Jumlah</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
            </div>
            @endforeach
            {{-- @endfor --}}
        </div>

        {{-- <div class="row"> --}}
            <a type="button" id="" href="{{route('list.barang')}}"
                class="btn btn-danger btn-label waves-effect waves-light float-start mb-2"><i
                    class=" ri-arrow-left-down-line label-icon align-middle fs-16 me-2"></i>Kembali</a>
            <button type="submit" id="" class="btn btn-primary btn-label waves-effect waves-light float-end mb-2"><i
                    class=" ri-check-double-fill label-icon align-middle fs-16 me-2"></i>Submit</button>

            {{--
        </div> --}}

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
<script>
    $(document).ready(function () {
    
    $('#loop_item').on('click', '#addRowBarang', function(){
        var id = $(this).data('id');
        console.log(id);
        addrows(id);
    });

    function addrows(id){
        console.log(id);
        var t = $('#add-rows'+id).DataTable();
        var counter = 1;
        // $('#addRowBarang').on('click', function () {
            // t.row.add([counter + '.1', counter + '.2', counter + '.3', counter + '.4', counter + '.5', counter + '.6', counter + '.7', counter + '.8', counter + '.9', counter + '.10', counter + '.11', counter + '.12']).draw(false);
            t.row.add([
                `<div>
                    <select class="form-control" name="barang[]" id="barang[]">
                        <option>Kode Barang - Nama Barang (Stock)</option>
                        <option>B001 - Ban Dalam (stock : 20)</option>
                        <option>BT001 - Baut 18cm (Stock : 1020)</option>
                        <option>AI001 - Aki Truck (Stock : 7)</option>
                    </select>
                </div>`,
                `<div>
                    <input type="number" class="form-control" id="jumlah_barang" name="jumlah_barang" min="0">
                </div>`,
                '<button class="btn btn-danger" id="delteRow">Hapus</button>'
            ]).draw(false);
            counter++;
        // }); // Automatically add a first row of data

        // $('#addRowBarang').click();
        $('#add-rows'+id+' tbody').on('click', '#delteRow', function () {
            t
                .row($(this).parents('tr'))
                .remove()
                .draw();
        });
    }

  
    });
</script>
@endsection