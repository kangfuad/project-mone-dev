@extends('layouts.master')
@section('title') @lang('translation.analytics') @endsection
@section('css')

{{--
<link href="{{ URL::asset('assets/libs/jsvectormap/jsvectormap.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" /> --}}
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
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-6">
                        <h5 class="card-title mb-0">Daftar Order Barang (SOB)</h5>
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
                                        <th>Tanggal Listing</th>
                                        <th>PIC FOREMAN</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(isset($passing['sob']['sob']))
                                    @foreach($passing['sob']['sob'] as $rpu)
                                    <tr class="">
                                        <td width="10%" class="">{{$loop->iteration}}</td>
                                        <td width="15%" class="">{{ $rpu['no_rpu'] }}</td>
                                        <td width="45%">
                                            <div class="accordion custom-accordionwithicon" id="accordionWithicon">
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header"
                                                        id="accordionwithiconExample2{{$loop->iteration}}">
                                                        <button class="accordion-button collapsed" type="button"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#accor_iconExamplecollapse2{{$loop->iteration}}"
                                                            aria-expanded="false"
                                                            aria-controls="accor_iconExamplecollapse2">
                                                            <i class="ri-user-location-line"></i> Tampilkan List
                                                            Sparepart Unit {{ $rpu['nomer_unit'] }}
                                                        </button>
                                                    </h2>
                                                    <div id="accor_iconExamplecollapse2{{$loop->iteration}}"
                                                        class="accordion-collapse collapse"
                                                        aria-labelledby="accordionwithiconExample2"
                                                        data-bs-parent="#accordionWithicon">
                                                        <div class="accordion-body">
                                                            <ul class="list-group">
                                                                @foreach($rpu['keluhan'] as $keluhan)

                                                                <li class="list-group-item">
                                                                    <i
                                                                        lass="mdi mdi-check-bold align-middle lh-1 me-2"></i>
                                                                    {{$keluhan['keluhan']}}
                                                                    <ul>
                                                                        @if(isset($keluhan['listing']) > 0)
                                                                        @foreach($keluhan['listing'] as $list)
                                                                        <li>
                                                                            {{$list['nama_barang']}}
                                                                        </li>
                                                                        @endforeach
                                                                        @endif
                                                                    </ul>
                                                                </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td width="10%" class="">{{ $passing['until']->hari_tanggal($rpu['updated_at'])
                                            }}</td>
                                        <td width="10%" class="">{{ $rpu['pic_foreman'] }}</td>
                                        <td width="10%" class="">
                                            <button type="button" data-rpu="{{ $rpu['no_rpu'] }}"
                                                class="btn btn-success btn-label waves-effect waves-light"
                                                id="approveList"><i
                                                    class="ri-check-double-line label-icon align-middle fs-16 me-2"></i>
                                                Buat SOB</button>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif

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

{{-- MODAL --}}
<!-- Modal Blur -->
<div id="zoomInModal" class="modal fade zoomIn" tabindex="-1" aria-labelledby="zoomInModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="javascript:void(0);">
                <div class="modal-header">
                    <h5 class="modal-title" id="zoomInModalLabel">Proses Pengajuan SOB</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    @csrf

                    <div class="row g-3">
                        <div class="col-xxl-6">
                            <div>
                                <label for="NoRpu" class="form-label">No RPU</label>
                                <input type="text" class="form-control" id="NoRpu" name="NoRpu" readonly>
                            </div>
                        </div>
                        <div class="col-xxl-6">
                            <div>
                                <label for="NoSob" class="form-label">No SOB</label>
                                <input type="text" class="form-control" id="NoSob" name="NoSob" readonly>
                                <small class="text-info">* Generate by system</small>
                            </div>
                        </div>
                        <div class="col-xxl-12">
                            <div>
                                <label for="id_warehouse" class="form-label">Warehouse</label>
                                <select class="js-example-basic-single" name="id_warehouse" id="id_warehouse">
                                    <option value="" disabled selected>Pilih warehouse</option>
                                    @foreach($passing['warehouse'] as $wr)
                                    <option value="{{$wr->id}}">{{$wr->name}} / {{ count($wr['count_warehouse']) }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <!--end row-->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" id="btnAjukanSob" class=" btn btn-primary"> Ajukan SOB </button>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- Toggle Between Modals -->
{{-- <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#firstmodal">Open First
    Modal</button> --}}
<!-- First modal dialog -->
<div class="modal fade" id="firstmodal" aria-hidden="true" aria-labelledby="..." tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body text-center p-5">
                <lord-icon src="https://cdn.lordicon.com/tdrtiskw.json" trigger="loop"
                    colors="primary:#f7b84b,secondary:#405189" style="width:130px;height:130px">
                </lord-icon>
                <div class="mt-4 pt-4">
                    <h4 id="warningMsg"></h4>
                    <p class="text-muted" id="desWarningMsg"></p>
                </div>
                <a href="javascript:void(0);" class="btn btn-link link-success fw-medium" data-bs-dismiss="modal"><i
                        class="ri-close-line me-1 align-middle"></i> Tutup</a>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="ModalSuccess" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body text-center p-5">
                <lord-icon src="https://cdn.lordicon.com/lupuorrc.json" trigger="loop"
                    colors="primary:#121331,secondary:#08a88a" style="width:120px;height:120px">
                </lord-icon>

                <div class="mt-4">
                    <h4 class="mb-3" id="successMsg"></h4>
                    <p class="text-muted mb-4" id="desSuccessMsg"> </p>
                    <div class="hstack gap-2 justify-content-center">
                        <a onClick="window.location.reload();" class="btn btn-link link-success fw-medium"
                            data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Tutup</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- END MODAL --}}

