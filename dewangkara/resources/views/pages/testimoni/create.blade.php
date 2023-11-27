@extends('layouts.main')

@section('title', $title = 'Testimoni')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> {{ $title }} / Tambah</h4>
    <!-- Responsive Table -->
    <div class="card">
        <h5 class="card-header">Tambah Testimoni</h5>
        <hr class="my-0" />
        <form action="{{ route('testimoni.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="form-group">
                        <div class="col mb-3">
                            <label for="testimoni" class="form-label">Testimoni</label>
                            <textarea type="text" id="testimoni" class="form-control @error('testimoni') is-invalid @enderror"
                                name="testimoni" placeholder="Masukkan testimoni" value="{{ old('testimoni') }}" autofocus /></textarea>
                            @error('testimoni')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col mb-3">
                            <label for="user_id" class="form-label">Member</label>
                            <select class="form-select @error('user_id') is-invalid @enderror" id="single-select-field"
                                name="user_id" aria-label="Pilih Bank yang Anda Gunakan">
                                <option selected disabled>Pilih Member</option>
                                @foreach ($users as $item)
                                <option value="{{ $item->id }}"
                                    @if(old('user_id')==$item->id) selected data-link-channel="{{ $item->id }}"@endif>{{
                                    $item->nama }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="{{ route('testimoni.index') }}" class="btn btn-outline-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection
