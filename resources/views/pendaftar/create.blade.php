@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-6 py-10">
    <div class="bg-white shadow-xl rounded-2xl p-8 md:p-12 border border-gray-200">
        <h2 class="text-3xl font-bold text-blue-700 mb-4">Form Pendaftaran Mahasiswa</h2>
        <p class="text-gray-500 mb-6">Lengkapi data berikut dengan benar agar proses pendaftaran berhasil.</p>

        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-800 rounded">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('pendaftar.store') }}" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 gap-6">
            @csrf

            <input type="text" name="nama" placeholder="Nama Lengkap" value="{{ old('nama') }}" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">

            <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">

            <input type="text" name="sekolah_asal" placeholder="Sekolah Asal" value="{{ old('sekolah_asal') }}" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">

            <select name="prodi_id" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                <option value="">-- Pilih Program Studi --</option>
                @foreach ($prodis as $prodi)
                    <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option>
                @endforeach
            </select>

            <select name="dosen_id" class="w-full border rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500">
                <option value="">-- Pilih Dosen Pembimbing --</option>
                @foreach ($dosens as $dosen)
                    <option value="{{ $dosen->id }}">{{ $dosen->nama_dosen }}</option>
                @endforeach
            </select>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block mb-1 text-gray-700 font-medium">Foto Pendaftar</label>
                    <input type="file" name="foto" class="w-full text-gray-600">
                </div>
                <div>
                    <label class="block mb-1 text-gray-700 font-medium">Dokumen (Ijazah/Rapor)</label>
                    <input type="file" name="dokumen" class="w-full text-gray-600">
                </div>
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition">Simpan Pendaftaran</button>
        </form>
    </div>
</div>
@endsection
