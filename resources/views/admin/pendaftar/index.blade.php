<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Kelola Pendaftar</h2>
    </x-slot>

    <div class="py-8 max-w-7xl mx-auto px-6">
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                {{ session('success') }}
            </div>
        @endif

        <div class="mb-6">
            <a href="{{ route('admin.pendaftar.create') }}"
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Tambah Pendaftar</a>
        </div>

        <div class="bg-white rounded-xl shadow border p-6 overflow-x-auto">
            <table class="w-full border-collapse">
                <thead>
                    <tr class="bg-gray-100 text-left">
                        <th class="p-3 border">Nama</th>
                        <th class="p-3 border">Email</th>
                        <th class="p-3 border">Sekolah</th>
                        <th class="p-3 border">Prodi</th>
                        <th class="p-3 border">Dosen</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendaftars as $p)
                        <tr class="border-t">
                            <td class="p-3 border">{{ $p->nama }}</td>
                            <td class="p-3 border">{{ $p->email }}</td>
                            <td class="p-3 border">{{ $p->sekolah_asal }}</td>
                            <td class="p-3 border">{{ $p->prodi->nama_prodi ?? '-' }}</td>
                            <td class="p-3 border">{{ $p->dosen->nama_dosen ?? '-' }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-6 text-center text-gray-500">Belum ada data pendaftar</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
