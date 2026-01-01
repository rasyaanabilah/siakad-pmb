@extends('layouts.app')

@section('content')
<div class="py-8 bg-gray-100 min-h-screen">
    <div class="max-w-7xl mx-auto px-6 space-y-6">

        {{-- ================= HEADER ================= --}}
        <div class="bg-white rounded-2xl shadow p-6">
            <h2 class="text-2xl font-bold text-gray-800">
                Data Pendaftar
            </h2>
            <p class="text-sm text-gray-500 mt-1">
                Level 5 — DataTables & AJAX (Sort, Search, Pagination tanpa reload)
            </p>
        </div>

        {{-- ================= TABLE ================= --}}
        <div class="bg-white rounded-2xl shadow p-6">
            <table id="pendaftarTable" class="w-full text-sm">
                <thead>
                    <tr class="border-b text-gray-600">
                        <th class="py-3">Nama</th>
                        <th>Email</th>
                        <th>Sekolah</th>
                        <th>Prodi</th>
                        <th>Dosen</th>
                        <th>Status</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                @foreach($pendaftars as $p)
                    <tr data-id="{{ $p->id }}" class="border-b hover:bg-gray-50 transition">

                        {{-- NAMA --}}
                        <td class="py-3 font-medium text-gray-800">
                            {{ $p->nama }}
                        </td>

                        {{-- EMAIL --}}
                        <td>{{ $p->email }}</td>

                        {{-- SEKOLAH --}}
                        <td>{{ $p->sekolah_asal }}</td>

                        {{-- PRODI --}}
                        <td>{{ $p->prodi->nama_prodi ?? '-' }}</td>

                        {{-- DOSEN --}}
                        <td>{{ $p->dosen->nama_dosen ?? '-' }}</td>

                        {{-- STATUS --}}
                        <td class="status-cell">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold
                                @if($p->status=='pending') bg-yellow-100 text-yellow-700
                                @elseif($p->status=='diterima') bg-green-100 text-green-700
                                @else bg-red-100 text-red-700 @endif">
                                {{ ucfirst($p->status) }}
                            </span>
                        </td>

                        {{-- AKSI --}}
                        <td class="aksi-cell text-center space-x-1">
                            @if($p->status === 'pending')
                                <button
                                    class="btn-status bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded-lg text-xs transition"
                                    data-status="diterima">
                                    Terima
                                </button>

                                <button
                                    class="btn-status bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-lg text-xs transition"
                                    data-status="ditolak">
                                    Tolak
                                </button>
                            @else
                                <span class="text-gray-400 text-xs">
                                    Selesai
                                </span>
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

{{-- ================= SCRIPT ================= --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function () {

    /**
     * ============================================
     * 1. DataTables
     *    - Search tanpa reload
     *    - Sort tanpa reload
     *    - Pagination tanpa reload
     * ============================================
     */
    const table = $('#pendaftarTable').DataTable({
        pageLength: 5,
        lengthChange: false,
        language: {
            search: "Cari:",
            paginate: {
                previous: "←",
                next: "→"
            }
        }
    });

    /**
     * ============================================
     * 2. AJAX Update Status (Tanpa Reload)
     * ============================================
     */
    $('#pendaftarTable').on('click', '.btn-status', function () {

        const btn = $(this);
        const row = btn.closest('tr');
        const id = row.data('id');
        const status = btn.data('status');

        if (!confirm('Yakin ubah status pendaftar?')) return;

        fetch(`/admin/pendaftar/${id}/status`, {
            method: 'PATCH',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ status })
        })
        .then(res => res.json())
        .then(() => {

            // 🔁 Update kolom status (real-time)
            row.find('.status-cell').html(`
                <span class="px-3 py-1 rounded-full text-xs font-semibold
                    ${status === 'diterima'
                        ? 'bg-green-100 text-green-700'
                        : 'bg-red-100 text-red-700'}">
                    ${status.charAt(0).toUpperCase() + status.slice(1)}
                </span>
            `);

            // 🔁 Update kolom aksi
            row.find('.aksi-cell').html(`
                <span class="text-gray-400 text-xs">Selesai</span>
            `);
        })
        .catch(() => alert('Gagal update status'));
    });

});
</script>
@endsection
