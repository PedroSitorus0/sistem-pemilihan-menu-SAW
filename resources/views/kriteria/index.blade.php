<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Data Kriteria') }}
        </h2>
    </x-slot>

    <style>
        .dt-length select {
            padding-right: 2.5rem !important;
            background-position: right 0.5rem center !important;
            width: auto !important;
        }
    </style>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold">Daftar Kriteria</h3>
                        <a href="{{ route('kriteria.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition">
                            + Tambah Kriteria
                        </a>
                    </div>

                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-700 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="overflow-x-auto">
                        <table id="table" class="w-full text-sm text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3">Kode</th>
                                    <th class="px-6 py-3">Nama</th>
                                    <th class="px-6 py-3">Sifat</th>
                                    <th class="px-6 py-3">Bobot</th>
                                    <th class="px-6 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($kriteria as $k)
                                <tr class="bg-white border-b">
                                    <td class="px-6 py-4 font-medium text-gray-900">{{ $k->kode_kriteria }}</td>
                                    <td class="px-6 py-4">{{ $k->nama_kriteria }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2 py-1 rounded {{ strtolower($k->sifat) == 'benefit' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ ucfirst($k->sifat) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4">{{ $k->bobot }}</td>
                                    <td class="px-6 py-4 flex gap-2">
                                        <a href="{{ route('kriteria.edit', $k->id) }}" class="text-blue-600 hover:underline">Edit</a>
                                        <form action="{{ route('kriteria.destroy', $k->id) }}" method="POST" onsubmit="return confirm('Yakin hapus kriteria ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6 p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <p class="text-md font-semibold">Total Bobot: 
                            <span class="{{ abs($totalBobot - 1) > 0.001 ? 'text-red-600' : 'text-green-600' }}">
                                {{ $totalBobot }}
                            </span>
                        </p>
                        
                        @if(abs($totalBobot - 1) > 0.001)
                            <div class="mt-2 p-3 bg-yellow-50 text-yellow-800 border-l-4 border-yellow-400 text-sm">
                                <strong>Perhatian:</strong> Total bobot harus bernilai 1. Mohon sesuaikan kembali.
                            </div>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>