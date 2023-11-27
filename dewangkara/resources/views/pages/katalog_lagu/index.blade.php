@extends('layouts.main')

@section('title', $title = 'Katalog Lagu')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> {{ $title }}</h4>
    <!-- Responsive Table -->
    <div class="card">
        <div class="table-responsive text-nowrap">
            @if(Auth::user()->hasRole('super-admin')||Auth::user()->hasRole('publisher'))
            <div class="card-header py-4">
                <div class="row">
                    <div class="col-sm-12 col-md-6 col-lg-6 pb-2"> <!-- Bagian kiri, untuk tombol "Tambah" dan "Export" -->
                        @if(Auth::user()->hasRole('super-admin'))
                        <a href="{{ route('katalog.create') }}" class="btn btn-primary">Tambah</a>
                        <a href="{{ asset('template_katalog_lagu_admin/katalog_lagu.xlsx') }}" class="btn btn-success ml-2" download="">Download Template</a>
                        @endif
                        @if(Auth::user()->hasRole('publisher'))
                        <a href="{{ asset('template_katalog_lagu_publisher/katalog_lagu.xlsx') }}" class="btn btn-success ml-2" download="">Download Template</a>
                        @endif
                    </div>
                    <div class="col-sm-12 col-md-6 col-lg-6 d-flex justify-content-end"> <!-- Bagian kanan, untuk form upload -->
                        <form action="{{ route('katalog.import') }}" method="POST" enctype="multipart/form-data" class="d-inline-block" id="fileUploadForm">
                            @csrf
                            <div class="input-group">
                                <input type="file" name="file" style="width: 50%;" class="form-control" id="fileInput">
                                <button class="btn btn-info rounded-end" type="submit">Unggah</button>
                            </div>
                            <small><div id="importFile" class="text-danger mt-1"></div></small>
                            {{-- <small><div id="katalog_lagu_error" class="text-danger">*Pastikan setiap kolom template telah terisi kecuali kolom youtube</div></small> --}}
                            <div class="progress mt-2" style="display: none;">
                                <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                                    role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                                    style="width: 0%;">0%</div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @else
            <div class="card-header py-3"></div>
            @endif
            <div class="container mb-2">
                <table class="table table-bordered" id="dataTable">
                    <thead>
                        <tr class="text-nowrap">
                            <th style="width: 20px">#</th>
                            <th>Judul Lagu</th>
                            <th>Pencipta Lagu</th>
                            <th>Pembawa Lagu</th>
                            <th>Publisher</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($katalogs as $key => $katalog)
                        <tr>
                            <th scope="row">{{ $key+1 }}</th>
                            <td>{{ $katalog->judul }}</td>
                            <td>{{ $katalog->pencipta_lagu }}</td>
                            <td>{{ $katalog->pembawa_lagu }}</td>
                            <td>{{ $katalog->User->nama }}</td>
                            <td>
                                <div class="dropstart">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow"
                                        data-bs-toggle="dropdown">
                                        <i class="bx bx-dots-vertical-rounded"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="{{ Route('katalog.show', Crypt::encryptString($katalog->id)) }}"><i
                                                class="bx bx-show-alt me-1"></i> Detail</a>
                                        @if(Auth::user()->hasRole('super-admin'))
                                        <a class="dropdown-item" href="{{ Route('katalog.edit', Crypt::encryptString($katalog->id)) }}"><i
                                                class="bx bx-edit-alt me-1"></i> Edit</a>
                                        <a id="delete" href="{{ route('katalog.destroy', $katalog) }}"
                                            class="dropdown-item" onclick="notificationBeforeDelete(event, this)"><i
                                                class=" tf-icons bx bx-trash"></i> Hapus</a>
                                        @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var form = document.getElementById('fileUploadForm');
        var progressBar = document.querySelector('.progress-bar');
        var progressContainer = document.querySelector('.progress');
        var audioInput = document.querySelector('input[name="file"]');

        form.addEventListener('submit', function (e) {
            e.preventDefault();

            // Periksa apakah ada file yang dipilih
            if (audioInput.files.length === 0) {
                var importFileError = document.getElementById('importFile');
                importFileError.textContent = 'Pilih file untuk diunggah.';
                importFileError.style.color = 'red';
                return;
            }

            // Periksa ekstensi file audio
            var allowedExtensions = ['.xlsx'];
            var fileName = audioInput.files[0].name;
            var fileExtension = fileName.substring(fileName.lastIndexOf('.')).toLowerCase();
            if (!allowedExtensions.includes(fileExtension)) {
                var importFileError = document.getElementById('importFile');
                importFileError.textContent = 'Format file harus .xlsx.';
                importFileError.style.color = 'red';
                return;
            }

            // Tampilkan progress bar saat pengunggahan dimulai
            progressContainer.style.display = 'block';

            // Lakukan pengunggahan file (Anda perlu menggantinya sesuai dengan kebutuhan Anda)
            var xhr = new XMLHttpRequest();

            xhr.upload.addEventListener('progress', function (e) {
                var percentCompleted = Math.round((e.loaded * 100) / e.total);
                progressBar.style.width = percentCompleted + '%';
                progressBar.textContent = percentCompleted + '%';
            });

            xhr.addEventListener('load', function () {
                if (xhr.status === 200) {
                    console.log('File berhasil diunggah.');
                    progressBar.classList.remove('bg-primary');
                    progressBar.classList.add('bg-success');
                    progressBar.textContent = 'File berhasil diunggah.';

                    setTimeout(function () {
                        location.reload();
                    }, 2000);
                } else {
                    console.error('Terjadi kesalahan saat mengunggah file.');
                    progressBar.classList.remove('bg-success');
                    progressBar.classList.add('bg-primary');
                    progressBar.textContent = 'Terjadi kesalahan saat mengunggah file.';
                    var importFileError = document.getElementById('importFile');
                    importFileError.textContent = 'Terdapat data kosong dalam file.';
                    importFileError.style.color = 'red';
                    return;
                }
            });

            xhr.addEventListener('error', function () {
                console.error('Terjadi kesalahan saat mengunggah file.');
                progressBar.classList.remove('bg-success');
                progressBar.classList.add('bg-primary');
                progressBar.textContent = 'Terjadi kesalahan saat mengunggah file.';
            });

            xhr.open('POST', form.getAttribute('action'), true);
            xhr.send(new FormData(form));
        });
    });
    </script>
@endsection
