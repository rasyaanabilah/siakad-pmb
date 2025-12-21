@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto px-6 py-10">

    <h2 class="text-3xl font-bold text-blue-700 mb-6">Dashboard Pendaftaran</h2>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded shadow">{{ session('success') }}</div>
    @endif

    @if($pendaftar)
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Card Detail Pendaftar -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                <h3 class="text-xl font-semibold mb-4">Informasi Pribadi</h3>
                <p><strong>Nama:</strong> {{ $pendaftar->nama }}</p>
                <p><strong>Email:</strong> {{ $pendaftar->email }}</p>
                <p><strong>Sekolah Asal:</strong> {{ $pendaftar->sekolah_asal }}</p>
            </div>

            <!-- Card Prodi & Dosen -->
            <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6">
                <h3 class="text-xl font-semibold mb-4">Program Studi & Dosen</h3>
                <p><strong>Prodi:</strong> {{ $pendaftar->prodi->nama_prodi ?? '-' }}</p>
                <p><strong>Dosen Pembimbing:</strong> {{ $pendaftar->dosen->nama_dosen ?? '-' }}</p>

                @if($pendaftar->foto)
                    <p class="mt-4"><strong>Foto:</strong></p>
                    <img src="{{ asset('storage/'.$pendaftar->foto) }}" class="rounded-lg mt-2 shadow-md w-full max-w-xs">
                @endif

                @if($pendaftar->dokumen)
                    <p class="mt-4"><strong>Dokumen:</strong></p>
                    <a href="{{ asset('storage/'.$pendaftar->dokumen) }}" target="_blank" class="text-blue-600 underline">Lihat Dokumen</a>
                @endif
            </div>
        </div>
    @else
        <div class="bg-white rounded-2xl shadow-lg border border-gray-200 p-6 text-center">
            <p class="text-gray-600 mb-4">Data pendaftaran belum tersedia. Silakan lengkapi formulir pendaftaran terlebih dahulu.</p>
            <a href="{{ route('pendaftar.create') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg transition">Isi Formulir Pendaftaran</a>
        </div>
    @endif

</div>
@endsection
