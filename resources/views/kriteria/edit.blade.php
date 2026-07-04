@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Edit Kriteria</h2>

    <form action="{{ route('kriteria.update', $kriterium) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Kode Kriteria</label>
            <input type="text" name="kode_kriteria" class="form-control"
                   maxlength="2" value="{{ old('kode_kriteria', $kriterium->kode_kriteria) }}" readonly>
            @error('kode_kriteria')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label>Nama Kriteria</label>
            <input type="text" name="nama_kriteria" class="form-control"
                   value="{{ old('nama_kriteria', $kriterium->nama_kriteria) }}" required>
            @error('nama_kriteria')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label>Sifat</label>
            <select name="sifat" class="form-control" required>
                <option value="cost" {{ old('sifat', $kriterium->sifat) == 'cost' ? 'selected' : '' }}>Cost</option>
                <option value="benefit" {{ old('sifat', $kriterium->sifat) == 'benefit' ? 'selected' : '' }}>Benefit</option>
            </select>
            @error('sifat')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <div class="mb-3">
            <label>Bobot (0 – 1)</label>
            <input type="number" name="bobot" class="form-control"
                   step="0.01" min="0" max="1" value="{{ old('bobot', $kriterium->bobot) }}" required>
            @error('bobot')
                <small class="text-danger">{{ $message }}</small>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Perbarui</button>
        <a href="{{ route('kriteria.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection