@extends('layouts.app')
@section('head')
<style>
/* ===== DATATABLES CUSTOM UI ===== */

/* Search box */
.dataTables_filter input {
    border-radius: 9999px;
    padding: 0.5rem 1rem;
    border: 1px solid #e5e7eb;
    outline: none;
    margin-left: 0.5rem;
}
.dataTables_filter input:focus {
    border-color: #2563eb;
    box-shadow: 0 0 0 2px rgba(37,99,235,.2);
}

/* Center bottom info + pagination */
.dataTables_wrapper .dataTables_info,
.dataTables_wrapper .dataTables_paginate {
    display: flex;
    justify-content: center;
    margin-top: 1rem;
    font-size: 0.875rem;
}

/* Pagination buttons */
.dataTables_wrapper .dataTables_paginate .paginate_button {
    padding: 0.4rem 0.75rem;
    margin: 0 0.2rem;
    border-radius: 0.5rem;
    border: 1px solid #e5e7eb;
    background: white;
    color: #374151 !important;
    transition: all .2s;
}

.dataTables_wrapper .dataTables_paginate .paginate_button:hover {
    background: #2563eb !important;
    color: white !important;
}

/* Active page */
.dataTables_wrapper .dataTables_paginate .paginate_button.current {
    background: #2563eb !important;
    color: white !important;
    border-radius: 9999px;
}

/* Disabled */
.dataTables_wrapper .dataTables_paginate .paginate_button.disabled {
    opacity: 0.4;
    cursor: not-allowed;
}
</style>
@endsection

@section('content')
<div class="py-8 bg-gray-100 min-h-screen">
    <div class="max-w-7xl mx-auto px-6 space-y-6">

    @if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-4">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">
        {{ session('error') }}
    </div>
@endif


        {{-- ================= HEADER ================= --}}
        <div class="bg-white rounded-2xl shadow p-6 flex items-center justify-between">
            <h2 class="text-2xl font-bold text-gray-800">
                Data Pendaftar
            </h2>

            <div class="flex gap-2">
                {{-- EXPORT --}}
                <a href="{{ route('admin.pendaftar.export') }}"
                class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg text-sm">
                    Export Excel
                </a>

                {{-- IMPORT --}}
                <form action="{{ route('admin.pendaftar.import') }}"
                    method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    <input type="file"
                        name="file"
                        accept=".xlsx,.csv"
                        required
                        class="text-sm">

                    <button type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">
                        Import Excel
                    </button>
                </form>
            </div>
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

                        {{-- MODAL EDIT --}}
<div id="editModal"
     class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">

    <div class="bg-white rounded-xl w-full max-w-lg p-6 relative">
        <h3 class="text-lg font-bold mb-4">Edit Pendaftar</h3>

        <form id="editForm">
            @csrf
            @method('PATCH')

            <input type="hidden" id="edit_id">

            <div class="mb-3">
                <label class="text-sm">Nama</label>
                <input type="text" id="edit_nama"
                       class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-3">
                <label class="text-sm">Email</label>
                <input type="email" id="edit_email"
                       class="w-full border rounded px-3 py-2">
            </div>

            <div class="mb-3">
                <label class="text-sm">Sekolah Asal</label>
                <input type="text" id="edit_sekolah"
                       class="w-full border rounded px-3 py-2">
            </div>

            <div class="flex justify-end gap-2 mt-4">
                <button type="button"
                        id="closeModal"
                        class="px-4 py-2 bg-gray-300 rounded">
                    Batal
                </button>

                <button type="submit"
                        class="px-4 py-2 bg-blue-600 text-white rounded">
                    Simpan
                </button>
            </div>
        </form>
    </div>
</div>


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
                            <button
                                class="btn-edit bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-lg text-xs"
                                data-id="{{ $p->id }}">
                                Edit
                            </button>

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
    pagingType: "simple_numbers",
    dom:
        "<'flex justify-between items-center mb-4'f>" +
        "rt" +
        "<'flex flex-col items-center mt-4'ip>",
    language: {
        search: "Cari",
        info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
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


/* ===============================
   BUKA MODAL + LOAD DATA
================================ */
$('#pendaftarTable').on('click', '.btn-edit', function () {

    const id = $(this).data('id');

    fetch(`/admin/pendaftar/${id}`)
        .then(res => res.json())
        .then(data => {
            $('#edit_id').val(data.id);
            $('#edit_nama').val(data.nama);
            $('#edit_email').val(data.email);
            $('#edit_sekolah').val(data.sekolah_asal);

            $('#editModal').removeClass('hidden').addClass('flex');
        });
});

/* TUTUP MODAL */
$('#closeModal').on('click', function () {
    $('#editModal').addClass('hidden').removeClass('flex');
});

/* ===============================
   SUBMIT EDIT (AJAX)
================================ */
$('#editForm').on('submit', function (e) {
    e.preventDefault();

    const id = $('#edit_id').val();

    fetch(`/admin/pendaftar/${id}`, {
        method: 'PATCH',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({
            nama: $('#edit_nama').val(),
            email: $('#edit_email').val(),
            sekolah_asal: $('#edit_sekolah').val()
        })
    })
    .then(res => res.json())
    .then(() => {
        alert('Data berhasil diupdate');
        location.reload(); // aman & simpel
    })
    .catch(() => alert('Gagal update data'));
});

});
</script>
@endsection
