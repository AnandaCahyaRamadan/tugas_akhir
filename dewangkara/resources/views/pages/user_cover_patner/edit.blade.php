@extends('layouts.main')

@section('title', $title = 'User Cover Partner')

@section('content')

<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> {{ $title }} / Edit</h4>
    <!-- Responsive Table -->
    <div class="card">
        <h5 class="card-header">Edit User Cover Partner</h5>
        <hr class="my-0" />
        <form action="{{ route('user_cover_patner.update', Crypt::encryptString($user->id)) }}" method="POST" enctype="multipart/form-data">
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
                            <label for="nik" class="form-label">Nomor Induk Kependudukan (NIK)</label>
                            <input type="text" id="nik"
                                class="form-control @error('nik') is-invalid @enderror" name="nik"
                                placeholder="Masukkan Nomor Induk Kependudukan" value="{{ $user->nik }}"
                                autofocus />
                            @error('nik')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="kota" class="form-label">Kota</label>
                        <select class="form-select @error('kota') is-invalid @enderror" id="single-select-field" name="kota" aria-label="Pilih kota yang Anda Gunakan">
                            <option selected disabled>Pilih Kota</option>
                            @foreach ($kota as $kota)
                            <option value="{{ $kota->id }}" @if($user->kota == $kota->id) selected @endif>{{ $kota->name }}</option>
                            @endforeach
                        </select>
                        @error('kota')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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
                    <div class="form-group">
                        <div class="col mb-3">
                            <label for="bank_id" class="form-label">Bank</label>
                            <select class="form-select @error('bank_id') is-invalid @enderror" id="bank_id"
                                name="bank_id" aria-label="Pilih Bank yang Anda Gunakan">
                                <option selected disabled>Pilih Bank</option>
                                @foreach ($bank as $bank)
                                <option value="{{ $bank->id }}" {{  ($bank->id == $user->bank_id ) ? 'selected' : '' }}>{{ $bank->nama }}</option>
                                @endforeach
                            </select>
                            @error('bank_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col mb-3">
                            <label for="no_rekening" class="form-label">Nomor Rekening</label>
                            <input type="text"
                                class="form-control @error('no_rekening') is-invalid @enderror"
                                id="no_rekening" name="no_rekening" value="{{ $user->no_rekening }}"
                                placeholder="Masukkan Nomor Rekening Sesuai Bank" autofocus />
                            @error('no_rekening')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col mb-3">
                            <label class="form-label" for="foto_ktp">Foto KTP</label>
                            @if($user->foto_ktp)
                            <img src="{{ asset('storage/' . $user->foto_ktp) }}" class="img-preview img-fluid mb-3 col-sm-5 d-block">
                            @endif
                            <input type="file" class="form-control @error('foto_ktp') is-invalid @enderror"
                                id="foto_ktp" name="foto_ktp" onchange="previewImage()" />
                            @error('foto_ktp')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col mb-3">
                            <label class="form-label" for="avatar">Foto Avatar</label>
                            @if($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" class="img-preview2 img-fluid mb-3 col-sm-5 d-block">
                            @else
                            <img src="{{ asset('template/img/no-image.png') }}" class="img-preview2 img-fluid mb-3 col-sm-5 d-block" />
                            @endif
                            <input type="file" class="form-control @error('avatar') is-invalid @enderror"
                                id="avatar" name="avatar" onchange="previewImage2()" />
                            @error('avatar')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col mb-3">
                            <label for="channel" class="form-label">Link Channel</label>
                            <div id="inputContainer" class="mb-2">
                                @foreach ($channels as $channel)
                                    <div class="input-group mb-2">
                                        <input type="text" class="form-control @error('channel') is-invalid @enderror" name="channel[]" placeholder="Masukkan Link Channel" autofocus value="{{ $channel->link_channel }}"/>
                                        <input type="text" class="form-control @error('nama_channel') is-invalid @enderror" name="nama_channel[]" placeholder="Nama Channel" required value="{{ $channel->nama_channel }}"/>
                                    </div>
                                @endforeach
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
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a id="delete" href="{{ route('user_cover_patner.destroy', $user) }}" class="btn btn-danger me-auto" onclick="notificationBeforeDelete(event, this)"><i class=" tf-icons bx bx-trash"></i></a>
                <a href="{{ route('user_cover_patner.index') }}" class="btn btn-outline-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

@endsection
<script>
    function previewImage(){
        const image = document.querySelector('#foto_ktp');
        const imgPreview = document.querySelector('.img-preview');
        imgPreview.style.display = 'block';
        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);
        oFReader.onload = function(oFREvent){
        imgPreview.src = oFREvent.target.result;
        }
    }
</script>
<script>
        function previewImage2(){
        const image = document.querySelector('#avatar');
        const imgPreview = document.querySelector('.img-preview2');
        imgPreview.style.display = 'block';
        const oFReader = new FileReader();
        oFReader.readAsDataURL(image.files[0]);
        oFReader.onload = function(oFREvent){
        imgPreview.src = oFREvent.target.result;
        }
    }
</script>
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
