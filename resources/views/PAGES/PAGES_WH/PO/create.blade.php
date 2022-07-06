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
    <form action="" method="POST">
        <div class="col-lg-12">
            {{-- Card RPU Form --}}
            <div class="card">
                <div class="card-header bg-primary">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="card-title mb-0 text-white">Form Purchase Order (PO)</h5>
                        </div>
                        <div class="col-6">
                            <h4 class="card-title mb-0 float-end"><span
                                    class="badge rounded-pill bg-light text-primary shadow p-2"> PIC Warehouse -
                                    {{Auth::user()->name}}</span></h4>
                        </div>
                    </div>
                </div>
                <div class="card-body">

                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="no_po" class="form-label">No. Purchase Order ( PO )</label>
                                <input type="text" class="form-control" id="no_po" name="no_po" readonly
                                    value="PO-<?=TIME()?>">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="tanggal_po" class="form-label">Tanggal Pembuatan (PO)</label>
                                <input type="text" class="form-control" id="tanggal_po" name="tanggal_po" readonly
                                    value="{{ date('d-m-Y', time()) }}">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="pic_po" class="form-label">Penanggung Jawab</label>
                                <input type="text" class="form-control" id="pic_po" name="pic_po" readonly
                                    value="{{Auth::user()->name}}">
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div>
                                <label for="supplie_po" class="form-label">Supplier</label>
                                <input type="text" class="form-control" id="supplie_po" name="supplie_po"
                                    value="">
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            {{-- Card Daftar kerusakan --}}
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="card-title mb-0">Daftar Barang</h5>
                        </div>
                        <div class="col-6">
                            <button type="button" id="addRow"
                                class="btn btn-primary btn-label waves-effect waves-light float-end"><i
                                    class="ri-tools-fill label-icon align-middle fs-16 me-2"></i>Tambah Data Barang</button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table id="add-items" class="table table-nowrap dt-responsive table-bordered display"
                        style="width:100%">
                        <thead>
                            <tr>
                                <th width="80%">Barang</th>
                                <th width="10%">Jumlah</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
                <div class="card-footer">
                    <a type="submit" href="{{route('warehouse.purchase_order.index')}}"
                        class="btn btn-danger btn-label waves-effect waves-light float-start mt-3"><i
                            class=" ri-checkbox-circle-fill label-icon align-middle fs-16 me-2"></i>Kembali</a>
                    <button type="submit" class="btn btn-primary btn-label waves-effect waves-light float-end mt-3"><i
                            class=" ri-checkbox-circle-fill label-icon align-middle fs-16 me-2"></i>Submit</button>
                </div>
            </div>
        </div>

        <!--end col-->
    </form>
</div>




@endsection
@section('script')
{{-- Jquery CDN --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

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
    var t = $('#add-items').DataTable();
    var counter = 1;
    $('#addRow').on('click', function () {
        // t.row.add([counter + '.1', counter + '.2', counter + '.3', counter + '.4', counter + '.5', counter + '.6', counter + '.7', counter + '.8', counter + '.9', counter + '.10', counter + '.11', counter + '.12']).draw(false);
        t.row.add([
            `<div>
                <select class="js-example-basic-single form-control" name="items" id="items">
                    <option>BR001 - Baut (Stock : 200)</option>
                    <option>BR002 - Baut (Stock : 200)</option>
                    <option>BR003 - Baut (Stock : 200)</option>
                    <option>BR004 - Baut (Stock : 200)</option>
                </select>
            </div>`,
            '<div><input type="number" class="form-control" id="qty" name="qty"></div>',
            '<button class="btn btn-danger" id="delteRow">Hapus</button>'
        ]).draw(false);
        counter++;
    }); // Automatically add a first row of data

    $('#addRow').click();
    $('#add-items tbody').on('click', '#delteRow', function () {
        t
            .row($(this).parents('tr'))
            .remove()
            .draw();
    });
});
</script>
@endsection