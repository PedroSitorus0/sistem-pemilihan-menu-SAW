@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Data Kriteria</h2>
    <a href="{{ route('kriteria.create') }}" class="btn btn-primary mb-3">Tambah Kriteria</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode</th>
                <th>Nama</th>
                <th>Sifat</th>
                <th>Bobot</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($kriteria as $k)
            <tr>
                <td>{{ $k->kode_kriteria }}</td>
                <td>{{ $k->nama_kriteria }}</td>
                <td>{{ $k->sifat }}</td>
                <td>{{ $k->bobot }}</td>
                <td>
                    <a href="{{ route('kriteria.edit', $k) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('kriteria.destroy', $k) }}" method="POST" style="display:inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"
                                onclick="return confirm('Yakin hapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <p><strong>Total Bobot:</strong> {{ $totalBobot }}</p>
    @if(abs($totalBobot - 1) > 0.001)
        <div class="alert alert-warning">Total bobot tidak 1, harap perbaiki.</div>
    @endif
</div>
@endsection