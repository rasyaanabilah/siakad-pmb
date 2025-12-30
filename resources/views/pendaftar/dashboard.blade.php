@extends('layouts.app')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-6 space-y-6">

        {{-- HEADER --}}
        <div class="bg-white rounded-2xl shadow p-6 flex items-center justify-between">
            <div>
                <h2 class="text-2xl font-bold text-gray-800">
                    Dashboard Pendaftaran
                </h2>
                <p class="text-sm text-gray-500">
                    Informasi pendaftaran mahasiswa baru
                </p>
            </div>

            {{-- STATUS --}}
            <div class="text-right">
                <p class="text-sm text-gray-500">Status</p>

                @if(!$pendaftar)
                    <span class="inline-block mt-1 px-3 py-1 rounded-full bg-gray-100 text-gray-600 text-sm">
                        Belum Terdaftar
                    </span>
                @elseif($pendaftar->status === 'pending')
                    <span class="inline-block mt-1 px-3 py-1 rounded-full bg-yellow-100 text-yellow-800 text-sm">
                        Pending
                    </span>
                @elseif($pendaftar->status === 'diterima')
                    <span class="inline-block mt-1 px-3 py-1 rounded-full bg-green-100 text-green-800 text-sm">
                        Diterima
                    </span>
                @else
                    <span class="inline-block mt-1 px-3 py-1 rounded-full bg-red-100 text-red-800 text-sm">
                        Ditolak
                    </span>
                @endif
            </div>
        </div>

        {{-- JIKA BELUM ISI FORM --}}
        @if(!$pendaftar)
            <div class="bg-white rounded-2xl shadow p-10 text-center">
                <h3 class="text-lg font-semibold mb-2">
                    Data Pendaftaran Belum Tersedia
                </h3>
                <p class="text-gray-500 mb-6">
                    Silakan lengkapi formulir pendaftaran terlebih dahulu.
                </p>

                <a href="{{ route('pendaftar.create') }}"
                   class="inline-block px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    Isi Formulir Pendaftaran
                </a>
            </div>
        @else

        {{-- GRID UTAMA --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- PROFIL --}}
            <div class="bg-white rounded-2xl shadow p-6 text-center">
                @if($pendaftar->foto)
                    <img src="{{ asset('storage/'.$pendaftar->foto) }}"
                         class="w-32 h-40 mx-auto rounded-lg object-cover border mb-4">
                @else
                    <div class="w-32 h-40 mx-auto flex items-center justify-center bg-gray-100 rounded-lg mb-4 text-gray-400 text-sm">
                        Tidak ada foto
                    </div>
                @endif

                <h4 class="font-semibold text-gray-800">
                    {{ $pendaftar->nama }}
                </h4>
                <p class="text-sm text-gray-500">
                    {{ $pendaftar->email }}
                </p>
            </div>

            {{-- DATA AKADEMIK --}}
            <div class="bg-white rounded-2xl shadow p-6 lg:col-span-2">
                <h3 class="font-semibold text-gray-800 mb-4 border-b pb-2">
                    Data Akademik
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 text-sm">
                    <div>
                        <p class="text-gray-500">Program Studi</p>
                        <p class="font-medium">
                            {{ $pendaftar->prodi->nama_prodi ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-gray-500">Dosen Pembimbing</p>
                        <p class="font-medium">
                            {{ $pendaftar->dosen->nama_dosen ?? '-' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-gray-500">Sekolah Asal</p>
                        <p class="font-medium">
                            {{ $pendaftar->sekolah_asal }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- DOKUMEN --}}
        <div class="bg-white rounded-2xl shadow p-6">
            <h3 class="font-semibold text-gray-800 mb-4 border-b pb-2">
                Dokumen Pendaftaran
            </h3>

            @if($pendaftar->dokumen)
                <div class="flex items-center justify-between border rounded-lg p-4">
                    <div class="flex items-center gap-2 text-sm">
                        📄 <span>Dokumen tersedia</span>
                    </div>

                    <a href="{{ asset('storage/'.$pendaftar->dokumen) }}"
                       target="_blank"
                       class="px-4 py-2 bg-blue-600 text-white rounded-md text-sm hover:bg-blue-700">
                        Lihat Dokumen
                    </a>

                </div>

                <div class="mt-4">
                    <a href="{{ route('pendaftar.krs.pdf') }}"
                    target="_blank"
                    class="px-4 py-2 bg-red-600 text-white rounded">
                        Cetak KRS (PDF)
                    </a>
                </div>
            @else
                <p class="text-gray-400 italic text-sm">
                    Dokumen belum diunggah
                </p>
            @endif
        </div>

        @endif

    </div>
</div>
@endsection
