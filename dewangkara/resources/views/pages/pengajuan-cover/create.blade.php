@extends('layouts.main')

@section('title', $title = 'Pengajuan Cover')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> {{ $title }} / Tambah</h4>
    <!-- Responsive Table -->
    <div class="card">
        <h5 class="card-header">Tambah Pengajuan Cover</h5>
        <hr class="my-0" />
        <form action="{{ route('pengajuan-cover.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="form-group">
                        <div class="col mb-3">
                            <label for="judul" class="form-label">Judul Lagu</label>
                            <input type="text" id="judul" class="form-control @error('judul') is-invalid @enderror"
                                name="judul" placeholder="Masukkan Pencipta Lagu" value="{{ $katalog->judul }}"
                                autofocus readonly />
                            @error('judul')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group" hidden>
                        <div class="col mb-3">
                            <label for="id" class="form-label">id Lagu</label>
                            <input type="text" id="id" class="form-control @error('id') is-invalid @enderror" name="id"
                                placeholder="Masukkan Pencipta Lagu" value="{{ $katalog->id }}" autofocus readonly />
                            @error('id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col mb-3">
                            <label for="pencipta_lagu" class="form-label">Pencipta Lagu</label>
                            <input type="text" id="pencipta_lagu"
                                class="form-control @error('pencipta_lagu') is-invalid @enderror" name="pencipta_lagu"
                                placeholder="Masukkan Pencipta Lagu" value="{{ $katalog->pencipta_lagu }}" autofocus
                                readonly />
                            @error('pencipta_lagu')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    @if ($katalog->link_vidio_lagu)
                    <div class="form-group">
                        <div class="col mb-3">
                            <label for="link_vidio_lagu" class="form-label">Link Lagu</label>
                            <input type="text" id="link_vidio_lagu"
                                class="form-control @error('link_vidio_lagu') is-invalid @enderror"
                                name="link_vidio_lagu" placeholder="Masukkan Link Lagu"
                                value="{{ $katalog->link_vidio_lagu }}" autofocus readonly />
                            @error('link_vidio_lagu')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    @endif
                    <div class="form-group">
                        <div class="col mb-3">
                            <label for="publisher_id" class="form-label">Publisher</label>
                            <input type="text" id="publisher_id"
                                class="form-control @error('publisher_id') is-invalid @enderror" name="publisher_id"
                                placeholder="Masukkan Publisher" value="{{ $katalog->User->nama }}" autofocus
                                readonly />
                            @error('publisher_id')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    @if(Auth::user()->hasRole('super-admin'))
                    <div class="form-group">
                        <div class="col mb-3">
                            <label for="created_by" class="form-label">Pengcover</label>
                            <select class="form-select @error('created_by') is-invalid @enderror"
                                id="single-select-field" name="created_by" aria-label="Pilih Bank yang Anda Gunakan">
                                <option selected disabled>Pilih Pengcover Lagu</option>
                                @foreach ($users as $item)
                                <option value="{{ $item->id }}" @if(old('created_by')==$item->id) selected
                                    data-link-channel="{{ $item->id }}"@endif>{{
                                    $item->nama }}</option>
                                @endforeach
                            </select>
                            @error('created_by')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    @endif
                    <div class="form-group">
                        <div class="col mb-3">
                            <label for="nama_channel" class="form-label">Nama Channel Cover</label>
                            <select class="form-select @error('nama_channel') is-invalid @enderror"
                                id="nama_channel_select" name="nama_channel" aria-label="Pilih Nama Channel">
                                <option selected data-user="Pilih Nama Channel" disabled>Pilih Nama Channel</option>
                                @if(Auth::user()->hasRole('super-admin'))
                                @foreach ($channel as $item)
                                <option value="{{ $item->nama_channel }}" data-user="{{ $item->user_id }}"
                                    @if(old('nama_channel')==$item->nama_channel) selected @endif>{{
                                    $item->nama_channel }}</option>
                                @endforeach
                                @endif
                                @if(Auth::user()->hasRole('cover-patner'))
                                @foreach ($channel as $item)
                                <option value="{{ $item->nama_channel }}" @if(old('nama_channel')==$item->nama_channel)
                                    selected @endif>{{
                                    $item->nama_channel }}</option>
                                @endforeach
                                @endif
                            </select>
                            @error('nama_channel')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col mb-3">
                            <label for="link_channel" class="form-label">Link Channel Cover</label>
                            <input type="text" class="form-control @error('link_channel') is-invalid @enderror"
                                id="link_channel_input" name="link_channel" aria-label="Link Channel" readonly>
                            @error('link_channel')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="{{ route('pengajuan-cover.index') }}" class="btn btn-outline-secondary">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>

<!-- Tambahkan JavaScript di sini -->
<!-- Tambahkan JavaScript di sini -->
@if(Auth::user()->hasRole('super-admin'))
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Simpan opsi channel asli saat halaman dimuat
        var originalChannelOptions = $('#nama_channel_select').html();

        // Ketika pemilihan pengcover berubah
        $('#single-select-field').change(function () {
            var selectedUserId = $(this).val();

            // Reset dropdown "Link Channel Cover" ke opsi asli
            $('#nama_channel_select').html(originalChannelOptions);

            // Jika pengcover dipilih, filter opsi channel
            if (selectedUserId) {
                $('#nama_channel_select option').each(function () {
                    var linkChannel = $(this).val();
                    var channelUserId = $(this).data('user');
                    // console.log(linkChannel);
                    // console.log(channelUserId);
                    // Jika channel tidak memiliki pengcover yang sesuai, sembunyikan opsi tersebut
                    if (channelUserId != selectedUserId) {
                        $(this).hide();
                    }
                });
            }
        });
    });
</script>
@endif
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        });

        $('#nama_channel_select').on('change', function () {
            var selectedChannel = $(this).val();

            // Memuat link channel berdasarkan nama channel yang dipilih
            loadLinkChannel(selectedChannel);
        });

        function loadLinkChannel(channelName) {
            $.ajax({
                type: "GET",
                url: "/dashboard/pengajuan-cover/getLinkChannel",
                data: {
                    nama_channel: channelName
                },
                success: function (response) {
                    // console.log(response);

                    if (Array.isArray(response) && response.length > 0) {
                        // Mengambil nilai link_channel dari objek pertama dalam array respons
                        var linkChannel = response[0].link_channel;

                        // Memasukkan nilai link_channel ke dalam input
                        $('#link_channel_input').val(linkChannel).prop('readonly', true);
                    } else {
                        // Jika tidak ada objek atau link_channel tidak ada, mengosongkan dan menonaktifkan input
                        $('#link_channel_input').val('').prop('readonly', true);
                    }
                },
                error: function (data) {
                    console.log('error', data);
                    // Menangani kesalahan jika ada
                }
            });
        }
    });
</script>

@endsection
