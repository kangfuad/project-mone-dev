@extends('layouts.master')
@section('title') @lang('translation.analytics') @endsection
@section('css')

<link href="{{ URL::asset('assets/libs/jsvectormap/jsvectormap.min.css') }}" rel="stylesheet">
<!-- Filepond css -->
<link rel="stylesheet" href="{{ URL::asset('assets/libs/filepond/filepond.min.css') }}" type="text/css" />
<link rel="stylesheet"
    href="{{ URL::asset('assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css') }}">

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
            <div class="card-body">
                <!-- Nav tabs -->
                <ul class="nav nav-pills nav-custom-light animation-nav nav-justified nav-danger mb-3" role="tablist">
                    <li class="nav-item ">
                        <a class="nav-link active" data-bs-toggle="tab" href="#border-navs-home" role="tab"
                            style="font-size: 1.3vh">Daftar Surat
                            Order Barang ( SOB )</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#border-navs-profile" role="tab"
                            style="font-size: 1.3vh">Daftar Surat
                            Penerimaan Barang ( SPB )</a>
                    </li>
                </ul><!-- Tab panes -->
                <div class="tab-content text-muted">
                    <div class="tab-pane active" id="border-navs-home" role="tabpanel">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="spbList"
                                    class="table table-bordered dt-responsive nowrap table-striped align-middle dataTable no-footer dtr-inline collapsed"
                                    style="width: 100%;" aria-describedby="example_info">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>No. SOB</th>
                                            <th>Tanggal</th>
                                            <th>Barang</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($passing['sob'] as $sob)

                                        <tr class="">
                                            <td class="text-center" width="5%">{{ $loop->iteration}}</td>
                                            <td class="text-center" width="15%">{{ $sob['data']['id_sob'] }}</td>
                                            <td class="text-center" width="10%">{{
                                                $passing['until']->hari_tanggal($sob['data']['tgl_sob']) }}</td>
                                            <td class="" width="60%">
                                                <!-- Accordions with Icons -->
                                                <div class="accordion custom-accordionwithicon" id="accordionWithicon">
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="listItemSOB">
                                                            <button class="accordion-button" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#accor_iconExamplecollapse1{{ $loop->iteration}}"
                                                                aria-expanded="true"
                                                                aria-controls="accor_iconExamplecollapse1{{ $loop->iteration}}">
                                                                <i class=" ri-file-list-2-fill"></i> &nbsp; Daftar
                                                                Barang
                                                            </button>
                                                        </h2>
                                                        <div id="accor_iconExamplecollapse1{{ $loop->iteration}}"
                                                            class="accordion-collapse collapse"
                                                            aria-labelledby="listItemSOB"
                                                            data-bs-parent="#accordionWithicon">
                                                            <div class="accordion-body">
                                                                <ol class="list-group list-group-numbered">
                                                                    @foreach($sob['listing'] as $list)
                                                                    @if($list['triger'] == 1)
                                                                    <strike>
                                                                        <li class="list-group-item">
                                                                            {{$list['kode_barang']}}
                                                                            - {{$list['nama_barang']}} <span
                                                                                class="badge bg-danger float-end p-2">{{
                                                                                $list['stock'] - $list['req_stock']
                                                                                }}</span></li>
                                                                    </strike>
                                                                    @else
                                                                    <li class="list-group-item">{{$list['kode_barang']}}
                                                                        - {{$list['nama_barang']}} <span
                                                                            class="badge bg-success float-end p-2">{{$list['req_stock']}}</span>
                                                                    </li>
                                                                    @endif
                                                                    @endforeach
                                                                </ol>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                @if($sob['data']['status_id'] == 23)
                                                <button type="button" disabled
                                                    class="btn btn-danger btn-label waves-effect waves-light"><i
                                                        class="ri-close-line label-icon align-middle fs-16 me-2"></i>
                                                    Pending</button>
                                                @else
                                                <button type="button"
                                                    class="btn btn-primary btn-label waves-effect waves-light"><i
                                                        class="ri-check-double-line label-icon align-middle fs-16 me-2"></i>
                                                    Terima</button>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane" id="border-navs-profile" role="tabpanel">
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="sobList"
                                    class="table table-bordered dt-responsive nowrap table-striped align-middle dataTable no-footer dtr-inline collapsed"
                                    style="width: 100%;" aria-describedby="example_info">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>No. SPB</th>
                                            <th>No. SOB</th>
                                            <th>Tanggal</th>
                                            <th>Barang</th>
                                            <th>Status</th>
                                            <th>PIC Warehouse</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="">
                                            <td class="text-center">1</td>
                                            <td class="text-center" width="10%">SPB-00010002</td>
                                            <td class="text-center" width="10%">SOB-00010002</td>
                                            <td class="text-center" width="10%">23 Mei 2022</td>
                                            <td class="" width="40%">
                                                <!-- Accordions with Icons -->
                                                <div class="accordion custom-accordionwithicon" id="accordionWithicon">
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="listItemSPB">
                                                            <button class="accordion-button" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#accor_iconExamplecollapse1"
                                                                aria-expanded="true"
                                                                aria-controls="accor_iconExamplecollapse1">
                                                                <i class=" ri-file-list-2-fill"></i> &nbsp; Daftar
                                                                Barang
                                                            </button>
                                                        </h2>
                                                        <div id="accor_iconExamplecollapse1"
                                                            class="accordion-collapse collapse"
                                                            aria-labelledby="listItemSPB"
                                                            data-bs-parent="#accordionWithicon">
                                                            <div class="accordion-body">
                                                                <ol class="list-group list-group-numbered">
                                                                    <li class="list-group-item">Selang Bensin <span
                                                                            class="badge bg-primary float-end p-2">10
                                                                            pcs</span></li>
                                                                    <li class="list-group-item">Ban Dalam <span
                                                                            class="badge bg-primary float-end p-2">10
                                                                            pcs</span></li>
                                                                    <li class="list-group-item">Ban Dalam <span
                                                                            class="badge bg-primary float-end p-2">10
                                                                            pcs</span></li>
                                                                    <li class="list-group-item">Velg <span
                                                                            class="badge bg-primary float-end p-2">10
                                                                            pcs</span></li>
                                                                    <li class="list-group-item">Ban Dalam <span
                                                                            class="badge bg-primary float-end p-2">10
                                                                            pcs</span></li>
                                                                </ol>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center"><span class="badge badge-soft-warning fs-6">Dalam
                                                    Proses</span></td>
                                            <td class="text-center"><span class="badge bg-primary p-2 fs-6">Daffa
                                                    A</span></td>
                                            <td class="text-center" width="10%">
                                                <button type="button"
                                                    class="btn btn-primary btn-label waves-effect waves-light"
                                                    data-bs-toggle="modal" data-bs-target="#myModal"><i
                                                        class="ri-check-double-line label-icon align-middle fs-16 me-2"></i>Konfirmasi</button>
                                            </td>
                                        </tr>
                                        <tr class="">
                                            <td class="text-center">1</td>
                                            <td class="text-center" width="10%">SPB-00010002</td>
                                            <td class="text-center" width="10%">SOB-00010002</td>
                                            <td class="text-center" width="10%">23 Mei 2022</td>
                                            <td class="" width="40%">
                                                <!-- Accordions with Icons -->
                                                <div class="accordion custom-accordionwithicon" id="accordionWithicon">
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="listItemSPB">
                                                            <button class="accordion-button" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#accor_iconExamplecollapse1"
                                                                aria-expanded="true"
                                                                aria-controls="accor_iconExamplecollapse1">
                                                                <i class=" ri-file-list-2-fill"></i> &nbsp; Daftar
                                                                Barang
                                                            </button>
                                                        </h2>
                                                        <div id="accor_iconExamplecollapse1"
                                                            class="accordion-collapse collapse"
                                                            aria-labelledby="listItemSPB"
                                                            data-bs-parent="#accordionWithicon">
                                                            <div class="accordion-body">
                                                                <ol class="list-group list-group-numbered">
                                                                    <li class="list-group-item">Selang Bensin <span
                                                                            class="badge bg-primary float-end p-2">10
                                                                            pcs</span></li>
                                                                    <li class="list-group-item">Ban Dalam <span
                                                                            class="badge bg-primary float-end p-2">10
                                                                            pcs</span></li>
                                                                    <li class="list-group-item">Ban Dalam <span
                                                                            class="badge bg-primary float-end p-2">10
                                                                            pcs</span></li>
                                                                    <li class="list-group-item">Velg <span
                                                                            class="badge bg-primary float-end p-2">10
                                                                            pcs</span></li>
                                                                    <li class="list-group-item">Ban Dalam <span
                                                                            class="badge bg-primary float-end p-2">10
                                                                            pcs</span></li>
                                                                </ol>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center"><span class="badge badge-soft-success fs-6">Dalam
                                                    Pengiriman</span></td>
                                            <td class="text-center"><span class="badge bg-primary p-2 fs-6">Daffa
                                                    A</span></td>
                                            <td class="text-center" width="10%">
                                                <button type="button"
                                                    class="btn btn-outline-primary btn-label waves-effect waves-light"
                                                    data-bs-toggle="modal" data-bs-target="#myModal" disabled><i
                                                        class="ri-check-double-line label-icon align-middle fs-16 me-2"></i>Terkonfirmasi</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end card-body -->
        </div>
    </div>
    <!--end col-->
