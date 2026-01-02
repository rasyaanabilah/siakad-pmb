@extends('layouts.app')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-6 space-y-6">

        {{-- HEADER --}}
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-xl font-semibold text-gray-800">
                Data Program Studi
            </h2>
            <p class="text-sm text-gray-500">
                Kelola data prodi + export & import Excel
            </p>
        </div>

        {{-- ALERT --}}
        @if(session('success'))
            <div class="p-4 bg-green-100 text-green-800 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        {{-- ACTION BAR --}}
        <div class="bg-white rounded-xl shadow p-6 flex flex-wrap gap-3 items-center justify-between">

            {{-- FORM TAMBAH --}}
            <form action="{{ route('admin.prodi.store') }}" method="POST" class="flex gap-3">
                @csrf
                <input type="text"
                       name="nama_prodi"
                       class="border rounded-lg px-3 py-2"
                       placeholder="Nama Prodi"
                       required>

                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    Tambah
                </button>
            </form>

        {{-- TABEL --}}
        <div class="bg-white rounded-xl shadow p-6">
            <h3 class="font-semibold mb-4">Daftar Prodi</h3>

            <table class="w-full border text-sm">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-3 py-2 w-16">No</th>
                        <th class="border px-3 py-2">Nama Prodi</th>
                        <th class="border px-3 py-2 w-40 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($prodis as $i => $prodi)
                        <tr class="hover:bg-gray-50">
                            <td class="border px-3 py-2">{{ $i + 1 }}</td>

                            {{-- EDIT (INLINE CRUD) --}}
                            <td class="border px-3 py-2">
                                <form action="{{ route('admin.prodi.update', $prodi->id) }}"
                                      method="POST"
                                      class="flex gap-2">
                                    @csrf
                                    @method('PUT')

                                    <input type="text"
                                           name="nama_prodi"
                                           value="{{ $prodi->nama_prodi }}"
                                           class="flex-1 border rounded px-2 py-1">

                                    <button class="px-3 py-1 bg-yellow-500 text-white rounded text-xs">
                                        Update
                                    </button>
                                </form>
                            </td>

                            {{-- DELETE --}}
                            <td class="border px-3 py-2 text-center">
                                <form action="{{ route('admin.prodi.destroy', $prodi->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Yakin hapus prodi ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button class="px-3 py-1 bg-red-600 text-white rounded text-xs">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center py-4 text-gray-500">
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
