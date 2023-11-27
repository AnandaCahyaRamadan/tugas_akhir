@extends('layouts.main')

@section('title', $title = 'User Publisher')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> {{ $title }} / Edit</h4>
    <!-- Responsive Table -->
    <div class="card">
        <h5 class="card-header">Edit User publisher</h5>
        <hr class="my-0" />
        <form action="{{ route('user_publisher.update', Crypt::encryptString($user->id)) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="modal-body">
                <div class="row">
                    <div class="form-group">
                        <div class="col mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" id="nama"
                                class="form-control @error('nama') is-invalid @enderror" name="nama"
                                placeholder="Masukkan Nama Lengkap Sesuai KTP" value="{{$user->nama }}"
                                autofocus />
                            @error('nama')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col mb-3">
                            <label for="alamat_ktp" class="form-label">Alamat</label>
                            <textarea type="text" id="alamat_ktp"
                                class="form-control @error('alamat_ktp') is-invalid @enderror"
                                name="alamat_ktp" placeholder="Masukkan Alamat Sesuai KTP"
                                autofocus>{{ $user->alamat_ktp }}</textarea>
                            @error('alamat_ktp')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" id="email"
                                class="form-control @error('email') is-invalid @enderror" name="email"
                                placeholder="Masukkan Email" value="{{ $user->email }}" />
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col mb-0 form-password-toggle">
                        <label class="form-label" for="password">Password</label>
                        <div class="input-group input-group-merge">
                            <input type="password" id="password"
                                class="form-control @error('password') is-invalid @enderror" name="password"
                                placeholder="Masukkan Password" aria-describedby="password" />
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col mb-0 form-password-toggle">
                        <label class="form-label" for="password">Ulangi Password</label>
                        <div class="input-group input-group-merge">
                            <input type="password" class="form-control" id="password-confirm"
                                placeholder="Ulangi Password" name="password_confirmation">
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="form-group">
                        <div class="col mb-3">
                            <label for="no_wa" class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control @error('no_wa') is-invalid @enderror"
                                id="no_wa" name="no_wa" value={{ $user->no_wa }}
                                placeholder="Masukkan Nomor Telepon WhatsApp" autofocus />
                            @error('no_wa')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a id="delete" href="{{ route('user_publisher.destroy', $user) }}" class="btn btn-danger me-auto" onclick="notificationBeforeDelete(event, this)"><i class=" tf-icons bx bx-trash"></i></a>
                <a href="{{ route('user_publisher.index') }}" class="btn btn-outline-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
@endsection
