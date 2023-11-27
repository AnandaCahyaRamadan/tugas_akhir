<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Pengajuan Konten</title>
</head>
<body>
    <p>Pengguna {{ Auth::user()->nama }} mengajukan konten. Silakan verifikasi informasi pengajuan konten berikut:</p>
    <ul>
        <li><strong>Lagu</strong> {{ $pengajuan->katalog->judul}}</li>
        <li><strong>Pencipta Lagu</strong> {{ $pengajuan->katalog->pencipta_lagu}}</li>
        <li><strong>Publisher</strong> {{ $pengajuan->katalog->User->nama}}</li>
        <li><strong>Link Channel Cover</strong> {{ $pengajuan->link_channel}}</li>
        <li><strong>Nama Artis</strong> {{ $pengajuan->nama_artis}}</li>
        {{-- <li><strong>Audio</strong> <audio controls>
            <source src="{{ asset('storage/'.$pengajuan->audio) }}" type="audio/mpeg">
        </audio></li>
        <li><strong>Art Track</strong> <img src="{{ asset('storage/'.$pengajuan->art_track) }}" alt="Thumbnail" width="200"></li> --}}
    </ul>
    <button><a href="{{ route('pengajuan-konten.updateAccepted',  Crypt::encryptString($pengajuan->id)) }}">Terima Pengajuan</a></button>
    <button><a href="{{ route('pengajuan-konten.updateRejectedGet',  Crypt::encryptString($pengajuan->id)) }}">Tolak Pengajuan</a></button>
    <p>Terima kasih!</p>
</body>
</html>
