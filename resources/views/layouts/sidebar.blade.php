<div class="sidebar-wrapper" data-layout="stroke-svg">
    <div class="logo-wrapper">
        <a href="index.html">
            <img class="img-fluid" style="width: 150px; margin-top: 10px" src="{{ asset('own_assets/logo/logo.png') }}"
                alt="">
        </a>
        <div class="back-btn"><i class="fa fa-angle-left"> </i></div>
        <div class="toggle-sidebar">
            <i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i>
        </div>
    </div>

    <div class="logo-icon-wrapper">
        <a href="index.html">
            <img class="img-fluid" src="{{ asset('own_assets/logo/logo.png') }}" alt="">
        </a>
    </div>
    <nav class="sidebar-main">
        <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
        <div id="sidebar-menu">
            <ul class="sidebar-links" id="simple-bar">
                <li class="back-btn"><a href="index.html"><img class="img-fluid"
                            src="{{ asset('own_assets/logo/logo.png') }}" alt=""></a>
                    <div class="mobile-back text-end"> <span>Back </span><i class="fa fa-angle-right ps-2"
                            aria-hidden="true"></i></div>
                </li>
                <li class="pin-title sidebar-main-title">
                    <div>
                        <h6>Pinned</h6>
                    </div>
                </li>
                <li class="sidebar-main-title">
                    <div>
                        <h6 class="lan-1">General</h6>
                    </div>
                </li>

                <li class="sidebar-list"><i class="fa fa-thumb-tack"> </i><a class="sidebar-link sidebar-title"
                        href="/dashboard">
                        <svg class="stroke-icon">
                            <use href="{{ asset('dashboard_assets/assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                        </svg>
                        <svg class="fill-icon">
                            <use href="{{ asset('dashboard_assets/assets/svg/icon-sprite.svg#fill-home') }}"></use>
                        </svg><span class="lan-3">Dashboard </span></a>
                </li>

                <li class="sidebar-main-title">
                    <div>
                        <h6 class="">Master</h6>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="/data-kamar">
                        <i class="fa fa-bed text-white"></i>
                        <span class="">Nomor Kamar</span>
                    </a>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="/pengaturan-kamar">
                        <i class="fa fa-door-open text-white"></i>
                        <span class="">Pengaturan Kamar</span>
                    </a>
                </li>

                <li class="sidebar-main-title">
                    <div>
                        <h6 class="">Data Peserta</h6>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="/daftar-peserta">
                        <i class="fa fa-users text-white"></i>
                        <span class="">Daftar Peserta</span>
                    </a>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="/registrasi-peserta">
                        <i class="fa fa-user-plus text-white"></i>
                        <span class="">Registrasi Peserta</span>
                    </a>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="/absensi-peserta">
                        <i class="fa fa-user-check text-white"></i>
                        <span class="">Absensi Peserta</span>
                    </a>
                </li>

                <li class="sidebar-main-title">
                    <div>
                        <h6 class="">Data Narasumber</h6>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="/daftar-narasumber">
                        <i class="fa fa-users text-white"></i>
                        <span class="">Daftar Narasumber</span>
                    </a>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="/registrasi-narasumber">
                        <i class="fa fa-user-plus text-white"></i>
                        <span class="">Registrasi Narasumber</span>
                    </a>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="/absensi-narasumber">
                        <i class="fa fa-user-check text-white"></i>
                        <span class="">Absensi Narasumber</span>
                    </a>
                </li>

                <li class="sidebar-main-title">
                    <div>
                        <h6 class="">Data Rapat</h6>
                    </div>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="/materi-raker">
                        <i class="fa fa-file-text text-white"></i>
                        <span class="">Materi Raker</span>
                    </a>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="/dokumentasi-raker">
                        <i class="fa fa-camera text-white"></i>
                        <span class="">Dokumentasi Raker</span>
                    </a>
                </li>

                <li class="sidebar-list">
                    <a class="sidebar-link sidebar-title" href="/kit-peserta">
                        <i class="fa fa-box-open text-white"></i>
                        <span class="">Kit Peserta</span>
                    </a>
                </li>

            </ul>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </div>
    </nav>
</div>
