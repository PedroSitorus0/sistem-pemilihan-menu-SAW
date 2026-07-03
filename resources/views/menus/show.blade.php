<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Menu') }}
            </h2>
            <a href="{{ route('menus.edit', $menu->id) }}" class="text-sm bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded shadow">
                Edit Menu Ini
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                
                <div class="pt-6 pb-12">
                    <nav aria-label="Breadcrumb">
                        <ol role="list" class="mx-auto flex max-w-2xl items-center space-x-2 px-4 sm:px-6 lg:max-w-7xl lg:px-8">
                            <li>
                                <div class="flex items-center">
                                    <a href="{{ route('menus.index') }}" class="mr-2 text-sm font-medium text-gray-900 hover:text-indigo-600">Menus</a>
                                    <svg viewBox="0 0 16 20" width="16" height="20" fill="currentColor" aria-hidden="true" class="h-5 w-4 text-gray-300">
                                        <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
                                    </svg>
                                </div>
                            </li>
                            <li>
                                <div class="flex items-center">
                                    <span class="mr-2 text-sm font-medium text-gray-900">{{ $menu->kategori }}</span>
                                    <svg viewBox="0 0 16 20" width="16" height="20" fill="currentColor" aria-hidden="true" class="h-5 w-4 text-gray-300">
                                        <path d="M5.697 4.34L8.98 16.532h1.327L7.025 4.341H5.697z" />
                                    </svg>
                                </div>
                            </li>
                            <li class="text-sm">
                                <span aria-current="page" class="font-medium text-gray-500">{{ $menu->nama_menu }}</span>
                            </li>
                        </ol>
                    </nav>

                    <div class="mx-auto mt-6 max-w-2xl sm:px-6 lg:max-w-7xl lg:px-8">
                        <div class="w-full bg-gray-50 rounded-lg overflow-hidden flex items-center justify-center shadow-inner border border-gray-100">
                            @if($menu->foto)
                                <img src="{{ asset('storage/' . $menu->foto) }}" alt="{{ $menu->nama_menu }}" class="w-full max-h-[500px] object-contain object-center p-2 sm:p-4" />
                            @else
                                <div class="w-full h-64 sm:h-96 flex flex-col items-center justify-center text-gray-400">
                                    <svg class="mx-auto h-12 w-12 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path vector-effect="non-scaling-stroke" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <p class="mt-2 text-sm font-semibold">Tidak ada foto</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="mx-auto max-w-2xl px-4 pt-10 pb-16 sm:px-6 lg:grid lg:max-w-7xl lg:grid-cols-3 lg:grid-rows-[auto_auto_1fr] lg:gap-x-8 lg:px-8 lg:pt-16 lg:pb-24">
                        <div class="lg:col-span-2 lg:border-r lg:border-gray-200 lg:pr-8">
                            <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">{{ $menu->nama_menu }}</h1>
                        </div>

                        <div class="mt-4 lg:row-span-3 lg:mt-0">
                            <h2 class="sr-only">Product information</h2>
                            <p class="text-3xl tracking-tight text-gray-900">Rp {{ number_format($menu->harga, 0, ',', '.') }}</p>

                            <div class="mt-10">
                                <h3 class="text-sm font-medium text-gray-900">Kategori</h3>
                                <div class="mt-3">
                                    <span class="inline-flex items-center rounded-md bg-blue-50 px-3 py-1.5 text-sm font-medium text-blue-700 ring-1 ring-inset ring-blue-700/10 uppercase">
                                        {{ $menu->kategori }}
                                    </span>
                                </div>
                            </div>

                            <div class="mt-8">
                                <h3 class="text-sm font-medium text-gray-900">Status Ketersediaan</h3>
                                <div class="mt-3">
                                    @php
                                        $statusColor = match($menu->ketersediaan) {
                                            'tersedia' => 'bg-green-50 text-green-700 ring-green-600/20',
                                            'tidak tersedia' => 'bg-red-50 text-red-700 ring-red-600/10',
                                            default => 'bg-gray-50 text-gray-600 ring-gray-500/10',
                                        };
                                    @endphp
                                    <span class="inline-flex items-center rounded-md px-3 py-1.5 text-sm font-medium ring-1 ring-inset {{ $statusColor }} uppercase">
                                        {{ $menu->ketersediaan }}
                                    </span>
                                </div>
                            </div>

                            <a href="{{ route('menus.index') }}" class="mt-10 flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-8 py-3 text-base font-medium text-white hover:bg-indigo-700 focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:outline-hidden transition-colors">
                                Kembali ke Daftar Menu
                            </a>
                        </div>

                        <div class="py-10 lg:col-span-2 lg:col-start-1 lg:border-r lg:border-gray-200 lg:pt-6 lg:pr-8 lg:pb-16">
                            
                            <div>
                                <h3 class="sr-only">Description</h3>
                                <div class="space-y-6">
                                    <p class="text-base text-gray-900 leading-relaxed">
                                        {{ $menu->deskripsi ?: 'Tidak ada deskripsi rinci untuk menu ini.' }}
                                    </p>
                                </div>
                            </div>

                            <div class="mt-10 border-t border-gray-100 pt-10">
                                <h3 class="text-sm font-medium text-gray-900">System Records</h3>
                                <div class="mt-4">
                                    <ul role="list" class="list-disc space-y-2 pl-4 text-sm">
                                        <li class="text-gray-400">
                                            <span class="text-gray-600 font-semibold">Dibuat pada:</span> 
                                            <span class="text-gray-600 ml-1">{{ $menu->created_at ? $menu->created_at->format('d F Y, H:i') : '-' }}</span>
                                        </li>
                                        <li class="text-gray-400">
                                            <span class="text-gray-600 font-semibold">Pembaruan terakhir:</span> 
                                            <span class="text-gray-600 ml-1">{{ $menu->updated_at ? $menu->updated_at->format('d F Y, H:i') : '-' }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>