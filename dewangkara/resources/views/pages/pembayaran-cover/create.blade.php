@extends('layouts.main')

@section('title', $title = 'Pembayaran Cover')

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Dashboard /</span> {{ $title }} / Tambah</h4>
    <!-- Responsive Table -->
    <div class="card">
        <h5 class="card-header">Tambah Pembayaran Cover</h5>
        <hr class="my-0" />
        <form action="{{ route('pembayaran_cover_patner.store', Crypt::encryptString($pembayaran->id)) }}" id="form-id" method="POST"
            enctype="multipart/form-data">
            @csrf
            <div class="modal-body">
                <div class="row">
                    <div class="form-group">
                        <div class="col mb-3">
                            <label for="user_nama" class="form-label">Pengcover</label>
                            <input type="text" id="user_nama"
                                class="form-control @error('user_nama') is-invalid @enderror" name="user_nama"
                                placeholder="Masukkan Pengcover" value="{{ $pembayaran->User->nama }}" autofocus
                                readonly />
                            @error('user_nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group" hidden>
                        <div class="col mb-3">
                            <label for="user_id" class="form-label">Pengcover</label>
                            <input type="text" id="user_id" class="form-control @error('user_id') is-invalid @enderror"
                                name="user_id" placeholder="Masukkan Pengcover" value="{{ $pembayaran->User->id }}"
                                autofocus readonly />
                            @error('user_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="mb-3">
                            <label for="channels" class="form-label">Nama Channels</label>
                            <select class="form-select @error('channels') is-invalid @enderror" id="multiple-select-field" name="channels[]" data-placeholder="Pilih Channel" multiple>
                                @foreach ($channels as $keys => $row)
                                    <option value="{{ $row->id }}">{{ $row->nama_channel }}</option>
                                @endforeach
                            </select>
                            @error('channels')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col mb-3">
                            <label for="tanggal_pembayaran" class="form-label">Tanggal</label>
                            <input type="date" id="tanggal_pembayaran"
                                class="form-control bg-light @error('tanggal_pembayaran') is-invalid @enderror"
                                name="tanggal_pembayaran" placeholder="Masukkan Tanggal"
                                value="{{ old('tanggal_pembayaran') }}" id="tanggal_pembayaran" autofocus />
                            @error('tanggal_pembayaran')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col mb-3">
                            <label for="nominal_pembayaran" class="form-label">Nominal</label>
                            <div class="input-group">
                                <span class="input-group-text">Rp.</span>
                                <input type="text" id="nominal_pembayaran"
                                class="form-control @error('nominal_pembayaran') is-invalid @enderror"
                                name="nominal_pembayaran" placeholder="Masukkan Nominal Pembayaran"
                                value="{{ old('nominal_pembayaran') }}" autofocus />
                                @error('nominal_pembayaran')
                                <span class="invalid-feedback" role="alert">
                                    {{ $message }}
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col mb-3">
                            <label for="detail_pembayaran" class="form-label">Detail Pembayaran <em
                                    class="text-danger">(Pdf)</em></label>
                            <input type="file" id="detail_pembayaran"
                                class="form-control @error('detail_pembayaran') is-invalid @enderror"
                                name="detail_pembayaran" placeholder="Masukkan detail Pembayaran"
                                value="{{ old('detail_pembayaran') }}" autofocus />
                            @error('detail_pembayaran')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col mb-3">
                            <label for="rincian_pembayaran" class="form-label">Rincian Pembayaran <em
                                    class="text-danger">(CSV)</em></label>
                            <input type="file" id="rincian_pembayaran"
                                class="form-control @error('rincian_pembayaran') is-invalid @enderror"
                                name="rincian_pembayaran" placeholder="Masukkan Rincian Pembayaran"
                                value="{{ old('rincian_pembayaran') }}" autofocus />
                            @error('rincian_pembayaran')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col mb-3">
                            <div>
                                <img src="{{ asset ('template/img/no-image.png') }}" id="gambar" class="img-responsive"
                                    style="width: 50%;" alt="Gambar" />
                            </div>
                            <label for="bukti_pembayaran" class="form-label">Bukti Pembayaran <em class="text-danger">(jpeg,
                                    jpg)</em></label>
                            <input type="file" id="bukti_pembayaran"
                                class="form-control @error('bukti_pembayaran') is-invalid @enderror" name="bukti_pembayaran"
                                placeholder="Masukkan Bukti Pembayaran" value="{{ old('bukti_pembayaran') }}" autofocus
                                onchange="previewImage(this)" />
                            @error('bukti_pembayaran')
                            <span class="invalid-feedback" role="alert">
                                {{ $message }}
                            </span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="{{ route('pembayaran_cover_patner.index') }}" class="btn btn-outline-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</div>
<script>
    function previewImage(input) {
        var imgElement = document.getElementById('gambar');
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                imgElement.src = e.target.result;
            }

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<script>
    // Fungsi untuk mengubah angka menjadi format Rupiah
    function formatRupiah(angka) {
        var numberString = angka.toString();
        var splitNumber = numberString.split(',');
        var sisa = splitNumber[0].length % 3;
        var rupiah = splitNumber[0].substr(0, sisa);
        var ribuan = splitNumber[0].substr(sisa).match(/\d{3}/g);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        return splitNumber[1] !== undefined ? rupiah + ',' + splitNumber[1] : rupiah;
    }

    // Fungsi untuk menghapus semua karakter selain angka
    function unformatRupiah(rupiah) {
        return rupiah.replace(/[^\d,]/g, '').replace(/,/g, '');
    }

    // Fungsi untuk mengatur input ke format Rupiah saat berubah
    document.getElementById('nominal_pembayaran').addEventListener('input', function () {
        var value = this.value;
        var unformattedValue = unformatRupiah(value);
        var formattedValue = formatRupiah(unformattedValue);

        this.value = formattedValue;
    });

    // Fungsi untuk menghapus format Rupiah saat formulir disubmit
    document.getElementById('form-id').addEventListener('submit', function () {
        var input = document.getElementById('nominal_pembayaran');
        var unformattedValue = unformatRupiah(input.value);

        // Simpan nilai yang tidak diformat ke dalam input sebelum pengiriman
        input.value = unformattedValue;
    });
</script>
@endsection
