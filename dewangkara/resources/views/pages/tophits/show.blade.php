@extends('layouts.main')

@section('title', $title = 'Top Hits')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> {{ $title }} / Tambah</h4>
    <!-- Responsive Table -->
    <div class="card">
        <h5 class="card-header">Detail Top Hits</h5>
        <hr class="my-0" />
        <form action="{{ route('tophits.update', Crypt::encryptString($tophits->id)) }}" method="POST" enctype="multipart/form-data">
            @method('put')
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="form-group">
                        <div class="col mb-3">
                            <div class="video_container">
                                <iframe  class="embed-responsive-item iframe_video" src="{{ $tophits->link }}" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="{{ route('tophits.index') }}" class="btn btn-outline-secondary">Kembali</a>
            </div>
        </form>
    </div>
</div>

@endsection
