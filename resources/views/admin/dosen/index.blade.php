@extends('layouts.app')

@section('content')
<div class="py-8">
    <div class="max-w-6xl mx-auto px-6 space-y-6">

        {{-- HEADER --}}
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-xl font-semibold text-gray-800">
                Data Dosen
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Kelola data dosen pembimbing
            </p>
        </div>

        {{-- ALERT --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        {{-- FORM TAMBAH --}}
        <div class="bg-white rounded-xl shadow p-6">
            <form action="{{ route('admin.dosen.store') }}" method="POST" class="flex gap-3">
                @csrf
                <input type="text" name="nama_dosen"
                       placeholder="Nama Dosen"
                       class="flex-1 border rounded-lg px-4 py-2"
                       required>
                <button class="px-6 py-2 bg-blue-600 text-white rounded-lg">
                    Simpan
                </button>
            </form>
        </div>

        {{-- TABLE --}}
        <div class="bg-white rounded-xl shadow p-6 overflow-x-auto">
            <h3 class="font-semibold mb-4">Daftar Dosen</h3>

            <table class="w-full border">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-4 py-2">No</th>
                        <th class="border px-4 py-2">Nama Dosen</th>
                        <th class="border px-4 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($dosens as $i => $d)
                    <tr>
                        <td class="border px-4 py-2">{{ $i + 1 }}</td>

                        {{-- INLINE UPDATE --}}
                        <td class="border px-4 py-2">
                            <form action="{{ route('admin.dosen.update', $d->id) }}"
                                  method="POST" class="flex gap-2">
                                @csrf
                                @method('PATCH')

                                <input type="text" name="nama_dosen"
                                       value="{{ $d->nama_dosen }}"
                                       class="border rounded px-2 py-1 w-full">

                                <button class="bg-yellow-500 text-white px-3 rounded text-sm">
                                    Update
                                </button>
                            </form>
                        </td>

                        {{-- DELETE --}}
                        <td class="border px-4 py-2 text-center">
                            <form action="{{ route('admin.dosen.destroy', $d->id) }}"
                                  method="POST"
                                  onsubmit="return confirm('Hapus data dosen ini?')">
                                @csrf
                                @method('DELETE')

                                <button class="bg-red-600 text-white px-3 py-1 rounded text-sm">
                                    Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center py-4 text-gray-500">
                            Belum ada data dosen
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

    </div>
</div>
@endsection
