@extends('layouts.main')

@section('title', $title = 'Riwayat Pembayaran')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> {{ $title }} / Detail</h4>
    <div class="card mb-4">
        <h5 class="card-header">Detail Riwayat Pembayaran</h5>
        <hr class="m-0" />
        <div class="card-body">
            <div class="row">
                <!-- List group Icons -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">CHANNEL</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                                @foreach($pembayaran->pivot_channels as $keys => $value)
                                    <a target="_blank" class="text-secondary" href="{{ $value->link_channel }}">{{ $value->link_channel }}</a><br>
                                @endforeach
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">TANGGAL</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $pembayaran->tanggal_pembayaran }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">NOMINAL</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            @currency($pembayaran->nominal_pembayaran)
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">STATUS</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            @if ($pembayaran->status == 'pending')
                                <span class="bg-warning p-2 rounded text-white">Menunggu</span>
                            @endif
                            @if ($pembayaran->status == 'success')
                                <span class="bg-success p-2 rounded text-white">Diterima</span>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">DETAIL PEMBAYARAN <small class="text-danger small"><em>(PDF)</em></small></h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            @if($pembayaran->detail_pembayaran)
                            <a href="{{ asset('storage/' . $pembayaran->detail_pembayaran) }}" download><button class="btn btn-primary" ><i class='bx bx-download'></i> Download</button></a>
                            @else
                            <a href=""><button  class="btn btn-danger"disabled><i class='bx bx-download'></i> Download</button></a>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">RINCIAN PEMBAYARAN <small class="text-danger small"><em>(CSV)</em></small></h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            @if($pembayaran->rincian_pembayaran)
                            <a href="{{ asset('storage/' . $pembayaran->rincian_pembayaran) }}" download><button class="btn btn-primary" ><i class='bx bx-download'></i> Download</button></a>
                            @else
                            <a href=""><button  class="btn btn-danger"disabled><i class='bx bx-download'></i> Download</button></a>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">BUKTI PEMBAYARAN <small class="text-danger small"><em>(JPEG, JPG)</em></small></h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            @if($pembayaran->bukti_pembayaran)
                            <a href="{{ asset('storage/' . $pembayaran->bukti_pembayaran) }}" download><button class="btn btn-primary" ><i class='bx bx-download'></i> Download</button></a>
                            @else
                            <a href=""><button  class="btn btn-danger"disabled><i class='bx bx-download'></i> Download</button></a>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="modal-footer">
                            @if(Auth::user()->hasRole('super-admin'))
                            <a href="{{ route('pembayaran_cover_patner.riwayat', Crypt::encryptString($pembayaran->user_id)) }}" class="btn btn-outline-secondary">Kembali</a>
                            @endif
                            @if(Auth::user()->hasRole('cover-patner'))
                            <a href="{{ route('pembayaran_cover_patner.riwayatCover', Crypt::encryptString(Auth::user()->id)) }}" class="btn btn-outline-secondary">Kembali</a>
                            @endif
                        </div>
                    </div>
                    <!--/ List group Icons -->
                </div>
            </div>
        </div>
    </div>
    @endsection
