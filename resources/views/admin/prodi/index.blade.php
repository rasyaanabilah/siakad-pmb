@extends('layouts.app')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-6 space-y-6">

        {{-- HEADER --}}
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-xl font-semibold text-gray-800">
                Data Program Studi
            </h2>
        </div>

        {{-- FORM TAMBAH PRODI --}}
        <div class="bg-white rounded-xl shadow p-6">
            @if(session('success'))
                <div class="mb-4 p-3 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('admin.prodi.store') }}" method="POST" class="flex gap-3">
                @csrf
                <input type="text"
                       name="nama_prodi"
                       class="flex-1 border rounded-lg px-3 py-2"
                       placeholder="Nama Prodi"
                       required>

                <button type="submit"
                        class="px-5 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Simpan
                </button>
            </form>
        </div>

        {{-- TABEL PRODI --}}
        <div class="bg-white rounded-xl shadow p-6">
            <h3 class="font-semibold mb-4">Daftar Prodi</h3>

            <table class="w-full border">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-3 py-2 w-16">No</th>
                        <th class="border px-3 py-2">Nama Prodi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($prodis as $i => $prodi)
                        <tr>
                            <td class="border px-3 py-2">{{ $i + 1 }}</td>
                            <td class="border px-3 py-2">{{ $prodi->nama_prodi }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="text-center py-4 text-gray-500">
                                Belum ada data prodi
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection
