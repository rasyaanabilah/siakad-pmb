@extends('layouts.app')

@section('content')
<div class="space-y-8">

    {{-- HEADER --}}
    <div>
        <h3 class="text-2xl font-bold text-gray-800">
            Halo, Admin 👋
        </h3>
        <p class="text-gray-500">
            Kelola data pendaftar, dosen, dan program studi
        </p>
    </div>

    {{-- STATISTIK --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <div class="bg-white rounded-xl shadow border p-6">
            <p class="text-sm text-gray-500">Total Pendaftar</p>
            <h4 class="text-2xl font-bold text-gray-800 mt-1">
                {{ \App\Models\Pendaftar::count() }}
            </h4>
        </div>

        <div class="bg-white rounded-xl shadow border p-6">
            <p class="text-sm text-gray-500">Diterima</p>
            <h4 class="text-2xl font-bold text-green-600 mt-1">
                {{ \App\Models\Pendaftar::where('status','diterima')->count() }}
            </h4>
        </div>

        <div class="bg-white rounded-xl shadow border p-6">
            <p class="text-sm text-gray-500">Pending</p>
            <h4 class="text-2xl font-bold text-yellow-600 mt-1">
                {{ \App\Models\Pendaftar::where('status','pending')->count() }}
            </h4>
        </div>

    </div>

    {{-- INFORMASI --}}
    <div class="bg-white rounded-xl shadow border p-6">
        <h4 class="font-semibold text-gray-800 mb-2">
            Informasi
        </h4>
        <p class="text-gray-500 text-sm">
            Gunakan menu di sidebar kiri untuk mengelola data pendaftar,
            dosen pembimbing, dan program studi.
        </p>
    </div>

</div>
@endsection