<meta name="csrf-token" id="csrf-token" content="{{ csrf_token() }}">

@endsection
@section('script')
{{-- Jquery CDN --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
{{--select2 cdn--}}
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ URL::asset('assets/js/pages/select2.init.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/datatables.init.js') }}"></script>
<!-- Lord Icon -->
<script src="https://cdn.lordicon.com/libs/mssddfmo/lord-icon-2.1.0.js"></script>
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
        
        $('#rpuList tbody').on( 'click', '#approveList', function () {
            rpu = $(this).data('rpu'); 
            sob = rpu.split('-');
            sob = sob[1]
            sob = "SOB-{{ TIME() }}-"+sob;
            $('#NoRpu').val(rpu)
            $('#NoSob').val(sob)
            $('#zoomInModal').modal('show');
        });

        

        $("#btnAjukanSob").on('click', function(){
            if(id_warehouse == null){
                $('#warningMsg').html("Peringatan!")
                $('#desWarningMsg').html("Silahakn tentukan user warehouse terlebih dahulu untuk mengajukan SOB!.")
                $("#firstmodal").modal('show');
                return false;
            }
            
            Swal.fire({
                title: 'Ajukan Sob?',
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#405189',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Prosess'
            }).then((result) => {
                if (result.isConfirmed) {
                    $("#btnAjukanSob").html("Prossing pengajuan ....");
                    let _token   = $('meta[name="csrf-token"]').attr('content');
                    $.ajax({
                        type:'POST',
                        url: "{{ url('/mcc/ajukan-sob') }}",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data: {
                            no_rpu :rpu,
                            no_sob : sob,
                            user_warehouse : $("#id_warehouse").val(),
                            _token : _token
                        },
                        success: (data) => {
                            if (data.pesan == "SUCCESS") {
                                $('#successMsg').html("Berhasil!")
                                $('#desSuccessMsg').html("Pengajuan SOB berhasil, Monitoring dapat dilakukan di menu Surat Penerimaan Barang (SPB)!.")
                                $("#ModalSuccess").modal('show');
                            } else {
                                Swal.fire({
                                    html: '<div class="mt-3">' +
                                        '<lord-icon src="https://cdn.lordicon.com/tdrtiskw.json" trigger="loop" colors="primary:#f06548,secondary:#f7b84b" style="width:120px;height:120px"></lord-icon>' +
                                        '<div class="mt-4 pt-2 fs-15">' +
                                        '<h4>Oops...! Terjadi kesalahan !</h4>' +
                                        '<p class="text-muted mx-4 mb-0">Silakukan cobalagi nanti atau hubungi tim support</p>' +
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
                                    '<p class="text-muted mx-4 mb-0">Silakukan cobalagi nanti atau hubungi tim support</p>' +
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
                } else{
                    location.reload();
                }
            });
            
        });
    });
</script>
@endsection