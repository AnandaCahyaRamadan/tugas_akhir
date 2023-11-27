<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Verification</title>
</head>
<body>
    <p>Anda memiliki pengguna yang baru mendaftar sebagai {{ implode(', ', Auth::user()->getRoleNames()->toArray()) }}. Silakan verifikasi informasi pengguna berikut:</p>
    <ul>
        <li><strong>Nama Pengguna:</strong> {{ Auth::user()->nama }}</li>
        <li><strong>Nik:</strong> {{ Auth::user()->nik }}</li>
        <li><strong>Email:</strong> {{ Auth::user()->email }}</li>
        <li><strong>Alamat:</strong> {{ Auth::user()->alamat_ktp }}</li>
        <li><strong>No Whatsapp:</strong> {{ Auth::user()->no_wa }}</li>
        <li><strong>Bank:</strong> {{ Auth::user()->Bank->nama }}</li>
        <li><strong>No Rekening:</strong> {{ Auth::user()->no_rekening }}</li>
    </ul>
    <a href="{{ route('email_verifikasi.update',  Crypt::encryptString(Auth::user()->id )) }}">Verifikasi Sekarang</a>
    <p>Terima kasih!</p>
</body>
</html>
