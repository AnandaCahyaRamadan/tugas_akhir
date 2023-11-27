@extends('layouts.main')

@section('title', $title = 'Katalog Lagu')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> {{ $title }} / Edit</h4>
    <!-- Responsive Table -->
    <div class="card">
        <h5 class="card-header">Edit Katalog Lagu</h5>
        <hr class="my-0" />
        <form action="{{ route('katalog.update', Crypt::encryptString($katalog->id)) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="row">
                    <div class="form-group">
                        <div class="col mb-3">
                            <label for="judul" class="form-label">Judul Lagu</label>
                            <input type="text" id="judul" class="form-control @error('judul') is-invalid @enderror"
                                name="judul" placeholder="Masukkan Judul Lagu" value="{{ $katalog->judul }}" autofocus />
                            @error('judul')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col mb-3">
                            <label for="pencipta_lagu" class="form-label">Pencipta Lagu</label>
                            <input type="text" id="pencipta_lagu"
                                class="form-control @error('pencipta_lagu') is-invalid @enderror" name="pencipta_lagu"
                                placeholder="Masukkan Pencipta Lagu" value="{{ $katalog->pencipta_lagu }}" autofocus />
                            @error('pencipta_lagu')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col mb-3">
                            <label for="pembawa_lagu" class="form-label">Pembawa Lagu</label>
                            <input type="text" id="pembawa_lagu"
                                class="form-control @error('pembawa_lagu') is-invalid @enderror" name="pembawa_lagu"
                                placeholder="Masukkan Pembawa Lagu" value="{{ $katalog->pembawa_lagu }}" autofocus />
                            @error('pembawa_lagu')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col mb-3">
                            <label for="link_vidio_lagu" class="form-label">Link Video</label>
                            <input type="text" id="link_vidio_lagu"
                                class="form-control @error('link_vidio_lagu') is-invalid @enderror"
                                name="link_vidio_lagu" placeholder="Masukkan Link Video"
                                value="{{ $katalog->link_vidio_lagu }}" autofocus />
                            @error('link_vidio_lagu')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col mb-3">
                            <label for="publisher_id" class="form-label">Publisher Lagu</label>
                            <select class="form-select @error('publisher_id') is-invalid @enderror" id="single-select-field"
                                name="publisher_id" aria-label="Pilih Bank yang Anda Gunakan">
                                <option selected disabled>Pilih Publisher Lagu</option>
                                @foreach ($publisher as $publish)
                                <option value="{{ $publish->id }}"  {{  ($publish->id == $katalog->publisher_id ) ? 'selected' : '' }}>{{
                                    $publish->nama }}</option>
                                @endforeach
                            </select>
                            @error('publisher_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="{{ route('katalog.index') }}" class="btn btn-outline-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection
