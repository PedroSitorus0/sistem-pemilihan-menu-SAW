@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Tambah Kriteria</h2>

    <form action="{{ route('kriteria.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Kode Kriteria</label>
            <input type="text" name="kode_kriteria" class="form-control"
                   maxlength="2" value="{{ old('kode_kriteria') }}" required>
            @error('kode_kriteria')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label>Nama Kriteria</label>
            <input type="text" name="nama_kriteria" class="form-control"
                   value="{{ old('nama_kriteria') }}" required>
            @error('nama_kriteria')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label>Sifat</label>
            <select name="sifat" class="form-control" required>
                <option value="cost" {{ old('sifat') == 'cost' ? 'selected' : '' }}>Cost</option>
                <option value="benefit" {{ old('sifat') == 'benefit' ? 'selected' : '' }}>Benefit</option>
            </select>
            @error('sifat')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label>Bobot (0 – 1)</label>
            <input type="number" name="bobot" class="form-control"
                   step="0.01" min="0" max="1" value="{{ old('bobot') }}" required>
            @error('bobot')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="{{ route('kriteria.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection