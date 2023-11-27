<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pengajuan Cover</title>
</head>
<body>
    @if($pengajuan->status == 'accepted')
    <p>Pengajuan anda telah diterima, Silahkan login melalui link dibawah ini</p>
    @elseif($pengajuan->status == 'rejected')
    <p>Pengajuan anda telah ditolak, Silahkan login melalui link dibawah ini</p>
    @endif
    <a href="{{ route('login') }}">Login Sekarang</a>
</body>
</html>