<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu">
    <!-- LOGO -->
    <div class="navbar-brand-box">
        <!-- Dark Logo-->
        <a href="/" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('assets/images/logo-light.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('assets/images/logo-light.png') }}" alt="" height="60">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="/" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('assets/images/logo-light.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('assets/images/logo-light.png') }}" alt="" height="60">
            </span>
        </a>
        <button type="button" class="btn btn-sm p-0 fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar" class="">
        <div class="container-fluid">

            <div id="two-column-menu">
            </div>

            <ul class="navbar-nav mt-1" id="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link menu-link" href="/">
                        <i class="ri-dashboard-2-line"></i> <span>BERANDA</span>
                    </a>
                </li>

                {{-- <li class="menu-title"><i class="ri-more-fill"></i> <span>-= ROLE USER =-</span></li> --}}
                {{-- <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarPages" data-bs-toggle="collapse" role="button"
                        aria-expanded="false" aria-controls="sidebarPages">
                        <i class="ri-pages-line"></i> <span>MENU</span>
                    </a>
                    <div class="collapse menu-dropdown" id="sidebarPages">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="pages-starter" class="nav-link">SUB MENU</a>
                            </li>
                        </ul>
                    </div>
                </li> --}}
                <li class="menu-title"><i class="ri-more-fill"></i> <span>{{$passing['menu_head']}}</span></li>
                @foreach($passing['menu'] as $m)
                    
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{ url($m->path_menu) }}">
                        <i class="{{$m->icon_sub_menu}}"></i> <span data-key="t-widgets">{{$m->nama_sub_menu}}</span>
                    </a>
                </li>
                @endforeach
                {{-- <li class="nav-item">
                    <a class="nav-link menu-link" href="#">
                        <i class="ri-alert-fill"></i> <span data-key="t-widgets">Barang Masuk</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#">
                        <i class="ri-alert-fill"></i> <span data-key="t-widgets">Barang Retur</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#">
                        <i class="ri-alert-fill"></i> <span data-key="t-widgets">Buat PO</span>
                    </a>
                </li>
                <li class="menu-title"><i class="ri-more-fill"></i> <span>Foreman</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="/foreman/listing">
                        <i class="ri-alert-fill"></i> <span data-key="t-widgets">Listing Sparepart</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#">
                        <i class="mdi mdi-clipboard-edit"></i> <span data-key="t-widgets">Work Order (WO)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#">
                        <i class="ri-alert-fill"></i> <span data-key="t-widgets">Status (WO)</span>
                    </a>
                </li>
                <li class="menu-title"><i class="ri-more-fill"></i> <span>MCC</span></li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="{{route('mcc.rpu.index')}}">
                        <i class="ri-alert-fill"></i> <span data-key="t-widgets">Request Perbaikan Unit (RPU)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#">
                        <i class="ri-alert-fill"></i> <span data-key="t-widgets">Surat Order Barang (SOB)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#">
                        <i class="ri-alert-fill"></i> <span data-key="t-widgets">Work Order (WO)</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link" href="#">
                        <i class="ri-alert-fill"></i> <span data-key="t-widgets">Penjadwalan Servis</span>
                    </a>
                </li> --}}
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
    <div class="sidebar-background"></div>
</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>