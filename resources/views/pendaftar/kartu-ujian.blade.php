<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Kartu Ujian</title>
    <style>
        body { font-family: DejaVu Sans; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; }
        td, th { border: 1px solid #000; padding: 6px; }
        .no-border td { border: none; }
    </style>
</head>
<body>

<div class="header">
    <h2>KARTU UJIAN MAHASISWA</h2>
    <p>SI AKAD - Sistem Akademik</p>
</div>

<table class="no-border">
    <tr><td>Nama</td><td>: {{ $pendaftar->nama }}</td></tr>
    <tr><td>Email</td><td>: {{ $pendaftar->email }}</td></tr>
    <tr><td>Program Studi</td><td>: {{ $pendaftar->prodi->nama_prodi ?? '-' }}</td></tr>
    <tr><td>Dosen Pembimbing</td><td>: {{ $pendaftar->dosen->nama_dosen ?? '-' }}</td></tr>
</table>

<br>

<table>
    <thead>
        <tr>
            <th>No</th>
            <th>Mata Ujian</th>
            <th>Waktu</th>
            <th>Ruang</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td align="center">1</td>
            <td>Ujian Akhir Semester</td>
            <td align="center">09.00 - 11.00</td>
            <td align="center">Lab 1</td>
        </tr>
    </tbody>
</table>

<br><br>

<table width="100%">
    <tr>
        <td width="60%">
            <p><strong>Catatan:</strong></p>
            <p>Kartu ini wajib dibawa saat ujian.</p>
        </td>

    </tr>
</table>

<br><br>
<p>___________________________</p>
<strong>Admin Akademik</strong>

</body>
</html>
