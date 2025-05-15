@extends('be.master')
@section('navbar')
    @include('be.navbar')
@endsection
@section('sidebar')
    @include('be.sidebar')
@endsection
@section('content')

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <div class="container-fluid">
                <div class="row page-titles mx-0">
                    <div class="col-sm-6 p-md-0">
                        <div class="welcome-text">
                            <h4>Hi, welcome back!</h4>
                            <p class="mb-0">Selamat datang di Dashboard Admin</p>
                        </div>
                    </div>
                    <div class="col-sm-6 p-md-0 justify-content-sm-end mt-2 mt-sm-0 d-flex">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Admin</a></li>
                            <li class="breadcrumb-item active"><a href="javascript:void(0)">Dashboard</a></li>
                        </ol>
                    </div>
                </div>

                <div class="row">
                    <!-- Card Statistik Pengguna -->
                    <div class="col-xl-3 col-lg-6 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <h2 class="text-primary">150</h2>
                                        <span class="text-muted">Total Pengguna</span>
                                    </div>
                                    <div class="icon-box bg-primary">
                                        <i class="mdi mdi-account-multiple"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Card Statistik Karyawan -->
                    <div class="col-xl-3 col-lg-6 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <h2 class="text-success">120</h2>
                                        <span class="text-muted">Total Karyawan</span>
                                    </div>
                                    <div class="icon-box bg-success">
                                        <i class="mdi mdi-badge-account"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Card Statistik Berita -->
                    <div class="col-xl-3 col-lg-6 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <h2 class="text-info">45</h2>
                                        <span class="text-muted">Total Berita</span>
                                    </div>
                                    <div class="icon-box bg-info">
                                        <i class="mdi mdi-newspaper"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Card Statistik Banned User -->
                    <div class="col-xl-3 col-lg-6 col-sm-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <div>
                                        <h2 class="text-danger">5</h2>
                                        <span class="text-muted">User Banned</span>
                                    </div>
                                    <div class="icon-box bg-danger">
                                        <i class="mdi mdi-account-off"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->
@endsection
@section('footer')
    @include('be.footer')
@endsection