</div>

<!-- Default Modals -->

<div id="myModal" class="modal fade" tabindex="-1" aria-labelledby="myModalLabel" aria-hidden="true"
    style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myModalLabel">Bukti Penerimaan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"> </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        <div class="mx-auto">
                            <input type="file" class="filepond filepond-input-circle" name="filepond"
                                accept="image/png, image/jpeg, image/gif" />
                        </div>

                    </div>
                    <!-- end card body -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary ">Submit</button>
            </div>

        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endsection
@section('script')
{{-- Jquery CDN --}}

{{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script> --}}

<script src="{{ URL::asset('assets/libs/datatables/jquery-3.6.0.min.js') }}"></script>
{{-- Data Table JS --}}

{{-- <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script> --}}

<script src="{{ URL::asset('assets/libs/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/datatables/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>

<!-- filepond js -->
<script src="{{ URL::asset('assets/libs/filepond/filepond.min.js') }}"></script>
<script src="{{ URL::asset('assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js') }}">
</script>
<script
    src="{{ URL::asset('assets/libs/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js') }}">
</script>
<script
    src="{{ URL::asset('assets/libs/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js') }}">
</script>
<script src="{{ URL::asset('assets/libs/filepond-plugin-file-encode/filepond-plugin-file-encode.min.js') }}"></script>
<!-- File upload js -->
<script src="{{ URL::asset('assets/js/pages/form-file-upload.init.js') }}"></script>

