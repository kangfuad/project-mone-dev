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

<div class="row" id="postListBarang">
    <form action="{{route('post.list.barang')}}" method="POST">
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
                    <input type="hidden" name="no_rpu" value="{{$passing['rpu']['no_rpu']}}">
                    <input type="hidden" name="id_mcc" value="{{$passing['rpu']['created_by']}}">
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
                {{-- @for($a = 1; $a<4; $a++) --}} @foreach($passing['rpu']['keluhan'] as $kel) <div
                    class="card ribbon-box border shadow-none mb-3">
                    <div class="card-body">
                        <div class="ribbon ribbon-primary round-shape">{{ $loop->iteration }}. {{ $kel->keluhan }}</div>
                        <button type="button" data-id="{{$kel->id}}" id="addRowBarang"
                            class="btn btn-sm btn-primary btn-label waves-effect waves-light float-end mb-2"><i
                                class="ri-tools-fill label-icon align-middle fs-16 me-2"></i>Tambah Sparepart</button>
                        <div class="ribbon-content mt-4 text-muted">
                            <table id="add-rows{{$kel->id}}"
                                class="table table-nowrap dt-responsive table-bordered display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th width="70%">Barang</th>
                                        <th width="20%">Jumlah</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody{{$kel->id}}">

                                </tbody>
                            </table>
                        </div>
                    </div>
            </div>
            @endforeach
            {{-- @endfor --}}
        </div>

        <a type="button" id="" href="{{route('list.barang')}}"
            class="btn btn-danger btn-label waves-effect waves-light float-start mb-2"><i
                class=" ri-arrow-left-down-line label-icon align-middle fs-16 me-2"></i>Kembali</a>
        <button type="butoon" id="SubmitListBarang"
            class="btn btn-primary btn-label waves-effect waves-light float-end mb-2"><i
                class=" ri-check-double-fill label-icon align-middle fs-16 me-2"></i>Submit</button>

</div>

<!--end col-->
</form>
</div>


<meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">


@endsection
@section('script')
{{-- Jquery CDN --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

{{-- Select2 JS --}}

{{-- List JS --}}
<script src="{{ URL::asset('assets/libs/list.js/list.js.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/list.pagination.js/list.pagination.js.min.js') }}"></script>
<!-- dashboard init -->
<!--select2 cdn-->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ URL::asset('assets/js/pages/select2.init.js') }}"></script>
{{-- datatable js --}}
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>

<!-- JAVASCRIPT -->
<script src="{{ URL::asset('assets/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>

<!-- Sweet Alerts js -->
<script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

<!-- Sweet alert init js-->
<script src="{{ URL::asset('assets/js/pages/sweetalerts.init.js') }}"></script>


<!--select2 cdn-->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ URL::asset('assets/js/pages/select2.init.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/datatables.init.js') }}"></script>

<script src="{{ URL::asset('assets/js/app.js') }}"></script>
<script>
    $(document).ready(function () {
        let _token   = $('meta[name="csrf-token"]').attr('content');
        var id = '';
        var option = function () {
            console.log(id);
            var tmp = null;
            $.ajax({
                async: false,
                type:'POST',
                url: "{{ url('/get-all-items') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    _token : _token
                },
                success: (data) => {
                    
                    if(data.pesan == "sukses"){
                        tmp = data.data;
                    }else {
                        Swal.fire({
                            html: '<div class="mt-3">' +
                                '<lord-icon src="https://cdn.lordicon.com/tdrtiskw.json" trigger="loop" colors="primary:#f06548,secondary:#f7b84b" style="width:120px;height:120px"></lord-icon>' +
                                '<div class="mt-4 pt-2 fs-15">' +
                                '<h4>Oops...! Terjadi kesalahan !</h4>' +
                                '<p class="text-muted mx-4 mb-0">Silahkan coba kembali nanti atau hubungi tim support!</p>' +
                                '</div>' +
                                '</div>',
                            showCancelButton: true,
                            showConfirmButton: false,
                            cancelButtonClass: 'btn btn-primary w-xs mb-1',
                            cancelButtonText: 'Tutup',
                            buttonsStyling: false,
                            showCloseButton: true
                        })
                    }
                },
                error: function(data){
                    Swal.fire({
                        html: '<div class="mt-3">' +
                            '<lord-icon src="https://cdn.lordicon.com/tdrtiskw.json" trigger="loop" colors="primary:#f06548,secondary:#f7b84b" style="width:120px;height:120px"></lord-icon>' +
                            '<div class="mt-4 pt-2 fs-15">' +
                            '<h4>Oops...! Terjadi kesalahan !</h4>' +
                            '<p class="text-muted mx-4 mb-0">Silahkan coba kembali nanti atau hubungi tim support!</p>' +
                            '</div>' +
                            '</div>',
                        showCancelButton: true,
                        showConfirmButton: false,
                        cancelButtonClass: 'btn btn-primary w-xs mb-1',
                        cancelButtonText: 'Tutup',
                        buttonsStyling: false,
                        showCloseButton: true
                    })
                }
            });
            return tmp;
        }();

        
        $('#loop_item').on('click', '#addRowBarang', function(){
            var id = $(this).data('id');
            addrows(id);
        });


        var counter = 0;

        function addrows(id){
            var t = $('#add-rows'+id).DataTable();

            initSelect2();
			function initSelect2() {
				$('.myselect').each(function(index, element) {
					$(this).select2({
						placeholder: "Pilih Barang"
					})
				})
			}
            t.row.add([
                `<div id="menuAddRows">
                </div>`,
                `<div>
                    <input type="number" class="form-control" id="jumlah_barang[]" name="barang[`+counter+`][jumlah_barang]" min="0">
                    <input type="hidden" class="form-control" name="barang[`+counter+`][id_keluhan]" value="`+id+`" min="0">
                </div>`,
                '<button class="btn btn-danger" id="delteRow">Hapus</button>'
            ]).draw(false);
            var html = '';
            var i;

            // console.log(option)
            
            for(i=0; i<option.length;i++){
                html += '<option value="'+option[i].kode_barang+'--&&--'+option[i].nama_barang+'">'+option[i].kode_barang+' - '+option[i].nama_barang+' (Stock : '+option[i].jumlah+')</option>';
            }

            let select = document.createElement('select')
                select.className = 'myselect form-control'
                select.id = 'barang'+counter
                select.name = 'barang['+counter+'][kode_barang]'
                select.innerHTML = '<option hidden selected disabled></option>'+html

                var elements = document.querySelectorAll('[id="menuAddRows"]');
                for(var i = 0; i < elements.length; i++) {
                    elements[i].appendChild(select);
                }
                initSelect2();

            counter++;
            

            $('#add-rows'+id+' tbody').on('click', '#delteRow', function () {
                t
                    .row($(this).parents('tr'))
                    .remove()
                    .draw();
            });
        }

        // $("#SubmitListBarang").on('click',function(){
        //     console.log("MASUK");
        // })

        // function handleFormSubmit(event) {
        // event.preventDefault();

        // const data = new FormData(event.target);

        // const formJSON = Object.fromEntries(data.entries());
        
        // // for multi-selects, we need special handling
        // formJSON.id_keluhan = data.getAll('id_keluhan');
        // formJSON.barang = data.getAll('barang');
        // formJSON.jumlah_barang = data.getAll('jumlah_barang');
        // console.log(JSON.stringify(formJSON, null, 2))
        // }
        // const form = document.querySelector('#postListBarang');
        // form.addEventListener('submit', handleFormSubmit);

    });
</script>
@endsection