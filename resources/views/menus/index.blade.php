<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Menu') }}
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
                        <h3 class="text-lg font-bold">Data Menu</h3>
                        <a href="{{ route('menus.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                            + Tambah Menu
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
                                    <th class="px-6 py-3">Nama Menu</th>
                                    <th class="px-6 py-3">Kategori</th>
                                    <th class="px-6 py-3">Harga</th>
                                    <th class="px-6 py-3">Status</th>
                                    <th class="px-6 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($menus as $menu)
                                <tr class="bg-white border-b">
                                    <td class="px-6 py-4 font-medium text-gray-900">{{ $menu->nama_menu }}</td>
                                    <td class="px-6 py-4">{{ $menu->kategori }}</td>
                                    <td class="px-6 py-4">Rp {{ number_format($menu->harga, 0, ',', '.') }}</td>
                                    <td class="px-6 py-4">{{ ucfirst($menu->ketersediaan) }}</td>
                                    <td class="px-6 py-4 flex gap-2">
                                        <a href="{{ route('menus.edit', $menu->id) }}" class="text-blue-600 hover:underline">Edit</a>
                                        <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" onsubmit="return confirm('Hapus menu ini?');">
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
                    </div>
            </div>
        </div>
    </div>
</x-app-layout>