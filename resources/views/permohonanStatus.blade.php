<!DOCTYPE html>
<html>
<head>
    <title>Status Permohonan Aplikasi</title>
</head>
<body>
    <p>Halo {{ $details['nama_pemohon'] }},</p>
    <p>{{ $details['message'] }}</p>

    <p>Informasi Permohonan:</p>
    <ul>
        <li>NIP: {{ $details['nip'] }}</li>
        <li>Nama Aplikasi: {{ $details['nama_aplikasi'] }}</li>
        <li>Nama OPD: {{ $details['nama_opd'] }}</li>
        <li>Nomor Telepon: {{ $details['nomor_telepon'] }}</li>
        <li>Email: {{ $details['email'] }}</li>
    </ul>

    <p>Terima kasih.</p>
</body>
</html>