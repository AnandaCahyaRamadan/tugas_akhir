@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
<!-- Content wrapper -->
<div class="content-wrapper">
    <!-- Content -->

    <div class="container-xxl flex-grow-1 container-p-y">
        <div class="row">
            <div class="col-12 col-md-6 col-lg-6 order-3 order-md-2">
                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-center justify-content-between">
                                    <h5 class="text-nowrap mb-2">Jumlah Pengajuan Cover</h5>
                                    <div id="icons1" class="badge badge-center rounded-pill bg-label-primary">
                                        <i class='bx bxs-microphone-alt bx-tada bx-flip-horizontal'></i>
                                    </div>
                                </div>
                                <ul class="p-0 m-0">
                                    <li class="d-flex card-link1">
                                        <div
                                            class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                            <div class="me-2">
                                                <h6 class="mb-0 badge bg-label-success rounded-pill">Diterima</h6>
                                            </div>
                                            <div class="user-progress d-flex align-items-center gap-1">
                                                <h6 class="mb-0">{{ $pengajuanCoverAccepted }}</h6>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="d-flex card-link1">
                                        <div
                                            class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                            <div class="me-2">
                                                <h6 class="mb-0 badge bg-label-warning rounded-pill">Menunggu</h6>
                                            </div>
                                            <div class="user-progress d-flex align-items-center gap-1">
                                                <h6 class="mb-0">{{ $pengajuanCoverPending }}</h6>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="d-flex card-link1">
                                        <div
                                            class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                            <div class="me-2">
                                                <h6 class="mb-0 badge bg-label-danger rounded-pill">Ditolak</h6>
                                            </div>
                                            <div class="user-progress d-flex align-items-center gap-1">
                                                <h6 class="mb-0">{{ $pengajuanCoverRejected }}</h6>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-6 order-3 order-md-2">
                <div class="row">
                    <div class="col-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title d-flex align-items-center justify-content-between">
                                    <h5 class="text-nowrap mb-2">Jumlah Pengajuan Konten</h5>
                                    <div id="icons1" class="badge badge-center rounded-pill bg-label-primary">
                                        <i class='bx bx-music bx-tada bx-flip-horizontal'></i>
                                    </div>
                                </div>
                                <ul class="p-0 m-0">
                                    <li class="d-flex card-link1">
                                        <div
                                            class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                            <div class="me-2">
                                                <h6 class="mb-0 badge bg-label-success rounded-pill">Diterima</h6>
                                            </div>
                                            <div class="user-progress d-flex align-items-center gap-1">
                                                <h6 class="mb-0">{{ $pengajuanKontenAccepted }}</h6>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="d-flex card-link1">
                                        <div
                                            class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                            <div class="me-2">
                                                <h6 class="mb-0 badge bg-label-warning rounded-pill">Menunggu</h6>
                                            </div>
                                            <div class="user-progress d-flex align-items-center gap-1">
                                                <h6 class="mb-0">{{ $pengajuanKontenPending }}</h6>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="d-flex card-link1">
                                        <div
                                            class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                            <div class="me-2">
                                                <h6 class="mb-0 badge bg-label-danger rounded-pill">Ditolak</h6>
                                            </div>
                                            <div class="user-progress d-flex align-items-center gap-1">
                                                <h6 class="mb-0">{{ $pengajuanKontenRejected }}</h6>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <!-- Total Revenue -->
            <div class="col-12 col-lg-12 order-2 order-md-3 order-lg-2 mb-4">
                <div class="card">
                    <div class="row row-bordered g-0">
                        <div class="card-body">
                            <div class="card-title d-flex align-items-center justify-content-between">
                                <h5 class="text-nowrap mb-2">Grafik Pendapatan</h5>
                            </div>
                            <div class="col-md-12">
                            <div style="width: 100%;">
                                {!! $chart->container() !!}
                            </div>

                            {!! $chart->script() !!}
                        </div>
                    </div>
                    </div>
                </div>
            </div>
            <!--/ Total Revenue -->
        </div>
    </div>
</div>

<!-- / Content -->
</div>
<!-- Content wrapper -->
@endsection
