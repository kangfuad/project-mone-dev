@extends('layouts.master-without-nav')
@section('title')
@lang('translation.signin')
@endsection
@section('css')

<link href="{{ URL::asset('assets/libs/jsvectormap/jsvectormap.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/libs/swiper/swiper.min.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('content')


<div class="container pt-5">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0 badge bg-primary">Unit MPE 883</h5>
                    <button type="button" class="btn btn-danger btn-label waves-effect waves-light float-end"><i class="ri-check-double-line label-icon align-middle fs-16 me-2"></i> Kembali</button>
                </div>            
            </div>
        </div>
        <div class="col-lg-12">
            <div>
                <div class="timeline">
                    <div class="timeline-item left">
                        <i class="icon ri-close-circle-fill text-danger"></i>
                        <div class="date">10 Jul 2021</div>
                        <div class="content">
                            <h5>New ticket received <span class="badge bg-danger text-white fs-10 align-middle ms-1">Menunggu</span></h5>
                            <p class="text-muted mb-2">
                                It is important for us that we receive email notifications when a ticket is created as our IT staff are mobile and will not always be looking at the dashboard for new tickets.
                            </p>
                            <a href="javascript:void(0);" class="link-primary text-decoration-underline">Read More <i class="ri-arrow-right-line"></i></a>
                        </div>
                    </div>
                    <div class="timeline-item right">
                        <i class="icon ri-close-circle-fill text-danger"></i>
                        <div class="date">18 May 2021</div>
                        <div class="content">
                            <h5>New ticket received <span class="badge bg-danger text-white fs-10 align-middle ms-1">Menunggu</span></h5>
                            <p class="text-muted mb-2">
                                It is important for us that we receive email notifications when a ticket is created as our IT staff are mobile and will not always be looking at the dashboard for new tickets.
                            </p>
                            <a href="javascript:void(0);" class="link-primary text-decoration-underline">Read More <i class="ri-arrow-right-line"></i></a>
                        </div>
                    </div>
                    <div class="timeline-item left">
                        <i class="icon ri-alert-fill text-warning"></i>
                        <div class="date">10 Feb 2021</div>
                        <div class="content">
                            <h5>New ticket received <span class="badge bg-warning text-white fs-10 align-middle ms-1">Dalam Proses</span></h5>
                            <p class="text-muted mb-2">
                                It is important for us that we receive email notifications when a ticket is created as our IT staff are mobile and will not always be looking at the dashboard for new tickets.
                            </p>
                            <a href="javascript:void(0);" class="link-primary text-decoration-underline">Read More <i class="ri-arrow-right-line"></i></a>
                        </div>
                    </div>
                    <div class="timeline-item right">
                        <i class="icon ri-checkbox-circle-fill text-success"></i>
                        <div class="date">01 Jan 2021</div>
                        <div class="content">
                            <h5>New ticket received <span class="badge bg-success text-white fs-10 align-middle ms-1">Selesai</span></h5>
                            <p class="text-muted mb-2">
                                It is important for us that we receive email notifications when a ticket is created as our IT staff are mobile and will not always be looking at the dashboard for new tickets.
                            </p>
                            <a href="javascript:void(0);" class="link-primary text-decoration-underline">Read More <i class="ri-arrow-right-line"></i></a>
                        </div>
                    </div>
                </div>
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