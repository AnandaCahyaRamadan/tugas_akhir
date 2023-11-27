@extends('layouts.main')

@section('title', $title = 'Testimoni')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> {{ $title }} / Detail</h4>
    <div class="card mb-4">
        <h5 class="card-header">Detail Testimoni</h5>
        <hr class="m-0" />
        <div class="card-body">
            <div class="row">
                <!-- List group Icons -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Testimoni</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $testimoni->testimoni }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">Member</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $testimoni->User->nama }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="modal-footer">
                            <a href="{{ route('testimoni.index') }}" class="btn btn-outline-secondary">Kembali</a>
                        </div>
                    </div>
                    <!--/ List group Icons -->
                </div>
            </div>
        </div>
    </div>
    @endsection


