@extends('layouts.app')

@section('title', 'Data Prodi')

@section('content')
<div class="card shadow-sm">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Manajemen Program Studi</h5>
    </div>

    <div class="card-body">
        <form method="POST" action="/prodi" class="row g-3 mb-4">
            @csrf
            <div class="col-md-9">
                <input type="text" name="nama_prodi" class="form-control" placeholder="Nama Program Studi">
            </div>
            <div class="col-md-3">
                <button class="btn btn-primary w-100">Tambah Prodi</button>
            </div>
        </form>

        <table class="table table-bordered table-striped">
            <thead class="table-light">
                <tr>
                    <th>No</th>
                    <th>Nama Prodi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($prodis as $i => $prodi)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $prodi->nama_prodi }}</td>
                    <td>
                        <form action="/prodi/{{ $prodi->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
