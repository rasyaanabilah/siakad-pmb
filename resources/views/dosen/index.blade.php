@extends('layouts.app')

@section('title', 'Data Dosen')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">Data Dosen</div>
    <div class="card-body">
        <form method="POST" action="/dosen" class="mb-3">
            @csrf
            <input name="nama_dosen" class="form-control" placeholder="Nama Dosen">
            <button class="btn btn-primary mt-2">Tambah</button>
        </form>

        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Nama Dosen</th>
            </tr>
            @foreach ($dosens as $i => $d)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $d->nama_dosen }}</td>
            </tr>
            @endforeach
        </table>
    </div>
</div>
@endsection
