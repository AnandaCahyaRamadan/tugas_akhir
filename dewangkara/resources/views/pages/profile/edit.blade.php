@extends('layouts.main')

@section('title', $title = 'Profil')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> {{ $title }}</h4>
    <div class="card mb-4">
        <form action="{{ route('profile.update', Crypt::encryptString($user->id)) }}" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <h5 class="card-header">Detail Profil</h5>
            <div class="card-body">
                <div class="d-flex align-items-start align-items-sm-center gap-4">
                    <img @if (Auth::user()->avatar)
                    src=" {{ asset('storage/'. Auth::user()->avatar) }}"
                    @else
                    src="{{ asset('template/img/no-image.png') }}"
                    @endif
                    alt="user-avatar"
                    class="d-block rounded img-preview"
                    height="100"
                    width="100"
                    id="avatar"
                    />
                    <div class="button-wrapper">
                        <label for="upload" class="btn btn-danger me-2 mb-4" tabindex="0">
                            <span class="d-none d-sm-block">Pilih File</span>
                            <i class="bx bx-upload d-block d-sm-none"></i>
                            <input name="upload_image" id="upload_image" accept="image/png, image/jpeg" type="file"
                                class="account-file-input" hidden />
                        </label>
                        <small><div id="image_format_error" class="text-danger"></div></small>
                        <p class="text-muted mb-0">File JPG, JPEG atau PNG. Ukuran maksimal 2 MB</p>
                    </div>
                </div>
            </div>

            {{-- modal upload image --}}
            <div id="uploadimageModal" class="modal" role="dialog">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalCenterTitle">CROP GAMBAR</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-lg-12 text-center">
                                    <div id="image_demo" style="width:350px; margin-top:30px; margin: 0 auto;"></div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                Batal
                            </button>
                            <button type="button" class="btn btn-primary crop_image">Simpan</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Account -->
            <hr class="my-0" />
            <div class="card-body">
                <div class="row">
                    @if(Auth::user()->hasRole('cover-patner'))
                    <div class="mb-3 col-md-6">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" id="nama" class="form-control @error('nama') is-invalid @enderror"
                            name="nama" placeholder="Masukkan Nama Lengkap Sesuai KTP" value="{{$user->nama }}"
                            autofocus />
                        @error('nama')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="nik" class="form-label">Nomor Induk Kependudukan (NIK)</label>
                        <input type="text" id="nik" class="form-control @error('nik') is-invalid @enderror" name="nik"
                            placeholder="Masukkan Nomor Induk Kependudukan" value="{{ $user->nik }}" autofocus
                            disabled />
                        @error('nik')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    @else
                    <div class="mb-3 col-md-12">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" id="nama" class="form-control @error('nama') is-invalid @enderror"
                            name="nama" placeholder="Masukkan Nama Lengkap Sesuai KTP" value="{{$user->nama }}"
                            autofocus />
                        @error('nama')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    @endif
                    <div class="mb-3 col-md-6">
                        <label for="alamat_ktp" class="form-label">Alamat</label>
                        <textarea type="text" id="alamat_ktp"
                            class="form-control @error('alamat_ktp') is-invalid @enderror" name="alamat_ktp"
                            placeholder="Masukkan Alamat Sesuai KTP" autofocus>{{ $user->alamat_ktp }}</textarea>
                        @error('alamat_ktp')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" placeholder="Masukkan Email" value="{{ $user->email }}" disabled />
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            {{ $message }}
                        </span>
                        @enderror
                    </div>
                    @if(Auth::user()->hasRole('cover-patner'))
                    <div class="mb-3 col-md-6">
                        <label for="no_wa" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control @error('no_wa') is-invalid @enderror" id="no_wa"
                            name="no_wa" value={{ $user->no_wa }}
                        placeholder="Masukkan Nomor Telepon WhatsApp" autofocus />
                        @error('no_wa')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="no_rekening" class="form-label">Nomor Rekening</label>
                        <input type="text" class="form-control @error('no_rekening') is-invalid @enderror"
                            id="no_rekening" name="no_rekening" value="{{ $user->no_rekening }}"
                            placeholder="Masukkan Nomor Rekening Sesuai Bank" autofocus disabled />
                        @error('no_rekening')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    @else
                    <div class="mb-3 col-md-12">
                        <label for="no_wa" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control @error('no_wa') is-invalid @enderror" id="no_wa"
                            name="no_wa" value={{ $user->no_wa }}
                        placeholder="Masukkan Nomor Telepon WhatsApp" autofocus />
                        @error('no_wa')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    @endif
                    <div class="mb-3 col-md-6">
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
                    <div class="mb-3 col-md-6">
                        <label class="form-label" for="password">Ulangi Password</label>
                        <div class="input-group input-group-merge">
                            <input type="password" class="form-control" id="password-confirm"
                                placeholder="Ulangi Password" name="password_confirmation">
                            <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                        </div>
                    </div>
                    <div class="mb-3 col-md-6" hidden>
                        <label class="form-label" for="foto_ktp">Foto KTP</label>
                        @if($user->foto_ktp)
                        <img src="{{ asset('storage/' . $user->foto_ktp) }}"
                            class="img-preview img-fluid mb-3 col-sm-5 d-block">
                        @endif
                        <input type="file" class="form-control @error('foto_ktp') is-invalid @enderror" id="foto_ktp"
                            name="foto_ktp" onchange="previewImage()" />
                        @error('foto_ktp')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6" hidden>
                        <label for="bank_id" class="form-label">Bank</label>
                        <select class="form-select @error('bank_id') is-invalid @enderror" id="bank_id" name="bank_id"
                            aria-label="Pilih Bank yang Anda Gunakan">
                            <option selected disabled>Pilih Bank</option>
                            @foreach ($bank as $bank)
                            <option value="{{ $bank->id }}" {{ ($bank->id == $user->bank_id ) ? 'selected' : '' }}>{{
                                $bank->nama }}</option>
                            @endforeach
                        </select>
                        @error('bank_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    @if(Auth::user()->hasRole('cover-patner'))
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
                                <button id="addInput" class="btn btn-sm btn-primary d-flex" type="button"><i
                                        class='bx bxs-plus-square'></i></button>
                                <button id="removeInput" class="btn btn-sm btn-danger d-flex ms-1" type="button"><i
                                        class='bx bxs-minus-square'></i></button>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <a href="/dashboard" class="btn btn-outline-secondary">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div>
    </div>
    </form>
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
{{-- <script>
    function previewImage(){
    const image = document.querySelector('#upload');
    const imgPreview = document.querySelector('.img-preview');
    imgPreview.style.display = 'block';
    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);
    oFReader.onload = function(oFREvent){
    imgPreview.src = oFREvent.target.result;
    }
}
</script> --}}
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
</script>

