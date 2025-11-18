@extends('layouts.template')

@section('content')
    <div class="container-fluid">
        <div class="page-title">
            <div class="row">
                <div class="col-6">
                    <h4>Dashboard</h4>
                </div>
                <div class="col-6">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html">
                                <svg class="stroke-icon">
                                    <use href="{{ asset('dashboard_assets/assets/svg/icon-sprite.svg#stroke-home') }}"></use>
                                </svg></a></li>
                        <li class="breadcrumb-item">Dashboard</li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row size-column">
            <div class="col-xl-6 col-sm-6">
                <div class="card o-hidden small-widget">
                    <div class="card-body total-project border-b-primary border-2"><span class="f-light f-w-500 f-14">Peserta Terdaftar</span>
                        <div class="project-details">
                            <div class="project-counter">
                                <h2 class="f-w-600">{{$countPeserta}}</h2><span class="f-12 f-w-400">(Peserta)</span>
                            </div>
                            <div class="product-sub bg-primary-light">
                                <i class="fa fa-users text-white"></i>
                            </div>
                        </div>
                        <ul class="bubbles">
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-6 col-sm-6">
                <div class="card o-hidden small-widget">
                    <div class="card-body total-project border-b-primary border-2"><span class="f-light f-w-500 f-14">Peserta Teregistrasi</span>
                        <div class="project-details">
                            <div class="project-counter">
                                <h2 class="f-w-600">{{$countRegistrasi}}</h2><span class="f-12 f-w-400">(Peserta)</span>
                            </div>
                            <div class="product-sub bg-primary-light">
                                <i class="fa fa-user-plus text-white"></i>
                            </div>
                        </div>
                        <ul class="bubbles">
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row size-column">
            <div class="col-xl-3 col-sm-6">
                <div class="card o-hidden small-widget">
                    <div class="card-body total-project border-b-warning border-2"><span class="f-light f-w-500 f-14">Absensi Hari 1</span>
                        <div class="project-details">
                            <div class="project-counter">
                                <h2 class="f-w-600">{{$countAbsensi1}}</h2><span class="f-12 f-w-400">(Peserta)</span>
                            </div>
                            <div class="product-sub bg-primary-light">
                                <i class="fa fa-user-check text-white"></i>
                            </div>
                        </div>
                        <ul class="bubbles">
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card o-hidden small-widget">
                    <div class="card-body total-project border-b-secondary border-2"><span class="f-light f-w-500 f-14">Absensi Hari 2</span>
                        <div class="project-details">
                            <div class="project-counter">
                                <h2 class="f-w-600">{{$countAbsensi2}}</h2><span class="f-12 f-w-400">(Peserta)</span>
                            </div>
                            <div class="product-sub bg-primary-light">
                                <i class="fa fa-user-check text-white"></i>
                            </div>
                        </div>
                        <ul class="bubbles">
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card o-hidden small-widget">
                    <div class="card-body total-project border-b-info border-2"><span class="f-light f-w-500 f-14">Absensi Hari 3</span>
                        <div class="project-details">
                            <div class="project-counter">
                                <h2 class="f-w-600">{{$countAbsensi3}}</h2><span class="f-12 f-w-400">(Peserta)</span>
                            </div>
                            <div class="product-sub bg-primary-light">
                                <i class="fa fa-user-check text-white"></i>
                            </div>
                        </div>
                        <ul class="bubbles">
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card o-hidden small-widget">
                    <div class="card-body total-upcoming"><span class="f-light f-w-500 f-14">Absensi Hari 4</span>
                        <div class="project-details">
                            <div class="project-counter">
                                <h2 class="f-w-600">{{$countAbsensi4}}</h2><span class="f-12 f-w-400">(Peserta)</span>
                            </div>
                            <div class="product-sub bg-primary-light">
                                <i class="fa fa-user-check text-white"></i>
                            </div>
                        </div>
                        <ul class="bubbles">
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                            <li class="bubble"></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
