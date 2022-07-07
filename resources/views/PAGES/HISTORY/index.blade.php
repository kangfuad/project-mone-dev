@extends('layouts.master-history')
@section('title')
@lang('translation.signin')
@endsection
@section('css')

<link href="{{ URL::asset('assets/libs/jsvectormap/jsvectormap.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/libs/swiper/swiper.min.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('content')


<div class="container-fluid pt-2">
    <h4 class="text-white">No RPU : {{$passing['kode_rpu']}} </h4>
    <div class="row">
        <div class="col-lg-12">
            {{-- <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0 badge bg-primary">Unit MPE 883</h5>
                    <button type="button" class="btn btn-danger btn-label waves-effect waves-light float-end"><i
                            class="ri-check-double-line label-icon align-middle fs-16 me-2"></i> Kembali</button>
                </div>
            </div> --}}
        </div>
        <div class="col-lg-12 mt-5">
            <div class="timeline">
                @foreach($passing['logs'] as $log)
                {{-- <div class="timeline-item @if ($loop->odd) left @else right @endif">
                    <i class="icon ri-alert-fill text-danger"></i>
                    <div class="date text-white">{{ $passing['until']->hari_tanggal($log->created_at) }}</div>
                    <div class="content">
                        <h5>{{$log['status']['deskripsi_status']}} <span
                                class="badge bg-info text-white fs-10 align-middle ms-1">Oleh : {{ $log['user']['name']
                                }}</span></h5>
                        <p class="text-muted mb-2">
                            {{$log->catatan}}
                        </p>
                        @if($log->foto != '')
                        <div class="col-6">
                            <div class="border border-dashed rounded gx-2 p-2">
                                <img src="{{ URL::asset('assets/images/',$log->foto) }}" alt=""
                                    class="img-fluid rounded w-50">
                            </div>
                        </div>
                        @endif
                    </div>
                </div> --}}
                <div class="timeline-item @if ($loop->odd) left @else right @endif">
                    <i class="icon ri-checkbox-circle-fill text-success"></i>
                    <div class="date text-white">{{ $passing['until']->hari_tanggal($log->created_at) }}</div>
                    <div class="date text-white mt-4">{{ $passing['until']->jam_menit($log->created_at) }}</div>
                    <div class="content">
                        <h5>{{$log['status']['deskripsi_status']}} <span
                                class="badge bg-success text-white fs-10 align-middle ms-1">Selesai</span></h5>
                        <h6>{{ $log['user']['name'] }} - ( <i> {{$log['role']['nama_role']}} </i> )</h6>
                        <p class="text-muted mp-3 mb-2" style="min-height: 35px;">
                            @if($log->catatan) {{$log->catatan}} @else Tidak ada catatan @endif
                        </p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <!--end col-->
    </div>
</div>
<!-- end auth-page-wrapper -->

@endsection
@section('script')
<script src="{{ URL::asset('assets/libs/particles.js/particles.js.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/particles.app.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/password-addon.init.js') }}"></script>
@endsection