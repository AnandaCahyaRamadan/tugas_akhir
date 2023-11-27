<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Pengajuan Cover</title>
</head>
<body>
    <p>Pengguna {{ Auth::user()->nama }} mengajukan cover. Silakan verifikasi informasi pengajuan cover berikut:</p>
    <ul>
        <li><strong>Lagu</strong> {{ $pengajuan->katalog->judul}}</li>
        <li><strong>Pencipta Lagu</strong> {{ $pengajuan->katalog->pencipta_lagu}}</li>
        <li><strong>Link Lagu</strong> {{ $pengajuan->katalog->link_vidio_lagu}}</li>
        <li><strong>Publisher</strong> {{ $pengajuan->katalog->User->nama}}</li>
        <li><strong>Link Channel Cover</strong> {{ $pengajuan->link_channel}}</li>
    </ul>
    <button><a href="{{ route('pengajuan-cover.updateAccepted',  Crypt::encryptString($pengajuan->id )) }}">Terima Pengajuan</a></button>
    <button><a href="{{ route('pengajuan-cover.updateRejected',  Crypt::encryptString($pengajuan->id )) }}">Tolak Pengajuan</a></button>
    <p>Terima kasih!</p>
</body>
</html>
