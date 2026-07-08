<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Proses Perhitungan SAW') }}
        </h2>
    </x-slot>
 
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">1. Matriks Keputusan (Nilai Rata-Rata)</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 border">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                                <tr>
                                    <th class="px-4 py-3 border">Alternatif / Menu</th>
                                    @foreach($kriteria as $k)
                                        <th class="px-4 py-3 border text-center" title="{{ $k->nama_kriteria }}">{{ $k->kode_kriteria }} ({{ ucfirst($k->sifat) }})</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($menus as $menu)
                                <tr class="border-b">
                                    <td class="px-4 py-3 font-medium text-gray-900 border">{{ $menu->nama_menu }}</td>
                                    @foreach($kriteria as $k)
                                        <td class="px-4 py-3 border text-center">{{ number_format($matriks[$menu->id][$k->id] ?? 0, 2) }}</td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">2. Matriks Normalisasi</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 border">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-100">
                                <tr>
                                    <th class="px-4 py-3 border">Alternatif / Menu</th>
                                    @foreach($kriteria as $k)
                                        <th class="px-4 py-3 border text-center">R ({{ $k->kode_kriteria }})</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($menus as $menu)
                                <tr class="border-b">
                                    <td class="px-4 py-3 font-medium text-gray-900 border">{{ $menu->nama_menu }}</td>
                                    @foreach($kriteria as $k)
                                        <td class="px-4 py-3 border text-center">{{ number_format($normalisasi[$menu->id][$k->id] ?? 0, 3) }}</td>
                                    @endforeach
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-bold mb-4">3. Hasil Akhir (Perangkingan)</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 border">
                            <thead class="text-xs text-white uppercase bg-indigo-600">
                                <tr>
                                    <th class="px-4 py-3 border text-center w-24">Peringkat</th>
                                    <th class="px-4 py-3 border">Nama Menu</th>
                                    <th class="px-4 py-3 border text-center">Skor Akhir (V)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($hasil as $item)
                                <tr class="border-b {{ $item['peringkat'] == 1 ? 'bg-yellow-50 font-bold' : '' }}">
                                    <td class="px-4 py-3 border text-center text-lg text-indigo-600">{{ $item['peringkat'] }}</td>
                                    <td class="px-4 py-3 font-medium text-gray-900 border">{{ $item['menu']->nama_menu }}</td>
                                    <td class="px-4 py-3 border text-center">{{ number_format($item['skor'], 4) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>