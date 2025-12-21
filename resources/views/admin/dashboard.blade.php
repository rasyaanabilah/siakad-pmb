@extends('layouts.app')

@section('content')
<div class="py-10">
    <div class="max-w-7xl mx-auto px-6">

        <!-- WELCOME -->
        <div class="mb-8">
            <h3 class="text-2xl font-bold text-gray-800">
                Halo, Admin 👋
            </h3>
            <p class="text-gray-500">
                Kelola data pendaftar, dosen, dan program studi
            </p>
        </div>

        <!-- MENU CARD -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- PENDAFTAR -->
            <div class="bg-white rounded-xl shadow border p-6">
                <div class="text-4xl mb-4">👨‍🎓</div>
                <h4 class="text-lg font-semibold text-gray-800 mb-2">
                    Data Pendaftar
                </h4>
                <p class="text-gray-500 mb-4">
                    Lihat dan verifikasi data pendaftar
                </p>
                <a href="{{ route('admin.pendaftar.index') }}"
                   class="inline-block px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                    Kelola
                </a>
            </div>

            <!-- DOSEN -->
            <div class="bg-white rounded-xl shadow border p-6">
                <div class="text-4xl mb-4">👨‍🏫</div>
                <h4 class="text-lg font-semibold text-gray-800 mb-2">
                    Data Dosen
                </h4>
                <p class="text-gray-500 mb-4">
                    Kelola data dosen pembimbing
                </p>
                <a href="{{ route('admin.dosen.index') }}">Kelola Dosen</a>
            </div>

            <!-- PRODI -->
            <div class="bg-white rounded-xl shadow border p-6">
                <div class="text-4xl mb-4">🎓</div>
                <h4 class="text-lg font-semibold text-gray-800 mb-2">
                    Program Studi
                </h4>
                <p class="text-gray-500 mb-4">
                    Kelola data program studi
                </p>
                <a href="{{ route('admin.prodi.index') }}">Kelola Prodi</a>
            </div>

        </div>

    </div>
</div>
@endsection
