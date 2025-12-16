@extends('layouts.app')

@section('title', 'Data Pendaftar')

@section('content')

<div class="card shadow-sm mb-4">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Form Pendaftaran Mahasiswa Baru</h5>
    </div>

    <div class="card-body">
        <form method="POST" action="/pendaftar" class="row g-3">
            @csrf
            <div class="col-md-6">
                <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap">
            </div>
            <div class="col-md-6">
                <input type="email" name="email" class="form-control" placeholder="Email">
            </div>
            <div class="col-md-6">
                <input type="text" name="sekolah_asal" class="form-control" placeholder="Sekolah Asal">
            </div>
            <div class="col-md-6">
                <select name="prodi_id" class="form-select">
                    <option value="">Pilih Program Studi</option>
                    @foreach ($prodis as $prodi)
                        <option value="{{ $prodi->id }}">{{ $prodi->nama_prodi }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-12">
                <button class="btn btn-success w-100">Daftar</button>
            </div>
        </form>
    </div>
</div>

<div class="card shadow-sm">
    <div class="card-header bg-secondary text-white">
        <h5 class="mb-0">Data Pendaftar</h5>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Prodi</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($pendaftars as $i => $p)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $p->nama }}</td>
                    <td>{{ $p->email }}</td>
                    <td>{{ $p->prodi->nama_prodi }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection
