@extends('layouts.app')
@section('title', 'Register')
@section('content')
<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <!-- Register Card -->
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center">
                        <a href="" class="app-brand-link gap-2">
                            <img src="{{ asset ('template/img/logo.png') }}" alt="" width="100px">
                        </a>
                    </div>
                    <!-- /Logo -->
                    <form id="formAuthentication" class="mb-3" action="{{ route('register') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Masukkan Nama Lengkap Sesuai KTP" autofocus/>
                            @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="nik" class="form-label">Nomor Induk Kependudukan (NIK)</label>
                            <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" value="{{ old('nik') }}" placeholder="Masukkan Nomor Induk Kependudukan" autofocus/>
                            @error('nik')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="kota" class="form-label">Kota</label>
                            <select class="form-select @error('kota') is-invalid @enderror" id="single-select-field" name="kota" aria-label="Pilih kota yang Anda Gunakan">
                                <option selected disabled>Pilih Kota</option>
                                @foreach ($kota as $kota)
                                <option value="{{ $kota->id }}" @if(old('kota') == $kota->id) selected @endif>{{ $kota->name }}</option>
                                @endforeach
                            </select>
                            @error('kota')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="alamat_ktp" class="form-label">Alamat</label>
                            <textarea type="text" class="form-control @error('alamat_ktp') is-invalid @enderror" id="alamat_ktp" name="alamat_ktp" placeholder="Masukkan Alamat Sesuai KTP" autofocus>{{ old('alamat_ktp') }}</textarea>
                            @error('alamat_ktp')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" placeholder="Masukkan Email Anda" />
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <label class="form-label" for="password">Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Masukkan Password" aria-describedby="password"/>
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <label class="form-label" for="password">Ulangi Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" class="form-control" id="password-confirm" placeholder="Ulangi Password" name="password_confirmation">
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="no_wa" class="form-label">Nomor Telepon</label>
                            <input type="text" class="form-control @error('no_wa') is-invalid @enderror" id="no_wa" name="no_wa" value="{{ old('no_wa') }}" placeholder="Masukkan Nomor Telepon WhatsApp" autofocus/>
                            @error('no_wa')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="bank_id" class="form-label">Bank</label>
                            <select class="form-select @error('bank_id') is-invalid @enderror" id="single-select-field" name="bank_id" aria-label="Pilih Bank yang Anda Gunakan">
                                <option selected disabled>Pilih Bank</option>
                                @foreach ($banks as $bank)
                                <option value="{{ $bank->id }}" @if(old('bank_id') == $bank->id) selected @endif>{{ $bank->nama }}</option>
                                @endforeach
                            </select>
                            @error('bank_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="no_rekening" class="form-label">Nomor Rekening</label>
                            <input type="text" class="form-control @error('no_rekening') is-invalid @enderror" id="no_rekening" name="no_rekening" value="{{ old('no_rekening') }}" placeholder="Masukkan Nomor Rekening Sesuai Bank" autofocus/>
                            @error('no_rekening')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="avatar">Foto KTP</label>
                            <input type="file" class="form-control @error('foto_ktp') is-invalid @enderror" id="foto_ktp" name="foto_ktp" />
                            @error('foto_ktp')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="avatar">Foto Avatar <span class="text-danger"> (1 : 1)</span></label>
                            <input type="file" class="form-control @error('avatar') is-invalid @enderror" id="avatar" name="avatar" />
                            @error('avatar')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="channel" class="form-label">Channel</label>
                            <div id="inputContainer" class="mb-2">
                                <div class="input-group mb-2">
                                    <input type="text" class="form-control @error('channel') is-invalid @enderror" name="channel[]" placeholder="Masukkan Link Channel" autofocus value="{{ old('channel[]') }}"/>
                                    <input type="text" class="form-control @error('nama_channel') is-invalid @enderror" name="nama_channel[]" placeholder="Nama Channel" required value="{{ old('nama_channel[]') }}"/>
                                </div>
                                @error('channel')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                @error('nama_channel')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="d-flex">
                                <button id="addInput" class="btn btn-sm btn-primary d-flex" type="button"><i class='bx bxs-plus-square'></i></button>
                                <button id="removeInput" class="btn btn-sm btn-danger d-flex ms-1" type="button"><i class='bx bxs-minus-square'></i></button>
                            </div>
                        </div>                        
                        <button class="btn btn-primary d-grid w-100" type="submit">Register</button>
                    </form>

                    <p class="text-center">
                        <span>Sudah punya akun?</span>
                        <a href="{{ route('login') }}">
                            <span>Login</span>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function () {
    const inputContainer = document.getElementById("inputContainer");
    const addInputButton = document.getElementById("addInput");
    const removeInputButton = document.getElementById("removeInput");

    addInputButton.addEventListener("click", function () {
        const newInputContainer = document.createElement("div");
        newInputContainer.className = "input-group mb-2";

        const newLinkInput = document.createElement("input");
        newLinkInput.type = "text";
        newLinkInput.className = "form-control";
        newLinkInput.name = "channel[]";
        newLinkInput.placeholder = "Masukkan Link Channel";

        const newChannelNameInput = document.createElement("input");
        newChannelNameInput.type = "text";
        newChannelNameInput.className = "form-control";
        newChannelNameInput.name = "nama_channel[]";
        newChannelNameInput.placeholder = "Nama Channel";

        const removeButton = document.createElement("button");
        removeButton.className = "btn btn-sm btn-danger d-flex ms-1";
        removeButton.type = "button";
        removeButton.innerHTML = "<i class='bx bxs-minus-square'></i>";
        removeButton.addEventListener("click", function () {
            inputContainer.removeChild(newInputContainer);
        });

        newInputContainer.appendChild(newLinkInput);
        newInputContainer.appendChild(newChannelNameInput);

        inputContainer.appendChild(newInputContainer);
    });

    removeInputButton.addEventListener("click", function () {
        const inputGroups = inputContainer.querySelectorAll(".input-group");
        if (inputGroups.length > 1) {
            inputContainer.removeChild(inputGroups[inputGroups.length - 1]);
        }
    });
});

</script>
