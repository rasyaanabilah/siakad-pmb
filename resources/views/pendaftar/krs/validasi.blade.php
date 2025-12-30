<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validasi KRS - SI AKAD</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            width: 100%;
        }
        .card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0,0,0,0.1);
            overflow: hidden;
            animation: slideUp 0.5s ease-out;
        }
        @keyframes slideUp {
            from {
                transform: translateY(30px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }
        .card-header {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            padding: 30px 30px 20px;
            text-align: center;
        }
        .card-header.invalid {
            background: linear-gradient(135deg, #dc3545 0%, #fd7e14 100%);
        }
        .card-header h1 {
            font-size: 28px;
            margin-bottom: 10px;
            font-weight: 600;
        }
        .card-header p {
            font-size: 16px;
            opacity: 0.9;
        }
        .card-body {
            padding: 30px;
        }
        .info-item {
            display: flex;
            margin-bottom: 15px;
            padding: 12px 15px;
            background: #f8f9fa;
            border-radius: 8px;
            border-left: 4px solid #007bff;
        }
        .info-item.invalid {
            border-left-color: #dc3545;
            background: #fff5f5;
        }
        .info-label {
            font-weight: 600;
            color: #495057;
            min-width: 140px;
            margin-right: 15px;
        }
        .info-value {
            color: #212529;
            flex: 1;
        }
        .status-badge {
            display: inline-block;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .status-valid {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }
        .status-invalid {
            background: #f8d7da;
            color: #721c24;
            border: 1px solid #f5c6cb;
        }
        .card-footer {
            background: #f8f9fa;
            padding: 20px 30px;
            text-align: center;
            border-top: 1px solid #dee2e6;
        }
        .footer-text {
            color: #6c757d;
            font-size: 14px;
            margin-bottom: 5px;
        }
        .footer-brand {
            font-weight: 600;
            color: #007bff;
        }
        .icon {
            font-size: 48px;
            margin-bottom: 15px;
            display: block;
        }
        .valid-icon {
            color: #28a745;
        }
        .invalid-icon {
            color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="card">
            @if($status === 'valid')
                <div class="card-header">
                    <span class="icon valid-icon">✅</span>
                    <h1>KRS Valid</h1>
                    <p>Dokumen Kartu Rencana Studi telah diverifikasi</p>
                </div>
                <div class="card-body">
                    <div class="status-badge status-valid">✓ Terverifikasi</div>
                    <br><br>
                    <div class="info-item">
                        <div class="info-label">Nama Mahasiswa</div>
                        <div class="info-value">{{ $pendaftar->nama }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Email</div>
                        <div class="info-value">{{ $pendaftar->email }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Program Studi</div>
                        <div class="info-value">{{ $pendaftar->prodi->nama_prodi ?? 'Belum ditentukan' }}</div>
                    </div>
                    <div class="info-item">
                        <div class="info-label">Dosen Pembimbing</div>
                        <div class="info-value">{{ $pendaftar->dosen->nama_dosen ?? 'Belum ditentukan' }}</div>
                    </div>
                </div>
            @else
                <div class="card-header invalid">
                    <span class="icon invalid-icon">❌</span>
                    <h1>KRS Tidak Valid</h1>
                    <p>Dokumen tidak dapat diverifikasi</p>
                </div>
                <div class="card-body">
                    <div class="status-badge status-invalid">✗ Tidak Valid</div>
                    <br><br>
                    <div class="info-item invalid">
                        <div class="info-label">Status</div>
                        <div class="info-value">Token tidak ditemukan atau sudah kadaluarsa</div>
                    </div>
                    <p style="color: #721c24; margin-top: 20px; text-align: center;">
                        Pastikan Anda memindai kode QR dari dokumen KRS yang asli dan masih berlaku.
                    </p>
                </div>
            @endif
            <div class="card-footer">
                <div class="footer-text">Dokumen resmi Sistem Akademik</div>
                <div class="footer-brand">SI AKAD - Universitas Teknologi Digital</div>
            </div>
        </div>
    </div>
</body>
</html>
