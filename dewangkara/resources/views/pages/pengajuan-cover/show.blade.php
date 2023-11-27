@extends('layouts.main')

@php
if(Auth::user()->hasRole('publisher')) {
$title = 'Member Cover Patner';
} else {
$title = 'Pengajuan Cover';
}
@endphp

@section('title', $title)

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> {{ $title }} / Detail</h4>
    <div class="card mb-4">
        <h5 class="card-header">Detail Pengajuan Cover</h5>
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
                            {{ $pengajuan->katalog->judul }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">PENCIPTA LAGU</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $pengajuan->katalog->pencipta_lagu }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">LAGU</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            <td><a href="{{ $pengajuan->katalog->link_vidio_lagu }}" class="btn btn-sm btn-primary"
                                    target="_blank">Play</a></td>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">PUBLISHER</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $pengajuan->katalog->User->nama }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">STATUS COVER</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            @if ($pengajuan->status == null)
                            <span class="bg-secondary p-1 rounded text-white">Belum Mengajukan</span>
                            @endif
                            @if ($pengajuan->status == 'pending')
                            <span class="bg-warning p-1 rounded text-white">Menunggu</span>
                            @endif
                            @if ($pengajuan->status == 'accepted')
                            <span class="bg-success p-1 rounded text-white">Diterima</span>
                            @endif
                            @if ($pengajuan->status == 'rejected')
                            <span class="bg-danger p-1 rounded text-white">Ditolak</span>
                            @endif
                            @if(Auth::user()->hasRole('publisher'))
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-chevron-down"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item"
                                    href="{{ Route('pengajuan-cover.updateAccepted', Crypt::encryptString($pengajuan->id)) }}"><i
                                        class='bx bxs-check-square me-1'></i> Terima</a>
                                <a class="dropdown-item"
                                    href="{{ Route('pengajuan-cover.updateRejected', Crypt::encryptString($pengajuan->id)) }}"><i
                                        class='bx bxs-x-square me-1'></i> Tolak</a>
                            </div>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">PENGCOVER</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $pengajuan->user->nama }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">NAMA CHANNEL COVER</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $pengajuan->nama_channel }}
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">LINK CHANNEL COVER</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            {{ $pengajuan->link_channel }}
                        </div>
                    </div>
                    <hr>
                    @if(($pengajuan->status != 'rejected' && $pengajuan->status != 'pending' && (Auth::user()->hasRole('super-admin') ||
                    Auth::user()->hasRole('cover-patner')))||(($pengajuan->is_active == 'pending' ||
                    $pengajuan->is_active == 'accepted') && Auth::user()->hasRole('publisher')))
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">AUDIO</h6>
                            @if(Auth::user()->hasRole('super-admin') || Auth::user()->hasRole('cover-patner'))
                            <p class="me-auto text-danger"><small><em>*16 bit 44100 khz - 24 bit 48000 khz berformat wav.</em></small></p>
                            @endif
                        </div>
                        <div class="col-sm-9 text-secondary">
                            @if($pengajuan->audio)
                            <!-- Display the currently uploaded audio file -->
                            <audio controls>
                                <source src="{{ asset('storage/'.$pengajuan->audio) }}" type="audio/mpeg">
                                Browser Anda tidak mendukung pemutar audio.
                            </audio>
                            <div>
                                <span><a href="{{ asset('storage/'.$pengajuan->audio)}}"
                                        class="bg-primary p-1 rounded text-white"><i class='bx bx-download'></i>
                                        Download</a></span>
                            </div>
                            @endif
                            @if(($pengajuan->audio == null && $pengajuan->is_active == 'rejected')||($pengajuan->audio
                            == null && $pengajuan->is_active == null))
                            <!-- Display a file input field for audio -->
                            <form id="fileUploadForm"
                                action="{{ route('pengajuan-cover.updateAudio', $pengajuan->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="input-group">
                                    <input type="file" name="audio"
                                        class="form-control @error('audio') is-invalid @enderror">
                                    <button type="submit" class="btn btn-sm rounded-end btn-primary"
                                        @if(Auth::user()->hasRole('publisher') || ($pengajuan->status ==
                                        'pending'||$pengajuan->status == 'rejected'))disabled @endif>Upload</button>
                                </div>
                                <div class="progress mt-2" style="display: none;">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary"
                                        role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
                                        style="width: 0%;">0%</div>
                                </div>
                            </form>
                            @error('audio')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                            <small><span id="audioBitrateError"></span></small>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">ART WORK</h6>
                            @if(Auth::user()->hasRole('super-admin') || Auth::user()->hasRole('cover-patner'))
                            <p class="me-auto text-danger"><small><em>*Format JPEG/JPG ukuran 2000x2000 px. Hanya berisi nama claimer dan judul lagu.</em></small></p>
                            @endif
                        </div>
                        <div class="col-sm-9 text-secondary">
                            @if($pengajuan->art_track)
                            <!-- Display the currently uploaded art_track file -->
                            <img src="{{ asset('storage/'.$pengajuan->art_track) }}" alt="Thumbnail" width="200">
                            @endif
                            @if(($pengajuan->art_track == null && $pengajuan->is_active ==
                            'rejected')||($pengajuan->art_track == null && $pengajuan->is_active == null))
                            <!-- Display a file input field for art_track -->
                            <form action="{{ route('pengajuan-cover.updateThumbnail', $pengajuan->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="input-group">
                                    <input type="file" name="art_track"
                                        class="form-control @error('art_track') is-invalid @enderror">
                                    <button type="submit" class="btn btn-sm rounded-end btn-primary"
                                        @if(Auth::user()->hasRole('publisher') || ($pengajuan->status ==
                                        'pending'||$pengajuan->status == 'rejected'))disabled @endif>Upload</button>
                                    @error('art_track')
                                    <span class="invalid-feedback" role="alert">
                                        {{ $message }}
                                    </span>
                                    @enderror
                                </div>
                            </form>
                            @endif
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-3">
                            <h6 class="mb-0">STATUS KONTEN</h6>
                        </div>
                        <div class="col-sm-9 text-secondary">
                            @if($pengajuan->is_active)
                            @if ($pengajuan->is_active == null)
                            <span class="bg-secondary p-1 rounded text-white">Belum Mengajukan</span>
                            @endif
                            @if ($pengajuan->is_active == 'pending')
                            <span class="bg-warning p-1 rounded text-white">Menunggu</span>
                            @endif
                            @if ($pengajuan->is_active == 'accepted')
                            <span class="bg-success p-1 rounded text-white">Diterima</span>
                            @endif
                            @if ($pengajuan->is_active == 'rejected')
                            <span class="bg-danger p-1 rounded text-white" style="cursor:pointer" data-bs-toggle="modal"
                                data-bs-target="#modalCenter1">Ditolak</span>
                            <div class="modal fade" id="modalCenter1" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalCenterTitle">Keterangan Ditolak</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="#" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col mb-3">
                                                        <p>{{ $pengajuan->keterangan }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            @endif
                            @else
                            <h5>-</h5>
                            @endif
                            @if(Auth::user()->hasRole('publisher') && $pengajuan->is_active != null)
                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="bx bx-chevron-down"></i>
                            </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item"
                                    href="{{ Route('pengajuan-konten.updateAccepted', Crypt::encryptString($pengajuan->id)) }}"><i
                                        class='bx bxs-check-square me-1'></i> Terima</a>
                                <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalCenter"
                                    href="{{ Route('pengajuan-konten.updateRejected', Crypt::encryptString($pengajuan->id)) }}"><i
                                        class='bx bxs-x-square me-1'></i> Tolak</a>
                            </div>
                            <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="modalCenterTitle">Keterangan Ditolak</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ Route('pengajuan-konten.updateRejected', Crypt::encryptString($pengajuan->id)) }}"
                                            method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col mb-3">
                                                        <label for="keterangan" class="form-label">Keterangan</label>
                                                        <textarea type="text" id="keterangan" class="form-control"
                                                            placeholder="Isi Keterangan" name="keterangan"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary"
                                                    data-bs-dismiss="modal">
                                                    Kembali
                                                </button>
                                                <button type="submit" class="btn btn-primary">Tolak</button>
                                            </div>
                                    </div>
                                    </form>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <hr>
                    @endif
                    <div class="row">
                        <div class="modal-footer">
                            @if(Auth::user()->hasRole('super-admin') || Auth::user()->hasRole('cover-patner'))
                            <p class="me-auto text-danger"><small><em>*Klik tombol tolak untuk melihat keterangan ditolak.</em></small></p>
                            @endif
                            @if(Auth::user()->hasRole('super-admin')&& $pengajuan->is_active != 'rejected' && $pengajuan->is_active != null)
                            <a href="{{ route('pengajuan-konten.destroy', $pengajuan->id) }}"
                                class="btn btn-outline-danger">Hapus Konten</a>
                            @endif
                            <a href="{{ route('pengajuan-cover.index') }}" class="btn btn-outline-secondary">Kembali</a>
                        </div>
                    </div>
                    <!--/ List group Icons -->
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {
    var form = document.getElementById('fileUploadForm');
    var progressBar = document.querySelector('.progress-bar');
    var progressContainer = document.querySelector('.progress');
    var audioInput = document.querySelector('input[name="audio"]');

    form.addEventListener('submit', function (e) {
        e.preventDefault();

        // Periksa apakah ada file yang dipilih
        if (audioInput.files.length === 0) {
            var bitrateErrorElement = document.getElementById('audioBitrateError');
            bitrateErrorElement.textContent = 'Kolom audio wajib diisi.';
            bitrateErrorElement.style.color = 'red';
            return;
        }

        // Periksa ekstensi file audio
        var allowedExtensions = ['.wav'];
        var fileName = audioInput.files[0].name;
        var fileExtension = fileName.substring(fileName.lastIndexOf('.')).toLowerCase();
        if (!allowedExtensions.includes(fileExtension)) {
            var bitrateErrorElement = document.getElementById('audioBitrateError');
            bitrateErrorElement.textContent = 'File audio harus berformat wav.';
            bitrateErrorElement.style.color = 'red';
            return;
        }

        // Tampilkan progress bar saat pengunggahan dimulai
        progressContainer.style.display = 'block';

        // Lanjutkan dengan pengunggahan jika validasi berhasil
        var formData = new FormData(form);

        // Buat objek audio menggunakan howler.js
        var sound = new Howl({
            src: [URL.createObjectURL(audioInput.files[0])],
            format: ['wav'],
            onload: function () {
                // Periksa durasi audio dalam detik
                var durationInSeconds = sound.duration();

                // Konversi durasi ke bit rate (contoh: dalam kbps)
                var bitRate = Math.round((audioInput.files[0].size * 8) / (durationInSeconds * 1000)); // dalam kbps
                console.log('Bit rate:', bitRate, 'kbps');

                // Lakukan validasi bit rate (contoh: harus lebih dari 1536 kbps)
                if (bitRate < 1536) {
                    var bitrateErrorElement = document.getElementById('audioBitrateError');
                    bitrateErrorElement.textContent = 'Bit rate file audio terlalu rendah. Bit rate minimal yang diperlukan adalah 1536 kbps.';
                    bitrateErrorElement.style.color = 'red';
                    return;
                }

                // Setelah semua validasi selesai, lanjutkan dengan pengunggahan
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
                    }
                });

                xhr.addEventListener('error', function () {
                    console.error('Terjadi kesalahan saat mengunggah file.');
                    progressBar.classList.remove('bg-success');
                    progressBar.classList.add('bg-primary');
                    progressBar.textContent = 'Terjadi kesalahan saat mengunggah file.';
                });

                xhr.open('POST', form.getAttribute('action'), true);
                xhr.send(formData);
            }
        });
    });
});



    </script>
    @endsection
