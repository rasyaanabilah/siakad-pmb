@extends('layouts.app')

@section('content')
<div class="py-8">
    <div class="max-w-7xl mx-auto px-6 space-y-6">

        {{-- HEADER --}}
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-xl font-semibold text-gray-800">Data Pendaftar</h2>
            <p class="text-sm text-gray-500">Kelola & verifikasi pendaftaran mahasiswa</p>
        </div>

        {{-- FILTER --}}
        <div class="bg-white rounded-xl shadow p-4">
            <form method="GET" class="flex gap-4 items-center">
                <label class="text-sm font-medium">Filter Status:</label>
                <select name="status" onchange="this.form.submit()"
                    class="border rounded-lg px-3 py-2 text-sm">
                    <option value="">Semua</option>
                    <option value="pending" {{ request('status')=='pending' ? 'selected' : '' }}>Pending</option>
                    <option value="diterima" {{ request('status')=='diterima' ? 'selected' : '' }}>Diterima</option>
                    <option value="ditolak" {{ request('status')=='ditolak' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </form>
        </div>

        <div class="flex gap-3 mb-4">
    <a href="{{ route('admin.pendaftar.export') }}"
       class="px-4 py-2 bg-green-600 text-white rounded">
        Export Excel
    </a>

    <form action="{{ route('admin.pendaftar.import') }}"
          method="POST"
          enctype="multipart/form-data"
          class="flex gap-2">
        @csrf
        <input type="file" name="file" required>
        <button class="px-4 py-2 bg-blue-600 text-white rounded">
            Import
        </button>
    </form>
</div>


        {{-- TABLE --}}
        <div class="bg-white rounded-xl shadow p-6 overflow-x-auto">
            <table class="w-full border">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="border px-3 py-2">Nama</th>
                        <th class="border px-3 py-2">Email</th>
                        <th class="border px-3 py-2">Sekolah</th>
                        <th class="border px-3 py-2">Prodi</th>
                        <th class="border px-3 py-2">Dosen</th>
                        <th class="border px-3 py-2">Status</th>
                        <th class="border px-3 py-2 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($pendaftars as $p)
                    <tr>
                        <td class="border px-3 py-2">{{ $p->nama }}</td>
                        <td class="border px-3 py-2">{{ $p->email }}</td>
                        <td class="border px-3 py-2">{{ $p->sekolah_asal }}</td>
                        <td class="border px-3 py-2">{{ $p->prodi->nama_prodi ?? '-' }}</td>
                        <td class="border px-3 py-2">{{ $p->dosen->nama_dosen ?? '-' }}</td>

                        {{-- STATUS --}}
                        <td class="border px-3 py-2">
                            @if($p->status === 'pending')
                                <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-sm">Pending</span>
                            @elseif($p->status === 'diterima')
                                <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-sm">Diterima</span>
                            @else
                                <span class="px-2 py-1 bg-red-100 text-red-800 rounded text-sm">Ditolak</span>
                            @endif
                        </td>

                        {{-- AKSI --}}
                        <td class="border px-3 py-2 text-center">
                           @if($p->status === 'pending')
                                <button
                                    type="button"
                                    class="btn-status px-3 py-1 bg-green-600 text-white rounded text-sm"
                                    data-id="{{ $p->id }}"
                                    data-status="diterima">
                                    Terima
                                </button>

                                <button
                                    type="button"
                                    class="btn-status px-3 py-1 bg-red-600 text-white rounded text-sm"
                                    data-id="{{ $p->id }}"
                                    data-status="ditolak">
                                    Tolak
                                </button>
                            @else
                                <span class="text-gray-400 text-sm">Selesai</span>

                                <form action="{{ route('admin.pendaftar.destroy', $p->id) }}"
                                    method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="px-3 py-1 bg-gray-600 text-white rounded text-sm">
                                        Hapus
                                    </button>
                                </form>
                            @endif


                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

{{-- AJAX --}}
<script>
document.addEventListener('DOMContentLoaded', function () {

    document.querySelectorAll('.btn-status').forEach(button => {
        button.addEventListener('click', function () {

            const id = this.dataset.id;
            const status = this.dataset.status;

            if (!confirm('Yakin ubah status?')) return;

            fetch(`/admin/pendaftar/${id}/status`, {
                method: 'PATCH',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ status })
            })
            .then(res => {
                if (!res.ok) throw new Error('Gagal update status');
                return res.json();
            })
            .then(() => {
                location.reload(); // aman & sederhana
            })
            .catch(err => alert(err.message));
        });
    });

});
</script>

@endsection
