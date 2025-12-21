<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Data Prodi & Pendaftar
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto px-6">

            {{-- Form tambah Prodi --}}
            <div class="mb-6 bg-white p-6 rounded-xl shadow">
                @if(session('success'))
                    <div class="mb-3 p-3 bg-green-100 text-green-800 rounded">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('admin.prodi.store') }}" method="POST" class="flex gap-2 items-center">
                    @csrf
                    <input type="text" name="nama_prodi" placeholder="Nama Prodi" class="border p-2 rounded flex-1" required>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Simpan</button>
                </form>
            </div>

            {{-- Tabel Prodi --}}
            <div class="mb-6 bg-white p-6 rounded-xl shadow">
                <h3 class="text-lg font-semibold mb-3">Daftar Prodi</h3>
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-gray-100 text-left">
                            <th class="p-3 border">No</th>
                            <th class="p-3 border">Nama Prodi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($prodis as $i => $prodi)
                        <tr>
                            <td class="p-3 border">{{ $i + 1 }}</td>
                            <td class="p-3 border">{{ $prodi->nama_prodi }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2" class="p-6 text-center text-gray-500">Belum ada data Prodi</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Tabel Pendaftar --}}
            <div class="bg-white rounded-xl shadow border p-6 overflow-x-auto">
                <h3 class="text-lg font-semibold mb-3">Data Pendaftar</h3>
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
                        @forelse ($pendaftars as $p)
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
    </div>
</x-app-layout>
