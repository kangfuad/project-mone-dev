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
                    {{-- @if(isset($title))
                    <li class="breadcrumb-item active">{{ $title }}</li>
                    @endif --}}
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
                        <!-- Grids in modals -->
                        {{-- <button type="button" class="btn btn-link" data-bs-toggle="modal"
                            data-bs-target="#ModalTambahMAsterMenu">
                            <i class="ri-add-circle-line"> Tambah Menu</i>
                        </button> --}}
                        <!-- Buttons with Label Right -->
                        <button type="button" class="btn btn-primary btn-label waves-effect right waves-light"
                            data-bs-toggle="modal" data-bs-target="#ModalTambahMAsterMenu">
                            <i class="ri-add-circle-line label-icon align-middle fs-16 ms-2"></i> Tambah Menu
                        </button>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table id="scroll-horizontal" class="table nowrap align-middle" style="width:100%">
                    <thead>
                        <tr>
                            <th>NO.</th>
                            <th>NAMA MENU</th>
                            <th>PATH MENU</th>
                            <th>ROLE MENU</th>
                            <th>ICON MUENU</th>
                            <th>IS ACTIVE</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($passing['table_menu'] as $tm)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$tm->nama_sub_menu}}</td>
                            <td>{{$tm->path_menu}}</td>
                            <td>{{$tm['role']['nama_role']}}</td>
                            <td class="text-center"> <i class="{{$tm->icon_sub_menu}}"></i></td>
                            @if($tm->is_active == 1)
                            <td class="text-center"><i class="text-success ri-shut-down-line"></i> Aktif</td>
                            @else
                            <td class="text-center"><i class="text-danger ri-shut-down-line"></i> Tidak Aktif</td>
                            @endif
                            <td>
                                <div class="dropup d-inline-block">
                                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="ri-more-fill align-middle"></i>
                                    </button>
                                    <ul class="dropdown-menu dropdown-menu-end" style="z-index: 1;">
                                        <li><a href="#!" class="dropdown-item"><i
                                                    class="ri-eye-fill align-bottom me-2 text-muted"></i> View</a></li>
                                        <li><a class="dropdown-item edit-item-btn"><i
                                                    class="ri-pencil-fill align-bottom me-2 text-muted"></i> Edit</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item remove-item-btn">
                                                <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete
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
    <!--end col-->
</div>
<!--end row-->

{{-- MODAL --}}

<div class="modal fade" id="ModalTambahMAsterMenu" data-bs-backdrop="static" tabindex="-1"
    aria-labelledby="ModalTambahMAsterMenuLabel" aria-modal="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalTambahMAsterMenuLabel">Tambah Menu</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{url('/admin/menu-manajemen')}}" method="post">
                    @csrf
                    <div class="row g-3">
                        <div class="col-xxl-12">
                            <div>
                                <label for="nama" class="form-label">Nama Menu</label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                    placeholder="Masukan nama menu">
                            </div>
                        </div>
                        <div class="col-xxl-12">
                            <div>
                                <label for="path" class="form-label">Path Menu</label>
                                <input type="text" class="form-control" id="path" name="path"
                                    placeholder="/[ path grup ]/[ path ]">
                            </div>
                        </div>
                        <div class="col-xxl-12">
                            <div>
                                <label for="icon" class="form-label">icon Menu</label>
                                <input type="text" class="form-control" id="icon" name="icon"
                                    placeholder="Masukan hanya class ex: ri-delete-bin-fill ">
                                <small>List Class yang dapat di gunakan <a href="{{ url('/admin/icon') }}"
                                        target="_blank">Disini</a></small>
                            </div>
                        </div>
                        <div class="col-xxl-12">
                            <div class="">
                                <label for="role" class="form-label">Role Menu</label>
                                <select class="form-select" name="role" id="role">
                                    <option selected disabled> --= Pilih Role USer =-- </option>
                                    <option value="1">SUPER ADMIN</option>
                                    <option value="2">MCC</option>
                                    <option value="3">FOREMAN</option>
                                    <option value="4">WEREHOUSE</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
{{-- END MODAL --}}

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