<script>
    $('document').ready(function () {
        $('#sobList').DataTable();
        $('#spbList').DataTable();
    })

    document.addEventListener('DOMContentLoaded', function () {
        // Register any plugins
        FilePond.registerPlugin(FilePondPluginImagePreview);

        // Create FilePond object
        const inputElement = document.querySelector('input[type="file"]');
        const pond = FilePond.create(inputElement);
    });

    /*
We need to register the required plugins to do image manipulation and previewing.
*/
    FilePond.registerPlugin(
        // encodes the file as base64 data
        FilePondPluginFileEncode,

        // validates files based on input type
        FilePondPluginFileValidateType,

        // corrects mobile image orientation
        FilePondPluginImageExifOrientation,

        // previews the image
        FilePondPluginImagePreview,

        // crops the image to a certain aspect ratio
        FilePondPluginImageCrop,

        // resizes the image to fit a certain size
        FilePondPluginImageResize,

        // applies crop and resize information on the client
        FilePondPluginImageTransform
    );

    // Select the file input and use create() to turn it into a pond
    // in this example we pass properties along with the create method
    // we could have also put these on the file input element itself
    FilePond.create(
        document.querySelector('input'), {
            labelIdle: `Klik untuk ambil gambar`,
            imagePreviewHeight: 170,
            imageCropAspectRatio: '1:1',
            imageResizeTargetWidth: 200,
            imageResizeTargetHeight: 200,
            stylePanelLayout: 'compact circle',
            styleLoadIndicatorPosition: 'center bottom',
            styleButtonRemoveItemPosition: 'center bottom'
        }
    );

</script>
@endsection