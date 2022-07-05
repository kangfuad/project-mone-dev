@extends('layouts.master-without-nav')
@section('title')
@lang('translation.signin')
@endsection
@section('css')

<link href="{{ URL::asset('assets/libs/jsvectormap/jsvectormap.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/libs/swiper/swiper.min.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('content')


<div class="container-fluid pt-2 bg-primary">
    <h4 class="text-white">No RPU : {{$kode_rpu}}	</h4>
    <div class="row">
        <div class="col-lg-12">
            {{-- <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0 badge bg-primary">Unit MPE 883</h5>
                    <button type="button" class="btn btn-danger btn-label waves-effect waves-light float-end"><i class="ri-check-double-line label-icon align-middle fs-16 me-2"></i> Kembali</button>
                </div>            
            </div> --}}
        </div>
        <div class="col-lg-12 mt-5">
            <div class="timeline">
                @foreach($logs as $log)
                    <div class="timeline-item @if ($loop->odd) left @else right @endif">
                        <i class="icon ri-alert-fill text-danger"></i>
                        <div class="date text-white">{{date('d M Y',strtotime($log->created_at))}}</div>
                        <div class="content">
                            <h5>New ticket received <span class="badge bg-warning text-white fs-10 align-middle ms-1">Dalam Proses</span></h5>
                            <p class="text-muted mb-2">
                               {{$log->deskripsi_status}}
                            </p>
                            {{-- <a href="javascript:void(0);" class="link-primary text-decoration-underline">Read More <i class="ri-arrow-right-line"></i></a> --}}
                            @if($log->foto != '')
                                <div class="col-6">
                                    <div class="border border-dashed rounded gx-2 p-2">
                                            <img src="{{ URL::asset('assets/images/',$log->foto) }}" alt="" class="img-fluid rounded w-50">
                                    </div>
                                </div>
                            @endif
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