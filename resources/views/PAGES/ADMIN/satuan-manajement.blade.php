@extends('layouts.master')
@section('title') @lang('translation.Datatables') @endsection
@section('css')
<!--datatable css-->
<link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
<!--datatable responsive css-->
<link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet"
    type="text/css" />
<link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
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
<div class="alert alert-success">
    {{ session('error') }}
</div>
@endif

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-6">
                        <h5 class="card-title mb-0">Table Menu</h5>
                    </div>
                    <div class="col-lg-6 text-end">
                        <button data-bs-toggle="modal" data-bs-target="#addSatuan" type="button"
                            class="btn btn-primary btn-label waves-effect right waves-light">
                            <i class="ri-add-circle-line label-icon align-middle fs-16 ms-2"></i> Tambah Unit
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th>NO.</th>
                            <th>Nama Satuan</th>
                            <th>Inisial Satuan</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 1; $i < 20; $i++) <tr>
                            <td>{{$i}}</td>
                            <td>Kilo Meter</td>
                            <td>KM</td>
                            <td>
                                <div class="dropup d-inline-block">
                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-fill align-middle"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" style="z-index: 1;">
                                        <li>
                                            <a class="dropdown-item edit-item-btn" id="btnUpdateMenu"
                                                data-nama="Master Satuan" data-path="/admin/satuan-manajemen"
                                                data-role="1" data-icon="ri-list-settings-fill"
                                                data-slug="master-satuan"><i
                                                    class="ri-pencil-fill align-bottom me-2 text-muted"></i> Ubah</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item remove-item-btn text-danger"
                                                data-slug="master-satuan" data-nama="Master Satuan" data-active="0"
                                                id="btnDeleteMenu"><i
                                                    class="ri-delete-bin-fill align-bottom me-2 text-danger"></i> Hapus
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
    <!--end col-->
</div>
<!--end row-->
<!-- Grids in modals -->

<div class="modal fade" id="addSatuan" tabindex="-1" aria-labelledby="exampleModalgridLabel" aria-modal="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalgridLabel">Tambah Satuan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="javascript:void(0);">
                    <div class="row g-3">
                        <div class="col-12">
                            <div>
                                <label for="nama_satuan" class="form-label">Nama Satuan</label>
                                <input type="text" class="form-control" id="nama_satuan" name="nama_satuan"
                                    placeholder="">
                            </div>
                        </div>
                        <div class="col-12">
                            <div>
                                <label for="inisial_satuan" class="form-label">Inisial Satuan</label>
                                <input type="text" class="form-control" id="inisial_satuan" name="inisial_satuan"
                                    placeholder="">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')

<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script src="{{ URL::asset('assets/js/pages/datatables.init.js') }}"></script>

<script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>

@endsection
