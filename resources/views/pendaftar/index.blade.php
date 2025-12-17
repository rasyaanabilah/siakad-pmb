@extends('layouts.app')

@section('title', 'Data Pendaftar')

@section('content')

<div class="container">

    {{-- FORM PENDAFTARAN --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Form Pendaftaran Mahasiswa Baru</h5>
        </div>

        <div class="card-body">
            <form method="POST" action="/pendaftar" enctype="multipart/form-data" class="row g-3">
                @csrf

                <div class="col-md-6">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="nama" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Sekolah Asal</label>
                    <input type="text" name="sekolah_asal" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Program Studi</label>
                    <select name="prodi_id" class="form-select" required>
                        <option value="">-- Pilih Prodi --</option>
                        @foreach ($prodis as $prodi)
                            <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Dosen Pembimbing</label>
                    <select name="dosen_id" class="form-select" required>
                        <option value="">-- Pilih Dosen --</option>
                        @foreach ($dosens as $dosen)
                            <option value="{{ $dosen->id }}">{{ $dosen->nama_dosen }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- 🔹 INI STEP 5: UPLOAD FILE --}}
                <div class="col-md-6">
                    <label class="form-label">Foto Pendaftar</label>
                    <input type="file" name="foto" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Dokumen (Ijazah / Rapor)</label>
                    <input type="file" name="dokumen" class="form-control">
                </div>

                <div class="col-12">
                    <button class="btn btn-success w-100">Simpan Pendaftaran</button>
                </div>
            </form>

        </div>
    </div>

    {{-- TABEL DATA --}}
    <div class="card shadow-sm">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0">Data Pendaftar</h5>
        </div>

        <div class="card-body">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-light text-center">
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Prodi</th>
                        <th>Dosen</th>
                        <th>Foto</th>
                        <th>Dokumen</th>
                    </tr>
                </thead>
                <tbody>
                @forelse ($pendaftars as $i => $p)
                    <tr>
                        <td class="text-center">{{ $i + 1 }}</td>
                        <td>{{ $p->nama }}</td>
                        <td>{{ $p->email }}</td>
                        <td>{{ $p->prodi->nama_prodi ?? '-' }}</td>
                        <td>{{ $p->dosen->nama_dosen ?? '-' }}</td>

                        {{-- PREVIEW FOTO --}}
                        <td class="text-center">
                            @if ($p->foto)
                                <img src="{{ asset('storage/' . $p->foto) }}"
                                    width="60"
                                    class="rounded">
                            @else
                                -
                            @endif
                        </td>

                        {{-- PREVIEW DOKUMEN --}}
                        <td class="text-center">
                            @if ($p->dokumen)
                                <a href="{{ asset('storage/' . $p->dokumen) }}"
                                target="_blank"
                                class="btn btn-sm btn-info">
                                    Lihat
                                </a>
                            @else
                                -
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">
                            Belum ada data pendaftar
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>

        </div>
    </div>

</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif


@endsection