<script>
    $(document).ready(function () {
        var $image_crop = $('#image_demo').croppie({
            enableExif: true,
            viewport: {
                width: 200,
                height: 200,
                type: 'square'//circle
            },
            boundary: {
                width: 300,
                height: 300
            }
        });

        $('#upload_image').on('change', function () {
            var reader = new FileReader();
            reader.onload = function (event) {
                $image_crop.croppie('bind', {
                    url: event.target.result
                }).then(function () {
                    console.log('jQuery bind complete');
                });
            }

            var input = this;
            var imageFile = input.files[0];

            // Validasi format gambar
            var allowedFormats = ['jpeg', 'jpg', 'png'];
            var fileFormat = imageFile.name.split('.').pop().toLowerCase();
            if (allowedFormats.indexOf(fileFormat) === -1) {
                // Tampilkan pesan kesalahan format di bawah input
                $('#image_format_error').text('Kolom avatar harus berupa file dengan ekstensi: jpeg, png, jpg.');
                return;
            } else {
                // Reset pesan kesalahan format jika valid
                $('#image_format_error').text('');
            }

            // Validasi ukuran maksimal (2 MB)
            var maxSize = 2048; // dalam KB
            var fileSize = imageFile.size / 1024; // Ubah ukuran gambar ke KB
            if (fileSize > maxSize) {
                // Tampilkan pesan kesalahan ukuran di bawah input
                $('#image_size_error').text('Ukuran avatar maksimal 2 MB.');
                return;
            } else {
                // Reset pesan kesalahan ukuran jika valid
                $('#image_size_error').text('');
            }

            reader.readAsDataURL(this.files[0]);
            $('#uploadimageModal').modal('show');
        });
        
        var previousFileName = '';
        // Event listener untuk mendeteksi ketika modal di-close
        $('#uploadimageModal').on('hidden.bs.modal', function () {
            // Reset label "Pilih File" ke nama file sebelumnya
            var chooseFileButton = document.querySelector('.button-wrapper label[for="upload"]');
            chooseFileButton.querySelector("span").textContent = previousFileName || 'Pilih File';

            // Reset nilai dari input file
            var fileInput = document.getElementById('upload_image');
            fileInput.value = '';
        });

        $('.crop_image').click(function (event) {
            $image_crop.croppie('result', {
                type: 'canvas',
                size: 'viewport'
            }).then(function (response) {
                // Mengganti gambar avatar dengan hasil potongan
                $('#avatar').attr('src', response);
                // Menampilkan gambar hasil potongan di dalam halaman web
                $('#uploaded_image').html('<img src="' + response + '">');
                $('#uploadimageModal').modal('hide');


            // Simpan gambar yang di-crop ke server menggunakan AJAX
                $.ajax({
                    url: '{{ route('uploadCropImage') }}',
                    type: 'POST',
                    data: { image: response },
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    success: function (data) {
                        console.log(data);

                        // Perbarui gambar avatar dengan yang baru
                        $('#avatar').attr('src', data.newAvatarURL); // Gantilah "data.newAvatarURL" dengan URL gambar avatar yang baru

                        // Tampilkan pesan SweetAlert
                        Swal.fire({
                            title: 'Sukses!',
                            text: 'Gambar berhasil di-crop dan disimpan.',
                            icon: 'success',
                            confirmButtonColor: '#696cff',
                            confirmButtonText: 'OK'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                // Memuat ulang halaman web saat tombol "OK" diklik
                                window.location.reload();
                            }
                        });
                    },
                    error: function (error) {
                        console.error(error);
                        // Menampilkan pesan SweetAlert jika ada kesalahan
                        Swal.fire({
                            title: 'Error!',
                            text: 'Terjadi kesalahan saat menyimpan gambar.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                });
            })
        });
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Temukan tombol "Pilih File" dan input file terkait
        var chooseFileButton = document.querySelector('.button-wrapper label[for="upload"]');
        var fileInput = document.getElementById('upload_image');

        // Tambahkan event listener untuk tombol "Pilih File"
        chooseFileButton.addEventListener("click", function () {
            // Simulasikan klik pada input file saat tombol "Pilih File" ditekan
            fileInput.click();
        });

        // Event listener untuk input file
        fileInput.addEventListener("change", function () {
            // Ambil nama file yang dipilih
            var fileName = this.value.split("\\").pop();
            // Tampilkan nama file yang dipilih jika ada, atau kembalikan ke "Pilih File" jika tidak ada
            chooseFileButton.querySelector("span").textContent = fileName || 'Pilih File';
        });
    });
</script>
