<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>KRS Mahasiswa - {{ $pendaftar->nama }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', Arial, sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #007bff;
            margin: 0;
            font-size: 18px;
            font-weight: bold;
        }
        .header p {
            margin: 5px 0 0 0;
            color: #666;
            font-size: 11px;
        }
        .info-table {
            width: 100%;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            overflow: hidden;
        }
        .info-table td {
            padding: 8px 12px;
            border-bottom: 1px solid #eee;
        }
        .info-table td:first-child {
            background: #f8f9fa;
            font-weight: bold;
            width: 30%;
            color: #495057;
        }
        .krs-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .krs-table th {
            background: #007bff;
            color: white;
            padding: 10px;
            text-align: center;
            font-weight: bold;
        }
        .krs-table td {
            padding: 8px 10px;
            border: 1px solid #ddd;
            text-align: center;
        }
        .krs-table tbody tr:nth-child(even) {
            background: #f8f9fa;
        }
        .signature-section {
            display: table;
            width: 100%;
            margin-top: 30px;
        }
        .signature-left {
            display: table-cell;
            width: 60%;
            vertical-align: top;
        }
        .signature-right {
            display: table-cell;
            width: 40%;
            text-align: center;
            vertical-align: top;
            border-left: 1px solid #ddd;
            padding-left: 20px;
        }
        .qr-code {
            margin: 10px 0;
        }
        .qr-code img {
            border: 1px solid #ddd;
            padding: 5px;
            background: white;
        }
        .qr-text {
            font-size: 10px;
            color: #666;
            margin-top: 5px;
        }
        .footer {
            margin-top: 40px;
            text-align: center;
            font-size: 10px;
            color: #999;
            border-top: 1px solid #eee;
            padding-top: 10px;
        }
        .signature-line {
            border-bottom: 1px solid #000;
            width: 200px;
            margin: 40px 0 5px 0;
            display: inline-block;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>KARTU RENCANA STUDI (KRS)</h1>
    <p>Sistem Akademik - SI AKAD</p>
    <p>Universitas Teknologi Digital</p>
</div>

<table class="info-table">
    <tr>
        <td>Nama Mahasiswa</td>
        <td>: {{ $pendaftar->nama }}</td>
    </tr>
    <tr>
        <td>Email</td>
        <td>: {{ $pendaftar->email }}</td>
    </tr>
    <tr>
        <td>Program Studi</td>
        <td>: {{ $pendaftar->prodi->nama_prodi ?? 'Belum ditentukan' }}</td>
    </tr>
    <tr>
        <td>Dosen Pembimbing</td>
        <td>: {{ $pendaftar->dosen->nama_dosen ?? 'Belum ditentukan' }}</td>
    </tr>
    <tr>
        <td>Tanggal Cetak</td>
        <td>: {{ date('d F Y') }}</td>
    </tr>
</table>

<h3 style="color: #007bff; margin: 20px 0 10px 0;">Mata Kuliah yang Diambil</h3>

<table class="krs-table">
    <thead>
        <tr>
            <th width="10%">No</th>
            <th width="70%">Nama Mata Kuliah</th>
            <th width="20%">SKS</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>1</td>
            <td>Evaluasi Sistem Informasi</td>
            <td>3</td>
        </tr>
        <tr>
            <td>2</td>
            <td>Manajemen Proyek</td>
            <td>3</td>
        </tr>
        <tr>
            <td colspan="2" style="text-align: right; font-weight: bold;">Total SKS</td>
            <td style="font-weight: bold; background: #e3f2fd;">6</td>
        </tr>
    </tbody>
</table>

<div class="signature-section">
    <div class="signature-left">
        <p><strong>Status:</strong> Menunggu Persetujuan</p>
        <br><br>
        <p><strong>Disetujui oleh:</strong></p>
        <div class="signature-line"></div>
        <p>Admin PMB</p>
        <br><br>
        <p><strong>Dosen Pembimbing:</strong></p>
        <div class="signature-line"></div>
        <p>{{ $pendaftar->dosen->nama_dosen ?? '_______________' }}</p>
    </div>
    <div class="signature-right">
        <p><strong>Kode QR Validasi</strong></p>
        <div class="qr-code">
            <img src="data:image/svg+xml;base64,{{ $qrCode }}" width="120" height="120" alt="QR Validasi">
        </div>
        <p class="qr-text">Scan kode QR ini untuk verifikasi keaslian dokumen KRS</p>
    </div>
</div>

<div class="footer">
    <p>Dokumen ini dihasilkan secara otomatis oleh Sistem Akademik SI AKAD</p>
    <p>© 2025 Universitas Teknologi Digital - Semua hak dilindungi</p>
</div>

</body>
</html>
