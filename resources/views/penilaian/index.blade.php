<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Katalog Penilaian Menu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="mb-8">
                <h2 class="text-3xl font-extrabold tracking-tight text-gray-900">Daftar Menu</h2>
                <p class="mt-2 text-sm text-gray-500">Pilih menu di bawah ini untuk melihat detail dan memberikan penilaian kriteria.</p>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 xl:gap-x-8">
                @foreach($menus as $menu)
                    <a href="{{ route('penilaian.show', $menu->id) }}" class="group">
                        <div class="aspect-square w-full overflow-hidden rounded-xl bg-gray-200">
                            @if($menu->foto)
                                <img src="{{ asset('storage/' . $menu->foto) }}" alt="{{ $menu->nama_menu }}" class="h-full w-full object-cover object-center group-hover:opacity-75 transition duration-300">
                            @else
                                <div class="h-full w-full flex items-center justify-center text-gray-400">Tidak ada foto</div>
                            @endif
                        </div>
                        
                        <div class="mt-4 flex justify-between items-start">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">{{ $menu->nama_menu }}</h3>
                                @if($penilaian->where('menu_id', $menu->id)->count() > 0)
                                    <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20 mt-1">Sudah Dinilai</span>
                                @else
                                    <span class="inline-flex items-center rounded-md bg-yellow-50 px-2 py-1 text-xs font-medium text-yellow-800 ring-1 ring-inset ring-yellow-600/20 mt-1">Belum Dinilai</span>
                                @endif
                            </div>
                            <p class="text-md font-medium text-indigo-600">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>
                        </div>
                    </a>
                @endforeach
            </div>

            <div class="mt-12 flex justify-center">
                @if ($menus->hasPages())
                    <nav aria-label="Page navigation">
                        <ul class="flex -space-x-px text-sm">
                            
                            <li>
                                @if ($menus->onFirstPage())
                                    <span class="flex items-center justify-center text-gray-400 bg-gray-50 border border-gray-300 rounded-s-md text-sm w-10 h-10 cursor-not-allowed">
                                        <span class="sr-only">Previous</span>
                                        <svg class="w-4 h-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7"/></svg>
                                    </span>
                                @else
                                    <a href="{{ $menus->previousPageUrl() }}" class="flex items-center justify-center text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-900 rounded-s-md text-sm w-10 h-10 transition">
                                        <span class="sr-only">Previous</span>
                                        <svg class="w-4 h-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m15 19-7-7 7-7"/></svg>
                                    </a>
                                @endif
                            </li>

                            @foreach ($menus->links()->elements[0] as $page => $url)
                                <li>
                                    @if ($page == $menus->currentPage())
                                        <span aria-current="page" class="flex items-center justify-center text-indigo-600 bg-indigo-50 border border-indigo-300 font-bold text-sm w-10 h-10">
                                            {{ $page }}
                                        </span>
                                    @else
                                        <a href="{{ $url }}" class="flex items-center justify-center text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-900 font-medium text-sm w-10 h-10 transition">
                                            {{ $page }}
                                        </a>
                                    @endif
                                </li>
                            @endforeach

                            <li>
                                @if ($menus->hasMorePages())
                                    <a href="{{ $menus->nextPageUrl() }}" class="flex items-center justify-center text-gray-700 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-900 rounded-e-md text-sm w-10 h-10 transition">
                                        <span class="sr-only">Next</span>
                                        <svg class="w-4 h-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/></svg>
                                    </a>
                                @else
                                    <span class="flex items-center justify-center text-gray-400 bg-gray-50 border border-gray-300 rounded-e-md text-sm w-10 h-10 cursor-not-allowed">
                                        <span class="sr-only">Next</span>
                                        <svg class="w-4 h-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24"><path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m9 5 7 7-7 7"/></svg>
                                    </span>
                                @endif
                            </li>
                            
                        </ul>
                    </nav>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>