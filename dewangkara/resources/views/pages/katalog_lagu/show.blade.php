@extends('layouts.main')

@section('title', $title = 'Katalog Lagu')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> {{ $title }} / Detail</h4>
    <div class="card mb-4">
        <h5 class="card-header">Detail Katalog Lagu</h5>
        <hr class="m-0" />
        <div class="card-body">
            <div class="row">
                <!-- List group Icons -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">JUDUL LAGU</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $katalog->judul }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">PENCIPTA LAGU</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $katalog->pencipta_lagu }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">PEMBAWA LAGU</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $katalog->pembawa_lagu }}
                        </div>
                    </div>
                    <hr>
                    @if ($katalog->link_vidio_lagu)
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">LINK VIDEO</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <a href="{{ $katalog->link_vidio_lagu }}" target="_blank" class="btn btn-sm btn-primary">Play</a>
                        </div>
                    </div>
                    <hr>
                    @endif
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">PUBLISHER</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $katalog->User->nama }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="modal-footer">
                            <a href="{{ route('katalog.index') }}" class="btn btn-outline-secondary">Kembali</a>
                            @if(Auth::user()->hasRole('super-admin') || Auth::user()->hasRole('cover-patner'))
                            <a href="{{ route('pengajuan-cover.create',   Crypt::encryptString($katalog->id)) }}" class="btn btn-primary">Ajukan</a>
                            @endif
                        </div>
                    </div>
                    <!--/ List group Icons -->
                </div>
            </div>
        </div>
    </div>
    @endsection


