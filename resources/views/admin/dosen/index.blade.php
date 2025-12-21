@extends('layouts.app')

@section('title', 'Data Dosen')

@section('content')
<div class="card">
    <div class="card-header bg-primary text-white">Data Dosen</div>
    <div class="card-body">

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.dosen.store') }}" method="POST" class="mb-4">
            @csrf
            <div class="mb-2">
                <input type="text" name="nama" placeholder="Nama Dosen" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Dosen</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dosens as $i => $d)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ $d->nama_dosen }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
